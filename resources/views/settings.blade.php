<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Brgy. Sibul Springs</title>
    
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
                            <div class="bg-white/80 rounded-circle d-flex align-items-center justify-content-center shadow sidebar-logo-box">
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 class="fw-extrabold text-dark tracking-wide m-0 sidebar-header-title">BRGY. SIBUL SPRINGS</h5>
                        <p class="text-dark fw-medium m-0 sidebar-header-sub">Community Information and Document Request System</p>
                    </div>
                    <div class="px-4 py-2 text-xs fw-bold text-dark text-uppercase tracking-wider mt-2 sidebar-section-label">Menu</div>
                    <nav class="flex-1 space-y-1 px-3 d-flex flex-column gap-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-link @if(request()->routeIs('dashboard')) active @endif">Dashboard</a>
                        <a href="{{ route('community.information') }}" class="sidebar-link @if(request()->routeIs('community.information')) active @endif">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link @if(request()->routeIs('documentsrequest')) active @endif">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link @if(request()->routeIs('incident.reports')) active @endif">Incident Report Information</a>
                        <a href="{{ route('user.management') }}" class="sidebar-link @if(request()->routeIs('user.management')) active @endif">User Management</a>
                    </nav>
                </div>
                <div class="p-4"></div>
            </div>
        </aside>

        <!-- SLIDING OFFCANVAS DRAWER -->
        <div class="offcanvas offcanvas-start text-dark border-end shadow-lg sliding-drawer" tabindex="-1" id="slidingMenuDrawer" aria-labelledby="slidingMenuDrawerLabel" data-bs-backdrop="false" data-bs-scroll="false" style="background-image: url('{{ asset('images/bg.jpg') }}');">
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
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4 min-vh-100">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mb-4 pb-2 border-bottom">
                    <h1 class="fw-bold text-dark fs-2 mb-1">Barangay Portal Configuration Settings</h1>
                    <p class="text-muted text-sm mb-0">Manage office operating hours, document fees, notification parameters, and database backups</p>
                </div>

                <div class="row g-4">
                    <!-- LEFT SETTINGS SUB-MENU NAVIGATION CARD -->
                    <div class="col-lg-4">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white">
                            <div class="nav flex-column nav-pills gap-2" id="settingsTab" role="tablist">
                                <button class="nav-link text-start fw-semibold active d-flex align-items-center gap-2 py-3 px-3 rounded-3 text-dark" id="barangay-info-tab" data-bs-toggle="pill" data-bs-target="#barangay-info" type="button" role="tab">
                                    <span>🏛️</span> Barangay Information
                                </button>
                                <button class="nav-link text-start fw-semibold d-flex align-items-center gap-2 py-3 px-3 rounded-3 text-dark" id="doc-fees-tab" data-bs-toggle="pill" data-bs-target="#doc-fees" type="button" role="tab">
                                    <span>📄</span> Document Fees & Turnaround
                                </button>
                                <button class="nav-link text-start fw-semibold d-flex align-items-center gap-2 py-3 px-3 rounded-3 text-dark" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">
                                    <span>🔒</span> Security and Password
                                </button>
                                <button class="nav-link text-start fw-semibold d-flex align-items-center gap-2 py-3 px-3 rounded-3 text-dark" id="db-maintenance-tab" data-bs-toggle="pill" data-bs-target="#db-maintenance" type="button" role="tab">
                                    <span>🗄️</span> Database Maintenance
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SETTINGS CONTENT PANELS -->
                    <div class="col-lg-8">
                        <div class="tab-content" id="settingsTabContent">
                            
                            <!-- BARANGAY INFORMATION PANEL -->
                            <div class="tab-pane fade show active" id="barangay-info" role="tabpanel" aria-labelledby="barangay-info-tab">
                                <div class="card border rounded-4 p-4 shadow-sm bg-white">
                                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">General Barangay Information</h5>
                                    
                                    <form action="{{ route('settings.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label text-xs fw-bold text-dark">Barangay Name</label>
                                                <input type="text" name="barangay_name" class="form-control bg-light text-sm" value="{{ $settings['barangay_name'] ?? 'Barangay Sibul' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-xs fw-bold text-dark">Municipality & Province</label>
                                                <input type="text" name="municipality_province" class="form-control bg-light text-sm" value="{{ $settings['municipality_province'] ?? 'San Miguel, Bulacan' }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-xs fw-bold text-dark">Barangay Hall Address</label>
                                            <input type="text" name="barangay_address" class="form-control bg-light text-sm" value="{{ $settings['barangay_address'] ?? 'Provincial Road, Zone 1 Propr, Sibul, San Miguel, Bulacan' }}">
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label text-xs fw-bold text-dark">Official Hotline Contact</label>
                                                <input type="text" name="hotline_contact" class="form-control bg-light text-sm" value="{{ $settings['hotline_contact'] ?? '0912-345-6789' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-xs fw-bold text-dark">Official Email</label>
                                                <input type="text" name="official_email" class="form-control bg-light text-sm" value="{{ $settings['official_email'] ?? 'sibul.gov@gmail.com' }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #0b1d88;">Save Changes</button>
                                    </form>
                                </div>
                            </div>

                            <!-- DOCUMENT FEES & TURNAROUND PANEL -->
                            <div class="tab-pane fade" id="doc-fees" role="tabpanel" aria-labelledby="doc-fees-tab">
                                <div class="card border rounded-4 p-4 shadow-sm bg-white">
                                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">Document Processing Fees & Turnaround</h5>
                                    
                                    <form action="{{ route('settings.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex flex-column gap-3 mb-4">
                                            <div class="d-flex align-items-center justify-content-between border rounded-3 p-3 bg-light">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-0 fs-6">Barangay Clearance Fee</h6>
                                                    <span class="text-muted" style="font-size: 11px;">Default Processing: 1 Working Day</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="text" name="clearance_fee" class="form-control form-control-sm text-center fw-bold" value="{{ $settings['clearance_fee'] ?? 'Php 20.00' }}" style="width: 100px;">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between border rounded-3 p-3 bg-light">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-0 fs-6">Certificate of Indigency</h6>
                                                    <span class="text-muted" style="font-size: 11px;">Default Processing: Same Day</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="text" name="indigency_fee" class="form-control form-control-sm text-center fw-bold" value="{{ $settings['indigency_fee'] ?? 'FREE (PHP 0)' }}" style="width: 110px;">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between border rounded-3 p-3 bg-light">
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-0 fs-6">Barangay Business Permit</h6>
                                                    <span class="text-muted" style="font-size: 11px;">Default Processing: 2 Days</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="text" name="permit_fee" class="form-control form-control-sm text-center fw-bold" value="{{ $settings['permit_fee'] ?? 'Php 100.00' }}" style="width: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #0b1d88;">Update Document Rates</button>
                                    </form>
                                </div>
                            </div>

                            <!-- SECURITY AND PASSWORD PANEL -->
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <div class="card border rounded-4 p-4 shadow-sm bg-white">
                                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">Admin Security Settings</h5>
                                    
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label text-xs fw-bold text-dark">Current Password</label>
                                            <input type="password" class="form-control bg-light text-sm" placeholder="Enter old password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-xs fw-bold text-dark">New Password</label>
                                            <input type="password" class="form-control bg-light text-sm" placeholder="Enter new password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label text-xs fw-bold text-dark">Confirm New Password</label>
                                            <input type="password" class="form-control bg-light text-sm" placeholder="Confirm new password">
                                        </div>
                                        <button type="button" class="btn text-white fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #0b1d88;">Update Admin Password</button>
                                    </form>
                                </div>
                            </div>

                            <!-- DATABASE MAINTENANCE PANEL -->
                            <div class="tab-pane fade" id="db-maintenance" role="tabpanel" aria-labelledby="db-maintenance-tab">
                                <div class="card border rounded-4 p-4 shadow-sm bg-white">
                                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">Database Backup & Archive Generator</h5>
                                    <p class="text-muted text-sm mb-4">Export system profiles, document requests, and incident records.</p>
                                    <div class="border rounded-3 p-3 bg-light d-flex align-items-center justify-content-between mb-4">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1 fs-6">Latest Backup Dump</h6>
                                            <span class="text-muted" style="font-size: 11px;">EBARANGAY_BACKUP_20261017.sql</span>
                                        </div>
                                        <button class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-pill shadow-sm" style="background-color: #0b1d88;">Download</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript para maalala ang huling binuksang Tab -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let activeTab = localStorage.getItem('activeSettingsTab');
            if (activeTab) {
                let tabTrigger = document.querySelector(`#settingsTab button[data-bs-target="${activeTab}"]`);
                if (tabTrigger) {
                    let tab = new bootstrap.Tab(tabTrigger);
                    tab.show();
                }
            }
            document.querySelectorAll('#settingsTab button').forEach(button => {
                button.addEventListener('shown.bs.tab', function (event) {
                    let targetTab = event.target.getAttribute('data-bs-target');
                    localStorage.setItem('activeSettingsTab', targetTab);
                });
            });
        });
    </script>
    
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
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm" data-bs-dismiss="modal" style="min-width: 110px;">
                        Cancel
                    </button>
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