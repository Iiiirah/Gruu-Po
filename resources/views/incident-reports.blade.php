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
                                <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
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
                    
                    <!-- Updated Logout Button to trigger the modal -->
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
                
                <!-- Page Title -->
                <div class="mb-4">
                    <h1 class="fw-bold text-dark fs-2 mb-1">Incident Report Information</h1>
                </div>
                <!-- Statistics Cards Row -->
                <div class="row g-3 mb-4">
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span>🏴</span> <span>Total Reports</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">{{ isset($reports) ? $reports->count() : 0 }}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-primary d-inline-block" style="width: 8px; height: 8px;"></span> <span>Flood</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">{{ isset($reports) ? $reports->where('incident_type', 'Flood')->count() : 0 }}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-danger d-inline-block" style="width: 8px; height: 8px;"></span> <span>Fire</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">{{ isset($reports) ? $reports->where('incident_type', 'Fire')->count() : 0 }}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-warning d-inline-block" style="width: 8px; height: 8px;"></span> <span>Landslide</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">{{ isset($reports) ? $reports->where('incident_type', 'Landslide')->count() : 0 }}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border rounded-4 p-3 shadow-sm bg-white text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1 mb-1 text-muted" style="font-size: 11px;">
                                <span class="rounded-circle bg-info d-inline-block" style="width: 8px; height: 8px;"></span> <span>Other</span>
                            </div>
                            <h3 class="fw-bold mb-0 text-dark" style="text-decoration: underline;">{{ isset($reports) ? $reports->whereNotIn('incident_type', ['Flood', 'Fire', 'Landslide'])->count() : 0 }}</h3>
                        </div>
                    </div>
                </div>
                <!-- Incident Reports Container Box -->
                <div class="border rounded-4 p-4 bg-white shadow-sm">
                    
                    <!-- Sub-header Controls -->
                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <select id="zoneSelect" class="form-select fw-semibold text-dark bg-light rounded-pill px-3 py-2 text-sm shadow-sm" style="width: 140px;" onchange="filterReports()">
                                <option value="all" selected>All Zones</option>
                                <option value="Zone 1">Zone 1</option>
                                <option value="Zone 2">Zone 2</option>
                                <option value="Zone 3">Zone 3</option>
                                <option value="Zone 4">Zone 4</option>
                            </select>
                            <div class="border rounded-pill px-3 py-2 bg-light text-muted text-sm fw-medium shadow-sm">
                                Report/s <strong class="text-dark" id="reportCountBadge">{{ isset($reports) ? $reports->count() : 0 }}</strong>
                            </div>
                        </div>
                        <!-- Search Bar at Filter Buttons -->
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="input-group" style="width: 240px;">
                                <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
                                <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm shadow-none" placeholder="Search Report..." oninput="filterReports()">
                            </div>
                            <div class="btn-group filter-buttons shadow-sm" role="group" id="filterTabs">
                                <button type="button" class="btn btn-outline-secondary text-sm px-3 active" data-filter="All" onclick="setStatusFilter('All', this)">All</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="New" onclick="setStatusFilter('New', this)">New</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Verified" onclick="setStatusFilter('Verified', this)">Verified</button>
                                <button type="button" class="btn btn-outline-secondary text-sm px-3" data-filter="Resolved" onclick="setStatusFilter('Resolved', this)">Resolved</button>
                            </div>
                        </div>
                    </div>
                    <!-- Report Item List -->
                    <div class="d-flex flex-column gap-3" id="reportsContainer">
                        @forelse($reports ?? [] as $report)
                            @php
                                $dbStatus = trim(ucfirst(strtolower($report->status ?? 'New')));
                                if($dbStatus == '') { $dbStatus = 'New'; }
                                
                                // Kulay ng Status Badge: New = Dilaw, Verified = Asul, Resolved = Berde
                                $statusBg = '#fef08a'; $statusColor = '#854d0e';
                                if($dbStatus == 'Verified') { $statusBg = '#e0f2fe'; $statusColor = '#0369a1'; } // Asul
                                elseif($dbStatus == 'Resolved') { $statusBg = '#bbf7d0'; $statusColor = '#15803d'; } // Berde
                                
                                $issueColor = 'text-dark';
                                $lowerIssue = strtolower($report->issue ?? $report->incident_type ?? '');
                                if(str_contains($lowerIssue, 'fire')) { $issueColor = 'text-danger'; }
                                elseif(str_contains($lowerIssue, 'flood')) { $issueColor = 'text-primary'; }
                                elseif(str_contains($lowerIssue, 'landslide')) { $issueColor = 'text-warning'; }
                                else { $issueColor = 'text-info'; }
                                $reportIdText = $report->report_id ?? ('IDT-' . str_pad($report->id, 3, '0', STR_PAD_LEFT));
                                $reportDescText = $report->description ?? '';
                                $reportIssueText = $report->issue ?? $report->incident_type ?? '';
                            @endphp
                            <!-- Ginagamit ang data-status at data-search para sa mabilisang filtering -->
                            <div class="card border rounded-4 p-3 shadow-sm d-flex flex-row align-items-center justify-content-between report-item" 
                                data-zone="{{ trim($report->zone ?? $report->area ?? 'Zone 1') }}" 
                                data-status="{{ $dbStatus }}"
                                data-search="{{ strtolower($reportIdText . ' ' . $reportIssueText . ' ' . $reportDescText . ' ' . ($report->zone ?? '')) }}">
                                <div>
                                    <h6 class="fw-bold text-dark mb-1 fs-6 report-title">
                                        {{ $reportIdText }} 
                                        <span class="{{ $issueColor }}">{{ $reportIssueText }}</span>
                                    </h6>
                                    <span class="text-muted report-date" style="font-size: 11px;">{{ $report->created_at->format('M d, Y') }} ({{ $report->zone ?? $report->area ?? 'Zone 1' }})</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge rounded-pill px-3 py-1 fw-medium" style="background-color: {{ $statusBg }}; color: {{ $statusColor }};">{{ $dbStatus }}</span>
                                    
                                    <!-- Admin Status Update Dropdown Form -->
                                    <form action="{{ route('admin.reports.updateStatus', $report->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm text-xs fw-semibold rounded-3 py-1" style="width: 110px; display: inline-block;" onchange="this.form.submit()">
                                            <option value="New" {{ $dbStatus == 'New' ? 'selected' : '' }}>New</option>
                                            <option value="Verified" {{ $dbStatus == 'Verified' ? 'selected' : '' }}>Verified</option>
                                            <option value="Resolved" {{ $dbStatus == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                        </select>
                                    </form>
                                    <!-- Delete Button -->
                                    <form action="{{ route('incident.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sigurado ka bang gusto mong burahin ang ulat na ito?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-1 text-xs fw-semibold rounded-3">Delete</button>
                                    </form>
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-sm btn-outline-primary px-3 py-1 text-xs fw-semibold rounded-3 view-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewReportModal"
                                        data-id="{{ $reportIdText }}" 
                                        data-area="{{ $report->zone ?? $report->area ?? 'Zone 1' }}" 
                                        data-issue="{{ $reportIssueText }}" 
                                        data-desc="{{ $reportDescText }}" 
                                        data-date="{{ $report->created_at->format('m/d/Y') }}" 
                                        data-reporter="{{ $report->reporter_name ?? ($report->user->name ?? 'Residente') }}"
                                        data-image="{{ $report->photo ? asset('storage/' . $report->photo) : '' }}">
                                        View
                                    </button>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        <!-- Dynamic Empty State Message (Lalabas kapag walang records o walang nag-match sa filter/search) -->
                        <div class="text-center text-muted py-5 d-none" id="noReportsMessage">
                            <p class="mb-1 fw-semibold fs-5">No incident reports found.</p>
                            <small>Walang kasalukuyang ulat sa napiling kategorya o pamantayan.</small>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- View Incident Report Modal -->
    <div class="modal fade" id="viewReportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">Incident Report Details</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Report ID</label>
                            <input type="text" id="modalReportId" class="form-control bg-light text-dark fw-semibold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-muted">Area / Zone</label>
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
                    <div class="mb-3 text-center">
                        <div id="modalImageContainer" class="border rounded-3 bg-light d-flex align-items-center justify-content-center text-muted fw-semibold shadow-inner overflow-hidden" style="height: 180px;">
                            <span class="tracking-widest fs-5 text-secondary" id="noImageText">WALANG LARAWAN</span>
                            <img id="modalReportImage" src="" alt="Incident Photo" class="w-100 h-100 object-fit-contain" style="display: none;">
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
    
    <!-- JavaScript na may kasamang Empty List Message Toggle -->
    <script>
        let currentStatusFilter = 'All';
        function setStatusFilter(status, button) {
            document.querySelectorAll('#filterTabs button').forEach(btn => {
                btn.classList.remove('active', 'btn-primary', 'text-white');
                btn.classList.add('btn-outline-secondary');
            });
            button.classList.add('active', 'btn-primary', 'text-white');
            button.classList.remove('btn-outline-secondary');
            currentStatusFilter = status.trim();
            filterReports();
        }
        function filterReports() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase().trim();
            const selectedZone = document.getElementById('zoneSelect').value.trim();
            const reports = document.querySelectorAll('.report-item');
            const noReportsMessage = document.getElementById('noReportsMessage');
            let visibleCount = 0;
            reports.forEach(report => {
                const zone = (report.getAttribute('data-zone') || '').trim();
                const status = (report.getAttribute('data-status') || '').trim();
                const searchData = (report.getAttribute('data-search') || '').toLowerCase();
                
                // Zone Matching
                const matchesZone = (selectedZone.toLowerCase() === 'all' || zone.toLowerCase() === selectedZone.toLowerCase());
                
                // Status Matching (All, New, Verified, Resolved)
                let matchesStatus = false;
                if (currentStatusFilter.toLowerCase() === 'all') {
                    matchesStatus = true;
                } else {
                    matchesStatus = (status.toLowerCase() === currentStatusFilter.toLowerCase());
                }
                // Search Bar Matching
                const matchesSearch = searchData.includes(searchInput);
                // Pagpapasya kung ipapakita o itatago gamit ang Bootstrap d-none class
                if (matchesZone && matchesStatus && matchesSearch) {
                    report.classList.remove('d-none');
                    visibleCount++;
                } else {
                    report.classList.add('d-none');
                }
            });
            // I-update ang badge count
            document.getElementById('reportCountBadge').textContent = visibleCount;
            // Ipakita ang "No incident reports found." kung 0 ang visible items
            if (visibleCount === 0) {
                if (noReportsMessage) noReportsMessage.classList.remove('d-none');
            } else {
                if (noReportsMessage) noReportsMessage.classList.add('d-none');
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            filterReports();
            const viewReportModal = document.getElementById('viewReportModal');
            if (viewReportModal) {
                viewReportModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    document.getElementById('modalReportId').value = button.getAttribute('data-id');
                    document.getElementById('modalReportArea').value = button.getAttribute('data-area');
                    document.getElementById('modalReportIssue').value = button.getAttribute('data-issue');
                    document.getElementById('modalReportDesc').value = button.getAttribute('data-desc');
                    document.getElementById('modalReportDate').value = button.getAttribute('data-date');
                    document.getElementById('modalReportReporter').value = button.getAttribute('data-reporter');
                    
                    const imgUrl = button.getAttribute('data-image');
                    const imgElement = document.getElementById('modalReportImage');
                    const noImgText = document.getElementById('noImageText');
                    if (imgUrl && imgUrl.trim() !== '') {
                        imgElement.src = imgUrl;
                        imgElement.style.display = 'block';
                        noImgText.style.display = 'none';
                    } else {
                        imgElement.style.display = 'none';
                        noImgText.style.display = 'block';
                    }
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>