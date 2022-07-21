<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/admin', '/admin/login');

Route::get('/admin/login', "App\Http\Controllers\Auth\LoginController@showLoginForm")->name('admin.login.index');
Route::post('/admin/login', "App\Http\Controllers\Auth\LoginController@login");
Route::get('/admin/logout', "App\Http\Controllers\Auth\LoginController@logout")->name('admin.logout.index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', "App\Http\Controllers\Admin\BackendHomeController@index")->name('admin.home.index');

    //Formu tüm methodlar için ajax ile post ettiğimden resource için url ve method biçimleri uygun olmuyor.
    Route::controller(SettingsController::class)->group(function () {
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'index');
            //ajax post işlemi olduğu için type post =>
            Route::post('/update', 'update');
            Route::post('/create', 'store');
            Route::post('/delete', 'destroy');
        });
    });

    Route::controller(BookController::class)->group(function () {
        Route::group(['prefix' => 'book'], function () {
            Route::redirect('/', '/admin/book/create');
            Route::get('/create', 'create')->name('books.create');
            Route::post('/', 'store')->name('books.store');
            Route::get('/{book}', 'edit')->name('books.edit');
            Route::put('/{book}', 'update')->name('books.update');
            Route::delete('/{book}', 'destroy')->name('books.destroy');
        });
        Route::get('/books', 'index')->name('books.list');
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::group(['prefix' => 'author'], function () {
            Route::redirect('/', '/admin/author/create');
            Route::get('/create', 'create')->name('authors.create');
            Route::post('/', 'store')->name('authors.store');
            Route::get('/{author}', 'edit')->name('authors.edit');
            Route::put('/{author}', 'update')->name('authors.update');
            Route::delete('/{author}', 'destroy')->name('authors.destroy');
        });
        Route::get('/authors', 'index')->name('authors.list');
    });
});
