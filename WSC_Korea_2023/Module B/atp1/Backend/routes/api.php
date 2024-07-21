<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::post('signup', 'signup');
            Route::post('signin', 'signin');
            Route::post('signout', 'signout');
        });


    });

});