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
        <aside id="mainSidebar" class="sidebar-transition sidebar-container d-flex flex-column justify-between border-end border-sky-200 shadow-lg" style="background-image: url('{{ asset('images/BG2.png') }}'); width: 288px; min-width: 288px; background-size: cover; background-position: right-bottom;">
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
                            <div class="bg-white/80 rounded-circle d-flex align-items-center justify-content-center shadow sidebar-logo-box" style="width: 64px; height: 64px;">
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                            </div>
                        </div>
                        <h5 class="fw-extrabold text-dark tracking-wide m-0 sidebar-header-title" style="font-size: 0.75rem;">BRGY. SIBUL SPRINGS</h5>
                        <p class="text-dark fw-medium m-0 sidebar-header-sub" style="font-size: 9px;">Community Information and Document Request System</p>
                    </div>
                    <!-- Menu Navigation -->
                    <div class="px-4 py-2 text-xs fw-bold text-dark text-uppercase tracking-wider mt-2 sidebar-section-label" style="font-size: 0.75rem;">Menu</div>
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
        <div class="offcanvas offcanvas-start text-dark border-end shadow-lg sliding-drawer" tabindex="-1" id="slidingMenuDrawer" aria-labelledby="slidingMenuDrawerLabel" data-bs-backdrop="false" data-bs-scroll="false" style="width: 288px; min-width: 288px; background-image: url('{{ asset('images/BG2.png') }}'); background-size: cover; background-position: right-bottom;">
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

        <!-- MAIN CONTENT AREA (About Page Layout) -->
        <main class="flex-grow-1 bg-light overflow-y-auto p-4">
            <div class="container-fluid bg-white border shadow-sm rounded-4 p-4 min-vh-100">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Page Title & Edit Button -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h2 class="fw-bold text-dark mb-0 fs-2">About Barangay Sibul</h2>
                    <button class="btn btn-primary fw-semibold px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#editAboutModal" style="background-color: #0b1d88; border: none;">
                        Edit About Content
                    </button>
                </div>

                <!-- Official Profile Hero Banner -->
                <div class="p-4 rounded-4 text-white mb-4 shadow-sm position-relative overflow-hidden about-hero-banner" style="background: linear-gradient(135deg, #0b1d88 0%, #1233d4 100%);">
                    <span class="badge border border-warning text-warning px-3 py-1 rounded-pill fw-bold mb-3 about-hero-badge">OFFICIAL PROFILE</span>
                    <h3 class="fw-bold fs-3 mb-2">{{ $aboutData['profile_title'] ?? 'Barangay Sibul, San Miguel, Bulacan' }}</h3>
                    <p class="text-light opacity-85 small m-0 about-hero-desc">
                        {{ $aboutData['profile_desc'] ?? 'Barangay Sibul is a historic and progressive agricultural community in San Miguel, Bulacan. Renowned for its natural springs, eco-tourism potential, and vibrant citizenry, eBarangay serves as its official modern digital platform.' }}
                    </p>
                </div>

                <!-- Vision & Mission Cards Row (Flexbox h-100 para pantay ang taas kahit magkaiba ang haba ng text) -->
                <div class="row g-4 mb-4">
                    <!-- Vision -->
                    <div class="col-md-6 d-flex">
                        <div class="p-4 rounded-4 border bg-light w-100 shadow-sm d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="fs-5">👁️</span>
                                    <h5 class="fw-bold text-dark m-0">Barangay Vision</h5>
                                </div>
                                <p class="text-muted small m-0">{{ $aboutData['vision'] ?? 'Insert Barangay Vision' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Mission -->
                    <div class="col-md-6 d-flex">
                        <div class="p-4 rounded-4 border bg-light w-100 shadow-sm d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="fs-5">🎯</span>
                                    <h5 class="fw-bold text-dark m-0">Barangay Mission</h5>
                                </div>
                                <p class="text-muted small m-0">{{ $aboutData['mission'] ?? 'Insert Barangay Mission' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Organizational Hierarchy Section -->
                <div class="p-4 rounded-4 border shadow-sm bg-white">
                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">Barangay Sibul Organizational Hierarchy</h5>
                    
                    <div class="row g-3">
                        @php
                            $officials = $aboutData['officials'] ?? [
                                ['name' => 'Name Here', 'title' => 'Barangay Chairman', 'photo' => ''],
                                ['name' => 'Name Here', 'title' => 'Barangay Secretary', 'photo' => ''],
                                ['name' => 'Name Here', 'title' => 'Barangay Treasurer', 'photo' => ''],
                                ['name' => 'Name Here', 'title' => 'Tanod', 'photo' => '']
                            ];
                        @endphp

                        @foreach($officials as $official)
                            <div class="col-md-3">
                                <div class="p-3 rounded-4 border bg-light text-center shadow-sm h-100 d-flex flex-column align-items-center justify-content-between">
                                    <div class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center bg-secondary bg-opacity-25 mb-2 shadow-sm" style="width: 80px; height: 80px; min-width: 80px;">
                                        @if(!empty($official['photo']))
                                            <img src="{{ asset('storage/' . $official['photo']) }}" alt="{{ $official['name'] }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <span class="fs-3">👤</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 fs-6">{{ $official['name'] }}</h6>
                                        <span class="text-muted small">{{ $official['title'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Edit About Content Modal -->
    <div class="modal fade" id="editAboutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">Edit About Page Contents</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body px-0 py-3" style="max-height: 70vh; overflow-y: auto;">
                        
                        <!-- Official Profile Section Editing -->
                        <h5 class="fw-bold text-dark mb-3">Official Profile Banner</h5>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Profile Title</label>
                            <input type="text" name="profile_title" class="form-control bg-light text-dark fw-semibold" value="{{ $aboutData['profile_title'] ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Profile Description</label>
                            <textarea name="profile_desc" class="form-control bg-light text-dark fw-semibold" rows="3" required>{{ $aboutData['profile_desc'] ?? '' }}</textarea>
                        </div>

                        <hr class="my-4">
                        <h5 class="fw-bold text-dark mb-3">Vision & Mission</h5>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Vision Content</label>
                            <textarea name="vision" class="form-control bg-light text-dark fw-semibold" rows="3" required>{{ $aboutData['vision'] ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Mission Content</label>
                            <textarea name="mission" class="form-control bg-light text-dark fw-semibold" rows="3" required>{{ $aboutData['mission'] ?? '' }}</textarea>
                        </div>

                        <hr class="my-4">
                        <h5 class="fw-bold text-dark mb-3">Organizational Hierarchy (1x1 Photos Supported)</h5>

                        @foreach($officials as $index => $official)
                            <div class="border rounded-3 p-3 bg-light mb-3">
                                <h6 class="fw-bold text-primary mb-2">Official #{{ $index + 1 }}</h6>
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label text-xs fw-bold text-muted">Name</label>
                                        <input type="text" name="officials[{{ $index }}][name]" class="form-control form-control-sm bg-white" value="{{ $official['name'] }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-xs fw-bold text-muted">Position / Title</label>
                                        <input type="text" name="officials[{{ $index }}][title]" class="form-control form-control-sm bg-white" value="{{ $official['title'] }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-xs fw-bold text-muted">1x1 Photo (Upload/Change)</label>
                                        <input type="file" name="officials[{{ $index }}][photo]" class="form-control form-control-sm bg-white mb-2" accept="image/*">
                                        <input type="hidden" name="officials[{{ $index }}][existing_photo]" value="{{ $official['photo'] ?? '' }}">
                                        
                                        @if(!empty($official['photo']))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="officials[{{ $index }}][remove_photo]" value="1" id="removePhoto{{ $index }}">
                                                <label class="form-check-label text-danger small fw-semibold" for="removePhoto{{ $index }}">
                                                    Remove current photo
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="modal-footer border-0 px-0 pt-3 justify-content-end gap-2">
                        <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-3 shadow-sm" style="background-color: #00c800;">Save Changes</button>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>