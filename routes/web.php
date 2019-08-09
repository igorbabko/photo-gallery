<?php

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/photos', 'PhotoController@index')->name('photos.index');
Route::post('/photos', 'PhotoController@store')->name('photos.store');
