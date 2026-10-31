<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class IncidentReportController extends Controller
{
    public function adminIndex()
    {
        $reports = IncidentReport::with('user')->latest()->get();
        return view('incident-reports', compact('reports'));
    }

    public function residentIndex()
    {
        $reports = IncidentReport::where('user_id', Auth::id())->latest()->get();
        return view('resident-reports', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'incident_type' => 'required|string',
            'zone' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('incidents', 'public');
        }

        $numericRefNumber = time();

        // 1. Siguraduhing may kahit isang record sa incident_categories para hindi mag-fail ang foreign key
        $categoryId = 1;
        try {
            $category = DB::table('incident_categories')->first();
            if ($category) {
                $categoryId = $category->id;
            } else {
                $categoryId = DB::table('incident_categories')->insertGetId([
                    'name' => 'General',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            $categoryId = 1;
        }

        // 2. Pansamantalang i-disable ang foreign key checks para sa insertion na ito
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        IncidentReport::create([
            'user_id' => Auth::id(),
            'category_id' => $categoryId,
            'reference_number' => $numericRefNumber,
            'reported_by' => Auth::id(),
            'location' => $request->zone,
            'zone' => $request->zone,
            'incident_type' => $request->incident_type,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'New', // Default status kapag bagong gawa
        ]);

        // 3. Ibalik ang foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Incident report submitted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $report = IncidentReport::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string|in:New,Verified,Resolved'
        ]);

        // I-update ang status sa database
        $report->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }

    public function update(Request $request, $id)
    {
        $report = IncidentReport::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'incident_type' => 'required|string',
            'zone' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'incident_type' => $request->incident_type,
            'location' => $request->zone,
            'zone' => $request->zone,
            'description' => $request->description,
        ];

        if ($request->input('remove_photo') == '1') {
            if ($report->photo && Storage::disk('public')->exists($report->photo)) {
                Storage::disk('public')->delete($report->photo);
            }
            $data['photo'] = null;
        }

        if ($request->hasFile('photo')) {
            if ($report->photo && Storage::disk('public')->exists($report->photo)) {
                Storage::disk('public')->delete($report->photo);
            }
            $data['photo'] = $request->file('photo')->store('incidents', 'public');
        }

        $report->update($data);

        return redirect()->back()->with('success', 'Incident report updated successfully.');
    }

    public function destroy($id)
    {
        $report = IncidentReport::findOrFail($id);
        if ($report->photo && Storage::disk('public')->exists($report->photo)) {
            Storage::disk('public')->delete($report->photo);
        }
        $report->delete();
        return redirect()->back()->with('success', 'Incident report deleted successfully.');
    }
}