<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookPostRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::where("status", "1")->get();
        return view("admin.books.add", compact("authors"));
    }
    public function show($id)
    {
        $book = Book::where("id", $id)->firstOrFail();
        $authors = Author::where("status", "1")->get();
        return view("admin.books.update", compact("authors", "book"));
    }
    public function index()
    {
        $books = Book::all();
        return view("admin.books.list", compact("books"));
    }

    //FormRequest
    public function store(BookPostRequest $request)
    {
        $filePath = false;
        $book = new Book();

        if ($request->file("image") != null) {
            $filePath = Storage::disk('uploads')->put('books', $request->file("image"), 'public');
        }

        if ($filePath == false) {
            $filePath = Storage::disk('uploads')->put('books', $request->file("image"), 'public');
        }

        $book->name = $request->input('name');
        $book->book_no = $request->input('book_no');
        $book->author_id = $request->input('author_id');
        $book->status = $request->input('status');
        $book->image = $filePath;
        $str = Str::slug($request->name, '-');
        $book->slug = $str;

        if ($book->save()) {
            return redirect("/admin/books/list");
        } else {
            return redirect("/admin/books/list");
        }
    }
    //FormRequest
    public function edit(Request $request, $id)
    {
        $oldBook = Book::where("id", $id)->firstOrFail();
        $filePath = $oldBook->image;
        $str = Str::slug($request->name, '-');

        if ($request->file("image") != null) {
            if ($oldBook->image != "no-image/no-image.jpeg") {
                Storage::disk('uploads')->delete($oldBook->image);
            }
            $filePath = Storage::disk('uploads')->put('books', $request->file("image"), 'public');
        }

        $book = Book::where("id", $id)->update([
            "name" => $request->input('name'),
            "author_id" => $request->input('author_id'),
            "book_no" => $request->input('book_no'),
            "status" => $request->input('status'),
            "image" => $filePath,
            "slug" => $str,
        ]);

        if ($book) {
            return redirect("/admin/books/list");
        } else {
            return redirect("/admin/books/list");
        }
    }

    public function destroy($id)
    {
        $book = Book::where("id", $id)->firstOrFail();
        if ($book->image != "no-image/no-image.jpeg") {
            Storage::disk('uploads')->delete($book->image);
        }
        $book->delete();

        if ($book) {
            return redirect("/admin/books/list");
        } else {
            return redirect("/admin/books/list");
        }
    }
}
