<?php

use Illuminate\Support\Facades\Route;

// Vô hiệu hóa chức năng "Đặt lại mật khẩu"
Auth::routes(['reset' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/bai-hat/{song}', 'SongController@listen')
    ->where('song', '[0-9]+')
    ->name('song.listen');

Route::get('/tim-kiem/bai-hat', 'SongController@findSong')->name('song.find');

Route::get('/nghe-si/', 'ArtistController@index')->name('artist.index');

Route::get('/nghe-si/{artist}', 'ArtistController@show')
    ->where('artist', '[0-9]+')
    ->name('artist.show');

Route::get('/bang-xep-hang/luot-nghe', 'SongController@topSongs')
    ->name('song.top-songs');

Route::get('/bai-hat/moi-phat-hanh', 'SongController@newSongs')
    ->name('song.new-songs');

Route::get('/the-loai', 'CategoryController@index')->name('category.index');

Route::get('/the-loai/{category}', 'CategoryController@show')
    ->where('category', '[0-9]+')
    ->name('category.show');

Route::get('/tai-khoan', 'UserController@index')->name('account.index');
Route::post('/tai-khoan', 'UserController@update')->name('account.update');
Route::get('/tai-khoan/doi-mat-khau', 'UserController@changePassword')->name('account.change-password');
Route::post('/tai-khoan/doi-mat-khau', 'UserController@updatePassword')->name('account.update-password');
