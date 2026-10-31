<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Information | Brgy. Sibul Springs</title>
    <!-- Bootstrap CSS para sa Lightbox Modal compatibility -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/resident-community-information.css') }}">
    
    <style>
        /* Pwersahang ginagamit ang eksaktong font style ng app.css / Document Request sa buong Community page */
        body, 
        .community-container, 
        .community-content, 
        .community-header h1, 
        .community-header p, 
        .welcome-section h2, 
        .welcome-section p, 
        .information-section, 
        .card-title, 
        .card-desc, 
        .category-badge, 
        .information-date, 
        input, 
        button, 
        span, 
        h3, 
        h4, 
        p, 
        article, 
        label {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, , Arial, sans-serif !important;
        }
    </style>
</head>
<body>
<div class="community-container">
    <!-- Header -->
    <header class="community-header">
        <img
            src="{{ asset('images/LogoSibul.png') }}"
            alt="Barangay Logo"
            class="barangay-logo"
        >
        <h1>BRGY. SIBUL SPRINGS</h1>
        <p>San Miguel, Bulacan</p>
    </header>
    <main class="community-content">
        <!-- Page Heading -->
        <section class="welcome-section">
            <h2>Community Information</h2>
            <p>Stay updated with your community.</p>
        </section>
        <!-- Search and Filters -->
        <section class="information-section">
            <div class="filter-toolbar">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m16 16 4 4"></path>
                    </svg>
                    <input
                        type="search"
                        id="informationSearch"
                        placeholder="Search announcements and events"
                        aria-label="Search community information"
                        onkeyup="applyResidentFilters()"
                    >
                </div>
                <div class="filter-buttons">
                    <button
                        type="button"
                        class="filter-button active"
                        data-filter="all"
                        onclick="setResidentCategory('all', this)"
                    >
                        All
                    </button>
                    <button
                        type="button"
                        class="filter-button"
                        data-filter="announcement"
                        onclick="setResidentCategory('announcement', this)"
                    >
                        Announcement
                    </button>
                    <button
                        type="button"
                        class="filter-button"
                        data-filter="events"
                        onclick="setResidentCategory('events', this)"
                    >
                        Events
                    </button>
                </div>
            </div>
            <!-- Community Information Cards (Dynamic galing kay Admin) -->
            <div class="information-list" id="informationList">
                @forelse($posts as $post)
                    <article class="information-card" data-category="{{ strtolower(trim($post->type ?? '')) }}">
                        <!-- Photo Preview on the Left (Magbubukas sa bagong tab kapag pinindot kung meron) -->
                        <div class="information-photo">
                            @if(!empty($post->image))
                                <a href="{{ asset('storage/' . $post->image) }}" target="_blank" title="Click to view full image in new tab" style="display: block; width: 100%; height: 100%;">
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $post->title }}"
                                        style="cursor: pointer; object-fit: cover; width: 100%; height: 100%;"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.setProperty('display', 'flex', 'important');"
                                    >
                                </a>
                            @endif
                            <span class="photo-placeholder" style="{{ !empty($post->image) ? 'display:none !important;' : 'display:flex !important;' }}">
                                Post Preview
                            </span>
                        </div>
                        <!-- Details -->
                        <div class="information-details">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-desc">{{ $post->content }}</p>
                        </div>
                        <!-- Category and Date -->
                        <div class="information-meta">
                            <span class="category-badge {{ strtolower(trim($post->type)) == 'announcement' ? 'announcement-badge' : 'event-badge' }}">
                                {{ strtoupper($post->type) }}
                            </span>
                            <span class="information-date">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </article>
                @empty
                    <!-- Kapag talagang zero post sa database si Admin -->
                    <div class="empty-message" id="defaultEmptyMessage" style="display: block !important;">
                        No community information available at the moment.
                    </div>
                @endforelse
                <!-- No Search or Category Result Message -->
                <div class="empty-message" id="emptyMessage" style="display: none !important;">
                    No community information found matching your search.
                </div>
            </div>
        </section>
    </main>
    
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
        <a
            href="{{ url('/resident-community-information') }}"
            class="nav-item active"
            aria-current="page"
        >
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
<!-- Bootstrap JS para sa Modal Lightbox Functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- HARDCORE FORCE JAVASCRIPT FILTERING -->
<script>
    let activeResidentFilter = 'all';
    function setResidentCategory(category, button) {
        document.querySelectorAll('.filter-buttons .filter-button').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        activeResidentFilter = category.toLowerCase().trim();
        applyResidentFilters();
    }
    function applyResidentFilters() {
        const searchInput = document.getElementById('informationSearch');
        const searchText = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const cards = document.querySelectorAll('#informationList .information-card');
        let visibleCount = 0;
        cards.forEach(function(card) {
            const category = (card.getAttribute('data-category') || '').toLowerCase().trim();
            const title = (card.querySelector('.card-title')?.textContent || '').toLowerCase().trim();
            const desc = (card.querySelector('.card-desc')?.textContent || '').toLowerCase().trim();
            let matchesCategory = false;
            if (activeResidentFilter === 'all') {
                matchesCategory = true;
            } else if (category.includes(activeResidentFilter) || (activeResidentFilter === 'events' && category.includes('event'))) {
                matchesCategory = true;
            }
            let matchesSearch = false;
            if (searchText === '') {
                matchesSearch = true;
            } else if (title.includes(searchText) || desc.includes(searchText)) {
                matchesSearch = true;
            }
            if (matchesCategory && matchesSearch) {
                card.style.setProperty('display', 'flex', 'important');
                visibleCount++;
            } else {
                card.style.setProperty('display', 'none', 'important');
            }
        });
        const emptyMessage = document.getElementById('emptyMessage');
        const defaultEmptyMessage = document.getElementById('defaultEmptyMessage');
        if (cards.length > 0) {
            if (defaultEmptyMessage) {
                defaultEmptyMessage.style.setProperty('display', 'none', 'important');
            }
            if (emptyMessage) {
                if (visibleCount === 0) {
                    emptyMessage.style.setProperty('display', 'block', 'important');
                } else {
                    emptyMessage.style.setProperty('display', 'none', 'important');
                }
            }
        }
    }
</script>
</body>
</html>