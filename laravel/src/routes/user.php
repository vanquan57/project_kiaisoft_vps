<?php

use App\Http\Controllers\Api\V1\User\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\User\FeedbackController;
use App\Http\Controllers\Api\V1\User\AuthorController;
use App\Http\Controllers\Api\V1\User\CategoryController;
use App\Http\Controllers\Api\V1\User\PublisherController;
use App\Http\Controllers\Api\V1\User\BookController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/google/callback', [AuthController::class, 'loginGoogle']);
            Route::post('/google/callback/register', [AuthController::class, 'registerGoogle']);
            Route::post('/verify-email', [AuthController::class, 'sendEmail']);
            Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
            Route::group(['middleware' => 'authentication.user'], function () {
                Route::put('/change-password', [AuthController::class, 'changePassword']);
            });
        });
        Route::group(['middleware' => 'authentication.user'], function () {
            Route::get('profile', [UserController::class, 'show']);
            Route::put('profile', [UserController::class, 'update']);
            Route::post('/feedback', [FeedbackController::class, 'store']);
        });
        Route::get('/feedbacks', [FeedbackController::class, 'getFeedbacksByBookId']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('publishers', [PublisherController::class, 'index']);
        Route::get('authors', [AuthorController::class, 'index']);
        Route::get('book', [BookController::class, 'index']);
        Route::get('book/{id}', [BookController::class, 'show']);
        Route::put('book/{id}', [BookController::class, 'updateBookViewCount']);
    });
});
