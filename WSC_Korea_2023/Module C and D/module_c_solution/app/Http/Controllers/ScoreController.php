<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function destroy(Score $score, Request $request)
    {
        $request->validate([
            'scope' => 'required|in:single,all'
        ]);

        if ($request->get('scope') === 'single') {
            $score->delete();
        } else if ($request->get('scope') === 'all') {
            $userScores = Score::select('scores.*')
                ->leftJoin('game_versions', 'game_versions.id', 'scores.game_version_id')
                ->where('game_versions.game_id', $score->gameVersion->game->id)
                ->where('user_id', $score->user_id)
                ->get();
            foreach ($userScores as $userScore) {
                $userScore->delete();
            }
        }

        return redirect()->back();
    }

    public function destroyGame(Game $game)
    {
        $gameScores = Score::select('scores.*')
            ->leftJoin('game_versions', 'game_versions.id', 'scores.game_version_id')
            ->where('game_versions.game_id', $game->id)->get();
        foreach ($gameScores as $gameScore) {
            $gameScore->delete();
        }

        return redirect()->back();
    }
}
