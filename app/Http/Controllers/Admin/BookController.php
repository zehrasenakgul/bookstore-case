<?php

namespace App\Http\Controllers\Admin;

use App\Enums\noImagePath;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\DeleteBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class BookController extends Controller
 {
    public function create() {
        $authors = Author::active()->get();
        $langs = Language::all();
        return view( 'admin.books.add', compact( 'authors', 'langs' ) );
    }

    public function show( Book $book ) {
        $authors = Author::active()->get();
        $langs = Language::all();
        $translations = BookTranslation::where( 'book_id', $book->id )->get();
        return view( 'admin.books.update', compact( 'authors', 'book', 'translations', 'langs' ) );
    }

    public function index() {
        $books = Book::with( 'translation' )->get();
        return view( 'admin.books.index', compact( 'books' ) );
    }

    public function store( CreateBookRequest $request ) {
        $filePath = noImagePath::PATH;
        if ( $request->hasFile( 'image' ) ) {
            $filePath = Storage::disk( 'storage' )->put( 'books', $request->file( 'image' ), 'public' );
        }
        $book = Book::create( [
            'author_id' => $request->input( 'author_id' ),
            'book_no' => $request->input( 'book_no' ),
            'status' => $request->input( 'status' ),
            'image' => $filePath
        ] );

        foreach ( $request->name as $key => $value ) {
            BookTranslation::create( [
                'book_id' => $book->id,
                'lang' => $request->lang[ $key ],
                'name' => $request->name[ $key ],
                'content' => $request->content[ $key ],
            ] );
        }
        Session::flash( 'alertSuccessMessage', 'Kitap Kaydı Başarılı!' );
        return redirect()->route( 'admin.books.index' );
    }

    //FormRequest

    public function update( UpdateBookRequest $request, Book $book ) {
        $filePath = $book->image;
        if ( $request->hasFile( 'image' ) ) {
            if ( $book->image != noImagePath::PATH ) {
                Storage::disk( 'storage' )->delete( $book->image );
            }
            $filePath = Storage::disk( 'storage' )->put( 'books', $request->file( 'image' ), 'public' );
        }
        $book->update( [
            'author_id' => $request->input( 'author_id' ),
            'book_no' => $request->input( 'book_no' ),
            'status' => $request->input( 'status' ),
            'image' => $filePath,
        ] );
        $translation = BookTranslation::where( 'book_id', $book->id )->get();
        foreach ( $translation as $index ) {
            foreach ( $request->name as $key => $value ) {
                if ( $index->lang == $request->lang[ $key ] ) {
                    $index->update( [
                        'book_id' => $book->id,
                        'name' => $request->name[ $key ],
                        'content' => $request->content[ $key ],
                    ] );
                }
            }
        }

        Session::flash( 'alertSuccessMessage', 'Kitap Güncelleme Başarılı!' );
        return redirect()->route( 'admin.books.index' );
    }

    public function destroy( Book $book, DeleteBookRequest $request ) {
        $book->delete( $request->validated() );
        Session::flash( 'alertSuccessMessage', 'Kitap Silme Başarılı!' );
        return redirect()->route( 'admin.books.index' );
    }
}
