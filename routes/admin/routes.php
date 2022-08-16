<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin', '/admin/login');

Route::get('/admin/login', "App\Http\Controllers\Auth\LoginController@showLoginForm")->name('admin.login.index');
Route::post('/admin/login', "App\Http\Controllers\Auth\LoginController@login");
Route::get('/admin/logout', "App\Http\Controllers\Auth\LoginController@logout")->name('admin.logout.index');

Route::group(['prefix' => 'admin', "as" => "admin.",'middleware'=>'auth'], function () {
    Route::get('/dashboard', "App\Http\Controllers\Admin\BackendHomeController@index")->name('admin.home.index');

    //Formu tüm methodlar için ajax ile post ettiğimden resource için url ve method biçimleri uygun olmuyor.
    Route::controller(SettingController::class)->group(function () {
        Route::group(['prefix' => 'settings', "as" => "settings."], function () {
            Route::get('/', 'index')->name("index");
            //ajax post işlemi olduğu için type post =>
            Route::post('/update', 'update')->name("update");
            Route::post('/create', 'store')->name("store");
            Route::post('/delete', 'destroy')->name("destroy");
        });
    });

    Route::controller(BookController::class)->group(function () {
        Route::group(['prefix' => 'books', "as" => "books."], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{book}', 'edit')->name('edit');
            Route::put('/{book}', 'update')->name('update');
            Route::delete('/{book}', 'destroy')->name('destroy');
        });
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::group(['prefix' => 'authors', "as" => "authors."], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{author}', 'edit')->name('edit');
            Route::put('/{author}', 'update')->name('update');
            Route::delete('/{author}', 'destroy')->name('destroy');
        });
    });
});
