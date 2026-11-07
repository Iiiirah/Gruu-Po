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
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link active">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
                        <a href="{{ route('user.management') }}" class="sidebar-link">User Management</a>
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
                            <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm shadow-none" placeholder="Search Request..." oninput="filterTable()">
                            <button class="btn btn-primary px-4 text-sm fw-semibold" type="button" id="searchBtn" onclick="filterTable()" style="background-color: #38bdf8; border: none; color: #0f172a;">Search</button>
                        </div>
                        <div class="btn-group filter-buttons shadow-sm" role="group" id="filterTabs">
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
                                @forelse($requests ?? [] as $req)
                                    @php
                                        $reqStatus = trim($req->status ?? 'Received');
                                        if($reqStatus == '') { $reqStatus = 'Received'; }

                                        // Pagpapalitan ng kulay batay sa status na may kasamang !important para sigurado
                                        $bg = '#e0f2fe'; $color = '#0369a1'; $border = '#38bdf8'; // Asul (Received/Default)
                                        
                                        if(strcasecmp($reqStatus, 'Approved') == 0) { 
                                            $bg = '#d1fae5'; $color = '#065f46'; $border = '#10b981'; // Berde 
                                        } elseif(strcasecmp($reqStatus, 'In Progress') == 0) { 
                                            $bg = '#fef3c7'; $color = '#92400e'; $border = '#f59e0b'; // Golden Yellow 
                                        }

                                        $residentName = $req->user->name ?? ($req->resident_name ?? 'Residente');
                                        $docType = $req->document_type ?? $req->type ?? 'Document';
                                        $purposeText = $req->purpose ?? '';
                                        $dateText = $req->created_at ? $req->created_at->format('F d, Y') : '';
                                    @endphp
                                    <tr class="request-row" 
                                        data-status="{{ strtolower($reqStatus) }}" 
                                        data-search="{{ strtolower($residentName . ' ' . $docType . ' ' . $purposeText . ' ' . $dateText . ' ' . $reqStatus) }}">
                                        <td class="fw-semibold px-3 resident-name">{{ $residentName }}</td>
                                        <td class="doc-type">{{ $docType }}</td>
                                        <td>{{ $dateText }}</td>
                                        <td class="status-cell">
                                            <span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: {{ $bg }} !important; color: {{ $color }} !important; border: 1px solid {{ $border }} !important;">{{ $reqStatus }}</span>
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                <!-- Status Update Form -->
                                                <form action="{{ route('documents.updateStatus', $req->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" class="form-select form-select-sm text-xs fw-semibold bg-light" onchange="this.form.submit()" style="width: 130px;">
                                                        <option value="In Progress" {{ strcasecmp($reqStatus, 'In Progress') == 0 ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Approved" {{ strcasecmp($reqStatus, 'Approved') == 0 ? 'selected' : '' }}>Approved</option>
                                                        <option value="Received" {{ strcasecmp($reqStatus, 'Received') == 0 ? 'selected' : '' }}>Received</option>
                                                    </select>
                                                </form>

                                                <!-- View Button -->
                                                <button type="button" class="btn btn-sm btn-outline-primary text-xs px-2 py-1" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewPurposeModal"
                                                    data-resident="{{ $residentName }}"
                                                    data-doctype="{{ $docType }}"
                                                    data-purpose="{{ $purposeText ?: 'Walang inilagay na layunin o purpose.' }}"
                                                    data-date="{{ $dateText }}">
                                                    View
                                                </button>

                                                <!-- Delete / Cancel Button -->
                                                <form action="{{ route('documents.destroy', $req->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sigurado ka bang gusto mong burahin ang row na ito?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger text-xs px-2 py-1">Cancel</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                                <!-- Row para kapag walang maipakita -->
                                <tr id="noResultsRow" class="d-none">
                                    <td colspan="5" class="text-center text-muted py-4">No document requests found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination / Footer Info -->
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                        <span class="text-muted text-xs" id="rowCountInfo">Showing 0 Requests</span>
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

    <!-- View Purpose Modal -->
    <div class="modal fade" id="viewPurposeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">Document Request Details</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0 py-4">
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-muted">Resident Name</label>
                        <input type="text" id="modalResidentName" class="form-control bg-light text-dark fw-semibold" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-muted">Document Type</label>
                        <input type="text" id="modalDocType" class="form-control bg-light text-dark fw-semibold" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-muted">Date Submitted</label>
                        <input type="text" id="modalDateSubmitted" class="form-control bg-light text-dark fw-semibold" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-xs fw-bold text-muted">Purpose of Request</label>
                        <textarea id="modalPurposeContent" class="form-control bg-light text-dark fw-semibold" rows="3" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-0 pt-2 justify-content-end">
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-semibold text-dark shadow-sm" data-bs-dismiss="modal">Close</button>
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

    <!-- JavaScript para sa Filtering, Search, at Modal Data Binding -->
    <script>
        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase().trim();
            const activeTab = document.querySelector('#filterTabs button.active');
            const activeFilter = activeTab ? activeTab.getAttribute('data-filter').toLowerCase().trim() : 'all';
            const rows = document.querySelectorAll('.request-row');
            const noResultsRow = document.getElementById('noResultsRow');
            let visibleCount = 0;

            rows.forEach(row => {
                const status = (row.getAttribute('data-status') || '').toLowerCase().trim();
                const searchData = (row.getAttribute('data-search') || '').toLowerCase();

                const matchesFilter = (activeFilter === 'all' || status === activeFilter);
                const matchesSearch = searchData.includes(searchInput);

                if (matchesFilter && matchesSearch) {
                    row.classList.remove('d-none');
                    visibleCount++;
                } else {
                    row.classList.add('d-none');
                }
            });

            // I-update ang footer row counter text
            const rowCountInfo = document.getElementById('rowCountInfo');
            if (rowCountInfo) {
                rowCountInfo.textContent = `Showing ${visibleCount} Requests`;
            }

            // Ipakita ang "No document requests found." kung walang nag-match
            if (noResultsRow) {
                if (visibleCount === 0) {
                    noResultsRow.classList.remove('d-none');
                } else {
                    noResultsRow.classList.add('d-none');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('#filterTabs button');

            // Event Listeners para sa Filter Tabs
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    filterButtons.forEach(b => {
                        b.classList.remove('active', 'btn-primary', 'text-white');
                        b.classList.add('btn-outline-secondary');
                    });
                    
                    this.classList.add('active', 'btn-primary', 'text-white');
                    this.classList.remove('btn-outline-secondary');
                    filterTable();
                });
            });

            // Unang pagpapatakbo ng filter sa pag-load ng page
            filterTable();

            // Script para sa pagpasa ng data papunta sa View Purpose Modal
            const viewPurposeModal = document.getElementById('viewPurposeModal');
            if (viewPurposeModal) {
                viewPurposeModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    document.getElementById('modalResidentName').value = button.getAttribute('data-resident');
                    document.getElementById('modalDocType').value = button.getAttribute('data-doctype');
                    document.getElementById('modalDateSubmitted').value = button.getAttribute('data-date');
                    document.getElementById('modalPurposeContent').value = button.getAttribute('data-purpose');
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>