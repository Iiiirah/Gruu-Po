
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Community Information | Brgy. Sibul Springs</title>

    <link rel="stylesheet" href="{{ asset('css/resident-community-information.css') }}">
</head>
<body>

<div class="community-container">

    <!-- Header -->
    <header class="community-header">
        <img
            src="{{ asset('images/barangay-logo.png') }}"
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
                    >
                </div>

                <div class="filter-buttons">
                    <button
                        type="button"
                        class="filter-button active"
                        data-filter="all"
                    >
                        All
                    </button>

                    <button
                        type="button"
                        class="filter-button"
                        data-filter="announcement"
                    >
                        Announcement
                    </button>

                    <button
                        type="button"
                        class="filter-button"
                        data-filter="event"
                    >
                        Events
                    </button>
                </div>

            </div>

            <!-- Community Information Cards -->
            <div class="information-list" id="informationList">

                <!-- Announcement Card -->
                <article class="information-card" data-category="announcement">

                    <!-- Photo Preview on the Left -->
                    <div class="information-photo">
                        <img
                            src="{{ asset('images/zone1-renovation.jpg') }}"
                            alt="Zone 1 infrastructure renovation"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >

                        <span class="photo-placeholder">
                            Post Preview
                        </span>
                    </div>

                    <!-- Announcement Details -->
                    <div class="information-details">
                        <h3>Renovation in Zone 1</h3>

                        <p>
                            Some of Zone 1 infrastructure will be temporarily
                            closed due to the renovation.
                        </p>
                    </div>

                    <!-- Category and Date -->
                    <div class="information-meta">
                        <span class="category-badge announcement-badge">
                            ANNOUNCEMENT
                        </span>

                        <span class="information-date">
                            Oct 9, 2026
                        </span>
                    </div>

                </article>

                <!-- Event Card -->
                <article class="information-card" data-category="event">

                    <!-- Photo Preview on the Left -->
                    <div class="information-photo">
                        <img
                            src="{{ asset('images/ber-month-promo.jpg') }}"
                            alt="Ber Month Promo"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >

                        <span class="photo-placeholder">
                            Post Preview
                        </span>
                    </div>

                    <!-- Event Details -->
                    <div class="information-details">
                        <h3>Ber Month Promo</h3>

                        <p>30% discount items on market.</p>
                    </div>

                    <!-- Category and Date -->
                    <div class="information-meta">
                        <span class="category-badge event-badge">
                            EVENT
                        </span>

                        <span class="information-date">
                            Oct 9, 2026
                        </span>
                    </div>

                </article>

                <!-- No Results -->
                <div class="empty-message" id="emptyMessage" hidden>
                    No community information found.
                </div>

            </div>

        </section>

    </main>

    <!-- Bottom Navigation: Same Layout and Icons as Dashboard -->
    <nav class="bottom-nav">

        <!-- Dashboard -->
        <a href="{{ url('/resident-dashboard') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 10.5 12 3l9 7.5"></path>
                <path d="M5.5 9.5V21h13V9.5"></path>
                <path d="M9 21v-7h6v7"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Community: Active Page -->
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

        <!-- Requests -->
        <a href="{{ url('/resident-document-request') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 3h9l4 4v14H6z"></path>
                <path d="M15 3v5h4M9 12h7M9 16h7"></path>
            </svg>
            <span>Requests</span>
        </a>

        <!-- Reports -->
        <a href="{{ url('/resident-reports') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3 22 21H2z"></path>
                <path d="M12 9v5M12 17h.01"></path>
            </svg>
            <span>Reports</span>
        </a>

        <!-- About -->
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
    const searchInput = document.getElementById('informationSearch');
    const filterButtons = document.querySelectorAll('.filter-button');
    const informationCards = document.querySelectorAll('.information-card');
    const emptyMessage = document.getElementById('emptyMessage');

    let activeFilter = 'all';

    function filterInformation() {
        const searchText = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        informationCards.forEach(function(card) {
            const category = card.dataset.category;
            const cardText = card.textContent.toLowerCase();

            const matchesCategory =
                activeFilter === 'all' || category === activeFilter;

            const matchesSearch = cardText.includes(searchText);

            if (matchesCategory && matchesSearch) {
                card.hidden = false;
                visibleCount++;
            } else {
                card.hidden = true;
            }
        });

        emptyMessage.hidden = visibleCount > 0;
    }

    searchInput.addEventListener('input', filterInformation);

    filterButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            activeFilter = button.dataset.filter;

            filterButtons.forEach(function(item) {
                item.classList.remove('active');
            });

            button.classList.add('active');

            filterInformation();
        });
    });
</script>

</body>
</html>

