<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class ResidentAboutController extends Controller
{
    /**
     * Ipakita ang Resident About page at kunin ang datos na isinave ng admin.
     */
    public function index()
    {
        // Kunin ang mga inilagay ng admin mula sa settings table gamit ang key na 'about_page_data'
        $aboutSetting = Setting::where('key', 'about_page_data')->first();
        
        // Kung walang data na isinave ang admin, magiging blangko/empty ang mga ito sa resident side
        $aboutData = $aboutSetting ? json_decode($aboutSetting->value, true) : [
            'profile_title' => '',
            'profile_desc' => '',
            'vision' => '',
            'mission' => '',
            'officials' => [
                ['name' => '', 'title' => 'Barangay Chairman', 'photo' => ''],
                ['name' => '', 'title' => 'Barangay Secretary', 'photo' => ''],
                ['name' => '', 'title' => 'Barangay Treasurer', 'photo' => ''],
                ['name' => '', 'title' => 'Tanod', 'photo' => '']
            ]
        ];

        return view('resident-about', compact('aboutData'));
    }
}