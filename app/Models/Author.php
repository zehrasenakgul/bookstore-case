<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model {
    use SoftDeletes, SoftCascadeTrait;
    use HasFactory;
    protected $softCascade = [ 'books' ];
    protected $fillable = [ 'name', 'status' ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function books() {
        return $this->hasMany( Book::class, 'author_id', 'id' );
    }

    public function scopeActive( $query ) {
        $query->where( 'status', 1 );
    }
}
