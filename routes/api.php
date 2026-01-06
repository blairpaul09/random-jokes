<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JokeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/me', [AuthController::class, 'me'])->name('auth.me');;
    });
});


Route::get('random-jokes', [JokeController::class, 'random'])->name('get.random-jokes')->middleware('auth:sanctum');
