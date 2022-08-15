<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;

class BackendHomeController extends Controller
{
    public function index()
    {
        $bookCount = Book::where('status', '1')->count();
        $authorCount = Author::where('status', '1')->count();

        return view('admin.home.index', compact('bookCount', 'authorCount'));
    }
}
