<?php

use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;




// Backend Routes //
Route::prefix('admin')->middleware('isAdmin')->group(function (){
    Route::get('/panel',[Dashboard::class,'index'])->name('admin.panel');
    Route::get('/cikis',[AuthController::class,'logout'])->name('admin.logout');
});

Route::get('/admin/giris',[AuthController::class,'login'])->name('admin.login');
Route::post('/admin/giris',[AuthController::class,'loginPost'])->name('admin.login.post');

// Front Routes //

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/iletisim','App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('singleContent');
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');


