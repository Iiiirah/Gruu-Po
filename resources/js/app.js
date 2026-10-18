import './bootstrap';
import '../css/app.css';
import 'bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Script for dashboard
    function openViewReportModal(data) {
        document.getElementById('modalReportId').value = data.id;
        document.getElementById('modalArea').value = data.area;
        document.getElementById('modalIssue').value = data.issue;
        document.getElementById('modalDescription').value = data.description;
        document.getElementById('modalDate').value = data.date;
        document.getElementById('modalReporter').value = data.reporter;

        const reportModal = new bootstrap.Modal(document.getElementById('viewReportModal'));
        reportModal.show();
    }

    // Open Delete Confirmation Modal
    window.openDeleteModal = function (deleteUrl, titleText = "Removing Report") {
        const form = document.getElementById('deleteFormAction');
        if (form) {
            form.action = deleteUrl;
        }
        
        const titleEl = document.getElementById('deleteModalLabel');
        if (titleEl) {
            titleEl.innerText = titleText;
        }

        const deleteModalEl = document.getElementById('deleteModal');
        if (deleteModalEl) {
            const deleteModal = new bootstrap.Modal(deleteModalEl);
            deleteModal.show();
        }
    };

    // Open Logout Confirmation Modal
    window.openLogoutModal = function () {
        const drawerEl = document.getElementById('slidingMenuDrawer');
        if (drawerEl) {
            const offcanvasInstance = bootstrap.Offcanvas.getInstance(drawerEl);
            if (offcanvasInstance) {
                offcanvasInstance.hide();
            }
        }

        const logoutModalEl = document.getElementById('logoutModal');
        if (logoutModalEl) {
            const logoutModal = new bootstrap.Modal(logoutModalEl);
            logoutModal.show();
        }
    };

    // Open View Report Modal
    window.openViewReportModal = function (data) {
        document.getElementById('modalReportId').value = data.id || '';
        document.getElementById('modalArea').value = data.area || '';
        document.getElementById('modalIssue').value = data.issue || '';
        document.getElementById('modalDescription').value = data.description || '';
        document.getElementById('modalDate').value = data.date || '';
        document.getElementById('modalReporter').value = data.reporter || '';

        const viewModalEl = document.getElementById('viewReportModal');
        if (viewModalEl) {
            const viewModal = new bootstrap.Modal(viewModalEl);
            viewModal.show();
        }
    };

    // Open View Post Modal
    window.openViewPostModal = function (data) {
        document.getElementById('modalPostTitle').value = data.title || '';
        document.getElementById('modalPostType').value = data.type || '';
        document.getElementById('modalPostDescription').value = data.description || '';
        document.getElementById('modalPostDate').value = data.date || '';
        document.getElementById('modalPostAuthor').value = data.author || '';

        const postModalEl = document.getElementById('viewPostModal');
        if (postModalEl) {
            const postModal = new bootstrap.Modal(postModalEl);
            postModal.show();
        }
    };


