<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view("admin.settings.settings", compact("settings"));
    }

    public function edit(Request $request)
    {
        $setting = Setting::where("key", $request->key)->update(["value" => $request->value]);
        if ($setting) {
            return "Başarılı";
        }
        return "hatalı";
    }

    public function store(Request $request)
    {
        $setting = new Setting();

        $setting->key = $request->key;
        $setting->value = $request->value;

        if ($setting->save()) {
            return ["status" => "success", "message" => "Ayar başarıyla kaydedildi", "title" => "Başarılı"];
        } else {
            return ["status" => "error", "message" => "Ayar kaydedilmedi", "title" => "Hatalı"];
        }
    }

    public function destroy(Request $request)
    {
        $setting = Setting::where("key", $request->key)->delete();
        if ($setting) {
            return ["status" => "success", "message" => "Ayar başarıyla silindi", "title" => "Başarılı"];
        } else {
            return ["status" => "error", "message" => "Ayar silinmedi", "title" => "Hatalı"];
        }
    }
}
