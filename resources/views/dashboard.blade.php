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
        <aside id="mainSidebar" class="sidebar-transition d-flex flex-column justify-between border-end border-sky-200 shadow-lg" style="background-image: url('{{ asset('images/bg.jpg') }}'); width: 288px; min-width: 288px; background-size: cover; background-position: center;">
            
            <!-- FULL MENU VIEW -->
            <div id="fullMenu" class="d-flex flex-column justify-between h-100 w-100">
                <div>
                    <!-- Sidebar Header / Burger Toggle Button -->
                    <div class="p-3 border-bottom border-sky-300/40">
                        <button class="btn btn-outline-dark p-2 border-0 shadow-none fs-4 fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#slidingMenuDrawer" aria-controls="slidingMenuDrawer">
                            ☰
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <div class="d-flex justify-content-center mb-2">
                            <div class="bg-white/80 rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 64px; height: 64px;">
                                <img src="{{ asset('images/logo.jpg') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 style="font-size: 0.75rem;" class="fw-extrabold text-dark tracking-wide m-0">BRGY. SIBUL SPRINGS</h5>
                        <p style="font-size: 9px;" class="text-dark fw-medium m-0">Community Information and Document Request System</p>
                    </div>

                    <!-- Menu Navigation -->
                    <div class="px-4 py-2 text-xs fw-bold text-dark text-uppercase tracking-wider mt-2" style="font-size: 0.75rem;">Menu</div>
                    <nav class="flex-1 space-y-1 px-3 d-flex flex-column gap-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-link @if(request()->routeIs('dashboard')) active @endif">Dashboard</a>
                        <a href="{{ route('community.information') }}" class="sidebar-link @if(request()->routeIs('community.information')) active @endif">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link @if(request()->routeIs('documentsrequest')) active @endif">Online Document Request</a>
                        <a href="#" class="sidebar-link">Incident Report Information</a>
                        <a href="#" class="sidebar-link">User Management</a>
                    </nav>
                </div>
                <div class="p-4"></div>
            </div>
        </aside>

        <!-- SLIDING OFFCANVAS DRAWER (Moved outside the sidebar structure to prevent layout breaks) -->
        <div class="offcanvas offcanvas-start text-dark border-end shadow-lg" tabindex="-1" id="slidingMenuDrawer" aria-labelledby="slidingMenuDrawerLabel">
            <div class="offcanvas-header border-bottom border-sky-300/40 px-4 py-3">
                <h5 class="offcanvas-title fw-bold fs-6 text-uppercase" id="slidingMenuDrawerLabel">System Menu</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-between p-0">
                <div class="nav flex-column p-3 gap-2">
                    <a href="{{ route('about') }}" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">About</a>
                    <a href="#" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">Settings</a>
                    <form method="POST" action="#" class="w-100">
                        @csrf
                        <button type="submit" class="nav-link text-danger fw-semibold py-2 px-3 w-100 text-start bg-transparent border-0">
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
                        <h1 class="fw-bold text-dark fs-2 mb-1">Dashboard</h1>
                        <p class="text-muted text-sm mb-0">Overview of document requests, latest announcements, reports</p>
                    </div>
                    <button class="btn btn-outline-secondary px-4 py-1 rounded-pill fw-semibold text-sm">Admin</button>
                </div>

                <!-- Top Statistics Cards Row -->
                <div class="row g-4 mb-4">
                    <!-- Approved Requests Card -->
                    <div class="col-md-4">
                        <div class="card card-approved-bg rounded-4 p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Approved Requests</span>
                                <span class="rounded-circle bg-success d-inline-block" style="width: 12px; height: 12px;"></span>
                            </div>
                            <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">5</h2>
                        </div>
                    </div>
                    <!-- In Progress Requests Card -->
                    <div class="col-md-4">
                        <div class="card card-progress-bg rounded-4 p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">In Progress Requests</span>
                                <span class="rounded-circle bg-warning d-inline-block" style="width: 12px; height: 12px;"></span>
                            </div>
                            <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">2</h2>
                        </div>
                    </div>
                    <!-- Received Requests Card -->
                    <div class="col-md-4">
                        <div class="card card-received-bg rounded-4 p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">Received Requests</span>
                                <span class="rounded-circle bg-primary d-inline-block" style="width: 12px; height: 12px;"></span>
                            </div>
                            <h2 class="fw-bold display-5 mt-2 mb-0 text-dark" style="text-decoration: underline;">8</h2>
                        </div>
                    </div>
                </div>

                <!-- Recent Announcement Section -->
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-3">Recent Announcement</h5>
                    <div class="card border rounded-3 p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3">
                            <div class="border rounded-3 p-4 text-center text-muted text-sm bg-light" style="width: 100px; height: 80px;">
                                <span style="font-size: 11px;">Post Preview</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold text-dark mb-1">Renovation in Zone 1</h6>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1" style="font-size: 10px;">Announcement</span>
                                </div>
                                <p class="text-muted text-sm mb-1">Some of Zone 1 infrastructure will be temporarily closed due to the renovation.</p>
                                <div class="text-end text-muted" style="font-size: 11px;">Oct 9, 2026</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-2 pt-2 border-top">
                            <button class="btn btn-sm btn-outline-danger px-3 py-0" style="font-size: 12px;">Delete</button>
                            <button class="btn btn-sm btn-outline-primary px-3 py-0" style="font-size: 12px;">View</button>
                        </div>
                    </div>
                </div>

                <!-- Recent Requests Section -->
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-3">Recent Requests</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-success d-inline-block" style="width: 10px; height: 10px;"></span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0 fs-6">Certificate of Indigency</h6>
                                    <span class="text-muted" style="font-size: 11px;">Approved</span>
                                </div>
                            </div>
                            <div class="fw-semibold text-dark text-sm">Mark Anthony Santos</div>
                            <div class="text-muted text-sm"><strong>Date:</strong> October 7, 2026</div>
                        </div>

                        <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="rounded-circle bg-warning d-inline-block" style="width: 10px; height: 10px;"></span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0 fs-6">Certificate of Residency</h6>
                                    <span class="text-muted" style="font-size: 11px;">In Progress</span>
                                </div>
                            </div>
                            <div class="fw-semibold text-dark text-sm">Maria Kristina Dela Cruz</div>
                            <div class="text-muted text-sm"><strong>Date:</strong> October 8, 2026</div>
                        </div>
                    </div>
                </div>

                <!-- Recent Reports Section -->
                <div>
                    <h5 class="fw-bold text-dark mb-3">Recent Reports</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <span class="fw-bold text-dark text-sm">IDT-001 <span class="text-danger">Fire</span></span>
                                <div class="text-muted" style="font-size: 11px;">Oct 10, 2026</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3" style="font-size: 11px;">Verified</span>
                                <button class="btn btn-sm btn-outline-danger py-0 px-2" style="font-size: 11px;">Delete</button>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 11px;">View</button>
                            </div>
                        </div>

                        <div class="card border rounded-3 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <span class="fw-bold text-dark text-sm">IDT-002 <span class="text-primary">Flood</span></span>
                                <div class="text-muted" style="font-size: 11px;">Oct 9, 2026</div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3" style="font-size: 11px;">Resolved</span>
                                <button class="btn btn-sm btn-outline-danger py-0 px-2" style="font-size: 11px;">Delete</button>
                                <button class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 11px;">View</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>