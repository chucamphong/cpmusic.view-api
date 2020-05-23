<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/bai-hat/{song}', 'SongController@listen')
    ->where('song', '[0-9]+')
    ->name('song.listen');
