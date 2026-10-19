<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\DocumentRequest;
use App\Models\IncidentReport;

class DashboardController extends Controller
{
    public function index()
{
    // 1. Stat card counts
    $approvedCount = 5;
    $inProgressCount = 2;
    $receivedCount = 8;

    // 2. Mock front-end data (so it doesn't query the database)
    $recentAnnouncement = (object) [
        'title' => 'Renovation in Zone 1',
        'content' => 'Some of Zone 1 infrastructure will be temporarily closed due to the renovation.',
        'date' => 'Oct 9, 2026'
    ];

    $recentRequests = [
        (object) ['title' => 'Certificate of Indigency', 'status' => 'Approved', 'name' => 'Mark Anthony Santos', 'date' => 'October 7, 2026'],
        (object) ['title' => 'Certificate of Residency', 'status' => 'In Progress', 'name' => 'Maria Kristina Dela Cruz', 'date' => 'October 8, 2026']
    ];

    $recentReports = [
        (object) ['code' => 'IDT-001', 'type' => 'Fire', 'status' => 'Verified', 'date' => 'Oct 10, 2026'],
        (object) ['code' => 'IDT-002', 'type' => 'Flood', 'status' => 'Resolved', 'date' => 'Oct 9, 2026']
    ];

    return view('dashboard', compact(
        'approvedCount', 
        'inProgressCount', 
        'receivedCount', 
        'recentAnnouncement', 
        'recentRequests', 
        'recentReports'
    ));
}
}