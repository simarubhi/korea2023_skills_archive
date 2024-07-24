<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class GameController extends Controller
{
    public function page(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->first();
        
        return view('game', ['game' => $game]);
    }

    public function delete(Request $request, $id)
    {
        $game = Game::find($id);

        $game->deleted = true;
        $game->save();

        return redirect()->back();
    }

    public function restore(Request $request, $id)
    {
        $game = Game::find($id);

        $game->deleted = false;
        $game->save();

        return redirect()->back();
    }

    public function get_thumbnail(Request $request, $id)
    {
        $game = Game::find($id);

        $thumbnail_path = $game->thumbnail;

        if (!isset($thumbnail_path)) {
            $versions = $game->versions;
            
            for ($i = count($versions) - 1; $i > 0; $i--) {
                if (Storage::disk('local')->exists($versions[$i]->path . '/thumbnail.png')) {
                    $game->thumbnail = $versions[$i]->path . '/thumbnail.png';
                    $game->save();

                    $thumbnail_path = $versions[$i]->path . '/thumbnail.png';
                    return Storage::download($thumbnail_path);
                }
            }
        }

        if (isset($thumbnail_path)) {
            return Storage::download($thumbnail_path);
        } else {
            return $thumbnail_path; // null
        }

    }

    public function delete_all_scores_game(Request $request, $game_id)
    {
        $game = Game::find($game_id);

        $versions = $game->versions;
        
        foreach ($versions as $version) {
            $scores = $version->scores;
            foreach ($scores as $score) {
                $score->delete();
            }
        }
        
        return redirect()->back();
    }

    public function delete_all_game_scores_user(Request $request, $user_id, $game_id)
    {
        $user = User::find($user_id);

        $user->scores()->whereHas('version', function (Builder $query) use ($game_id) {
            $query->where('game_id', $game_id);
        })->delete();

        return redirect()->back();
    }

    public function delete_all_scores_user(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $scores = $user->scores;

        foreach ($scores as $score) {
            $score->delete();
        }
        
        return redirect()->back();
    }

    public function delete_score(Request $request, $game_id, $score_id)
    {
        $score = Score::find($score_id);

        $score->delete();

        return redirect()->back();
    }
}
