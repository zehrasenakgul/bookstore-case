<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin', '/admin/login');

Route::get('/admin/login', "App\Http\Controllers\Auth\LoginController@showLoginForm")->name('admin.login.index');
Route::post('/admin/login', "App\Http\Controllers\Auth\LoginController@login");
Route::get('/admin/logout', "App\Http\Controllers\Auth\LoginController@logout")->name('admin.logout.index');

Route::group(['prefix' => 'admin', "as" => "admin.",'middleware'=>'auth'], function () {
    Route::get('/dashboard', "App\Http\Controllers\Admin\BackendHomeController@index")->name('admin.home.index');

    Route::resource("languages",LanguageController::class);
    Route::resource("books",BookController::class);
    Route::resource("authors",AuthorController::class);

    Route::controller(SettingController::class)->group(function () {
        Route::group(['prefix' => 'settings', "as" => "settings."], function () {
            Route::get('/', 'index')->name("index");
            //ajax post işlemi olduğu için type post =>
            Route::post('/update', 'update')->name("update");
            Route::post('/create', 'store')->name("store");
            Route::post('/delete', 'destroy')->name("destroy");
        });
    });

 
});
