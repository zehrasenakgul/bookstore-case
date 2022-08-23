<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LanguageShareProvider extends ServiceProvider {
    /**
    * Register services.
    *
    * @return void
    */

    public function register() {
        $this->composeLanguageShare();
    }

    /**
    * Bootstrap services.
    *
    * @return void
    */

    public function boot() {
        //
    }

    public function composeLanguageShare() {
        view()->composer( 'layouts.frontend', 'App\Http\Composers\LanguageShareComposer' );
    }
}
