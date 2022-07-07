<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "Books";
    protected $fillable  = ["name", "author_id", "book_no", "status"];
    public function author()
    {
        return $this->hasOne(Author::class, "id", "author_id");
    }
    use HasFactory;
}
