<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class AuthorController extends Controller
{
    public function create()
    {
        return view("admin.authors.add");
    }
    public function index()
    {
        $authors = Author::all();
        return view("admin.authors.list", compact("authors"));
    }
    public function show(Author $author)
    {
        return view("admin.authors.update", compact("author"));
    }

    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->input("name");
        $author->status = $request->input("status");
        $str = Str::slug($request->input("name"), '-');
        $author->slug = $str;
        $author->save();
        Session::flash('authorRegistrationSuccessful', 'Yazar Kaydı Başarılı!');
        return redirect()->action([AuthorController::class, 'index']);
    }
    public function update(Request $request, Author $author)
    {
        $str = Str::slug($request->input("name"), '-');
        $author->update([
            "name" => $request->input("name"),
            "status" => $request->input("status"),
            "slug" => $str
        ]);

        Session::flash('authorUpdateSuccessful', 'Yazar Güncelleme Başarılı!');
        return redirect()->action([AuthorController::class, 'index']);
    }
    public function destroy(Author $author)
    {
        $author->delete();
        Session::flash('authorDeletionSuccessful', 'Yazar Silme Başarılı!');
        return redirect()->action([AuthorController::class, 'index']);
    }
}
