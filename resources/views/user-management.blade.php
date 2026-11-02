<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Brgy. Sibul Springs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                                    <th class="py-3">Name</th>
                                    <th class="py-3">Username</th>
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
                                        <td class="fw-medium">{{ $user->name ?? 'N/A' }}</td>
                                        <td class="fw-medium">{{ $user->username ?? 'N/A' }}</td>
                                        <td class="fw-medium">{{ $user->email }}</td>
                                        <td>
                                            @php
                                                $roleValue = $user->role ?? 'Resident';
                                                $isAdmin = strtolower($roleValue) === 'admin';
                                                $badgeColor = $isAdmin ? '#fde047' : '#bae6fd';
                                                $badgeTextColor = $isAdmin ? '#854d0e' : '#0284c7';
                                            @endphp
                                            <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: {{ $badgeColor }}; color: {{ $badgeTextColor }};">
                                                {{ ucfirst($roleValue) }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="text-end px-4">
                                            @php
                                                $isMainAdmin = ($user->email === 'admin@sibul.com');
                                                $isLoggedInUser = (Auth::check() && Auth::id() === $user->id);
                                            @endphp

                                            @if($isMainAdmin || $isLoggedInUser)
                                                <button type="button" class="btn btn-sm btn-outline-secondary text-xs px-2 py-0 rounded" disabled title="This account cannot be deleted">Delete</button>
                                            @else
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
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
                <form action="{{ route('user.store') }}" method="POST" id="addUserForm">
                    @csrf
                    <div class="modal-body py-3">
                        <div id="passwordAlert" class="alert alert-danger d-none py-2 mb-3" style="font-size: 12px;"></div>

                        <!-- Pagpapakita ng Laravel Validation Errors sa loob ng Modal -->
                        @if($errors->any())
                            <div class="alert alert-danger py-2 mb-3" style="font-size: 12px;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Full Name</label>
                            <input type="text" name="name" class="form-control bg-light text-sm" placeholder="Type the Full Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Username</label>
                            <input type="text" name="username" class="form-control bg-light text-sm" placeholder="Type the Username" value="{{ old('username') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control bg-light text-sm" placeholder="Type the Email" value="{{ old('email') }}" required>
                        </div>

                        <!-- Password with Eye Toggle -->
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Enter Password (Min. 8 characters)</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control bg-light text-sm" placeholder="Enter Password" required>
                                <button class="btn btn-outline-secondary border" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="eyeIcon1"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password with Eye Toggle -->
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light text-sm" placeholder="Confirm Password" required>
                                <button class="btn btn-outline-secondary border" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye-slash" id="eyeIcon2"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-dark">Role</label>
                            <select name="role" class="form-select bg-light text-sm" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Resident" {{ old('role') == 'Resident' ? 'selected' : '' }}>Resident</option>
                            </select>
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

    <!-- Script para sa Password Validation at Eye Toggle -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon1');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmInput = document.getElementById('password_confirmation');
            const eyeIcon = document.getElementById('eyeIcon2');
            if (confirmInput.type === 'password') {
                confirmInput.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                confirmInput.type = 'password';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });

        document.getElementById('addUserForm').addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const alertBox = document.getElementById('passwordAlert');

            if (password.length < 8) {
                e.preventDefault();
                alertBox.textContent = 'Password must be at least 8 characters long.';
                alertBox.classList.remove('d-none');
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alertBox.textContent = 'Passwords do not match!';
                alertBox.classList.remove('d-none');
                return;
            }

            alertBox.classList.add('d-none');
        });
    </script>
</body>
</html>