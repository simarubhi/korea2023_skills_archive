<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'integer|min:0',
            'size' => 'integer|min:1',
            'sortBy' => 'in:title,popular,uploaddate',
            'sortDir' => 'in:asc,desc',
        ]);

        $page = (int) $request->get('page', 0);
        $size = (int) $request->get('size', 10);
        $sortBy = $request->get('sortBy', 'title');
        $sortDir = $request->get('sortDir', 'asc');

        $sortByColumn = 'title';
        if ($sortBy === 'uploaddate') {
            $sortByColumn = 'game_versions.created_at';
        } else if ($sortBy === 'popular') {
            $sortByColumn = 'scoreCount';
        }

        $games = Game::select('games.*',
                DB::raw('(SELECT COUNT(DISTINCT scores.user_id) FROM scores LEFT JOIN game_versions ON game_versions.id = scores.game_version_id WHERE game_versions.game_id = games.id) as scoreCount')
            )
            ->leftJoin('game_versions', function ($join) {
                $join->on('games.id', '=', 'game_versions.game_id')->where('game_versions.deleted_at', null);
            })
            ->whereNotNull('game_versions.game_id')
            ->skip($page * $size)
            ->take($size)
            ->orderBy($sortByColumn, $sortDir)
            ->groupBy('games.id')
            ->get();

        return [
            'page' => $page,
            'size' => count($games),
            'totalElements' => GameVersion::count(),
            'content' => $games->map(function ($game) {
                return collect($game)->except(['latest_version', 'game_author', 'game_path', 'gamePath']);
            }),
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:60',
            'description' => 'required|min:0|max:200',
        ]);

        $slug = Str::slug($request->get('title'));

        if (Game::where('slug', $slug)->first()) {
            return response()->json([
                'status' => 'invalid',
                'slug' => 'Game title already exists',
            ], 400);
        }

        $game = new Game();
        $game->title = $request->get('title');
        $game->slug = $slug;
        $game->description = $request->get('description');
        $game->created_by = $request->user()->id;
        $game->save();

        return response()->json([
            'status' => 'success',
            'slug' => $slug,
        ], 201);
    }

    public function show(Game $game)
    {
        return collect($game)->except(['latest_version', 'game_author']);
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'min:3|max:60',
            'description' => 'min:0|max:200',
        ]);

        if ($game->created_by !== $request->user()->id) {
            return response()->json([
                'status' => 'forbidden',
                'message' => 'You are not the game author',
            ], 403);
        }

        $game->title = $request->get('title', $game->title);
        $game->description = $request->get('description', $game->description);
        $game->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function destroy(Request $request, Game $game)
    {
        if ($game->created_by !== $request->user()->id) {
            return response()->json([
                'status' => 'forbidden',
                'message' => 'You are not the game author',
            ], 403);
        }

        foreach ($game->versions as $version) {
            $versionScores = Score::where('game_version_id', $version->id)->get();
            foreach ($versionScores as $versionScore) {
                $versionScore->delete();
            }
            $version->delete();
        }

        $game->delete();

        return response('', 204);
    }
}
