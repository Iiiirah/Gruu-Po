<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Requests | Brgy. Sibul Springs</title>
    <link rel="stylesheet" href="{{ asset('css/resident-document-request.css') }}">
</head>
<body>
<div class="dashboard-container">
    <!-- Header -->
    <header class="dashboard-header">
        <img
            src="{{ asset('images/LogoSibul.png') }}"
            alt="Barangay Logo"
            class="barangay-logo"
        >
        <h1>BRGY. SIBUL SPRINGS</h1>
        <p>San Miguel, Bulacan</p>
    </header>
    <main class="dashboard-content">
        <!-- Page Heading -->
        <section class="welcome-section">
            <h2>Document Requests</h2>
            <p>Request and manage your barangay documents.</p>
        </section>
        @if(session('success'))
            <div class="alert alert-success" style="padding: 10px; background: #d4edda; color: #155724; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 15px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif
        <!-- Search and Filters -->
        <section class="request-tools">
            <div class="search-box">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="10.8" cy="10.8" r="6.8"></circle>
                    <path d="m16 16 5 5"></path>
                </svg>
                <input
                    type="search"
                    id="requestSearch"
                    placeholder="Search document requests..."
                    aria-label="Search document requests"
                >
            </div>
            <div class="status-filters" aria-label="Filter requests by status">
                <button class="filter-button active" data-filter="All" type="button">All</button>
                <button class="filter-button" data-filter="Approved" type="button">Approved</button>
                <button class="filter-button" data-filter="In Progress" type="button">In Progress</button>
                <button class="filter-button" data-filter="Received" type="button">Received</button>
            </div>
        </section>
        <!-- Request List -->
        <section class="request-section">
            <div class="list-heading">
                <h3 class="section-title">My Requests</h3>
                <span id="requestCount">{{ count($requests) }} requests</span>
            </div>
            <div id="requestList">
                @forelse($requests as $req)
                    @php
                        $statusVal = trim($req->status ?? 'In Progress');
                        $purposeText = $req->purpose ?? '';
                        $residentNameVal = $req->resident_name ?? optional(Auth::user())->name ?? 'Resident';
                        $docTypeVal = $req->document_type ?? '';
                    @endphp
                    <article
                        class="request-card"
                        data-status="{{ $statusVal }}"
                        data-resident-name="{{ $residentNameVal }}"
                        data-document-type="{{ $docTypeVal }}"
                        data-purpose="{{ $purposeText }}"
                        data-id="{{ $req->id }}"
                    >
                        <div class="request-card-top">
                            <div class="request-info">
                                <h4>{{ $docTypeVal }}</h4>
                                <p style="font-size: 13px; color: #555; margin-bottom: 2px;">Resident: {{ $residentNameVal }}</p>
                                <p style="font-size: 12px; color: #777; margin-bottom: 4px;">Purpose: {{ $purposeText }}</p>
                                <p>Requested on {{ \Carbon\Carbon::parse($req->requested_at ?? $req->created_at)->format('M d, Y') }}</p>
                            </div>
                            <span class="status {{ Str::slug($statusVal) }}">
                                {{ $statusVal }}
                            </span>
                        </div>
                        <div class="request-card-bottom">
                            <span class="request-reference">{{ $req->reference_number ?? 'REF-' . $req->id }}</span>
                            <div class="request-actions">
                                @if(strcasecmp($statusVal, 'Approved') == 0)
                                    <!-- Kapag Approved: Ginamit ang edit-button class sa View para magkapareho ang itsura, at cancel-button na disabled -->
                                    <button class="action-button edit-button" type="button" data-action="view"
                                        data-resident="{{ $residentNameVal }}"
                                        data-doctype="{{ $docTypeVal }}"
                                        data-purpose="{{ $purposeText }}"
                                        data-date="{{ \Carbon\Carbon::parse($req->requested_at ?? $req->created_at)->format('F d, Y') }}">
                                        View
                                    </button>
                                    <button class="action-button cancel-button" type="button" disabled style="opacity: 0.4; cursor: not-allowed;">
                                        Cancel
                                    </button>
                                @elseif(strcasecmp($statusVal, 'Received') == 0)
                                    <!-- Kapag Received: View at Delete na gumagamit ng parehong edit-button at cancel-button classes para magkapareho ng kulay -->
                                    <button class="action-button edit-button" type="button" data-action="view"
                                        data-resident="{{ $residentNameVal }}"
                                        data-doctype="{{ $docTypeVal }}"
                                        data-purpose="{{ $purposeText }}"
                                        data-date="{{ \Carbon\Carbon::parse($req->requested_at ?? $req->created_at)->format('F d, Y') }}">
                                        View
                                    </button>
                                    <form action="{{ route('resident.document.destroy', $req->id) }}" method="POST" class="d-inline remove-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-button cancel-button" type="submit" data-action="remove">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <!-- Kapag In Progress (Default): Edit at Cancel buttons -->
                                    <button class="action-button edit-button" type="button" data-action="edit">
                                        Edit
                                    </button>
                                    <form action="{{ route('resident.document.destroy', $req->id) }}" method="POST" class="d-inline cancel-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-button cancel-button" type="submit" data-action="cancel">
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <!-- Walang laman by default -->
                @endforelse
            </div>
            <div class="empty-state" id="emptyState" @if(count($requests) > 0) hidden @endif>
                <p>No requests found.</p>
                <span>Try another search or status filter.</span>
            </div>
        </section>
    </main>
    <!-- Add Request Button -->
    <button
        type="button"
        class="add-request-button"
        id="openRequestModal"
        aria-label="Create a document request"
    >+</button>

    <!-- Request Form Modal -->
    <div class="modal-overlay" id="requestModal" hidden>
        <section
            class="request-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modalTitle"
        >
            <div class="modal-heading">
                <div>
                    <h3 id="modalTitle">New Document Request</h3>
                    <p>Fill in the details below.</p>
                </div>
                <button
                    type="button"
                    class="close-modal"
                    id="closeRequestModal"
                    aria-label="Close form"
                >&times;</button>
            </div>
            <form id="requestForm" action="{{ route('resident.document.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                
                <!-- Name of Resident Field -->
                <label for="residentName">Name of Resident</label>
                <input disabled
                    type="text"
                    id="residentName"
                    name="resident_name"
                    class="form-control mb-3"
                    value="{{ optional(Auth::user())->name ?? '' }}"
                    required
                    placeholder="Enter resident name..."
                    style="width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px;"
                >
                <label for="documentType">Document Type</label>
                <select id="documentType" name="document_type" required>
                    <option value="">Select a document</option>
                    <option value="Certificate of Indigency">Certificate of Indigency</option>
                    <option value="Certificate of Residency">Certificate of Residency</option>
                    <option value="Barangay Clearance">Barangay Clearance</option>
                    <option value="Certificate of Good Moral Character">Certificate of Good Moral Character</option>
                    <option value="Other Barangay Document">Other Barangay Document</option>
                </select>
                <label for="requestPurpose">Purpose of Request</label>
                <textarea
                    id="requestPurpose"
                    name="purpose"
                    rows="3"
                    placeholder="Enter the purpose of your request..."
                    required
                ></textarea>
                <p class="form-note">
                    Approved documents must be claimed at the barangay hall.
                </p>
                <div class="modal-actions">
                    <button type="button" class="modal-cancel-button" id="discardRequest">
                        Back
                    </button>
                    <button type="submit" class="submit-request-button" id="submitRequest">
                        Submit Request
                    </button>
                </div>
            </form>
        </section>
    </div>

    <!-- Custom View Modal para sa Approved at Received -->
    <div class="modal-overlay" id="viewDetailsModal" hidden>
        <section class="request-modal" role="dialog" aria-modal="true">
            <div class="modal-heading">
                <div>
                    <h3>Document Request Details</h3>
                    <p>Viewing submitted request information.</p>
                </div>
                <button type="button" class="close-modal" id="closeViewModal">&times;</button>
            </div>
            <div style="margin-top: 15px;">
                <label style="font-weight: bold; font-size: 13px; color: #555;">Resident Name</label>
                <input type="text" id="viewResidentName" class="form-control mb-3" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background: #f9f9f9;">
                
                <label style="font-weight: bold; font-size: 13px; color: #555;">Document Type</label>
                <input type="text" id="viewDocType" class="form-control mb-3" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background: #f9f9f9;">
                
                <label style="font-weight: bold; font-size: 13px; color: #555;">Date Requested</label>
                <input type="text" id="viewDate" class="form-control mb-3" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background: #f9f9f9;">
                
                <label style="font-weight: bold; font-size: 13px; color: #555;">Purpose of Request</label>
                <textarea id="viewPurpose" rows="3" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background: #f9f9f9;"></textarea>
            </div>
            <div class="modal-actions" style="margin-top: 20px;">
                <button type="button" class="modal-cancel-button" id="closeViewBtn">Close</button>
            </div>
        </section>
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="{{ url('/resident-dashboard') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 10.5 12 3l9 7.5"></path>
                <path d="M5.5 9.5V21h13V9.5"></path>
                <path d="M9 21v-7h6v7"></path>
            </svg>
            <span>Dashboard</span>
        </a>
        <a href="{{ url('/resident-community-information') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 3h14v18H5z"></path>
                <path d="M8 8h8M8 12h8M8 16h5"></path>
            </svg>
            <span>Community</span>
        </a>
        <a
            href="{{ url('/resident-document-request') }}"
            class="nav-item active"
            aria-current="page"
        >
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 3h9l4 4v14H6z"></path>
                <path d="M15 3v5h4M9 12h7M9 16h7"></path>
            </svg>
            <span>Requests</span>
        </a>
        <a href="{{ url('/resident-reports') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3 22 21H2z"></path>
                <path d="M12 9v5M12 17h.01"></path>
            </svg>
            <span>Reports</span>
        </a>
        <a href="{{ url('/resident-about') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21a8 8 0 0 1 16 0"></path>
            </svg>
            <span>About</span>
        </a>
    </nav>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('requestSearch');
    const filterButtons = document.querySelectorAll('.filter-button');
    const requestList = document.getElementById('requestList');
    const requestCount = document.getElementById('requestCount');
    const emptyState = document.getElementById('emptyState');
    const modal = document.getElementById('requestModal');
    const form = document.getElementById('requestForm');
    const modalTitle = document.getElementById('modalTitle');
    const submitButton = document.getElementById('submitRequest');
    const residentNameInput = document.getElementById('residentName');
    const documentType = document.getElementById('documentType');
    const requestPurpose = document.getElementById('requestPurpose');
    const formMethod = document.getElementById('formMethod');
    
    // View Modal Elements
    const viewModal = document.getElementById('viewDetailsModal');
    const viewResidentName = document.getElementById('viewResidentName');
    const viewDocType = document.getElementById('viewDocType');
    const viewDate = document.getElementById('viewDate');
    const viewPurpose = document.getElementById('viewPurpose');
    const closeViewModalBtn = document.getElementById('closeViewModal');
    const closeViewBtn = document.getElementById('closeViewBtn');

    let currentFilter = 'All';
    let editingCardId = null;

    function getCards() {
        return Array.from(requestList.querySelectorAll('.request-card'));
    }

    function filterRequests() {
        const searchText = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        getCards().forEach(function (card) {
            const cardStatus = (card.dataset.status || '').trim();
            const filterValue = currentFilter.trim();
            const matchesStatus =
                filterValue === 'All' ||
                cardStatus.toLowerCase() === filterValue.toLowerCase();
            
            // Isinasama ang purpose, resident name, at document type para gumana ang pag-type tulad ng "para sa akin"
            const searchContent = (
                (card.dataset.residentName || '') + ' ' +
                (card.dataset.documentType || '') + ' ' +
                (card.dataset.purpose || '') + ' ' +
                cardStatus
            ).toLowerCase();
            const matchesSearch = searchContent.includes(searchText);
            const visible = matchesStatus && matchesSearch;
            
            card.style.display = visible ? '' : 'none';
            if (visible) {
                visibleCount++;
            }
        });
        requestCount.textContent =
            visibleCount + (visibleCount === 1 ? ' request' : ' requests');
        
        emptyState.hidden = visibleCount !== 0;
    }

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            currentFilter = button.dataset.filter;
            filterButtons.forEach(function (item) {
                item.classList.toggle('active', item === button);
            });
            filterRequests();
        });
    });

    searchInput.addEventListener('input', filterRequests);

    function openModal(card = null) {
        form.reset();
        if (card) {
            editingCardId = card.dataset.id;
            modalTitle.textContent = 'Edit Document Request';
            submitButton.textContent = 'Save Changes';
            residentNameInput.value = card.dataset.residentName || "{{ optional(Auth::user())->name ?? '' }}";
            documentType.value = card.dataset.documentType || '';
            requestPurpose.value = card.dataset.purpose || '';
            form.action = `/resident-document-request/${editingCardId}`;
            formMethod.value = 'PUT';
        } else {
            editingCardId = null;
            modalTitle.textContent = 'New Document Request';
            submitButton.textContent = 'Submit Request';
            residentNameInput.value = "{{ optional(Auth::user())->name ?? '' }}";
            form.action = "{{ route('resident.document.store') }}";
            formMethod.value = 'POST';
        }
        modal.hidden = false;
        documentType.focus();
    }

    function closeModal() {
        modal.hidden = true;
        editingCardId = null;
        form.reset();
    }

    function openViewModal(resident, doctype, date, purpose) {
        viewResidentName.value = resident;
        viewDocType.value = doctype;
        viewDate.value = date;
        viewPurpose.value = purpose;
        viewModal.hidden = false;
    }

    function closeViewModal() {
        viewModal.hidden = true;
    }

    const openModalBtn = document.getElementById('openRequestModal');
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function () {
            openModal();
        });
    }
    document.getElementById('closeRequestModal').addEventListener('click', closeModal);
    document.getElementById('discardRequest').addEventListener('click', closeModal);
    
    if (closeViewModalBtn) closeViewModalBtn.addEventListener('click', closeViewModal);
    if (closeViewBtn) closeViewBtn.addEventListener('click', closeViewModal);

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    viewModal.addEventListener('click', function (event) {
        if (event.target === viewModal) {
            closeViewModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (!modal.hidden) closeModal();
            if (!viewModal.hidden) closeViewModal();
        }
    });

    form.addEventListener('submit', function (event) {
        if (!documentType.value || documentType.value === "") {
            alert('Please select a document type.');
            documentType.focus();
            event.preventDefault();
            return false;
        }
    });

    requestList.addEventListener('click', function (event) {
        const button = event.target.closest('button[data-action]');
        if (!button) {
            return;
        }
        const card = button.closest('.request-card');
        const status = (card.dataset.status || '').toLowerCase();

        if (button.dataset.action === 'edit') {
            if (status === 'approved' || status === 'released' || status === 'received') {
                alert('Approved or received requests cannot be edited.');
                return;
            }
            openModal(card);
        } else if (button.dataset.action === 'view') {
            openViewModal(
                button.getAttribute('data-resident'),
                button.getAttribute('data-doctype'),
                button.getAttribute('data-date'),
                button.getAttribute('data-purpose')
            );
        }
    });

    requestList.addEventListener('submit', function (event) {
        const cancelForm = event.target.closest('.cancel-form');
        const removeForm = event.target.closest('.remove-form');

        if (cancelForm) {
            const card = cancelForm.closest('.request-card');
            const status = (card.dataset.status || '').toLowerCase();
            if (status === 'approved' || status === 'released' || status === 'received') {
                alert('This request cannot be cancelled.');
                event.preventDefault();
                return;
            }
            if (!confirm('Are you sure you want to cancel this document request?')) {
                event.preventDefault();
            }
        }

        if (removeForm) {
            if (!confirm('Are you sure you want to remove?')) {
                event.preventDefault();
            }
        }
    });

    filterRequests();
});
</script>
</body>
</html>