<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Ipakita ang About page kasama ang mga naka-save na data mula sa database.
     */
    public function index()
    {
        $aboutSetting = Setting::where('key', 'about_page_data')->first();
        
        $aboutData = $aboutSetting ? json_decode($aboutSetting->value, true) : [
            'profile_title' => 'Barangay Sibul, San Miguel, Bulacan',
            'profile_desc' => 'Barangay Sibul is a historic and progressive agricultural community in San Miguel, Bulacan. Renowned for its natural springs, eco-tourism potential, and vibrant citizenry, eBarangay serves as its official modern digital platform.',
            'vision' => 'Insert Barangay Vision',
            'mission' => 'Insert Barangay Mission',
            'officials' => [
                ['name' => 'Name Here', 'title' => 'Barangay Chairman', 'photo' => ''],
                ['name' => 'Name Here', 'title' => 'Barangay Secretary', 'photo' => ''],
                ['name' => 'Name Here', 'title' => 'Barangay Treasurer', 'photo' => ''],
                ['name' => 'Name Here', 'title' => 'Tanod', 'photo' => '']
            ]
        ];

        return view('about', compact('aboutData'));
    }

    /**
     * I-update ang Official Profile, Vision, Mission, at Hierarchy.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_title' => 'required|string',
            'profile_desc' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'officials' => 'required|array',
        ]);

        $existingSetting = Setting::where('key', 'about_page_data')->first();
        $existingData = $existingSetting ? json_decode($existingSetting->value, true) : [];

        $officials = [];
        if ($request->has('officials')) {
            foreach ($request->officials as $index => $officialData) {
                $photoPath = $officialData['existing_photo'] ?? '';

                // 1. Kung pinili ng admin na i-remove ang larawan
                if (isset($officialData['remove_photo']) && $officialData['remove_photo'] == '1') {
                    if (!empty($photoPath) && Storage::disk('public')->exists($photoPath)) {
                        Storage::disk('public')->delete($photoPath);
                    }
                    $photoPath = '';
                }

                // 2. Kung nag-upload ng bagong 1x1 photo
                if ($request->hasFile("officials.{$index}.photo")) {
                    $file = $request->file("officials.{$index}.photo");
                    
                    // Burahin ang lumang larawan kung meron man
                    if (!empty($photoPath) && Storage::disk('public')->exists($photoPath)) {
                        Storage::disk('public')->delete($photoPath);
                    }

                    $photoPath = $file->store('officials', 'public');
                }

                $officials[] = [
                    'name' => $officialData['name'] ?? 'Name Here',
                    'title' => $officialData['title'] ?? 'Position',
                    'photo' => $photoPath,
                ];
            }
        }

        $data = [
            'profile_title' => $request->profile_title,
            'profile_desc' => $request->profile_desc,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'officials' => $officials,
        ];

        Setting::updateOrCreate(
            ['key' => 'about_page_data'],
            ['value' => json_encode($data)]
        );

        return redirect()->back()->with('success', 'About page updated successfully!');
    }
}