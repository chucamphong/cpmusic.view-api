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

Route::get('/bang-xep-hang/luot-nghe', 'SongController@topSongs')
    ->name('song.top-songs');

Route::get('/bai-hat/moi-phat-hanh', 'SongController@newSongs')
    ->name('song.new-songs');

Route::get('/the-loai/{category}', 'CategoryController@show')
    ->where('category', '[0-9]+')
    ->name('category.show');
