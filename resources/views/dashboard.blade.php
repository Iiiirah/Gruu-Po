<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Brgy. Sibul Springs</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark m-0 font-sans antialiased">
    <div class="d-flex vh-100 overflow-hidden position-relative">
        
        <!-- SIDEBAR -->
        <aside id="mainSidebar" class="sidebar-transition d-flex flex-column justify-between border-end border-sky-200 shadow-lg" style="background-image: url('{{ asset('images/BG2.png') }}'); width: 288px; min-width: 288px; background-size: cover; background-position: right-bottom;">
            <div id="fullMenu" class="d-flex flex-column justify-between h-100 w-100">
                <div>
                    <div class="p-3 border-bottom border-sky-300/40">
                        <button class="btn btn-outline-dark p-2 border-0 shadow-none fs-4 fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#slidingMenuDrawer" aria-controls="slidingMenuDrawer">
                            ☰
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        <div class="d-flex justify-content-center mb-2">
                            <div class="bg-white/80 rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 64px; height: 64px;">
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 style="font-size: 0.75rem;" class="fw-extrabold text-dark tracking-wide m-0">BRGY. SIBUL SPRINGS</h5>
                        <p style="font-size: 9px;" class="text-dark fw-medium m-0">Community Information and Document Request System</p>
                    </div>
                    <div class="px-4 py-2 text-xs fw-bold text-dark text-uppercase tracking-wider mt-2" style="font-size: 0.75rem;">Menu</div>
                    <nav class="flex-1 space-y-1 px-3 d-flex flex-column gap-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-link active">Dashboard</a>
                        <a href="{{ route('community.information') }}" class="sidebar-link">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
                        <a href="{{ route('user.management') }}" class="sidebar-link">User Management</a>
                    </nav>
                </div>
                <div class="p-4"></div>
            </div>
        </aside>

        <!-- SLIDING OFFCANVAS DRAWER -->
        <div class="offcanvas offcanvas-start text-dark border-end shadow-lg" tabindex="-1" id="slidingMenuDrawer" aria-labelledby="slidingMenuDrawerLabel" data-bs-backdrop="false" data-bs-scroll="true" style="width: 288px; min-width: 288px; background-image: url('{{ asset('images/BG2.png') }}'); background-size: cover; background-position: right-bottom;">
            <div class="offcanvas-header border-bottom border-sky-300/40 px-4 py-3">
                <h5 class="offcanvas-title fw-bold fs-6 text-uppercase" id="slidingMenuDrawerLabel">System Menu</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-between p-0">
                <div class="nav flex-column p-3 gap-2">
                    <a href="{{ route('about') }}" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">About</a>
                    <a href="{{ route('settings') }}" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">Settings</a>
                    <form class="w-100">
                        <button type="button" class="nav-link text-danger fw-semibold py-2 px-3 w-100 text-start bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            Log Out
                        </button>
                    </form>
                </div>
                <div></div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4 min-vh-100">
                
                <!-- Dashboard Top Header -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-bold text-dark fs-2 mb-1">Admin Dashboard</h1>
                        <p class="text-muted text-sm mb-0">Overview of document requests, latest announcements, reports</p>
                    </div>
                    
                </div>

                <!-- Top Statistics Cards Row -->
                <div class="row g-4 mb-4">
                    <!-- Approved Requests Card -->
                    <div class="col-md-4">
                        <a href="{{ route('documentsrequest', ['filter' => 'Approved']) }}" class="text-decoration-none">
                            <div class="card rounded-4 p-4 shadow-sm bg-white border h-100 position-relative hover-shadow" style="transition: transform 0.2s;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark">Approved Requests</span>
                                    <span class="rounded-circle bg-success d-inline-block" style="width: 12px; height: 12px;"></span>
                                </div>
                                <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">{{ $approvedCount ?? 0 }}</h2>
                            </div>
                        </a>
                    </div>
                    <!-- In Progress Requests Card -->
                    <div class="col-md-4">
                        <a href="{{ route('documentsrequest', ['filter' => 'In Progress']) }}" class="text-decoration-none">
                            <div class="card rounded-4 p-4 shadow-sm bg-white border h-100 position-relative hover-shadow" style="transition: transform 0.2s;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark">In Progress Requests</span>
                                    <span class="rounded-circle bg-warning d-inline-block" style="width: 12px; height: 12px;"></span>
                                </div>
                                <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">{{ $inProgressCount ?? 0 }}</h2>
                            </div>
                        </a>
                    </div>
                    <!-- Received Requests Card -->
                    <div class="col-md-4">
                        <a href="{{ route('documentsrequest', ['filter' => 'Received']) }}" class="text-decoration-none">
                            <div class="card rounded-4 p-4 shadow-sm bg-white border h-100 position-relative hover-shadow" style="transition: transform 0.2s;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark">Received Requests</span>
                                    <span class="rounded-circle bg-primary d-inline-block" style="width: 12px; height: 12px;"></span>
                                </div>
                                <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">{{ $receivedCount ?? 0 }}</h2>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Announcement Section -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Recent Announcement</h5>
                        <a href="{{ route('community.information') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold text-xs">View All</a>
                    </div>
                    
                    <div class="d-flex flex-column gap-3">
                        @forelse($announcements ?? [] as $announcement)
                            @php
                                $announcementImage = $announcement->photo ?? $announcement->image ?? $announcement->file ?? null;
                            @endphp
                            <div class="card border rounded-3 p-3 shadow-sm">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="border rounded-3 text-center text-muted text-sm bg-light overflow-hidden d-flex align-items-center justify-content-center" style="width: 100px; height: 80px; min-width: 100px;">
                                        @if(!empty($announcementImage))
                                            <!-- Ginawang clickable ang photo para magbukas sa bagong tab -->
                                            <a href="{{ asset('storage/' . $announcementImage) }}" target="_blank" title="Click to view full image">
                                                <img src="{{ asset('storage/' . $announcementImage) }}" alt="Post Preview" class="w-100 h-100 object-fit-cover rounded-3">
                                            </a>
                                        @else
                                            <span style="font-size: 11px;">Post Preview</span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="fw-bold text-dark mb-1">{{ $announcement->title ?? 'Announcement' }}</h6>
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1" style="font-size: 10px;">{{ ucfirst($announcement->category ?? $announcement->type ?? 'Announcement') }}</span>
                                        </div>
                                        <p class="text-muted text-sm mb-1">{{ Str::limit($announcement->content ?? $announcement->description ?? '', 100) }}</p>
                                        <div class="text-end text-muted" style="font-size: 11px;">{{ $announcement->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border rounded-3 p-4 text-center text-muted">
                                <p class="mb-0 text-sm">Walang kasalukuyang mga anunsyo.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Requests Section -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Recent Requests</h5>
                        <a href="{{ route('documentsrequest') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold text-xs">View All</a>
                    </div>
                    
                    <div class="d-flex flex-column gap-2">
                        @forelse($recentRequests ?? [] as $req)
                            @php
                                $status = trim($req->status ?? 'Received');
                                $dotColor = 'bg-primary';
                                if($status == 'Approved') { $dotColor = 'bg-success'; }
                                elseif($status == 'In Progress') { $dotColor = 'bg-warning'; }
                            @endphp
                            <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="rounded-circle {{ $dotColor }} d-inline-block" style="width: 10px; height: 10px;"></span>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 fs-6">{{ $req->document_type ?? $req->service_type ?? 'Document Request' }}</h6>
                                        <span class="text-muted" style="font-size: 11px;">{{ $status }}</span>
                                    </div>
                                </div>
                                <div class="fw-semibold text-dark text-sm">{{ $req->user->name ?? $req->resident_name ?? 'N/A' }}</div>
                                <div class="text-muted text-sm"><strong>Date:</strong> {{ $req->created_at->format('F d, Y') }}</div>
                            </div>
                        @empty
                            <div class="card border rounded-3 p-4 text-center text-muted">
                                <p class="mb-0 text-sm">Walang mga huling kahilingan sa dokumento.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Reports Section -->
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">Recent Reports</h5>
                        <a href="{{ route('incident.reports') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold text-xs">View All</a>
                    </div>
                    
                    <div class="d-flex flex-column gap-2">
                        @forelse($recentReports ?? [] as $report)
                            @php
                                $repStatus = trim(ucfirst(strtolower($report->status ?? 'New')));
                                $badgeBg = '#d1e7dd'; $badgeColor = '#0f5132';
                                if($repStatus == 'Verified') { $badgeBg = '#cff4fc'; $badgeColor = '#055160'; }
                                elseif($repStatus == 'New') { $badgeBg = '#fff3cd'; $badgeColor = '#664d03'; }
                                
                                $reportId = $report->report_id ?? ('IDT-' . str_pad($report->id, 3, '0', STR_PAD_LEFT));
                                $incidentType = $report->incident_type ?? $report->issue ?? 'Incident';
                            @endphp
                            <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                                <div>
                                    <span class="fw-bold text-dark text-sm">{{ $reportId }} <span class="text-danger">{{ $incidentType }}</span></span>
                                    <div class="text-muted" style="font-size: 11px;">{{ $report->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill px-3 py-1" style="font-size: 11px; background-color: {{ $badgeBg }}; color: {{ $badgeColor }};">{{ $repStatus }}</span>
                                    <a href="{{ route('incident.reports') }}" class="btn btn-sm btn-outline-primary py-0 px-2 text-decoration-none" style="font-size: 11px;">View</a>
                                </div>
                            </div>
                        @empty
                            <div class="card border rounded-3 p-4 text-center text-muted">
                                <p class="mb-0 text-sm">Walang mga huling ulat ng insidente.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center">
                <div class="modal-body py-4">
                    <h3 class="fw-bold text-dark fs-2 mb-0">
                        Are you sure you want<br>to Log Out?
                    </h3>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-3 pb-2">
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>