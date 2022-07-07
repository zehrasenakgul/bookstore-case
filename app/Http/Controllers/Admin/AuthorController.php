<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
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
    public function show($id)
    {
        $author = Author::where("id", $id)->firstOrFail();
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
            return redirect("/admin/authors/list");
        } else {
            return redirect("/admin/authors/list");
        }
    }
    public function edit(Request $request, $id)
    {

        $str = Str::slug($request->input("name"), '-');
        $author = Author::where("id", $id)->firstOrFail();
        if ($request->input("status") == "0") {
            $book = Book::where("author_id", $author->id)->get();
            foreach ($book as $bookItem) {
                $bookItem->update([
                    "status" => "0"
                ]);
            }
        }
        $author = Author::where("id", $id)->update([
            "name" => $request->input("name"),
            "status" => $request->input("status"),
            "slug" => $str
        ]);

        if ($author) {
            return redirect("/admin/authors/list");
        } else {
            return redirect("/admin/authors/list");
        }
    }
    public function destroy($id)
    {
        //Yazar kaydı silindiğinde yazara ait kitaplar ve o kitaba ait görsel de silinmeli;
        $author = Author::where("id", $id)->firstOrFail();
        $book = Book::where("author_id", $author->id)->get();
        foreach ($book as $bookItem) {
            Storage::disk('uploads')->delete($bookItem->image);
            $bookItem->delete();
        }
        $author->delete();

        if ($author) {
            return redirect("/admin/authors/list");
        } else {
            return redirect("/admin/authors/list");
        }
    }
}
