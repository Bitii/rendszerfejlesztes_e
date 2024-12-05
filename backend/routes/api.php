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
    return [
        [
            "title" => "Looney Tunes",
            "description" => "A classic cartoon featuring Bugs Bunny and friends.",
            "poster" => "https://example.com/posters/looney-tunes.jpg"
        ],
        [
            "title" => "Tom and Jerry",
            "description" => "A humorous series about the rivalry between a cat and a mouse.",
            "poster" => "https://example.com/posters/tom-and-jerry.jpg"
        ],
        [
            "title" => "The Lion King",
            "description" => "A story about the journey of Simba, a lion cub.",
            "poster" => "https://example.com/posters/lion-king.jpg"
        ]
    ];
});


?>