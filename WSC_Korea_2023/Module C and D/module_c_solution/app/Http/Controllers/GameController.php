<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index', ['games' => Game::withTrashed()->get()]);
    }

    public function show(Game $game)
    {
        return view('game.detail', ['game' => $game]);
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->back();
    }
}
