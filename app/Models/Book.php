<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Book extends Model
 {
    //SoftDelete => $book = Book::onlyTrashed()->get();

    use HasFactory;
    use SoftDeletes;
    protected $fillable = [ 'author_id', 'image', 'book_no', 'status' ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive( $query ) {
        $query->where( 'status', 1 );
    }

    public function author() {
        return $this->belongsTo( Author::class );
    }

    public  function translation( $language = null ) {
        if ( $language == null ) {
            $language = App::getLocale();
        }
        return $this->hasMany( BookTranslation::class )->where( 'lang', '=', $language );
    }
}
