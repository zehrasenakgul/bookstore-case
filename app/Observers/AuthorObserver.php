<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Author;

class AuthorObserver {
    public function creating( Author $author ) {
        $author->slug = Str::slug( $author->name );

    }

    /**
    * Handle the author 'updated' event.
    *
    * @param  \App\Models\author  $author
    * @return void
    */

    public function updating( Author $author ) {
        $author->slug = Str::slug( $author->name );

    }

}
