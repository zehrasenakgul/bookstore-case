<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::where('status', '1')->get();

        return view('frontend.home.index', compact('books'));
    }
}
