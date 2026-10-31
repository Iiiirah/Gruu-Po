<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\DocumentRequest;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Bilang ng requests para sa 3 statistics cards
        $approvedCount = DocumentRequest::where('status', 'Approved')->count();
        $inProgressCount = DocumentRequest::where('status', 'In Progress')->count();
        $receivedCount = DocumentRequest::where('status', 'Received')->count();

        // 2. Recent Announcement (Max 3 para sa admin dashboard)
        $announcements = Announcement::latest()->take(3)->get();

        // 3. Recent Requests (Hanggang 6 na pinakabago, o kung ilan man ang magkasya kung mas mababa sa 6)
        $recentRequests = DocumentRequest::latest()->take(6)->get();

        // 4. Recent Reports (Max 3 para sa admin dashboard)
        $recentReports = IncidentReport::latest()->take(3)->get();

        return view('dashboard', compact(
            'approvedCount',
            'inProgressCount',
            'receivedCount',
            'announcements',
            'recentRequests',
            'recentReports'
        ));
    }

    public function residentDashboard()
    {
        $userId = Auth::id();

        $approvedCount = DocumentRequest::where('user_id', $userId)->where('status', 'Approved')->count();
        $inProgressCount = DocumentRequest::where('user_id', $userId)->where('status', 'In Progress')->count();
        $receivedCount = DocumentRequest::where('user_id', $userId)->count();

        $announcements = Announcement::latest()->take(3)->get();
        $requests = DocumentRequest::where('user_id', $userId)->latest()->take(3)->get();
        $reports = IncidentReport::where('user_id', $userId)->latest()->take(3)->get();

        return view('resident-dashboard', compact(
            'approvedCount', 
            'inProgressCount', 
            'receivedCount', 
            'announcements', 
            'requests', 
            'reports'
        ));
    }
}