<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ["name", "status"];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function books()
    {
        return $this->hasMany(Book::class, "author_id", "id");
    }
    use HasFactory;
}
