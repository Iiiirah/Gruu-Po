<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard | Brgy. Sibul Springs</title>
    <link rel="stylesheet" href="{{ asset('css/resident-dashboard.css') }}">
    <style>
        .section-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .section-header-flex .section-title {
            margin-bottom: 0 !important;
        }
        .view-all-btn {
            font-size: 0.85rem;
            font-weight: 600;
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s;
        }
        .view-all-btn:hover {
            text-decoration: underline;
            color: #0056b3;
        }
        .dashboard-empty-state {
            padding: 1.5rem;
            text-align: center;
            background: #fff;
            border-radius: 8px;
            color: #6c757d;
            font-size: 0.9rem;
            border: 1px dashed #dee2e6;
            display: block !important;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <!-- Header -->
    <header class="dashboard-header">
        <img
            src="{{ asset('images/LogoSibul.png') }}"
            alt="Barangay Logo"
            class="barangay-logo"
        >
        <h1>BRGY. SIBUL SPRINGS</h1>
        <p>San Miguel, Bulacan</p>
    </header>
    <main class="dashboard-content">
        <!-- Welcome -->
        <section class="welcome-section">
            <h2>Resident Dashboard</h2>
            <p>Stay updated with your community.</p>
        </section>

        <!-- FORCE DATA FETCHING PARA SA ANNOUNCEMENTS, REQUESTS, AT REPORTS -->
        @php
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\DB;

            $userId = Auth::check() ? Auth::id() : null;

            // 1. Announcements (Top 3 mula kay Admin)
            $displayAnnouncements = \App\Models\Announcement::latest()->take(3)->get();

            // 2. Requests (Top 3 para sa kasalukuyang user - pilit nating hinahanap kahit anong posibleng table name)
            $displayRequests = collect();
            if ($userId) {
                try {
                    if (\Illuminate\Support\Facades\Schema::hasTable('document_requests')) {
                        $displayRequests = DB::table('document_requests')->where('user_id', $userId)->latest()->take(3)->get();
                    } elseif (\Illuminate\Support\Facades\Schema::hasTable('requests')) {
                        $displayRequests = DB::table('requests')->where('user_id', $userId)->latest()->take(3)->get();
                    }
                } catch (\Exception $e) {
                    $displayRequests = collect();
                }
            }

            // 3. Reports (Top 3 para sa kasalukuyang user)
            $displayReports = collect();
            if ($userId) {
                try {
                    if (\Illuminate\Support\Facades\Schema::hasTable('incident_reports')) {
                        $displayReports = DB::table('incident_reports')->where('user_id', $userId)->latest()->take(3)->get();
                    } elseif (\Illuminate\Support\Facades\Schema::hasTable('reports')) {
                        $displayReports = DB::table('reports')->where('user_id', $userId)->latest()->take(3)->get();
                    }
                } catch (\Exception $e) {
                    $displayReports = collect();
                }
            }
        @endphp

        <!-- Recent Announcement -->
        <section class="dashboard-section">
            <div class="section-header-flex">
                <h3 class="section-title">Recent Announcement</h3>
                <a href="{{ url('/resident-community-information') }}" class="view-all-btn">View All &rarr;</a>
            </div>

            @if($displayAnnouncements->count() > 0)
                @foreach($displayAnnouncements as $announcement)
                    <a href="{{ url('/resident-community-information') }}" class="dashboard-link" style="display: block; margin-bottom: 10px; text-decoration: none;">
                        <article class="announcement-card" style="display: flex; width: 100%;">
                            <!-- Announcement Photo on the Left -->
                            <div class="announcement-photo">
                                @if(!empty($announcement->image))
                                    <img
                                        src="{{ asset('storage/' . $announcement->image) }}"
                                        alt="{{ $announcement->title }}"
                                        style="object-fit: cover; width: 100%; height: 100%;"
                                        onerror="this.style.display='none';"
                                    >
                                @else
                                    <div style="width: 80px; height: 60px; background: #e9ecef; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #6c757d; border-radius: 4px;">
                                        Post Preview
                                    </div>
                                @endif
                            </div>
                            <!-- Announcement Details -->
                            <div class="announcement-content" style="flex-grow: 1; padding: 0 15px;">
                                <h4>{{ $announcement->title }}</h4>
                                <p>{{ Str::limit($announcement->content, 80) }}</p>
                            </div>
                            <!-- Announcement Category and Date -->
                            <div class="announcement-meta">
                                <span class="announcement-label">
                                    {{ strtoupper($announcement->type ?? 'ANNOUNCEMENT') }}
                                </span>
                                <span class="announcement-date">
                                    {{ $announcement->created_at ? \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') : '' }}
                                </span>
                            </div>
                        </article>
                    </a>
                @endforeach
            @else
                <div class="dashboard-empty-state">
                    Empty.... No announcements available at the moment.
                </div>
            @endif
        </section>

        <!-- Recent Requests (Forced to show top 3 personal requests) -->
        <section class="dashboard-section">
            <div class="section-header-flex">
                <h3 class="section-title">Recent Requests</h3>
                <a href="{{ url('/resident-document-request') }}" class="view-all-btn">View All &rarr;</a>
            </div>

            @if($displayRequests->count() > 0)
                @foreach($displayRequests as $req)
                    <article class="activity-card request-card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="request-dot {{ strtolower($req->status ?? '') == 'approved' ? 'approved-dot' : 'progress-dot' }}"></span>
                            <div class="request-title">
                                <h4>{{ $req->document_type ?? ($req->title ?? 'Document Request') }}</h4>
                                <p>{{ $req->status ?? 'In Progress' }}</p>
                            </div>
                        </div>
                        <div class="request-owner" style="text-align: right;">
                            <h4>{{ $req->name ?? (Auth::check() ? Auth::user()->name : 'Resident') }}</h4>
                            <p>{{ isset($req->created_at) ? \Carbon\Carbon::parse($req->created_at)->format('M d, Y') : '' }}</p>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="dashboard-empty-state">
                    Empty.... No document requests found.
                </div>
            @endif
        </section>

        <!-- Recent Reports -->
        <section class="dashboard-section">
            <div class="section-header-flex">
                <h3 class="section-title">Recent Reports</h3>
                <a href="{{ url('/resident-reports') }}" class="view-all-btn">View All &rarr;</a>
            </div>

            @if($displayReports->count() > 0)
                @foreach($displayReports as $rep)
                    <article class="activity-card report-card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                        <div class="activity-details">
                            <h4>
                                <span class="report-id">{{ $rep->report_code ?? ('IDT-00' . $rep->id) }}</span>
                                {{ $rep->incident_type ?? ($rep->title ?? 'Incident Report') }}
                            </h4>
                            <p>{{ isset($rep->created_at) ? \Carbon\Carbon::parse($rep->created_at)->format('M d, Y') : '' }}</p>
                        </div>
                        <span class="status {{ strtolower($rep->status ?? 'verified') }}">
                            {{ ucfirst($rep->status ?? 'Verified') }}
                        </span>
                    </article>
                @endforeach
            @else
                <div class="dashboard-empty-state">
                    Empty.... No incident reports found.
                </div>
            @endif
        </section>
    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <!-- Dashboard -->
        <a href="{{ url('/resident-dashboard') }}"
           class="nav-item active"
           aria-current="page">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 10.5 12 3l9 7.5"></path>
                <path d="M5.5 9.5V21h13V9.5"></path>
                <path d="M9 21v-7h6v7"></path>
            </svg>
            <span>Dashboard</span>
        </a>
        <!-- Community Information -->
        <a href="{{ url('/resident-community-information') }}"
           class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 3h14v18H5z"></path>
                <path d="M8 8h8M8 12h8M8 16h5"></path>
            </svg>
            <span>Community</span>
        </a>
        <!-- Document Request -->
        <a href="{{ url('/resident-document-request') }}"
           class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 3h9l4 4v14H6z"></path>
                <path d="M15 3v5h4M9 12h7M9 16h7"></path>
            </svg>
            <span>Requests</span>
        </a>
        <!-- Incident Reports -->
        <a href="{{ url('/resident-reports') }}"
           class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3 22 21H2z"></path>
                <path d="M12 9v5M12 17h.01"></path>
            </svg>
            <span>Reports</span>
        </a>
        <!-- About -->
        <a href="{{ url('/resident-about') }}"
           class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21a8 8 0 0 1 16 0"></path>
            </svg>
            <span>About</span>
        </a>
    </nav>
</div>
</body>
</html>