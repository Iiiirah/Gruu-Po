<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Document Request - Brgy. Sibul Springs</title>
    
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
                        <a href="{{ route('dashboard') }}" class="sidebar-link">Dashboard</a>
                        <a href="{{ route('community.information') }}" class="sidebar-link">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link active">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
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
                    <form class="w-100">
                        <button type="button" class="nav-link text-danger fw-semibold py-2 px-3 w-100 text-start bg-transparent border-0" onclick="openLogoutModal()">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4 min-vh-100">
                
                <!-- Page Title -->
                <div class="mb-4">
                    <h1 class="fw-bold text-dark fs-2 mb-1">Online Document Request</h1>
                    <p class="text-muted text-sm mb-0">Overview of document requests</p>
                </div>

                <!-- Card Container with Filters & Table -->
                <div class="border rounded-4 p-4 bg-white shadow-sm">
                    
                    <!-- Search Bar & Status Filter Tabs -->
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div class="input-group" style="max-width: 380px;">
                            <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
                            <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm" placeholder="Search Request...">
                            <button class="btn btn-primary px-4 text-sm fw-semibold" type="button" id="searchBtn" style="background-color: #38bdf8; border: none; color: #0f172a;">Search</button>
                        </div>
                        <div class="btn-group" role="group" id="filterTabs">
                            <button type="button" class="btn btn-outline-secondary text-sm px-3 active" data-filter="all">All</button>
                            <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Received">Received</button>
                            <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Approved">Approved</button>
                            <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="In Progress">In Progress</button>
                        </div>
                    </div>

                    <!-- Requests Table -->
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover align-middle mb-0" id="requestsTable">
                            <thead class="table-light text-secondary text-uppercase fs-7" style="font-size: 11px; letter-spacing: 0.5px;">
                                <tr>
                                    <th class="py-3 px-3">Residents Name</th>
                                    <th class="py-3">Document Type</th>
                                    <th class="py-3">Date Submitted</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 px-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark text-sm" id="tableBody">
                                <!-- Row 1 -->
                                <tr data-status="Approved">
                                    <td class="fw-semibold px-3 resident-name">Mark Anthony Santos</td>
                                    <td class="doc-type">Certificate of Indigency</td>
                                    <td>October 7, 2026</td>
                                    <td class="status-cell">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #d1fae5; color: #065f46; border: 1px solid #10b981;">Approved</span>
                                    </td>
                                    <td class="text-end px-3">
                                        <select class="form-select form-select-sm d-inline-block w-auto text-xs fw-semibold bg-light action-select">
                                            <option selected disabled>Actions</option>
                                            <option value="Approved">Mark as Approved</option>
                                            <option value="In Progress">Mark as In Progress</option>
                                            <option value="Received">Mark as Received</option>
                                            <option value="delete">Delete Row</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr data-status="In Progress">
                                    <td class="fw-semibold px-3 resident-name">Maria Kristina dela Cruz</td>
                                    <td class="doc-type">Certificate of Residency</td>
                                    <td>October 8, 2026</td>
                                    <td class="status-cell">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #fef3c7; color: #92400e; border: 1px solid #f59e0b;">In Progress</span>
                                    </td>
                                    <td class="text-end px-3">
                                        <select class="form-select form-select-sm d-inline-block w-auto text-xs fw-semibold bg-light action-select">
                                            <option selected disabled>Actions</option>
                                            <option value="Approved">Mark as Approved</option>
                                            <option value="In Progress">Mark as In Progress</option>
                                            <option value="Received">Mark as Received</option>
                                            <option value="delete">Delete Row</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr data-status="Approved">
                                    <td class="fw-semibold px-3 resident-name">Paulian Reyes</td>
                                    <td class="doc-type">Barangay Business Permit</td>
                                    <td>October 8, 2026</td>
                                    <td class="status-cell">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #d1fae5; color: #065f46; border: 1px solid #10b981;">Approved</span>
                                    </td>
                                    <td class="text-end px-3">
                                        <select class="form-select form-select-sm d-inline-block w-auto text-xs fw-semibold bg-light action-select">
                                            <option selected disabled>Actions</option>
                                            <option value="Approved">Mark as Approved</option>
                                            <option value="In Progress">Mark as In Progress</option>
                                            <option value="Received">Mark as Received</option>
                                            <option value="delete">Delete Row</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Row 4 -->
                                <tr data-status="Received">
                                    <td class="fw-semibold px-3 resident-name">Kristin Nicole Ramos</td>
                                    <td class="doc-type">Barangay Clearance</td>
                                    <td>October 9, 2026</td>
                                    <td class="status-cell">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #38bdf8;">Received</span>
                                    </td>
                                    <td class="text-end px-3">
                                        <select class="form-select form-select-sm d-inline-block w-auto text-xs fw-semibold bg-light action-select">
                                            <option selected disabled>Actions</option>
                                            <option value="Approved">Mark as Approved</option>
                                            <option value="In Progress">Mark as In Progress</option>
                                            <option value="Received">Mark as Received</option>
                                            <option value="delete">Delete Row</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Row 5 -->
                                <tr data-status="Received">
                                    <td class="fw-semibold px-3 resident-name">Aira Mendoza</td>
                                    <td class="doc-type">Barangay Clearance</td>
                                    <td>October 9, 2026</td>
                                    <td class="status-cell">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #38bdf8;">Received</span>
                                    </td>
                                    <td class="text-end px-3">
                                        <select class="form-select form-select-sm d-inline-block w-auto text-xs fw-semibold bg-light action-select">
                                            <option selected disabled>Actions</option>
                                            <option value="Approved">Mark as Approved</option>
                                            <option value="In Progress">Mark as In Progress</option>
                                            <option value="Received">Mark as Received</option>
                                            <option value="delete">Delete Row</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Footer -->
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                        <span class="text-muted text-xs" id="rowCountInfo">Showing 5 of 5 Requests</span>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item active"><a class="page-link bg-warning border-warning text-dark fw-bold" href="#">1</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Removing Row Confirmation Modal -->
    <div class="modal fade" id="deleteRowModal" tabindex="-1" aria-labelledby="deleteRowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center">
                
                <div class="modal-header border-0 pb-0 justify-content-start">
                    <h4 class="modal-title fw-bold text-dark fs-4" id="deleteRowModalLabel">Removing Row</h4>
                </div>

                <div class="modal-body py-4">
                    <p class="fw-bold text-dark fs-5 mb-0">
                        Are you sure you want to delete this row?
                    </p>
                </div>

                <div class="modal-footer border-0 justify-content-end gap-2 pb-2">
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm btn-modal-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" id="confirmDeleteRowBtn" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold shadow-sm text-white" style="background-color: #ff0000; min-width: 100px;">
                        Yes
                    </button>
                </div>
            </div>
        </div>
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
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm btn-modal-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white btn-modal-confirm">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>