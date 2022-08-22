<?php

namespace App\Http\Controllers\Admin;

use App\Enums\noImagePath;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
 {
    public function create() {
        $authors = Author::active()->get();
        return view( 'admin.books.add', compact( 'authors' ) );
    }

    public function edit( Book $book ) {
        $authors = Author::active()->get();
        return view( 'admin.books.update', compact( 'authors', 'book' ) );
    }

    public function index() {
        $books = Book::all();
        return view( 'admin.books.index', compact( 'books' ) );
    }

    public function store( CreateBookRequest $request ) {
        $filePath = noImagePath::PATH;
        if ( $request->hasFile( 'image' ) ) {
            $filePath = Storage::disk( 'storage' )->put( 'books', $request->file( 'image' ), 'public' );
        }
        Book::create( [
            'name' => $request->input( 'name' ),
            'author_id' => $request->input( 'author_id' ),
            'book_no' => $request->input( 'book_no' ),
            'status' => $request->input( 'status' ),
            'image' => $filePath
        ] );
        Session::flash( 'alertSuccessMessage', 'Kitap Kaydı Başarılı!' );
        return redirect()->route( 'admin.books.index' );
    }

    //FormRequest

    public function update( Request $request, Book $book ) {
        $filePath = $book->image;
        if ( $request->hasFile( 'image' ) ) {
            if ( $book->image != noImagePath::PATH ) {
                Storage::disk( 'storage' )->delete( $book->image );
            }
            $filePath = Storage::disk( 'storage' )->put( 'books', $request->file( 'image' ), 'public' );
        }
        $book->update( [
            'name' => $request->input( 'name' ),
            'author_id' => $request->input( 'author_id' ),
            'book_no' => $request->input( 'book_no' ),
            'status' => $request->input( 'status' ),
            'image' => $filePath,
        ] );
        Session::flash( 'alertSuccessMessage', 'Kitap Güncelleme Başarılı!' );
        // return redirect()->action( [ BookController::class, 'index' ] );
        return redirect()->route( 'admin.books.index' );
    }

    public function destroy( Book $book ) {
        //soft delete yaptığımız için bu işleme gerek yok görseli silmiyor ;
        // if ( $book->image != noImagePath::PATH ) {
        //     Storage::disk( 'storage' )->delete( $book->image );
        // }
        $book->delete();
        Session::flash( 'alertSuccessMessage', 'Kitap Silme Başarılı!' );
        return redirect()->route( 'admin.books.index' );
    }
}
