<?php

use Illuminate\Support\Facades\Route;


Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/blog/{slug}','App\Http\Controllers\Front\Homepage@single')->name('singleContent');
