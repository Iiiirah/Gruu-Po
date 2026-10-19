<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Information - Brgy. Sibul Springs</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark m-0 font-sans antialiased">

    <div class="d-flex vh-100 overflow-hidden position-relative">
        
        <!-- SIDEBAR -->
        <aside id="mainSidebar" class="sidebar-transition d-flex flex-column justify-between border-end border-sky-200 shadow-lg" style="background-image: url('{{ asset('images/bg.jpg') }}'); width: 288px; min-width: 288px; background-size: cover; background-position: center;">
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
                                <img src="{{ asset('images/logo.jpg') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 style="font-size: 0.75rem;" class="fw-extrabold text-dark tracking-wide m-0">BRGY. SIBUL SPRINGS</h5>
                        <p style="font-size: 9px;" class="text-dark fw-medium m-0">Community Information and Document Request System</p>
                    </div>

                    <div class="px-4 py-2 text-xs fw-bold text-dark text-uppercase tracking-wider mt-2" style="font-size: 0.75rem;">Menu</div>
                    <nav class="flex-1 space-y-1 px-3 d-flex flex-column gap-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
                        <a href="{{ route('community.information') }}" class="sidebar-link">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link active">Incident Report Information</a>
                        <a href="{{ route('user.management') }}" class="sidebar-link">User Management</a>
                    </nav>
                </div>
                <div class="p-4"></div>
            </div>
        </aside>

        <!-- SLIDING OFFCANVAS DRAWER -->
        <div class="offcanvas offcanvas-start text-dark border-end shadow-lg" tabindex="-1" id="slidingMenuDrawer" aria-labelledby="slidingMenuDrawerLabel" data-bs-backdrop="false" data-bs-scroll="true" style="width: 288px; min-width: 288px; background-image: url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center;">
            <div class="offcanvas-header border-bottom border-sky-300/40 px-4 py-3">
                <h5 class="offcanvas-title fw-bold fs-6 text-uppercase" id="slidingMenuDrawerLabel">System Menu</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-between p-0">
                <div class="nav flex-column p-3 gap-2">
                    <a href="{{ route('about') }}" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">About</a>
                    <a href="{{ route('settings') }}" class="nav-link text-gray-900 fw-semibold py-2 px-3 rounded bg-white/40 shadow-sm text-decoration-none">Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-100" onsubmit="return confirm('Are you sure you want to log out?');">
                        @csrf
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
                
                <!-- Page Title -->
                <div class="mb-4">
                    <h1 class="fw-bold text-dark fs-2 mb-1">Incident Report Information</h1>
                </div>

                <!-- 5 Statistics Cards Row -->
                <div class="row g-3 mb-4">
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span>🏴</span> <span>Total Reports</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">47</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-primary d-inline-block" style="width: 8px; height: 8px;"></span> <span>Flood</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">18</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-danger d-inline-block" style="width: 8px; height: 8px;"></span> <span>Fire</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">7</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-warning d-inline-block" style="width: 8px; height: 8px;"></span> <span>Landslide</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">9</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-info d-inline-block" style="width: 8px; height: 8px;"></span> <span>Other</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">13</h3>
                        </div>
                    </div>
                </div>

                <!-- Incident Reports Container Box -->
                <div class="border rounded-4 p-4 bg-white shadow-sm">
                    
                    <!-- Sub-header Controls -->
                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <select id="zoneSelect" class="form-select fw-semibold text-dark bg-light rounded-pill px-3 py-2 text-sm shadow-sm" style="width: 140px;">
                                <option value="all" selected>All Zones</option>
                                <option value="Zone 1">Zone 1</option>
                                <option value="Zone 2">Zone 2</option>
                                <option value="Zone 3">Zone 3</option>
                            </select>
                            <div class="border rounded-pill px-3 py-2 bg-light text-muted text-sm fw-medium shadow-sm">
                                Report/s <strong class="text-dark" id="reportCountBadge">4</strong>
                            </div>
                        </div>

                        <!-- Search and Filter Buttons -->
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <div class="input-group" style="max-width: 240px;">
                                <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
                                <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm" placeholder="Search Report...">
                            </div>
                            <div class="btn-group" role="group" id="filterTabs">
                                <button type="button" class="btn btn-outline-secondary text-sm px-3 active" data-filter="all">All</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Verified">Verified</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Resolved">Resolved</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="New">New</button>
                            </div>
                        </div>
                    </div>

                    <!-- Report Item List -->
                    <div class="d-flex flex-column gap-3" id="reportsContainer">
                        
                        <!-- Report 1 -->
                        <div class="card border rounded-4 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between report-item" data-zone="Zone 1" data-status="Verified">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 fs-6 report-title">IDT-001 <span class="text-danger">Fire</span></h6>
                                <span class="text-muted report-date" style="font-size: 11px;">Oct 10, 2026</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #a7f3d0; color: #047857;">Verified</span>
                                <button class="btn btn-sm btn-outline-danger px-3 py-1 text-xs fw-semibold rounded-3 delete-btn">Delete</button>
                                <button class="btn btn-sm btn-outline-primary px-3 py-1 text-xs fw-semibold rounded-3 view-btn" 
                                    data-id="IDT-001" 
                                    data-area="Zone 1" 
                                    data-issue="Fire" 
                                    data-desc="Structure fire incident reported and verified." 
                                    data-date="10/10/2026" 
                                    data-reporter="Resus, Irah">View</button>
                            </div>
                        </div>

                        <!-- Report 2 -->
                        <div class="card border rounded-4 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between report-item" data-zone="Zone 1" data-status="Resolved">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 fs-6 report-title">IDT-002 <span class="text-primary">Flood</span></h6>
                                <span class="text-muted report-date" style="font-size: 11px;">Oct 9, 2026</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bbf7d0; color: #15803d;">Resolved</span>
                                <button class="btn btn-sm btn-outline-danger px-3 py-1 text-xs fw-semibold rounded-3 delete-btn">Delete</button>
                                <button class="btn btn-sm btn-outline-primary px-3 py-1 text-xs fw-semibold rounded-3 view-btn" 
                                    data-id="IDT-002" 
                                    data-area="Zone 1" 
                                    data-issue="Flood" 
                                    data-desc="Path ways are sunk." 
                                    data-date="10/09/2026" 
                                    data-reporter="Resus, Irah">View</button>
                            </div>
                        </div>

                        <!-- Report 3 -->
                        <div class="card border rounded-4 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between report-item" data-zone="Zone 2" data-status="New">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 fs-6 report-title">IDT-003 <span class="text-warning">Landslide</span></h6>
                                <span class="text-muted report-date" style="font-size: 11px;">Sept 20, 2026</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #fef08a; color: #854d0e;">New</span>
                                <button class="btn btn-sm btn-outline-danger px-3 py-1 text-xs fw-semibold rounded-3 delete-btn">Delete</button>
                                <button class="btn btn-sm btn-outline-primary px-3 py-1 text-xs fw-semibold rounded-3 view-btn" 
                                    data-id="IDT-003" 
                                    data-area="Zone 2" 
                                    data-issue="Landslide" 
                                    data-desc="Minor soil erosion near roadside." 
                                    data-date="09/20/2026" 
                                    data-reporter="Santos, Mark">View</button>
                            </div>
                        </div>

                        <!-- Report 4 -->
                        <div class="card border rounded-4 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between report-item" data-zone="Zone 3" data-status="Verified">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 fs-6 report-title">IDT-004 <span class="text-info">Thief</span></h6>
                                <span class="text-muted report-date" style="font-size: 11px;">Oct 1, 2026</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #a7f3d0; color: #047857;">Verified</span>
                                <button class="btn btn-sm btn-outline-danger px-3 py-1 text-xs fw-semibold rounded-3 delete-btn">Delete</button>
                                <button class="btn btn-sm btn-outline-primary px-3 py-1 text-xs fw-semibold rounded-3 view-btn" 
                                    data-id="IDT-004" 
                                    data-area="Zone 3" 
                                    data-issue="Thief" 
                                    data-desc="Stolen bicycle reported." 
                                    data-date="10/01/2026" 
                                    data-reporter="Cruz, Maria">View</button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Removing Row Confirmation Modal -->
    <div class="modal fade" id="deleteReportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center">
                <div class="modal-header border-0 pb-0 justify-content-start">
                    <h4 class="modal-title fw-bold text-dark fs-4">Removing Row</h4>
                </div>
                <div class="modal-body py-4">
                    <p class="fw-bold text-dark fs-5 mb-0">Are you sure you want to delete this row?</p>
                </div>
                <div class="modal-footer border-0 justify-content-end gap-2 pb-2">
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal" style="min-width: 100px;">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold shadow-sm text-white" style="background-color: #ff0000; min-width: 100px;">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Incident Report Modal (Exact Mockup Match) -->
    <div class="modal fade" id="viewReportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">Incident Report</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-0 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Report ID</label>
                            <input type="text" id="modalReportId" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Area</label>
                            <input type="text" id="modalReportArea" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Issue Reported</label>
                            <input type="text" id="modalReportIssue" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Description</label>
                            <input type="text" id="modalReportDesc" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center text-muted fw-semibold shadow-inner" style="height: 180px;">
                            <span class="tracking-widest fs-5 text-secondary">IMAGE</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Date/Time Reported</label>
                            <input type="text" id="modalReportDate" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Reported By</label>
                            <input type="text" id="modalReportReporter" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 px-0 pt-2 justify-content-end">
                    <button type="button" class="btn text-white fw-bold px-5 py-2 rounded-3 shadow-sm" data-bs-dismiss="modal" style="background-color: #00c800;">OK</button>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center">
                
                <!-- Modal Body / Question -->
                <div class="modal-body py-4">
                    <h3 class="fw-bold text-dark fs-2 mb-0">
                        Are you sure you want<br>to Log Out?
                    </h3>
                </div>

                <!-- Modal Footer / Buttons -->
                <div class="modal-footer border-0 justify-content-center gap-3 pb-2">
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm" data-bs-dismiss="modal" style="min-width: 110px;">
                        Cancel
                    </button>

                    <!-- Yes / Confirm Logout Form Button -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white" style="background-color: #ff0000; min-width: 110px;">
                            Yes
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>