<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');
Route::get('/books', "App\Http\Controllers\Frontend\HomeController@index")->name('frontend.index');
Route::get('/books/{slug}', "App\Http\Controllers\Frontend\BookController@show")->name('frontend.book.show');
