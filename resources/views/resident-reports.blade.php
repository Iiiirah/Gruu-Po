<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Incident Reports | Brgy. Sibul Springs</title>

    <link rel="stylesheet" href="{{ asset('css/resident-reports.css') }}">
</head>
<body>

<div class="dashboard-container">

    <!-- HEADER -->
    <header class="dashboard-header">
        <img
            src="{{ asset('images/barangay-logo.png') }}"
            alt="Barangay Logo"
            class="barangay-logo"
        >

        <h1>BRGY. SIBUL SPRINGS</h1>
        <p>San Miguel, Bulacan</p>
    </header>

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">

        <section class="welcome-section">
            <h2>Incident Reports</h2>
            <p>Submit and manage your community incident reports.</p>
        </section>

        <!-- SEARCH -->
        <section class="report-tools">
            <div class="search-box">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m16 16 4 4"></path>
                </svg>

                <input
                    type="search"
                    id="reportSearch"
                    placeholder="Search incident reports..."
                    aria-label="Search incident reports"
                >
            </div>
        </section>

        <!-- REPORTS -->
        <section class="report-section">

            <div class="list-heading">
                <div class="zone-selector">
                    <label for="zoneFilter">Zone:</label>

                    <select id="zoneFilter">
                        <option value="All">All Zones</option>
                        <option value="Zone 1">Zone 1</option>
                        <option value="Zone 2">Zone 2</option>
                        <option value="Zone 3">Zone 3</option>
                        <option value="Zone 4">Zone 4</option>
                    </select>
                </div>

                <div class="report-count-box">
                    <span id="reportCount">3 reports</span>
                </div>
            </div>

            <!-- STATUS FILTERS -->
            <div class="status-filters">
                <button type="button" class="filter-button active" data-filter="All">
                    All
                </button>

                <button type="button" class="filter-button" data-filter="New">
                    New
                </button>

                <button type="button" class="filter-button" data-filter="Verified">
                    Verified
                </button>

                <button type="button" class="filter-button" data-filter="Resolved">
                    Resolved
                </button>
            </div>

            <!-- REPORT LIST -->
            <div id="reportList">

                <!-- REPORT 1 -->
                <article
                    class="report-card"
                    data-status="Verified"
                    data-incident-type="Fire"
                    data-zone="Zone 1"
                    data-description="A fire incident was reported near a residential area."
                    data-date="2026-10-12T14:30"
                >
                    <div class="report-card-top">
                        <div class="report-info">
                            <span class="incident-name fire">Fire</span>

                            <p class="report-zone">Zone 1</p>

                            <p class="report-date">
                                Oct 12, 2026 · 2:30 PM
                            </p>
                        </div>

                        <span class="status verified">Verified</span>
                    </div>

                    <div class="report-card-bottom">
                        <span class="report-reference">IDT-001</span>
                    </div>
                </article>

                <!-- REPORT 2 -->
                <article
                    class="report-card"
                    data-status="Resolved"
                    data-incident-type="Flood"
                    data-zone="Zone 2"
                    data-description="Flooding was reported after heavy rainfall."
                    data-date="2026-10-10T08:15"
                >
                    <div class="report-card-top">
                        <div class="report-info">
                            <span class="incident-name flood">Flood</span>

                            <p class="report-zone">Zone 2</p>

                            <p class="report-date">
                                Oct 10, 2026 · 8:15 AM
                            </p>
                        </div>

                        <span class="status resolved">Resolved</span>
                    </div>

                    <div class="report-card-bottom">
                        <span class="report-reference">IDT-002</span>
                    </div>
                </article>

                <!-- REPORT 3 -->
                <article
                    class="report-card"
                    data-status="New"
                    data-incident-type="Landslide"
                    data-zone="Zone 3"
                    data-description="A possible landslide was reported along a roadside."
                    data-date="2026-10-07T16:45"
                >
                    <div class="report-card-top">
                        <div class="report-info">
                            <span class="incident-name landslide">Landslide</span>

                            <p class="report-zone">Zone 3</p>

                            <p class="report-date">
                                Oct 7, 2026 · 4:45 PM
                            </p>
                        </div>

                        <span class="status new">New</span>
                    </div>

                    <div class="report-card-bottom">
                        <span class="report-reference">IDT-003</span>
                    </div>
                </article>

            </div>

            <!-- EMPTY STATE -->
            <div class="empty-state" id="emptyState" hidden>
                <p>No incident reports found.</p>
                <span>Try changing your search or filters.</span>
            </div>

        </section>
    </main>

    <!-- FLOATING ADD REPORT BUTTON -->
    <button
        type="button"
        class="add-report-button"
        id="openReportModal"
        aria-label="Add incident report"
    >
        +
    </button>

    <!-- ADD REPORT MODAL -->
    <div class="modal-overlay" id="reportModal" hidden>
        <div
            class="report-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modalTitle"
        >
            <div class="modal-heading">
                <div>
                    <h3 id="modalTitle">Submit Incident Report</h3>
                    <p>Provide the details of the incident.</p>
                </div>

                <button
                    type="button"
                    class="close-modal"
                    id="closeReportModal"
                    aria-label="Close modal"
                >
                    &times;
                </button>
            </div>

            <form id="reportForm">

                <label for="incidentType">Incident Type</label>
                <select id="incidentType" required>
                    <option value="">Select incident type</option>
                    <option value="Fire">Fire</option>
                    <option value="Flood">Flood</option>
                    <option value="Landslide">Landslide</option>
                    <option value="Typhoon">Typhoon</option>
                    <option value="Earthquake">Earthquake</option>
                    <option value="Accident">Accident</option>
                    <option value="Theft">Theft</option>
                    <option value="Other">Other</option>
                </select>

                <label for="reportZone">Zone</label>
                <select id="reportZone" required>
                    <option value="">Select zone</option>
                    <option value="Zone 1">Zone 1</option>
                    <option value="Zone 2">Zone 2</option>
                    <option value="Zone 3">Zone 3</option>
                    <option value="Zone 4">Zone 4</option>
                </select>

                <label for="incidentDate">Date and Time</label>
                <input type="datetime-local" id="incidentDate" required>

                <label for="reportDescription">Description</label>
                <textarea
                    id="reportDescription"
                    placeholder="Describe the incident..."
                    required
                ></textarea>

                <label for="reportPhoto">Attach Photo (Optional)</label>
                <input type="file" id="reportPhoto" accept="image/*">

                <p class="form-note">
                    Your report will initially have a New status.
                </p>

                <div class="modal-actions">
                    <button
                        type="button"
                        class="modal-cancel-button"
                        id="discardReport"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="submit-report-button">
                        Submit Report
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- BOTTOM NAVIGATION -->
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

        <a href="{{ url('/resident-document-request') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 3h9l4 4v14H6z"></path>
                <path d="M15 3v5h4M9 12h7M9 16h7"></path>
            </svg>
            <span>Requests</span>
        </a>

        <a
            href="{{ url('/resident-reports') }}"
            class="nav-item active"
            aria-current="page"
        >
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
    const reportList = document.getElementById('reportList');
    const reportSearch = document.getElementById('reportSearch');
    const zoneFilter = document.getElementById('zoneFilter');
    const reportCount = document.getElementById('reportCount');
    const emptyState = document.getElementById('emptyState');

    const reportModal = document.getElementById('reportModal');
    const openReportModal = document.getElementById('openReportModal');
    const closeReportModal = document.getElementById('closeReportModal');
    const discardReport = document.getElementById('discardReport');
    const reportForm = document.getElementById('reportForm');

    const incidentType = document.getElementById('incidentType');
    const reportZone = document.getElementById('reportZone');
    const incidentDate = document.getElementById('incidentDate');
    const reportDescription = document.getElementById('reportDescription');
    const reportPhoto = document.getElementById('reportPhoto');

    const filterButtons = document.querySelectorAll('.filter-button');

    let activeStatus = 'All';
    let nextReportNumber = 4;

    function getIncidentClass(type) {
        const classes = {
            Fire: 'fire',
            Flood: 'flood',
            Landslide: 'landslide',
            Typhoon: 'typhoon',
            Earthquake: 'earthquake',
            Accident: 'accident',
            Theft: 'theft',
            Other: 'other'
        };

        return classes[type] || 'other';
    }

    function formatDate(dateValue) {
        const date = new Date(dateValue);

        if (Number.isNaN(date.getTime())) {
            return dateValue;
        }

        return date.toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit'
        }).replace(',', ' ·');
    }

    function filterReports() {
        const searchValue = reportSearch.value.trim().toLowerCase();
        const selectedZone = zoneFilter.value;
        const cards = reportList.querySelectorAll('.report-card');

        let visibleCount = 0;

        cards.forEach(function (card) {
            const status = card.dataset.status;
            const zone = card.dataset.zone;
            const incident = card.dataset.incidentType || '';
            const description = card.dataset.description || '';
            const reference =
                card.querySelector('.report-reference')?.textContent || '';
            const date = card.dataset.date || '';

            const searchableText = (
                incident + ' ' +
                description + ' ' +
                zone + ' ' +
                reference + ' ' +
                date + ' ' +
                status
            ).toLowerCase();

            const matchesSearch = searchableText.includes(searchValue);
            const matchesZone =
                selectedZone === 'All' || zone === selectedZone;
            const matchesStatus =
                activeStatus === 'All' || status === activeStatus;

            const isVisible =
                matchesSearch && matchesZone && matchesStatus;

            card.hidden = !isVisible;

            if (isVisible) {
                visibleCount++;
            }
        });

        reportCount.textContent =
            visibleCount + (visibleCount === 1 ? ' report' : ' reports');

        emptyState.hidden = visibleCount !== 0;
    }

    reportSearch.addEventListener('input', filterReports);
    zoneFilter.addEventListener('change', filterReports);

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            filterButtons.forEach(function (item) {
                item.classList.remove('active');
            });

            button.classList.add('active');
            activeStatus = button.dataset.filter;

            filterReports();
        });
    });

    function showModal() {
        reportModal.hidden = false;
        incidentType.focus();
    }

    function hideModal() {
        reportModal.hidden = true;
    }

    openReportModal.addEventListener('click', showModal);
    closeReportModal.addEventListener('click', hideModal);
    discardReport.addEventListener('click', hideModal);

    reportModal.addEventListener('click', function (event) {
        if (event.target === reportModal) {
            hideModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !reportModal.hidden) {
            hideModal();
        }
    });

    reportPhoto.addEventListener('change', function () {
        const file = reportPhoto.files[0];

        if (file && !file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            reportPhoto.value = '';
        }
    });

    reportForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const type = incidentType.value;
        const zone = reportZone.value;
        const dateValue = incidentDate.value;
        const description = reportDescription.value.trim();
        const photoFile = reportPhoto.files[0];

        if (!type || !zone || !dateValue || !description) {
            alert('Please complete all required fields.');
            return;
        }

        if (photoFile && !photoFile.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            return;
        }

        const reportId = 'IDT-' +
            String(nextReportNumber).padStart(3, '0');

        nextReportNumber++;

        const card = document.createElement('article');

        card.className = 'report-card';
        card.dataset.status = 'New';
        card.dataset.incidentType = type;
        card.dataset.zone = zone;
        card.dataset.description = description;
        card.dataset.date = dateValue;

        const cardTop = document.createElement('div');
        cardTop.className = 'report-card-top';

        const reportInfo = document.createElement('div');
        reportInfo.className = 'report-info';

        const incidentName = document.createElement('span');
        incidentName.className = 'incident-name ' + getIncidentClass(type);
        incidentName.textContent = type;

        const reportZoneLabel = document.createElement('p');
        reportZoneLabel.className = 'report-zone';
        reportZoneLabel.textContent = zone;

        const reportDate = document.createElement('p');
        reportDate.className = 'report-date';
        reportDate.textContent = formatDate(dateValue);

        reportInfo.appendChild(incidentName);
        reportInfo.appendChild(reportZoneLabel);
        reportInfo.appendChild(reportDate);

        const status = document.createElement('span');
        status.className = 'status new';
        status.textContent = 'New';

        cardTop.appendChild(reportInfo);
        cardTop.appendChild(status);
        card.appendChild(cardTop);

        if (photoFile) {
            const photoPreview = document.createElement('img');
            photoPreview.className = 'report-photo-preview';
            photoPreview.alt = 'Attached incident photo';
            photoPreview.src = URL.createObjectURL(photoFile);

            card.appendChild(photoPreview);
        }

        const cardBottom = document.createElement('div');
        cardBottom.className = 'report-card-bottom';

        const reference = document.createElement('span');
        reference.className = 'report-reference';
        reference.textContent = reportId;

        cardBottom.appendChild(reference);
        card.appendChild(cardBottom);

        reportList.prepend(card);

        reportForm.reset();
        hideModal();

        activeStatus = 'All';

        filterButtons.forEach(function (button) {
            button.classList.toggle(
                'active',
                button.dataset.filter === 'All'
            );
        });

        zoneFilter.value = 'All';
        reportSearch.value = '';

        filterReports();
    });

    filterReports();
});
</script>

</body>
</html>