<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
        Session::flash('settingUpdateSuccessful', 'Ayar Güncelleme Başarılı!');
    }

    public function store(Request $request)
    {
        $setting = new Setting();

        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();
        Session::flash('settingRegistrationSuccessful', 'Ayar Kaydı Başarılı!');
    }

    public function destroy(Request $request)
    {
        $setting = Setting::where("key", $request->key)->delete();
        Session::flash('settingDeletionSuccessful', 'Ayar Silme Başarılı!');
    }
}
