<?php

use App\Http\Controllers\AdminController;
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
    
});

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin-login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');