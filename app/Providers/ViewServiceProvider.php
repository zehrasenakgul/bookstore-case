<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

use Illuminate\Http\Request;

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
        $data = [];
        $settings = Setting::all();
        $settingArr = [];
        foreach ($settings as $setting) {
            $settingArr[$setting->key] = $setting->value;
        }
        $data["settings"] = $settingArr;
        View::share($data);
        return $request;
    }
}
