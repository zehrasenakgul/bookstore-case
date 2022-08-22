<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\DeleteAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Author::create( $request->validated() );
        Session::flash( 'alertSuccessMessage', 'Yazar Kaydı Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }

    public function update( UpdateAuthorRequest $request, Author $author ) {
        $author->update( $request->validated() );
        Session::flash( 'alertSuccessMessage', 'Yazar Güncelleme Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }

    public function destroy( Author $author, DeleteAuthorRequest $request ) {
        $author->delete( $request->validated() );
        Session::flash( 'alertSuccessMessage', 'Yazar Silme Başarılı!' );
        return redirect()->route( 'admin.authors.index' );
    }
}
