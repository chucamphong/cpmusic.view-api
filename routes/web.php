<?php

use Illuminate\Support\Facades\Route;

// Vô hiệu hóa chức năng "Đặt lại mật khẩu"
Auth::routes(['reset' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/bai-hat/{song}', 'SongController@listen')
    ->where('song', '[0-9]+')
    ->name('song.listen');

Route::get('/ca-si/{artist}', 'ArtistController@show')
    ->where('artist', '[0-9]+')
    ->name('artist.show');
