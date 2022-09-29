<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookTranslation extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $table = 'booktranslations';
    protected $fillable = [ 'name', 'book_id', 'slug', 'lang', 'content' ];

    public function book() {
        return $this->belongsTo( Book::class );
    }

    public function language() {
        return $this->belongsTo( Language::class );
    }

}
