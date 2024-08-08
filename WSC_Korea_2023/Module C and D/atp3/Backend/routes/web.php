<?php

use App\Models\Game;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;

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



Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('/admin');
    });
    Route::get('/admin', function () {
        return view('admin.login');
    })->name('admin-login-form');
    
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin-login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        return view('admin.dashboard', [
            'admins' => Admin::all(),
            'users' => User::withTrashed()->get(),
            'games' => Game::withTrashed()->get(),
        ]);
    })->name('admin-dashboard');

    Route::get('user/{username}', function ($username) {
        return view('user-page', ['user' => User::where('username', $username)->firstOrFail()]);
    })->name('user-page');

    Route::delete('user/{id}/block', [UserController::class, 'block'])->name('user-block');
    Route::post('user/{id}/unblock', [UserController::class, 'unblock'])->name('user-unblock');

    Route::get('game/{slug}', function ($slug) {
        return view('game-page', ['game' => Game::where('slug', $slug)->firstOrFail()]);
    })->name('game-page');

    Route::delete('game/{id}/delete', [GameController::class, 'delete'])->name('game-delete');


    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');
});

