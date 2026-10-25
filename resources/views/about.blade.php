<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Brgy. Sibul Springs</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark m-0 font-sans antialiased">

    <div class="d-flex vh-100 overflow-hidden position-relative">
        
        <!-- SIDEBAR -->
        <aside id="mainSidebar" class="sidebar-transition sidebar-container d-flex flex-column justify-between border-end border-sky-200 shadow-lg" style="background-image: url('{{ asset('images/bg.jpg') }}');">
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
                            <div class="bg-white/80 rounded-circle d-flex align-items-center justify-content-center shadow sidebar-logo-box">
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 class="fw-extrabold text-dark tracking-wide m-0 sidebar-header-title">BRGY. SIBUL SPRINGS</h5>
                        <p class="text-dark fw-medium m-0 sidebar-header-sub">Community Information and Document Request System</p>
                    </div>

                    <!-- Menu Navigation -->
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
                        <button type="button" class="nav-link text-danger fw-semibold py-2 px-3 w-100 text-start bg-transparent border-0" onclick="openLogoutModal()">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA (About Page Layout) -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4">
                
                <!-- Page Title -->
                <h2 class="fw-bold text-dark mb-4 pb-2 border-bottom">About Barangay Sibul</h2>

                <!-- Official Profile Hero Banner -->
                <div class="p-4 rounded-4 text-white mb-4 shadow-sm position-relative overflow-hidden about-hero-banner">
                    <span class="badge border border-warning text-warning px-3 py-1 rounded-pill fw-bold mb-3 about-hero-badge">OFFICIAL PROFILE</span>
                    <h3 class="fw-bold fs-3 mb-2">Barangay Sibul, San Miguel, Bulacan</h3>
                    <p class="text-light opacity-85 small m-0 about-hero-desc">
                        Barangay Sibul is a historic and progressive agricultural community in San Miguel, Bulacan. Renowned for its natural springs, eco-tourism potential, and vibrant citizenry, eBarangay serves as its official modern digital platform.
                    </p>
                </div>

                <!-- Vision & Mission Cards Row -->
                <div class="row g-4 mb-4">
                    <!-- Vision -->
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="fs-5">👁️</span>
                                <h5 class="fw-bold text-dark m-0">Barangay Vision</h5>
                            </div>
                            <p class="text-muted small m-0">Insert Barangay Vision</p>
                        </div>
                    </div>
                    <!-- Mission -->
                    <div class="col-md-6">
                        <div class="p-4 rounded-4 border bg-light h-100 shadow-sm">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="fs-5">🎯</span>
                                <h5 class="fw-bold text-dark m-0">Barangay Mission</h5>
                            </div>
                            <p class="text-muted small m-0">Insert Barangay Mission</p>
                        </div>
                    </div>
                </div>

                <!-- Organizational Hierarchy Section -->
                <div class="p-4 rounded-4 border shadow-sm">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Barangay Sibul Organizational Hierarchy</h5>
                    
                    <div class="row g-3">
                        <!-- Chairman -->
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 border bg-light text-center shadow-sm">
                                <div class="bg-secondary bg-opacity-25 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2 hierarchy-avatar-box">
                                    👤
                                </div>
                                <h6 class="fw-bold text-dark mb-0 fs-6">Name Here</h6>
                                <span class="text-muted hierarchy-title">Barangay Chairman</span>
                            </div>
                        </div>
                        <!-- Secretary -->
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 border bg-light text-center shadow-sm">
                                <div class="bg-secondary bg-opacity-25 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2 hierarchy-avatar-box">
                                    👤
                                </div>
                                <h6 class="fw-bold text-dark mb-0 fs-6">Name Here</h6>
                                <span class="text-muted hierarchy-title">Barangay Secretary</span>
                            </div>
                        </div>
                        <!-- Treasurer -->
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 border bg-light text-center shadow-sm">
                                <div class="bg-secondary bg-opacity-25 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2 hierarchy-avatar-box">
                                    👤
                                </div>
                                <h6 class="fw-bold text-dark mb-0 fs-6">Name Here</h6>
                                <span class="text-muted hierarchy-title">Barangay Treasurer</span>
                            </div>
                        </div>
                        <!-- Tanod -->
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 border bg-light text-center shadow-sm">
                                <div class="bg-secondary bg-opacity-25 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2 hierarchy-avatar-box">
                                    👤
                                </div>
                                <h6 class="fw-bold text-dark mb-0 fs-6">Name Here</h6>
                                <span class="text-muted hierarchy-title">Tanod</span>
                            </div>
                        </div>
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
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm logout-btn-width" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white bg-danger logout-btn-width">
                            Yes
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>