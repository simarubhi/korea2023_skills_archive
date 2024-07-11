<?php

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::get('/', function () {
    return redirect('/admin');
});


Route::middleware('guest:admin')->get('/admin', function() {
    return view('login');
})->name('login-form');

Route::middleware('admin')->get('/dashboard', function() {
    return view('dashboard', [
        'admins' => Admin::all(),
        'users' => User::all(),
    ]);
})->name('dashboard');

Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');

Route::put('/users/unblock', [AdminController::class, 'unblock_user'])->name('unblock');
Route::put('/users/block', [AdminController::class, 'block_user'])->name('block');