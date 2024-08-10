<?php

use App\Http\Controllers\Api\Auth\SigninController;
use App\Http\Controllers\Api\Auth\SignoutController;
use App\Http\Controllers\Api\Auth\SignupController;
use App\Http\Controllers\Api\Games\ScoresController;
use App\Http\Controllers\Api\GamesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/v1')->middleware('json.response')->group(function () {
    Route::apiResource('auth/signup', SignupController::class);
    Route::apiResource('auth/signin', SigninController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('auth/signout', SignoutController::class);
        Route::apiResource('games', GamesController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('games.scores', ScoresController::class)->only(['store', 'update', 'destroy']);

        Route::get('users/{user:username}', [UsersController::class, 'show']);
    });

    Route::apiResource('games', GamesController::class)->only(['index', 'show']);
    Route::apiResource('games.scores', ScoresController::class)->only(['index', 'show']);
});
