<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;


class HomeController extends Controller
{
    public function index()
    {
        $books = Book::where("status", "1")->get();
        return view("frontend.home.index", compact("books"));
    }
}
