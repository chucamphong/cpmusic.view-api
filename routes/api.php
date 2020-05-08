<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', 'UserController');

    Route::apiResource('songs', 'SongController');

    Route::apiResource('artists', 'ArtistController');

    Route::apiResource('categories', 'CategoryController');

    Route::post('upload', 'UploadController@upload');
});
