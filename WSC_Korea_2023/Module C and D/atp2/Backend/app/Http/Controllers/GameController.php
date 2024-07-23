<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
