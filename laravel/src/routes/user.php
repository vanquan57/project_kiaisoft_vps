<?php

use App\Http\Controllers\Api\V1\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/google/callback', [AuthController::class, 'loginGoogle']);
            Route::post('/google/callback/register', [AuthController::class, 'registerGoogle']);
        });
    });
});
