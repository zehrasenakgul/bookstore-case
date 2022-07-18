<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;

Route::redirect('/admin', '/admin/login');

Route::get("/admin/login", "App\Http\Controllers\Auth\LoginController@showLoginForm")->name("admin.login.index");
Route::post("/admin/login", "App\Http\Controllers\Auth\LoginController@login");
Route::get("/admin/logout", "App\Http\Controllers\Auth\LoginController@logout")->name("admin.logout.index");

Route::group(["prefix" => "admin", "middleware" => "auth"], function () {

    Route::get("/dashboard", "App\Http\Controllers\Admin\BackendHomeController@index")->name("admin.home.index");

    Route::controller(SettingsController::class)->group(function () {
        Route::group(["prefix" => "settings"], function () {
            Route::get("/", "index");
            //ajax post işlemi olduğu için type post =>
            Route::post("/update", "update");
            Route::post("/add", "store");
            Route::post("/delete", "destroy");
        });
    });

    Route::controller(BookController::class)->group(function () {
        Route::group(["prefix" => "book"], function () {
            Route::redirect('/', '/admin/book/add');
            Route::get("/add", "create");
            Route::post("/add", "store");
            Route::get("/update/{book}", "show");
            Route::put("/update/{book}", "update");
            Route::get("/delete/{book}", "destroy");
        });
        Route::redirect('/books', '/admin/books/list');
        Route::get("/books/list", "index");
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::group(["prefix" => "author"], function () {
            Route::redirect('/', '/admin/author/add');
            Route::get("/add", "create");
            Route::post("/add", "store");
            Route::get('/update/{author}', 'show');
            Route::put("/update/{author}", "update");
            Route::get("/delete/{author}", "destroy");
        });
        Route::redirect('/authors', '/admin/authors/list');
        Route::get("/authors/list", "index");
    });
});
