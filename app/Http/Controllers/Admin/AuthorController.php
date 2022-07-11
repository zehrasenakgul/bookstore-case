<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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
        $author = Author::where("id", $author->id)->firstOrFail();
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
        return $this->index();
    }
    public function edit(Request $request, Author $author)
    {
        $str = Str::slug($request->input("name"), '-');
        $author = Author::where("id", $author->id)->firstOrFail();
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
        $authors = Author::all();
        //Yazar kaydı silindiğinde yazara ait kitaplar ve o kitaba ait görsel de silinmeli;
        $deletedAuthor = Author::where("id", $author->id)->firstOrFail();
        $deletedAuthor->delete();
        //yazar silindiyse ona ait kitapları ve görselleri de siliyoruz =>
        if ($deletedAuthor) {
            $book = Book::where("author_id", $author->id)->get();
            foreach ($book as $bookItem) {
                Storage::disk('uploads')->delete($bookItem->image);
                $bookItem->delete();
            }
            Session::flash('authorDeletionSuccessful', 'Yazar Silme Başarılı!');
        } else {
            Session::flash('authorDeletionFailed', 'Yazar Silme Başarısız!');
        }
        return $this->index();
    }
}
