<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', 'UserController');

    Route::apiResource('songs', 'SongController');

    Route::post('upload', 'UploadController@upload')->name('upload');
});

Route::apiResource('artists', 'ArtistController');

Route::apiResource('categories', 'CategoryController');
