<?php

namespace App\Http\Composers;

use App\Models\Language;
use Illuminate\Contracts\View\View;

class LanguageShareComposer
 {
    public function compose( View $view ) {
        $langs = Language::all();
        $view->with( 'langs', $langs );
    }
}
