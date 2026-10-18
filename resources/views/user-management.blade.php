<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Brgy. Sibul Springs</title>
    
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
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
                        <a href="#" class="sidebar-link active">User Management</a>
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
                <div></div>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4 min-vh-100">
                
                <!-- Page Title Header with Add User Button -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h1 class="fw-bold text-dark fs-2 mb-1">User Management</h1>
                        <p class="text-muted text-sm mb-0">Manage systems users, roles and account access[cite: 14]</p>
                    </div>
                    <button class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2 text-white" style="background-color: #c25e00; border: none;" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <span class="fs-5">+</span> Add User
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="input-group" style="max-width: 320px;">
                        <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
                        <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm" placeholder="Search Users...">
                    </div>
                </div>

                <!-- Table Card Container -->
                <div class="border rounded-4 bg-white shadow-sm overflow-hidden">
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="userTable">
                            <thead class="table-light text-secondary fs-7" style="font-size: 12px;">
                                <tr>
                                    <th class="py-3 px-4">User ID</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3">Role</th>
                                    <th class="py-3">Date Created</th>
                                    <th class="py-3 px-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark text-sm" id="userTableBody">
                                <!-- User 1 -->
                                <tr>
                                    <td class="fw-semibold px-4 user-id">USR_001</td>
                                    <td class="fw-medium user-email">admin@gmail.com</td>
                                    <td class="user-role">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bae6fd; color: #0284c7;">Admin</span>
                                    </td>
                                    <td class="fw-semibold user-date">Oct 1, 2026</td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded me-1 edit-btn">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded delete-btn">Delete</button>
                                    </td>
                                </tr>
                                <!-- User 2 -->
                                <tr>
                                    <td class="fw-semibold px-4 user-id">USR_002</td>
                                    <td class="fw-medium user-email">carlaguevarra@gmail.com</td>
                                    <td class="user-role">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bbf7d0; color: #16a34a;">Resident</span>
                                    </td>
                                    <td class="fw-semibold user-date">Oct 6, 2026</td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded me-1 edit-btn">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded delete-btn">Delete</button>
                                    </td>
                                </tr>
                                <!-- User 3 -->
                                <tr>
                                    <td class="fw-semibold px-4 user-id">USR_003</td>
                                    <td class="fw-medium user-email">juanjosemuñoz@gmail.com</td>
                                    <td class="user-role">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bbf7d0; color: #16a34a;">Resident</span>
                                    </td>
                                    <td class="fw-semibold user-date">Oct 7, 2026</td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded me-1 edit-btn">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded delete-btn">Delete</button>
                                    </td>
                                </tr>
                                <!-- User 4 -->
                                <tr>
                                    <td class="fw-semibold px-4 user-id">USR_004</td>
                                    <td class="fw-medium user-email">carmenmartinez@gmail.com</td>
                                    <td class="user-role">
                                        <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bbf7d0; color: #16a34a;">Resident</span>
                                    </td>
                                    <td class="fw-semibold user-date">Oct 3, 2026</td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded me-1 edit-btn">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded delete-btn">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Footer -->
                    <div class="d-flex justify-content-between align-items-center p-3 border-top bg-light-subtle">
                        <span class="text-muted text-xs" id="rowCountInfo">Showing 4 of 4 Users</span>
                        <nav>
                            <ul class="pagination pagination-sm mb-0 gap-1">
                                <li class="page-item disabled"><a class="page-link rounded text-muted" href="#">←</a></li>
                                <li class="page-item active"><a class="page-link rounded bg-warning border-warning text-dark fw-bold" href="#">1</a></li>
                                <li class="page-item disabled"><a class="page-link rounded text-muted" href="#">→</a></li>
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
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal" style="min-width: 100px;">
                        Cancel
                    </button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold shadow-sm text-white" style="background-color: #ff0000; min-width: 100px;">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-4">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title fw-bold text-dark" id="addUserModalLabel">Add New User</h4>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">User ID</label>
                        <input type="text" id="addUserId" class="form-control bg-light text-sm" value="USR_005" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Email Address</label>
                        <input type="email" id="addUserEmail" class="form-control bg-light text-sm" placeholder="Type the Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Password</label>
                        <input type="password" id="addUserPassword" class="form-control bg-light text-sm" placeholder="Type the Password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Role</label>
                        <select id="addUserRole" class="form-select bg-light text-sm">
                            <option value="Admin">Admin</option>
                            <option value="Resident" selected>Resident</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2 pb-2">
                <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="saveNewUserBtn" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #c25e00;">Save User</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-4">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title fw-bold text-dark" id="editUserModalLabel">Edit User</h4>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                <form id="editUserForm">
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">User ID</label>
                        <input type="text" id="editUserId" class="form-control bg-light text-sm" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Email Address</label>
                        <input type="email" id="editUserEmail" class="form-control bg-light text-sm" placeholder="Type the Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Password</label>
                        <input type="password" id="addUserPassword" class="form-control bg-light text-sm" placeholder="Type the Password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-dark">Role</label>
                        <select id="editUserRole" class="form-select bg-light text-sm">
                            <option value="Admin">Admin</option>
                            <option value="Resident">Resident</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2 pb-2">
                <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="updateUserBtn" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #c25e00;">Save Changes</button>
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