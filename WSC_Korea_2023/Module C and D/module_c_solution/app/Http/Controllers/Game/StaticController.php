<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class StaticController extends Controller
{
    public function index(Game $game, string $path)
    {
        if (str_contains($path, '..')) {
            return response('Invalid path', 400);
        }

        return Storage::disk('local')->response($game->latestVersion->storage_path.'/'.$path);
    }
}
