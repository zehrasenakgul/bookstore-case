<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        try {
            $data = [];
            $settings = Setting::all();
            $settingArr = [];
            foreach ($settings as $setting) {
                $settingArr[$setting->key] = $setting->value;
            }
            $data['settings'] = $settingArr;


            View::share($data);

            return $request;
        } catch (\Exception $e) {

            return false;
        }
    }
}
