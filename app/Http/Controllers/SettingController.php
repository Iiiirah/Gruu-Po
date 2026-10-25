<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Ipakita ang settings page at kunin ang mga saved values mula sa database
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('settings', compact('settings'));
    }

    // I-save o i-update ang mga binagong settings
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}