<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;



Route::redirect('/admin', '/admin/login');

Route::get("/admin/login", "App\Http\Controllers\Auth\LoginController@showLoginForm")->name("admin.login.index");
Route::post("/admin/login", "App\Http\Controllers\Auth\LoginController@login");
Route::get("/admin/logout", "App\Http\Controllers\Auth\LoginController@logout")->name("admin.logout.index");

Route::group(["prefix" => "admin", "as" => "backend", "middleware" => "auth"], function () {

    Route::get("/dashboard", "App\Http\Controllers\Admin\BackendHomeController@index")->name("admin.home.index");

    Route::controller(SettingsController::class)->group(function () {
        Route::group(["prefix" => "settings"], function () {
            Route::get("/", "index")->name(".index");
            //ajax post işlemi olduğu için type post =>
            Route::post("/update", "edit")->name(".edit");
            Route::post("/add", "store")->name(".store");
            Route::post("/delete", "destroy")->name(".destroy");
        });
    });

    Route::controller(BookController::class)->group(function () {
        Route::group(["prefix" => "book"], function () {
            Route::redirect('/', '/admin/book/add');
            Route::get("/add", "create")->name(".create");
            Route::post("/add", "store")->name(".store");
            Route::get("/update/{book}", "show")->name(".show");
            Route::put("/update/{book}", "edit")->name(".edit");
            Route::get("/delete/{book}", "destroy")->name(".destroy");
        });
        Route::redirect('/books', '/admin/books/list');
        Route::get("/books/list", "index")->name(".index");
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::group(["prefix" => "author"], function () {
            Route::redirect('/', '/admin/author/add');
            Route::get("/add", "create")->name(".create");
            Route::post("/add", "store")->name(".store");
            Route::get("/update/{author}", "show")->name(".show");
            Route::put("/update/{author}", "edit")->name(".edit");
            Route::get("/delete/{author}", "destroy")->name(".destroy");
        });
        Route::redirect('/authors', '/admin/authors/list');
        Route::get("/authors/list", "index")->name(".index");
    });
});
