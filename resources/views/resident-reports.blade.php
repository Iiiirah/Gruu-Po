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
            src="{{ asset('images/LogoSibul.png') }}"
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
                    <span id="reportCount">{{ count($reports) }} reports</span>
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
                @forelse($reports as $report)
                    <article
                        class="report-card"
                        data-status="{{ $report->status }}"
                        data-incident-type="{{ $report->incident_type }}"
                        data-zone="{{ $report->zone }}"
                        data-description="{{ $report->description }}"
                        data-date="{{ $report->incident_date }}"
                    >
                        <div class="report-card-top">
                            <div class="report-info">
                                <span class="incident-name {{ strtolower($report->incident_type) }}">{{ $report->incident_type }}</span>
                                <p class="report-zone">{{ $report->zone }}</p>
                                <p class="report-date">
                                    {{ \Carbon\Carbon::parse($report->incident_date ?? $report->created_at)->format('M d, Y · g:i A') }}
                                </p>
                            </div>
                            <span class="status {{ strtolower($report->status) }}">{{ $report->status }}</span>
                        </div>
                        
                        <!-- PHOTO PREVIEW IN CARD -->
                        @if($report->photo)
                            <div class="report-photo-container" style="margin-top: 10px; margin-bottom: 10px;">
                                <a href="{{ asset('storage/' . $report->photo) }}" target="_blank" title="I-click para lumaki ang litrato">
                                    <img src="{{ asset('storage/' . $report->photo) }}" alt="Attached Incident Photo" class="report-photo-preview" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd; cursor: pointer;">
                                </a>
                            </div>
                        @endif
                        <div class="report-card-bottom" style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="report-reference">{{ $report->reference_no ?? $report->reference_number }}</span>
                            
                            <!-- EDIT AT DELETE BUTTONS -->
                            <div class="report-actions" style="display: flex; gap: 8px;">
                                <!-- Pinahintulutan ang 'open', 'new', 'n' status para laging lalabas ang Edit button sa mga bago/open na ulat -->
                                @if(in_array(strtolower($report->status ?? 'open'), ['new', 'open', 'n', 'pending']))
                                    <button 
                                        type="button" 
                                        class="btn-edit" 
                                        style="padding: 4px 10px; font-size: 12px; background: #3b82f6; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                        onclick="openEditModal('{{ $report->id }}', '{{ $report->incident_type }}', '{{ $report->zone }}', '{{ $report->incident_date ?? $report->created_at }}', '{{ addslashes($report->description) }}', '{{ $report->photo ? asset('storage/' . $report->photo) : '' }}')"
                                    >
                                        Edit
                                    </button>
                                @endif
                                <form action="{{ route('resident.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Sigurado ka bang gusto mong burahin ang report na ito?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="padding: 4px 10px; font-size: 12px; background: #ef4444; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <!-- Empty by default if user has no reports -->
                @endforelse
            </div>
            <!-- EMPTY STATE -->
            <div class="empty-state" id="emptyState" {{ count($reports) > 0 ? 'hidden' : '' }}>
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
    <!-- ADD / EDIT REPORT MODAL -->
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
                    <p id="modalSubtitle">Provide the details of the incident.</p>
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
            <form id="reportForm" action="{{ route('resident.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>
                <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">
                <label for="incidentType">Incident Type</label>
                <select id="incidentType" name="incident_type" required>
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
                <select id="reportZone" name="zone" required>
                    <option value="">Select zone</option>
                    <option value="Zone 1">Zone 1</option>
                    <option value="Zone 2">Zone 2</option>
                    <option value="Zone 3">Zone 3</option>
                    <option value="Zone 4">Zone 4</option>
                </select>
                <label for="incidentDate">Date and Time</label>
                <input type="datetime-local" id="incidentDate" name="incident_date" required readonly style="background-color: #f9f9f9; cursor: not-allowed;">
                <label for="reportDescription">Description</label>
                <textarea
                    id="reportDescription"
                    name="description"
                    placeholder="Describe the incident..."
                    required
                ></textarea>
                <label for="reportPhoto">Attach Photo (Optional)</label>
                <input type="file" id="reportPhoto" name="photo" accept="image/*">
                <!-- LIVE PREVIEW CONTAINER WITH REMOVE BUTTON IN MODAL -->
                <div id="modalPhotoPreviewContainer" style="display: none; margin-top: 10px; margin-bottom: 10px; position: relative;">
                    <p style="font-size: 12px; font-weight: 600; margin-bottom: 4px; color: #475569;">Selected Photo:</p>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img id="modalPhotoPreview" src="" alt="Preview" style="max-width: 120px; max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover;">
                        <button type="button" id="removePhotoBtn" style="padding: 6px 12px; font-size: 12px; background-color: #ef4444; color: white; border: none; border-radius: 4px; cursor: pointer; height: fit-content;">
                            Remove Photo
                        </button>
                    </div>
                </div>
                <p class="form-note" id="formNote">
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
                    <button type="submit" class="submit-report-button" id="submitButtonText">
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
    const modalPhotoPreviewContainer = document.getElementById('modalPhotoPreviewContainer');
    const modalPhotoPreview = document.getElementById('modalPhotoPreview');
    const removePhotoBtn = document.getElementById('removePhotoBtn');
    const removePhotoInput = document.getElementById('removePhotoInput');
    let activeStatus = 'All';

    function setCurrentDateTime() {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        incidentDate.value = now.toISOString().slice(0, 16);
    }

    removePhotoBtn.addEventListener('click', function () {
        reportPhoto.value = '';
        modalPhotoPreview.src = '';
        modalPhotoPreviewContainer.style.display = 'none';
        removePhotoInput.value = '1';
    });

    reportPhoto.addEventListener('change', function () {
        const file = reportPhoto.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file.');
                reportPhoto.value = '';
                modalPhotoPreviewContainer.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                modalPhotoPreview.src = e.target.result;
                modalPhotoPreviewContainer.style.display = 'block';
                removePhotoInput.value = '0';
            };
            reader.readAsDataURL(file);
        }
    });

    window.openEditModal = function(id, type, zone, date, description, photoUrl) {
        reportModal.hidden = false;
        document.getElementById('modalTitle').textContent = 'Edit Incident Report';
        document.getElementById('modalSubtitle').textContent = 'Update the details of your report.';
        document.getElementById('submitButtonText').textContent = 'Update Report';
        
        reportForm.action = '/resident-reports/' + id;
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        removePhotoInput.value = '0';
        incidentType.value = type;
        reportZone.value = zone;
        incidentDate.value = date ? date.replace(' ', 'T').slice(0, 16) : '';
        reportDescription.value = description;
        reportPhoto.value = '';
        if (photoUrl) {
            modalPhotoPreview.src = photoUrl;
            modalPhotoPreviewContainer.style.display = 'block';
        } else {
            modalPhotoPreview.src = '';
            modalPhotoPreviewContainer.style.display = 'none';
        }
        incidentType.focus();
    };

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
                activeStatus === 'All' || status.toLowerCase() === activeStatus.toLowerCase();
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
        document.getElementById('modalTitle').textContent = 'Submit Incident Report';
        document.getElementById('modalSubtitle').textContent = 'Provide the details of the incident.';
        document.getElementById('submitButtonText').textContent = 'Submit Report';
        reportForm.action = "{{ route('resident.reports.store') }}";
        document.getElementById('methodField').innerHTML = '';
        removePhotoInput.value = '0';
        reportForm.reset();
        modalPhotoPreview.src = '';
        modalPhotoPreviewContainer.style.display = 'none';
        setCurrentDateTime();
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

    filterReports();
});
</script>
</body>
</html>