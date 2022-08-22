<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model {
    use HasFactory;
    protected $table = 'translations';
    protected $fillable = [ 'language_id', 'slug', 'data' ];

    public function language() {
        return $this->belongsTo( Language::class );
    }
}
