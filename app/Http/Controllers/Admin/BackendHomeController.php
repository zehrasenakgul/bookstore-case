<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;

class BackendHomeController extends Controller
 {
    public function index()
 {
        $bookCount = Book::active()->count();
        $authorCount = Author::active()->count();
        return view( 'admin.home.index', compact( 'bookCount', 'authorCount' ) );
    }
}
