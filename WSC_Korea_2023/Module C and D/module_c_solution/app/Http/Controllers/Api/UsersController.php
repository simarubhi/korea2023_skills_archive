<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function show(User $user, Request $request)
    {
        $authoredGames = Game::leftJoin('game_versions', function ($join) {
                $join->on('games.id', '=', 'game_versions.game_id')->where('game_versions.deleted_at', null);
            })->where('created_by', $user->id);

        if ($user->id !== $request->user()->id) {
            $authoredGames = $authoredGames->whereNotNull('game_versions.id');
        }

        $authoredGames = $authoredGames->get()->map(function ($game) {
            return collect($game)->only(['slug', 'title', 'description']);
        });

        $highscores = Score::select('scores.*', 'game_versions.game_id as game_id', DB::raw('MAX(score) AS max_score'))
            ->leftJoin('game_versions', 'game_versions.id', 'scores.game_version_id')
            ->leftJoin('users', 'users.id', 'scores.user_id')
            ->where('user_id', $user->id)
            ->whereNull('users.deleted_at')
            ->whereNotNull('game_versions.game_id')
            ->groupBy('game_versions.game_id')
            ->get()
            ->map(function ($highscore) {
                return [
                    'game' => [
                        'slug' => $highscore->gameVersion->game->slug,
                        'title' => $highscore->gameVersion->game->title,
                        'description' => $highscore->gameVersion->game->description,
                    ],
                    'score' => $highscore->max_score,
                    'timestamp' => Score::leftJoin('game_versions', 'game_versions.id', 'scores.game_version_id')->where('user_id', $highscore->user_id)->where('game_versions.game_id', $highscore->game_id)->orderBy('score', 'desc')->first()->created_at,
                ];
            });

        return [
            'username' => $user->username,
            'registeredTimestamp' => $user->created_at,
            'authoredGames' => $authoredGames,
            'highscores' => $highscores,
        ];
    }
}
