<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function show($slug)
    {
        $book = Book::with('author')->where("slug", $slug)->where("status", "1")->firstOrFail();
        return view("frontend.book.index", compact("book"));
    }
}
