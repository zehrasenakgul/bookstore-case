<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller {
    public function create() {
        return view( 'admin.authors.add' );
    }

    public function index() {
        $authors = Author::all();

        return view( 'admin.authors.index', compact( 'authors' ) );
    }

    public function edit( Author $author ) {
        return view( 'admin.authors.update', compact( 'author' ) );
    }

    public function store( CreateAuthorRequest $request ) {
        Author::create( $request->all() );
        Session::flash( 'alertSuccessMessage', 'Yazar Kaydı Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }

    public function update( Request $request, Author $author ) {
        $author->update( $request->all() );
        Session::flash( 'alertSuccessMessage', 'Yazar Güncelleme Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }

    public function destroy( Author $author ) {
        $author->delete();
        Session::flash( 'alertSuccessMessage', 'Yazar Silme Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }
}
