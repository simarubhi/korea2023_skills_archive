<?php

namespace App\Http\Controllers\Api\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;
use ZipArchive;

class UploadController extends Controller
{
    public function store(Game $game, Request $request)
    {
        $request->validate([
            'zipfile' => 'required|file',
            'token' => 'required',
        ]);

        $token = PersonalAccessToken::findToken($request->get('token'));
        if (!$token) {
            return response('Unauthorized', 401);
        }

        $user = $token->tokenable;
        if ($user->id !== $game->created_by) {
            return response('A game can only be updated by the author', 403);
        }

        $version = 'v1';

        if ($game->latestVersion) {
            $version = 'v'.((int) substr($game->latestVersion->version, 1)) + 1;
        }

        $zip = new ZipArchive();
        if (!$zip->open($request->file('zipfile')->getRealPath())) {
            return response('ZIP file cannot be opened', 400);
        }

        $storagePath = 'games/'.$game->id.'/'.$version;
        $absolutePath = Storage::disk('local')->path($storagePath);
        if (!Storage::disk('local')->exists($storagePath)) {
            try {
                if (!Storage::makeDirectory($storagePath, 0755, true)) {
                    return response('Storage path ('.$storagePath.') cannot be created', 500);
                }
            } catch (\Exception $e) {
                return response('Storage path ('.$storagePath.') cannot be created', 500);
            }
        }

        $zip->extractTo($absolutePath);
        $zip->close();

        // delete old versions
        foreach (GameVersion::where('game_id', $game->id)->get() as $oldGameVersion) {
            $oldGameVersion->delete();
        }

        $gameVersion = new GameVersion();
        $gameVersion->game_id = $game->id;
        $gameVersion->version = $version;
        $gameVersion->storage_path = $storagePath.'/';
        $gameVersion->save();

        return response('Upload successful', 201);
    }
}
