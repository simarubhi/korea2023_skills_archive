<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

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
    redirect('/admin');
});


Route::middleware('guest:admin')->get('/admin', function() {
    return view('login');
})->name('login-form');

Route::middleware('admin')->get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

Route::post('/admin/login', [AdminController::class, 'login'])->name('login');