<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResidentPureReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResidentIncidentReportController extends Controller
{
    public function index()
    {
        $reports = ResidentPureReport::where('user_id', Auth::id())->latest()->get();
        return view('resident-reports', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'incident_type' => 'required|string',
            'zone' => 'required|string',
            'incident_date' => 'required|date',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $count = ResidentPureReport::count() + 1;
        $referenceNo = 'IDT-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('incident_photos', 'public');
        }

        ResidentPureReport::create([
            'user_id' => Auth::id(),
            'reference_no' => $referenceNo,
            'incident_type' => $request->incident_type,
            'zone' => $request->zone,
            'incident_date' => $request->incident_date,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'New',
        ]);

        return redirect()->back()->with('success', 'Incident report submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        $report = ResidentPureReport::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'incident_type' => 'required|string',
            'zone' => 'required|string',
            'incident_date' => 'required|date',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $report->photo;

        // Kung pinindot ang Remove Photo
        if ($request->input('remove_photo') == '1') {
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = null;
        }

        // Kung may bagong ini-upload na litrato
        if ($request->hasFile('photo')) {
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('incident_photos', 'public');
        }

        $report->update([
            'incident_type' => $request->incident_type,
            'zone' => $request->zone,
            'incident_date' => $request->incident_date,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Incident report updated successfully.');
    }

    public function destroy($id)
    {
        $report = ResidentPureReport::where('user_id', Auth::id())->findOrFail($id);
        if ($report->photo && Storage::disk('public')->exists($report->photo)) {
            Storage::disk('public')->delete($report->photo);
        }
        $report->delete();

        return redirect()->back()->with('success', 'Incident report deleted successfully.');
    }
}