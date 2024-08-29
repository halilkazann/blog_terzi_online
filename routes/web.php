<?php

use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;



// Backend Routes //
Route::prefix('/admin')->middleware('isadmin')->group(function (){
    Route::get('/cikis',[AuthController::class,'logout'])->name('admin.logout');
    Route::get('/panel',[Dashboard::class,'index'])->name('admin.panel');
    Route::get('/profile',[Dashboard::class,'profile'])->name('admin.profile');
    Route::post('/profile/update',[Dashboard::class,'profileUpdate'])->name('admin.profile.update');
    Route::resource('/makaleler',ArticleController::class);
    Route::get('/switch',[ArticleController::class,'switch'])->name('admin.switch');
    Route::get('/deletearticle/{id}',[ArticleController::class,'delete'])->name('admin.article.delete');
    Route::get('/harddeletearticle/{id}',[ArticleController::class,'hardDelete'])->name('admin.article.harddelete');
    Route::get('/trash',[ArticleController::class,'trash'])->name('admin.article.trash');
    Route::get('/recycle/{id}',[ArticleController::class,'recycle'])->name('admin.article.recycle');
    Route::get('/sayfalar',[PageController::class,'index'])->name('admin.page');
    Route::get('/sayfa/status',[PageController::class,'switch'])->name('admin.page.switch');
    Route::get('/sayfa/getData',[PageController::class,'getData'])->name('admin.page.getdata');
    Route::get('/sayfa/ekle',[PageController::class,'create'])->name('admin.page.create');
    Route::post('/sayfa/ekle',[PageController::class,'create'])->name('admin.page.createpost');


    Route::get('/kategoriler',[CategoryController::class,'index'])->name('admin.category.index');
    Route::post('/kategori/ekle',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/kategori/guncelle',[CategoryController::class,'update'])->name('admin.category.update');
    Route::post('/kategori/sil',[CategoryController::class,'delete'])->name('admin.category.delete');
    Route::post('/kategori/forcesil',[CategoryController::class,'forcedelete'])->name('admin.category.forcedelete');
    Route::get('/kategori/status',[CategoryController::class,'switch'])->name('admin.category.switch');
    Route::get('/kategori/getData',[CategoryController::class,'getData'])->name('admin.category.getdata');

});


Route::prefix('/admin')->middleware('islogin')->group(function (){
    Route::get('/giris',[AuthController::class,'login'])->name('admin.login');
    Route::post('/giris',[AuthController::class,'loginPost'])->name('admin.login.post');

});



// Front Routes //

Route::get('/','App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/iletisim','App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim','App\Http\Controllers\Front\Homepage@contactpost')->name('contactpost');
Route::get('/kategori/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('singleContent');
Route::get('/{sayfa}','App\Http\Controllers\Front\Homepage@page')->name('page');





