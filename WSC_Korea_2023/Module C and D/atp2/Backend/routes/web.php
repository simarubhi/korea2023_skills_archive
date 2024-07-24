<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('guest:admin')->group(function () {
    Route::get('/admin', function () {
        return view('login');
    })->name('admin-login-view');
    
    Route::get('/', function () {
        return redirect('/admin');
    });    

});

Route::middleware('auth:admin')->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user/{username}', [AdminController::class, 'user'])->name('user-profile');

    Route::post('user/{id}/block', [AdminController::class, 'user_block'])->name('user-block');
    Route::post('user/{id}/unblock', [AdminController::class, 'user_unblock'])->name('user-unblock');

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');

    Route::get('/game/{slug}', [GameController::class, 'page'])->name('game-page');
    Route::post('/game/{id}/delete', [GameController::class, 'delete'])->name('game-delete');
    Route::post('/game/{id}/restore', [GameController::class, 'restore'])->name('game-restore');

    Route::get('/game/{id}/thumbnail', [GameController::class, 'get_thumbnail'])->name('game-thumbnail');

    Route::delete('/game/{game_id}/score/{score_id}', [GameController::class, 'delete_score'])->name('score-delete');
    Route::delete('/game/{game_id}/score', [GameController::class, 'delete_all_scores_game'])->name('game-score-delete');
    Route::delete('user/{id}/scores', [GameController::class, 'delete_all_scores_user'])->name('user-delete-scores');
    Route::delete('user/{id}/game/{game_id}/scores', [GameController::class, 'delete_all_game_scores_user'])->name('user-delete-game-scores');
});

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin-login');