// Community Information Module
    document.addEventListener('DOMContentLoaded', function () {
            const postsContainer = document.getElementById('postsContainer');
            const searchInput = document.getElementById('searchInput');
            const filterButtons = document.querySelectorAll('#filterTabs button');
            const tabCards = document.querySelectorAll('.tab-card');
            
            let currentView = 'published'; // 'published', 'draft', 'archive'
            let currentFilter = 'all';
            let itemToDelete = null;

            const deleteModal = new bootstrap.Modal(document.getElementById('deletePostModal'));
            const viewModal = new bootstrap.Modal(document.getElementById('viewPostModal'));
            const draftModal = new bootstrap.Modal(document.getElementById('draftViewModal'));
            const createModal = new bootstrap.Modal(document.getElementById('createPostModal'));

            // Mock Data Store
            const dataStore = {
                published: [
                    { title: "Renovation in Zone 1", desc: "Some of Zone 1 infrastructure will be temporarily closed due to the renovation.", type: "Announcement", date: "Oct 9, 2026" },
                    { title: "Ber Month Promo", desc: "30% discount items on market.", type: "Events", date: "Oct 9, 2026" }
                ],
                draft: [
                    { title: "Scholar Pay Out", desc: "Claim your allowance at the Barangay Hall.", type: "Announcement", date: "Oct 9, 2026" }
                ],
                archive: [
                    { title: "School Maintenance", desc: "School will temporarily be closed for classroom renovations.", type: "Announcement", date: "June 2, 2025" }
                ]
            };

            function renderPosts() {
                postsContainer.innerHTML = '';
                const query = searchInput.value.toLowerCase().trim();
                const items = dataStore[currentView];

                items.forEach((item, index) => {
                    const matchesSearch = item.title.toLowerCase().includes(query) || item.desc.toLowerCase().includes(query);
                    const matchesFilter = (currentFilter === 'all' || item.type === currentFilter);

                    if (matchesSearch && matchesFilter) {
                        const badgeBg = item.type === 'Announcement' ? '#f87171' : '#fde047';
                        const badgeColor = item.type === 'Announcement' ? 'white' : '#854d0e';

                        const card = document.createElement('div');
                        card.className = 'card border rounded-4 p-3 shadow-sm post-item';
                        card.innerHTML = `
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="border rounded-4 p-3 text-center text-muted bg-light d-flex align-items-center justify-content-center" style="width: 110px; height: 90px;">
                                        <span style="font-size: 11px;">Post Preview</span>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1 fs-6 post-title">${item.title}</h5>
                                        <p class="text-muted text-sm mb-0 post-desc">${item.desc}</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end justify-content-between" style="height: 90px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-pill px-3 py-1" style="background-color: ${badgeBg}; color: ${badgeColor}; font-size: 10px;">${item.type}</span>
                                        <span class="text-muted text-xs ms-1">${item.date}</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm text-danger fw-bold text-xs p-0 border-0 me-2 delete-btn" data-index="${index}">Delete</button>
                                        <button class="btn btn-sm btn-outline-primary text-xs px-3 py-0 rounded-3 view-btn" data-index="${index}">View</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        postsContainer.appendChild(card);
                    }
                });

                attachListeners();
            }

            function attachListeners() {
                // Delete button
                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.onclick = function() {
                        itemToDelete = { view: currentView, index: this.getAttribute('data-index') };
                        deleteModal.show();
                    };
                });

                // View button
                document.querySelectorAll('.view-btn').forEach(btn => {
                    btn.onclick = function() {
                        const item = dataStore[currentView][this.getAttribute('data-index')];
                        if (currentView === 'draft') {
                            document.getElementById('modalDraftTitle').value = item.title;
                            document.getElementById('modalDraftType').value = item.type;
                            document.getElementById('modalDraftDesc').value = item.desc;
                            document.getElementById('modalDraftDate').value = item.date;
                            draftModal.show();
                        } else {
                            document.getElementById('modalViewTitle').value = item.title;
                            document.getElementById('modalViewType').value = item.type;
                            document.getElementById('modalViewDesc').value = item.desc;
                            document.getElementById('modalViewDate').value = item.date;
                            viewModal.show();
                        }
                    };
                });
            }

            // Confirm Delete
            document.getElementById('confirmDeletePostBtn').onclick = function() {
                if (itemToDelete) {
                    dataStore[itemToDelete.view].splice(itemToDelete.index, 1);
                    itemToDelete = null;
                    renderPosts();
                }
                deleteModal.hide();
            };

            // Switch views when clicking Draft or Archive cards
            tabCards.forEach(card => {
                card.onclick = function() {
                    currentView = this.getAttribute('data-view');
                    const mainTitle = document.getElementById('pageMainTitle');
                    const subTitle = document.getElementById('pageSubTitle');

                    if (currentView === 'draft') {
                        mainTitle.textContent = "Drafts";
                        subTitle.textContent = "Overview of draft posts";
                    } else if (currentView === 'archive') {
                        mainTitle.textContent = "Archives";
                        subTitle.textContent = "Overview of archived posts";
                    } else {
                        mainTitle.textContent = "Community Information";
                        subTitle.textContent = "Creates Post for the Community";
                    }
                    renderPosts();
                };
            });

            // Search input live filter
            searchInput.addEventListener('input', renderPosts);

            // Filter category tabs
            filterButtons.forEach(btn => {
                btn.onclick = function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.getAttribute('data-filter');
                    renderPosts();
                };
            });

            // Save New Post
            document.getElementById('saveNewPostBtn').onclick = function() {
                const title = document.getElementById('newPostTitle').value.trim();
                const type = document.getElementById('newPostType').value;
                const desc = document.getElementById('newPostDesc').value.trim();

                if (!title || !desc) {
                    alert('Please fill in all fields.');
                    return;
                }

                dataStore.published.push({ title, desc, type, date: "10/09/2026" });
                renderPosts();
                createModal.hide();
                document.getElementById('createPostForm').reset();
            };

            // Initial Render
            renderPosts();
        });

//for document request

    document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                const searchBtn = document.getElementById('searchBtn');
                const filterButtons = document.querySelectorAll('#filterTabs button');
                let tableRows = document.querySelectorAll('#tableBody tr');
                const rowCountInfo = document.getElementById('rowCountInfo');

                let currentFilter = 'all';
                let rowToDelete = null;

                // Initialize Modal Instance
                const deleteModalEl = document.getElementById('deleteRowModal');
                const deleteModal = new bootstrap.Modal(deleteModalEl);
                const confirmDeleteRowBtn = document.getElementById('confirmDeleteRowBtn');

                // Function to filter rows based on search input and active status tab
                function filterTable() {
                    const query = searchInput.value.toLowerCase().trim();
                    let visibleCount = 0;
                    tableRows = document.querySelectorAll('#tableBody tr');

                    tableRows.forEach(row => {
                        const residentName = row.querySelector('.resident-name').textContent.toLowerCase();
                        const docType = row.querySelector('.doc-type').textContent.toLowerCase();
                        const rowStatus = row.getAttribute('data-status');

                        const matchesSearch = residentName.includes(query) || docType.includes(query);
                        const matchesTab = (currentFilter === 'all' || rowStatus === currentFilter);

                        if (matchesSearch && matchesTab) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    rowCountInfo.innerText = `Showing ${visibleCount} of ${tableRows.length} Requests`;
                }

                // Search bar event listeners
                searchInput.addEventListener('input', filterTable);
                searchBtn.addEventListener('click', filterTable);

                // Filter tab buttons event listeners
                filterButtons.forEach(btn => {
                    btn.addEventListener('click', function () {
                        filterButtons.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        currentFilter = this.getAttribute('data-filter');
                        filterTable();
                    });
                });

                // Bind change handlers to dropdowns
                function bindActionSelects() {
                    const actionSelects = document.querySelectorAll('.action-select');
                    actionSelects.forEach(select => {
                        select.onchange = function () {
                            const selectedValue = this.value;
                            const row = this.closest('tr');
                            const statusCell = row.querySelector('.status-cell');

                            if (selectedValue === 'delete') {
                                rowToDelete = row;
                                deleteModal.show();
                            } else if (selectedValue) {
                                row.setAttribute('data-status', selectedValue);

                                let badgeHtml = '';
                                if (selectedValue === 'Approved') {
                                    badgeHtml = '<span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #d1fae5; color: #065f46; border: 1px solid #10b981;">Approved</span>';
                                } else if (selectedValue === 'In Progress') {
                                    badgeHtml = '<span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #fef3c7; color: #92400e; border: 1px solid #f59e0b;">In Progress</span>';
                                } else if (selectedValue === 'Received') {
                                    badgeHtml = '<span class="badge rounded-pill px-3 py-1 fw-medium status-badge" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #38bdf8;">Received</span>';
                                }
                                statusCell.innerHTML = badgeHtml;
                            }

                            this.selectedIndex = 0;
                        };
                    });
                }
                // Inside your DOMContentLoaded block:
                const cancelDeleteBtn = document.querySelector('#deleteRowModal .btn-modal-cancel, #deleteRowModal [data-bs-dismiss="modal"]');

                if (cancelDeleteBtn) {
                    cancelDeleteBtn.addEventListener('click', function () {
                        rowToDelete = null; // Clear the stored row on cancel
                        deleteModal.hide();
                    });
                }
                // Confirm Row Deletion in Modal
                confirmDeleteRowBtn.addEventListener('click', function () {
                    if (rowToDelete) {
                        rowToDelete.remove();
                        rowToDelete = null;
                        filterTable();
                    }
                    deleteModal.hide();
                });

                bindActionSelects();
            });

// for User Management
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        let tableRows = document.querySelectorAll('#userTableBody tr');
        const rowCountInfo = document.getElementById('rowCountInfo');

        let rowToDelete = null;
        let rowToEdit = null; // Track specific row being edited

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteRowModal'));
        const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
        const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const saveNewUserBtn = document.getElementById('saveNewUserBtn');     
        const updateUserBtn = document.getElementById('updateUserBtn');     

        // Live Search functionality
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;
            tableRows = document.querySelectorAll('#userTableBody tr');

            tableRows.forEach(row => {
                const userId = row.querySelector('.user-id').textContent.toLowerCase();
                const email = row.querySelector('.user-email').textContent.toLowerCase();

                if (userId.includes(query) || email.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            rowCountInfo.innerText = `Showing ${visibleCount} of ${tableRows.length} Users`;
        });

        // Attach Event Handlers for Edit & Delete buttons inside table rows
        function attachRowListeners() {
            // Delete Button Click
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.onclick = function () {
                    rowToDelete = this.closest('tr');
                    deleteModal.show();
                };
            });

            // Edit Button Click
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.onclick = function () {
                    rowToEdit = this.closest('tr');
                    const id = rowToEdit.querySelector('.user-id').textContent;
                    const email = rowToEdit.querySelector('.user-email').textContent;
                    const role = rowToEdit.querySelector('.user-role').textContent.trim();

                    // Populate Separate Edit Modal
                    document.getElementById('editUserId').value = id;
                    document.getElementById('editUserEmail').value = email;
                    document.getElementById('editUserRole').value = role;

                    editUserModal.show();
                };
            });
        }

        // Confirm Delete action from popup modal
        confirmDeleteBtn.onclick = function () {
            if (rowToDelete) {
                rowToDelete.remove();
                rowToDelete = null;
                tableRows = document.querySelectorAll('#userTableBody tr');
                rowCountInfo.innerText = `Showing ${tableRows.length} of ${tableRows.length} Users`;
            }
            deleteModal.hide();
        };

        // Save New User (Add Modal Action with Password)
        if (saveNewUserBtn) {
            saveNewUserBtn.onclick = function () {
                const id = document.getElementById('addUserId').value;
                const email = document.getElementById('addUserEmail').value;
                const password = document.getElementById('addUserPassword').value; // Added password variable
                const role = document.getElementById('addUserRole').value;

                if (!email || !password) {
                    alert('Please fill out both the email and password fields.');
                    return;
                }

                // Note: If you are sending this to a backend Laravel controller, 
                // make sure to securely handle the password transmission/hashing there.

                const roleBadgeStyle = role === 'Admin' 
                    ? 'background-color: #bae6fd; color: #0284c7;' 
                    : 'background-color: #bbf7d0; color: #16a34a;';

                const tbody = document.getElementById('userTableBody');
                const newRow = document.createElement('tr');
                const currentDate = new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

                newRow.innerHTML = `
                    <td class="fw-semibold px-4 user-id">${id}</td>
                    <td class="fw-medium user-email">${email}</td>
                    <td class="user-role">
                        <span class="badge rounded-pill px-3 py-1 fw-medium" style="${roleBadgeStyle}">${role}</span>
                    </td>
                    <td class="fw-semibold user-date">${currentDate}</td>
                    <td class="text-end px-4">
                        <button class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded me-1 edit-btn">Edit</button>
                        <button class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded delete-btn">Delete</button>
                    </td>
                `;
                tbody.appendChild(newRow);

                tableRows = document.querySelectorAll('#userTableBody tr');
                rowCountInfo.innerText = `Showing ${tableRows.length} of ${tableRows.length} Users`;
                attachRowListeners();
                addUserModal.hide();

                // Reset Add Form and increment next ID placeholder
                document.getElementById('addUserForm').reset();
                document.getElementById('addUserId').value = `USR_00${tableRows.length + 1}`;
            };
        }

        // Update Existing User (Edit Modal Action)
        if (updateUserBtn) {
            updateUserBtn.onclick = function () {
                const email = document.getElementById('editUserEmail').value;
                const role = document.getElementById('editUserRole').value;

                if (!email) {
                    alert('Please enter a valid email address.');
                    return;
                }

                const roleBadgeStyle = role === 'Admin' 
                    ? 'background-color: #bae6fd; color: #0284c7;' 
                    : 'background-color: #bbf7d0; color: #16a34a;';

                if (rowToEdit) {
                    rowToEdit.querySelector('.user-email').textContent = email;
                    rowToEdit.querySelector('.user-role').innerHTML = `<span class="badge rounded-pill px-3 py-1 fw-medium" style="${roleBadgeStyle}">${role}</span>`;
                    rowToEdit = null;
                }

                editUserModal.hide();
                document.getElementById('editUserForm').reset();
            };
        }

        // Initial listener attachment
        attachRowListeners();
    });

//Incident Report
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const zoneSelect = document.getElementById('zoneSelect');
    const filterButtons = document.querySelectorAll('#filterTabs button');
    const reportsContainer = document.getElementById('reportsContainer');
    const reportCountBadge = document.getElementById('reportCountBadge');

    let currentFilter = 'all';
    let reportToDelete = null;

    const deleteModal = new bootstrap.Modal(document.getElementById('deleteReportModal'));
    const viewModal = new bootstrap.Modal(document.getElementById('viewReportModal'));

    function filterReports() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedZone = zoneSelect.value.trim().toLowerCase();
        const reportItems = reportsContainer.querySelectorAll('.report-item');
        let visibleCount = 0;

        reportItems.forEach(item => {
            // Get all text content inside the card for broad search
            const cardText = item.textContent.toLowerCase();
            const itemZone = (item.getAttribute('data-zone') || '').trim().toLowerCase();
            const itemStatus = (item.getAttribute('data-status') || '').trim().toLowerCase();

            // Match conditions
            const matchesSearch = query === '' || cardText.includes(query);
            const matchesZone = itemZone === selectedZone || selectedZone === 'all';
            const matchesTab = (currentFilter === 'all' || itemStatus === currentFilter.toLowerCase());

            if (matchesSearch && matchesZone && matchesTab) {
                item.style.setProperty('display', 'flex', 'important');
                visibleCount++;
            } else {
                item.style.setProperty('display', 'none', 'important');
            }
        });

        if (reportCountBadge) {
            reportCountBadge.textContent = visibleCount;
        }
    }

    // Live Event Listeners
    if (searchInput) {
        searchInput.addEventListener('keyup', filterReports);
        searchInput.addEventListener('input', filterReports);
    }

    if (zoneSelect) {
        zoneSelect.addEventListener('change', filterReports);
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.getAttribute('data-filter');
            filterReports();
        });
    });

    function attachListeners() {
        // Delete button listener
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.onclick = function () {
                reportToDelete = this.closest('.report-item');
                deleteModal.show();
            };
        });

        // View button listener
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.onclick = function () {
                document.getElementById('modalReportId').value = this.getAttribute('data-id') || '';
                document.getElementById('modalReportArea').value = this.getAttribute('data-area') || '';
                document.getElementById('modalReportIssue').value = this.getAttribute('data-issue') || '';
                document.getElementById('modalReportDesc').value = this.getAttribute('data-desc') || '';
                document.getElementById('modalReportDate').value = this.getAttribute('data-date') || '';
                document.getElementById('modalReportReporter').value = this.getAttribute('data-reporter') || '';
                viewModal.show();
            };
        });
    }

    // Confirm Delete Action
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    if (confirmBtn) {
        confirmBtn.onclick = function () {
            if (reportToDelete) {
                reportToDelete.remove();
                reportToDelete = null;
                filterReports();
            }
            deleteModal.hide();
        };
    }

    attachListeners();
    filterReports();
});