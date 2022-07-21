<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        Setting::where('key', $request->key)->update(['value' => $request->value]);
        Session::flash('alertSuccessMessage', 'Ayar Güncelleme Başarılı!');
    }

    public function store(Request $request)
    {
        $setting = new Setting();

        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->save();
        Session::flash('alertSuccessMessage', 'Ayar Kaydı Başarılı!');
    }

    public function destroy(Request $request)
    {
        Setting::where('key', $request->key)->delete();
        Session::flash('alertSuccessMessage', 'Ayar Silme Başarılı!');
    }
}
