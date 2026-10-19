
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
            src="{{ asset('images/barangay-logo.png') }}"
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
                <span id="requestCount">3 requests</span>
            </div>

            <div id="requestList">

                <!-- Request 1 -->
                <article
                    class="request-card"
                    data-status="In Progress"
                    data-document-type="Certificate of Indigency"
                    data-purpose="Personal use"
                >
                    <div class="request-card-top">
                        <div class="request-info">
                            <h4>Certificate of Indigency</h4>
                            <p>Requested on Oct 12, 2026</p>
                        </div>

                        <span class="status in-progress">In Progress</span>
                    </div>

                    <div class="request-card-bottom">
                        <span class="request-reference">REQ-001</span>

                        <div class="request-actions">
                            <button class="action-button edit-button" type="button" data-action="edit">
                                Edit
                            </button>

                            <button class="action-button cancel-button" type="button" data-action="cancel">
                                Cancel
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Request 2 -->
                <article
                    class="request-card"
                    data-status="Approved"
                    data-document-type="Certificate of Residency"
                    data-purpose="Employment"
                >
                    <div class="request-card-top">
                        <div class="request-info">
                            <h4>Certificate of Residency</h4>
                            <p>Requested on Oct 10, 2026</p>
                        </div>

                        <span class="status approved">Approved</span>
                    </div>

                    <div class="request-card-bottom">
                        <span class="request-reference">REQ-002</span>

                        <div class="request-actions">
                            <button class="action-button edit-button" type="button" data-action="edit">
                                Edit
                            </button>

                            <button class="action-button cancel-button" type="button" data-action="cancel">
                                Cancel
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Request 3 -->
                <article
                    class="request-card"
                    data-status="Received"
                    data-document-type="Barangay Clearance"
                    data-purpose="Personal use"
                >
                    <div class="request-card-top">
                        <div class="request-info">
                            <h4>Barangay Clearance</h4>
                            <p>Requested on Oct 7, 2026</p>
                        </div>

                        <span class="status received">Received</span>
                    </div>

                    <div class="request-card-bottom">
                        <span class="request-reference">REQ-003</span>

                        <div class="request-actions">
                            <button class="action-button edit-button" type="button" data-action="edit">
                                Edit
                            </button>

                            <button class="action-button cancel-button" type="button" data-action="cancel">
                                Cancel
                            </button>
                        </div>
                    </div>
                </article>

            </div>

            <div class="empty-state" id="emptyState" hidden>
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

            <form id="requestForm">
                <label for="documentType">Document Type</label>

                <select id="documentType" required>
                    <option value="">Select a document</option>
                    <option>Certificate of Indigency</option>
                    <option>Certificate of Residency</option>
                    <option>Barangay Clearance</option>
                    <option>Certificate of Good Moral Character</option>
                    <option>Other Barangay Document</option>
                </select>

                <label for="requestPurpose">Purpose of Request</label>

                <textarea
                    id="requestPurpose"
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

        <a href="{{ url('/about') }}" class="nav-item">
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
    const documentType = document.getElementById('documentType');
    const requestPurpose = document.getElementById('requestPurpose');

    let currentFilter = 'All';
    let editingCard = null;
    let nextRequestNumber = 4;

    function getCards() {
        return Array.from(requestList.querySelectorAll('.request-card'));
    }

    function filterRequests() {
        const searchText = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        getCards().forEach(function (card) {
            const matchesStatus =
                currentFilter === 'All' ||
                card.dataset.status === currentFilter;

            const matchesSearch =
                card.textContent.toLowerCase().includes(searchText);

            const visible = matchesStatus && matchesSearch;
            card.hidden = !visible;

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
        editingCard = card;
        form.reset();

        if (card) {
            modalTitle.textContent = 'Edit Document Request';
            submitButton.textContent = 'Save Changes';
            documentType.value = card.dataset.documentType || '';
            requestPurpose.value = card.dataset.purpose || '';
        } else {
            modalTitle.textContent = 'New Document Request';
            submitButton.textContent = 'Submit Request';
        }

        modal.hidden = false;
        documentType.focus();
    }

    function closeModal() {
        modal.hidden = true;
        editingCard = null;
        form.reset();
    }

    document.getElementById('openRequestModal').addEventListener('click', function () {
        openModal();
    });

    document.getElementById('closeRequestModal').addEventListener('click', closeModal);
    document.getElementById('discardRequest').addEventListener('click', closeModal);

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !modal.hidden) {
            closeModal();
        }
    });

    requestList.addEventListener('click', function (event) {
        const button = event.target.closest('button[data-action]');

        if (!button) {
            return;
        }

        const card = button.closest('.request-card');

        if (button.dataset.action === 'edit') {
            if (card.dataset.status === 'Received') {
                alert('Received requests cannot be edited.');
                return;
            }

            openModal(card);
        }

        if (button.dataset.action === 'cancel') {
            if (card.dataset.status === 'Received') {
                alert('Received requests cannot be cancelled.');
                return;
            }

            if (confirm('Are you sure you want to cancel this document request?')) {
                card.remove();
                filterRequests();
            }
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const selectedDocument = documentType.value;
        const purpose = requestPurpose.value.trim();

        if (!selectedDocument || !purpose) {
            return;
        }

        if (editingCard) {
            editingCard.dataset.documentType = selectedDocument;
            editingCard.dataset.purpose = purpose;

            editingCard.querySelector('.request-info h4').textContent =
                selectedDocument;

            closeModal();
            filterRequests();
            return;
        }

        const reference = 'REQ-' + String(nextRequestNumber).padStart(3, '0');
        nextRequestNumber++;

        const card = document.createElement('article');
        card.className = 'request-card';
        card.dataset.status = 'In Progress';
        card.dataset.documentType = selectedDocument;
        card.dataset.purpose = purpose;

        const top = document.createElement('div');
        top.className = 'request-card-top';

        // No paper icon: show the document information directly.
        const info = document.createElement('div');
        info.className = 'request-info';

        const title = document.createElement('h4');
        title.textContent = selectedDocument;

        const date = document.createElement('p');
        date.textContent = 'Requested on ' +
            new Date().toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

        info.append(title, date);

        const status = document.createElement('span');
        status.className = 'status in-progress';
        status.textContent = 'In Progress';

        top.append(info, status);

        const bottom = document.createElement('div');
        bottom.className = 'request-card-bottom';

        const referenceText = document.createElement('span');
        referenceText.className = 'request-reference';
        referenceText.textContent = reference;

        const actions = document.createElement('div');
        actions.className = 'request-actions';

        const edit = document.createElement('button');
        edit.type = 'button';
        edit.className = 'action-button edit-button';
        edit.dataset.action = 'edit';
        edit.textContent = 'Edit';

        const cancel = document.createElement('button');
        cancel.type = 'button';
        cancel.className = 'action-button cancel-button';
        cancel.dataset.action = 'cancel';
        cancel.textContent = 'Cancel';

        actions.append(edit, cancel);
        bottom.append(referenceText, actions);
        card.append(top, bottom);

        requestList.prepend(card);

        closeModal();

        currentFilter = 'All';
        searchInput.value = '';

        filterButtons.forEach(function (button) {
            button.classList.toggle('active', button.dataset.filter === 'All');
        });

        filterRequests();
    });

    filterRequests();
});
</script>

</body>
</html>

