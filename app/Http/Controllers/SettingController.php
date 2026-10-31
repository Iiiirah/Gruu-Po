<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    // Ipakita ang settings page at kunin ang mga saved values mula sa database
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('settings', compact('settings'));
    }

    // I-save o i-update ang mga binagong settings (tulad ng Barangay Info at Document Fees)
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

    // Bagong function para sa pagpapalit ng admin password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:6', 'same:confirm_password'],
        ], [
            'current_password.required' => 'Kailangan ilagay ang kasalukuyang password.',
            'new_password.required' => 'Kailangan ilagay ang bagong password.',
            'new_password.min' => 'Ang bagong password ay dapat hindi bababa sa 6 na karakter.',
            'new_password.same' => 'Ang bagong password at confirm password ay hindi magkatugma.',
        ]);

        $admin = Auth::user();

        // 1. Suriin kung tama ang kasalukuyang password (old password)
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Ang iyong kasalukuyang password ay hindi tugma.']);
        }

        // 2. I-update at i-hash ang bagong password sa database ng users
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password changed successfully!');
    }
}