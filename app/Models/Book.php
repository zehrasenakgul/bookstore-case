<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    //SoftDelete => $book = Book::onlyTrashed()->get(); -> sadece silinenleri gösterir.

    use HasFactory;
    use SoftDeletes;
    protected $table = "Books";
    protected $fillable  = ["name", "author_id", "book_no", "status"];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function author()
    {
        return $this->hasOne(Author::class, "id", "author_id");
    }
}
