<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');
Route::get('/books', "App\Http\Controllers\Frontend\HomeController@index")->name(".index");
Route::get('/book/{slug}', "App\Http\Controllers\Frontend\BookController@show")->name(".show");
