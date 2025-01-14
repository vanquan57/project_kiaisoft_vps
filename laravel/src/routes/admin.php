<?php

use App\Http\Controllers\Api\V1\Admin\AuthController;
use App\Http\Controllers\Api\V1\Admin\EmployeeCodeController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });

    Route::group(['middleware' => 'authentication.admin'], function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('user', [UserController::class, 'index']);
            Route::put('user/{id}', [UserController::class, 'update']);
            Route::get('employees', [EmployeeCodeController::class, 'index']);
            Route::post('employees', [EmployeeCodeController::class, 'store']);
        });
    });
});
