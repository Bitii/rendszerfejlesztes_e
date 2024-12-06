<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users/login', [UsersController::class, 'login']);

Route::post('/users/logout', [UsersController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::post('/users/register', [UsersController::class, 'register']);

Route::post('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/movies', function () {
    return [];
});

Route::post('/movie-info', [UsersController::class, 'updateMovieInfo']);

Route::get('/movie-info/{user_id}', [UsersController::class, 'getMovieInfo']);








?>