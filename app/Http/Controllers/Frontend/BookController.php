<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookTranslation;

class BookController extends Controller
 {
    public function show( $slug )
 {
        $translate = BookTranslation::with( [ 'book', 'book.author' ] )->where( 'slug', $slug )->firstOrFail();
        return view( 'frontend.book.index', compact( 'translate' ) );
    }
}
