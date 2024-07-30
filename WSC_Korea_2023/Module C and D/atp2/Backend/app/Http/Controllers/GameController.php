<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Score;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    // API
    public function get_games(Request $request)
    {
        $page = intval($request->page ?? 0);
        $size = intval($request->size ?? 10);
        $sort_by = $request->sortBy ?? 'title';
        $sort_dir = $request->sortDir ?? 'asc';

        // $page = $request->input('page', 0);
        // $size = $request->input('size', 10);
        // $sort_by = $request->input('sortBy', 'title');
        // $sort_dir = $request->input('sortDir', 'asc');

        $sort_by_opt = ['title', 'popular', 'uploaddate'];
        $sort_dir_opt = ['asc', 'desc'];

        $response = array();

        if ($page < 0 || $size < 1 || !in_array($sort_by, $sort_by_opt) || !in_array($sort_dir, $sort_dir_opt)) {
            $response['status'] = 'invalid';
            $response['message'] = 'Request body is not valid';
            $response['violations'] = array();

            if ($page < 0) {
                array_push($response['violations'], ['page' => ['message' => 'Must be greater than or equal to 0']]);
            }

            if ($size < 1) {
                array_push($response['violations'], ['size' => ['message' => 'Must be greater than or equal to 1']]);
            }

            if (!in_array($sort_by, $sort_by_opt)) {
                array_push($response['violations'], ['sortBy' => ['message' => "Must be one of 'title', 'popular', 'uploaddate'"]]);
            }

            if (!in_array($sort_dir, $sort_dir_opt)) {
                array_push($response['violations'], ['sortDir' => ['message' => "Must be one of 'asc', 'desc'"]]);
            }

            return response()->json($response, 400);
        }

        // $games = Game::where('deleted', false)->whereHas('versions')->get();
        $game_query = Game::where('deleted', false)->whereHas('versions');

        if ($sort_by == 'title') {
            $game_query->orderBy($sort_by, $sort_dir);
        } elseif ($sort_by == 'popular') {
        } elseif ($sort_by == 'uploaddate') {
            $game_query->select('games.*')->orderBy(DB::raw('(SELECT MAX(version_time) FROM versions WHERE versions.game_id = games.id)'), $sort_dir);
            // $game_query->with('versions')->orderBy(Version::select('version_time')->whereColumn('games.id', 'versions.game_id')->latest()->take(1), $sort_dir);
        }

        dd($game_query->get());


        // $total_elements = count($games);
        // $page_count = ceil($total_elements / $size);
        // $is_last_page = ($page + 1) * $size >= $total_elements;

        // // Last page
        // if ($is_last_page || $page > $page_count) {
        //     $response['page'] = $page_count;
        //     $size = $total_elements % $size;
        //     dd($size); 
        // } else {

        // }

        // dd(count($games));

    }
}
