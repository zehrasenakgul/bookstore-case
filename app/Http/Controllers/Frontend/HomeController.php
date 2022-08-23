<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HomeController extends Controller
 {
    public function index() {
        $books = Book::active()->with( 'translation' )->get();
        $langs = Language::all();
        return view( 'frontend.home.index', compact( 'books', 'langs' ) );
    }

    public function change( Request $request )
 {
        App::setLocale( $request->lang );
        session()->put( 'locale', $request->lang );
        return redirect()->back();
    }
}
