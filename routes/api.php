<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', 'UserController');

    Route::apiResource('songs', 'SongController');

    Route::apiResource('artists', 'ArtistController');

    Route::post('upload', 'UploadController@upload')->name('upload');
});

Route::apiResource('categories', 'CategoryController');
