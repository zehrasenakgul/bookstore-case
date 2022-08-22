<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageSwitcher {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure( \Illuminate\Http\Request ): ( \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse )  $next
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */

    public function handle( $request, Closure $next ) {
        if ( session()->has( 'locale' ) ) {
            App::setLocale( session()->get( 'locale' ) );
        }
        return $next( $request );
    }
}
