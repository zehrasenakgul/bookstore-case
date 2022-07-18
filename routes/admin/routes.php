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

    Route::resource("settings", SettingsController::class);

    Route::controller(BookController::class)->group(function () {
        Route::group(["prefix" => "book"], function () {
            Route::redirect('/', '/admin/book/add');
            Route::get("/add", "create")->name("admin.books.add");
            Route::post("/add", "store")->name("books.store");
            Route::get("/update/{book}", "show")->name("admin.books.update");
            Route::put("/update/{book}", "update")->name("books.update");
            Route::get("/delete/{book}", "destroy")->name("books.destroy");
        });
        Route::redirect('/books', '/admin/books/list');
        Route::get("/books/list", "index")->name("admin.books.list");
    });
    Route::controller(AuthorController::class)->group(function () {
        Route::group(["prefix" => "author"], function () {
            Route::redirect('/', '/admin/author/add');
            Route::get("/add", "create")->name("admin.authors.add");
            Route::post("/add", "store")->name("authors.store");
            Route::get('/update/{author}', 'show')->name("admin.authors.update");;
            Route::put("/update/{author}", "update")->name("authors.update");
            Route::get("/delete/{author}", "destroy")->name("authors.destroy");
        });
        Route::redirect('/authors', '/admin/authors/list');
        Route::get("/authors/list", "index")->name("admin.authors.list");
    });
});
