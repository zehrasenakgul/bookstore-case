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

        if ($author->save()) {
            Session::flash('authorRegistrationSuccessful', 'Yazar Kaydı Başarılı!');
        } else {
            Session::flash('authorRegistrationFailed', 'Yazar Kaydı Başarısız!');
        }
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

        if ($author) {
            Session::flash('authorUpdateSuccessful', 'Yazar Güncelleme Başarılı!');
            // return redirect("/admin/author/update/$author->id")->with('authorUpdateSuccessful', 'Yazar Güncelleme Başarılı!');
        } else {
            Session::flash('authorUpdateFailed', 'Yazar Güncelleme Başarısız!');
        }
        return $this->show($author);
    }
    public function destroy(Author $author)
    {
        $author->delete();
        if ($author) {
            Session::flash('authorDeletionSuccessful', 'Yazar Silme Başarılı!');
        } else {
            Session::flash('authorDeletionFailed', 'Yazar Silme Başarısız!');
        }
        return redirect()->action([AuthorController::class, 'index']);
    }
}
