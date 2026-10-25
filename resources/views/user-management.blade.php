<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Brgy. Sibul Springs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Logo" class="w-100 h-100 object-fit-contain rounded-circle">
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
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
                        <a href="{{ route('user.management') }}" class="sidebar-link active">User Management</a>
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
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h1 class="fw-bold text-dark fs-2 mb-1">User Management</h1>
                        <p class="text-muted text-sm mb-0">Manage system users, roles and account access</p>
                    </div>
                    <button class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm text-white" style="background-color: #c25e00;" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <span class="fs-5">+</span> Add User
                    </button>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Table Container -->
                <div class="border rounded-4 bg-white shadow-sm overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary fs-7" style="font-size: 12px;">
                                <tr>
                                    <th class="py-3 px-4">User ID</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3">Role</th>
                                    <th class="py-3">Date Created</th>
                                    <th class="py-3 px-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark text-sm">
                                @forelse($users as $user)
                                    <tr>
                                        <td class="fw-semibold px-4">USR_{{ sprintf('%03d', $user->id) }}</td>
                                        <td class="fw-medium">{{ $user->email }}</td>
                                        <td>
                                            <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: #bae6fd; color: #0284c7;">
                                                {{ $user->role->role ?? 'Resident' }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="text-end px-4">
                                            <!-- Delete Form -->
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <p class="mb-1 fw-semibold">No records found.</p>
                                            <small>Click the "+ Add User" button above to insert data into the database.</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD USER MODAL -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4">
                <div class="modal-header border-0 pb-0">
                    <h4 class="modal-title fw-bold text-dark">Add New User</h4>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light text-sm" placeholder="Type the Email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Password</label>
                            <input type="password" name="password" class="form-control bg-light text-sm" placeholder="Type the Password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Role ID (1 para Admin, 2 para Resident)</label>
                            <input type="number" name="role_id" class="form-control bg-light text-sm" value="2" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-end gap-2 pb-2">
                        <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #c25e00;">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>