<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Information - Brgy. Sibul Springs</title>
    
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
                        <a href="{{ route('community.information') }}" class="sidebar-link active">Community Information</a>
                        <a href="{{ route('documentsrequest') }}" class="sidebar-link">Online Document Request</a>
                        <a href="{{ route('incident.reports') }}" class="sidebar-link">Incident Report Information</a>
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
                
                <!-- Page Header with Action Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="fw-bold text-dark fs-2 mb-1">Community Information</h1>
                        <p class="text-muted text-sm mb-0">Creates Post for the Community</p>
                    </div>
                    <button class="btn text-white fw-semibold px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background-color: #00d2ff; border: none;" data-bs-toggle="modal" data-bs-target="#createPostModal">
                        <span class="fs-5">+</span> Create New Post
                    </button>
                </div>

                <!-- 2x2 Stats Cards Grid -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card border rounded-4 p-4 shadow-sm bg-white">
                            <span class="fs-5 fw-medium text-dark">Total Post</span>
                            <h2 class="fw-bold display-6 mt-1 mb-0 text-dark" style="text-decoration: underline;">{{ $posts->count() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border rounded-4 p-4 shadow-sm bg-white">
                            <span class="fs-5 fw-medium text-dark">Published</span>
                            <h2 class="fw-bold display-6 mt-1 mb-0 text-dark" style="text-decoration: underline;">{{ $posts->where('status', 'Published')->count() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border rounded-4 p-4 shadow-sm bg-white">
                            <span class="fs-5 fw-medium text-dark">Draft</span>
                            <h2 class="fw-bold display-6 mt-1 mb-0 text-dark" style="text-decoration: underline;">{{ $posts->where('status', 'Draft')->count() }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border rounded-4 p-4 shadow-sm bg-white">
                            <span class="fs-5 fw-medium text-dark">Archive</span>
                            <h2 class="fw-bold display-6 mt-1 mb-0 text-dark" style="text-decoration: underline;">{{ $posts->where('status', 'Archive')->count() }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Posts List Container -->
                <div class="p-4 rounded-4 border bg-white shadow-sm">
                    
                    <!-- Search & Filter Controls -->
                    <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
                        <div class="input-group" style="max-width: 320px;">
                            <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
                            <input type="text" id="searchInput" class="form-control bg-light border-start-0 text-sm" placeholder="Search Post..." onkeyup="applyFilters()">
                        </div>
                        <div class="btn-group filter-buttons" role="group">
                            <button type="button" class="btn btn-outline-secondary text-sm px-3 active" onclick="setCategory('all', this)">All</button>
                            <button type="button" class="btn btn-outline-secondary text-sm px-3" onclick="setCategory('Announcement', this)">Announcement</button>
                            <button type="button" class="btn btn-outline-secondary text-sm px-3" onclick="setCategory('Events', this)">Events</button>
                        </div>
                    </div>

                    <!-- Dynamic Posts Container -->
                    <div class="d-flex flex-column gap-3" id="postsContainer">
                        @forelse($posts as $post)
                            <div class="post-item border rounded-3 p-3 bg-white shadow-sm d-flex align-items-center justify-content-between" data-type="{{ trim($post->type ?? '') }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted text-xs overflow-hidden" style="width: 80px; height: 60px;">
                                        @if(!empty($post->image))
                                            <!-- Naka-set sa pagbubukas sa bagong tab kapag pinindot ang larawan -->
                                            <a href="{{ asset('storage/' . $post->image) }}" target="_blank" title="Click to view full image in new tab">
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-100 h-100 object-fit-cover">
                                            </a>
                                        @else
                                            Post Preview
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1 post-title">{{ $post->title }}</h6>
                                        <p class="text-muted text-sm mb-0 post-desc">{{ $post->content }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    @if(!empty($post->type))
                                        <span class="badge rounded-pill px-3 py-1 fw-medium post-type-badge {{ strtolower(trim($post->type)) == 'announcement' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning' }}" style="font-size: 11px;">
                                            {{ $post->type }}
                                        </span>
                                    @endif
                                    <span class="text-muted text-xs fw-semibold">{{ $post->created_at->format('M d, Y') }}</span>
                                    <div class="d-flex gap-1">
                                        <!-- Delete Form -->
                                        <form action="{{ route('community.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sigurado ka bang gusto mong burahin ang post na ito?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger text-xs px-2 py-0 rounded">Delete</button>
                                        </form>
                                        <!-- View / Edit Button -->
                                        <button type="button" class="btn btn-sm btn-outline-primary text-xs px-2 py-0 rounded" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewPostModal"
                                            data-id="{{ $post->id }}"
                                            data-title="{{ $post->title }}"
                                            data-type="{{ trim($post->type ?? '') }}"
                                            data-content="{{ $post->content }}"
                                            data-image="{{ $post->image ? asset('storage/' . $post->image) : '' }}"
                                            data-date="{{ $post->created_at->format('M d, Y') }}">
                                            View / Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5" id="noPostsMessage">
                                <p class="mb-1 fw-semibold fs-5">No posts found.</p>
                                <small>Click the "+ Create New Post" button above to add entries.</small>
                            </div>
                        @endforelse

                        <!-- No search or category result dynamic message -->
                        <div id="noSearchResult" class="text-center text-muted py-5" style="display: none !important;">
                            <p class="mb-1 fw-semibold fs-5">No posts found.</p>
                            <small>Wala pong nahanap na post na tumutugma sa iyong hinahanap o kategorya.</small>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">Create Post</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0 py-4">
                    <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Title</label>
                                <input type="text" name="title" class="form-control bg-light text-dark fw-semibold" placeholder="write here..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Type of Post</label>
                                <select name="type" class="form-select bg-light text-dark fw-semibold" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Events">Events</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Description</label>
                            <textarea name="content" class="form-control bg-light text-dark fw-semibold" rows="3" placeholder="Write here..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Attach Image / Photo</label>
                            <input type="file" name="image" id="createImageInput" class="form-control bg-light text-dark fw-semibold mb-2" accept="image/*" onchange="previewCreateImage(event)">
                            <div id="createImagePreviewContainer" class="mt-2" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded border">
                                    <a id="createImagePreviewLink" href="" target="_blank">
                                        <img id="createImagePreview" src="" alt="Preview" class="img-thumbnail" style="max-height: 70px;" title="Click to view in new tab">
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger text-xs fw-semibold px-2 py-1 rounded" onclick="clearCreateImage()">
                                        Remove Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Date/Time Posted</label>
                                <input type="text" name="date_posted" class="form-control bg-light text-dark fw-semibold" value="{{ \Carbon\Carbon::now()->format('M d, Y') }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Assign Who Posted</label>
                                <select name="author" class="form-select bg-light text-dark fw-semibold">
                                    <option>Irah Resus</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 px-0 pt-3 justify-content-end">
                            <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-3 shadow-sm" style="background-color: #00c800;">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View / Edit Post Modal -->
    <div class="modal fade" id="viewPostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="modal-header border-bottom pb-3 px-0 align-items-center">
                    <h4 class="modal-title fw-bold text-dark mb-0">View / Edit Post</h4>
                    <button type="button" class="btn-close shadow-none fs-5 bg-danger bg-opacity-10 text-danger rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPostForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body px-0 py-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Title</label>
                                <input type="text" id="modalTitle" name="title" class="form-control bg-light text-dark fw-semibold" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Type of Post</label>
                                <select id="modalType" name="type" class="form-select bg-light text-dark fw-semibold" required>
                                    <option value="" disabled>Select a category</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Events">Events</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Description</label>
                            <textarea id="modalContent" name="content" class="form-control bg-light text-dark fw-semibold" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-xs fw-bold text-muted">Update Image / Photo</label>
                            <input type="file" name="image" id="editImageInput" class="form-control bg-light text-dark fw-semibold mb-2" accept="image/*" onchange="previewEditImage(event)">
                            <input type="hidden" name="remove_image" id="removeImageFlag" value="0">
                            <div id="imagePreviewContainer" class="mt-2" style="display: none;">
                                <div class="d-flex align-items-center justify-content-between bg-light p-2 rounded border">
                                    <a id="modalImagePreviewLink" href="" target="_blank">
                                        <img id="modalImagePreview" src="" alt="Current Image" class="img-thumbnail" style="max-height: 70px;" title="Click to view in new tab">
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger text-xs fw-semibold px-2 py-1 rounded" onclick="removeExistingImage()">
                                        Remove Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Date Posted</label>
                                <input type="text" id="modalDate" class="form-control bg-light text-dark fw-semibold" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-xs fw-bold text-muted">Posted By</label>
                                <input type="text" class="form-control bg-light text-dark fw-semibold" readonly value="Irah Resus">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-0 pt-2 justify-content-end gap-2">
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
                    <button type="button" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold text-dark shadow-sm btn-modal-cancel" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-semibold shadow-sm text-white btn-modal-confirm">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- HARDCORE FORCE JAVASCRIPT FILTERING -->
    <script>
        let currentCategory = 'all';
        function setCategory(category, button) {
            document.querySelectorAll('.filter-buttons .btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            currentCategory = category.toLowerCase().trim();
            applyFilters();
        }
        function applyFilters() {
            let searchInput = document.getElementById('searchInput').value.toLowerCase().trim();
            let posts = document.querySelectorAll('#postsContainer .post-item');
            let visibleCount = 0;
            posts.forEach(post => {
                let dataType = (post.getAttribute('data-type') || '').toLowerCase().trim();
                let badgeText = '';
                let badgeElem = post.querySelector('.post-type-badge');
                if (badgeElem) {
                    badgeText = badgeElem.textContent.toLowerCase().trim();
                }
                let postType = dataType || badgeText;
                let title = (post.querySelector('.post-title')?.textContent || '').toLowerCase().trim();
                let desc = (post.querySelector('.post-desc')?.textContent || '').toLowerCase().trim();
                
                let matchesCategory = false;
                if (currentCategory === 'all') {
                    matchesCategory = true;
                } else if (postType.includes(currentCategory)) {
                    matchesCategory = true;
                }
                
                let matchesSearch = false;
                if (searchInput === '') {
                    matchesSearch = true;
                } else if (title.includes(searchInput) || desc.includes(searchInput)) {
                    matchesSearch = true;
                }
                
                if (matchesCategory && matchesSearch) {
                    post.style.setProperty('display', 'flex', 'important');
                    visibleCount++;
                } else {
                    post.style.setProperty('display', 'none', 'important');
                }
            });
            
            let noResultMsg = document.getElementById('noSearchResult');
            if (noResultMsg) {
                if (visibleCount === 0) {
                    noResultMsg.style.setProperty('display', 'block', 'important');
                } else {
                    noResultMsg.style.setProperty('display', 'none', 'important');
                }
            }
        }

        // Create Post Image Preview & Clear
        function previewCreateImage(event) {
            const file = event.target.files[0];
            const container = document.getElementById('createImagePreviewContainer');
            const previewImg = document.getElementById('createImagePreview');
            const previewLink = document.getElementById('createImagePreviewLink');
            if (file) {
                const fileURL = URL.createObjectURL(file);
                previewImg.src = fileURL;
                previewLink.href = fileURL;
                container.style.display = 'block';
            }
        }
        function clearCreateImage() {
            document.getElementById('createImageInput').value = '';
            document.getElementById('createImagePreviewContainer').style.display = 'none';
        }

        // Edit Post Image Removal & Preview
        function removeExistingImage() {
            document.getElementById('editImageInput').value = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('removeImageFlag').value = '1';
        }
        function previewEditImage(event) {
            const file = event.target.files[0];
            const container = document.getElementById('imagePreviewContainer');
            const previewImg = document.getElementById('modalImagePreview');
            const previewLink = document.getElementById('modalImagePreviewLink');
            if (file) {
                const fileURL = URL.createObjectURL(file);
                previewImg.src = fileURL;
                previewLink.href = fileURL;
                container.style.display = 'block';
                document.getElementById('removeImageFlag').value = '0';
            }
        }

        const viewPostModal = document.getElementById('viewPostModal');
        if (viewPostModal) {
            viewPostModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const title = button.getAttribute('data-title');
                const type = button.getAttribute('data-type');
                const content = button.getAttribute('data-content');
                const imageUrl = button.getAttribute('data-image');
                const date = button.getAttribute('data-date');
                
                document.getElementById('modalTitle').value = title;
                document.getElementById('modalType').value = type;
                document.getElementById('modalContent').value = content;
                document.getElementById('modalDate').value = date;
                
                document.getElementById('editImageInput').value = '';
                document.getElementById('removeImageFlag').value = '0';
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                const modalImagePreview = document.getElementById('modalImagePreview');
                const modalImagePreviewLink = document.getElementById('modalImagePreviewLink');
                
                if (imageUrl) {
                    modalImagePreview.src = imageUrl;
                    modalImagePreviewLink.href = imageUrl;
                    imagePreviewContainer.style.display = 'block';
                } else {
                    imagePreviewContainer.style.display = 'none';
                }
                const form = document.getElementById('editPostForm');
                form.action = `/community-information/${id}`;
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>