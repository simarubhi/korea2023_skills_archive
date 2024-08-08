<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function delete($id)
    {
        $game = Game::find($id);
        $game->delete();

        return back();
    }
}
