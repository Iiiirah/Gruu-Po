
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resident Dashboard | Brgy. Sibul Springs</title>

    <link rel="stylesheet" href="{{ asset('css/resident-dashboard.css') }}">
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

        <!-- Welcome -->
        <section class="welcome-section">
            <h2>Resident Dashboard</h2>
            <p>Stay updated with your community.</p>
        </section>

        <!-- Recent Announcement -->
        <section class="dashboard-section">
            <h3 class="section-title">Recent Announcement</h3>

            <a href="{{ url('/resident-community-information') }}"
               class="dashboard-link">

                <article class="announcement-card">

                    <!-- Announcement Photo on the Left -->
                    <div class="announcement-photo">
                        <img
                            src="{{ asset('images/zone1-renovation.jpg') }}"
                            alt="Zone 1 infrastructure renovation"
                            onerror="this.style.display='none';"
                        >
                    </div>

                    <!-- Announcement Details -->
                    <div class="announcement-content">
                        <h4>Renovation in Zone 1</h4>

                        <p>
                            Some of Zone 1 infrastructure will be
                            temporarily closed due to the renovation.
                        </p>

                        <span class="view-link">
                            View announcement →
                        </span>
                    </div>

                    <!-- Announcement Category and Date -->
                    <div class="announcement-meta">
                        <span class="announcement-label">
                            ANNOUNCEMENT
                        </span>

                        <span class="announcement-date">
                            Oct 9, 2026
                        </span>
                    </div>

                </article>

            </a>
        </section>

        <!-- Recent Requests -->
        <section class="dashboard-section">
            <h3 class="section-title">Recent Requests</h3>

            <article class="activity-card request-card">
                <span class="request-dot approved-dot"></span>

                <div class="request-title">
                    <h4>Certificate of Indigency</h4>
                    <p>Approved</p>
                </div>

                <div class="request-owner">
                    <h4>Mark Anthony Santos</h4>
                    <p>Oct 7, 2026</p>
                </div>
            </article>

            <article class="activity-card request-card">
                <span class="request-dot progress-dot"></span>

                <div class="request-title">
                    <h4>Certificate of Residency</h4>
                    <p>In Progress</p>
                </div>

                <div class="request-owner">
                    <h4>Maria Kristina Dela Cruz</h4>
                    <p>Oct 8, 2026</p>
                </div>
            </article>
        </section>

        <!-- Recent Reports -->
        <section class="dashboard-section">
            <h3 class="section-title">Recent Reports</h3>

            <article class="activity-card report-card">
                <div class="activity-details">
                    <h4>
                        <span class="report-id">IDT-001</span>
                        Fire
                    </h4>

                    <p>Oct 10, 2026</p>
                </div>

                <span class="status verified">Verified</span>
            </article>

            <article class="activity-card report-card">
                <div class="activity-details">
                    <h4>
                        <span class="report-id">IDT-002</span>
                        Flood
                    </h4>

                    <p>Oct 9, 2026</p>
                </div>

                <span class="status resolved">Resolved</span>
            </article>
        </section>

    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">

        <!-- Dashboard -->
        <a href="{{ url('/resident-dashboard') }}"
           class="nav-item active"
           aria-current="page">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 10.5 12 3l9 7.5"></path>
                <path d="M5.5 9.5V21h13V9.5"></path>
                <path d="M9 21v-7h6v7"></path>
            </svg>

            <span>Dashboard</span>
        </a>

        <!-- Community Information -->
        <a href="{{ url('/resident-community-information') }}"
           class="nav-item">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 3h14v18H5z"></path>
                <path d="M8 8h8M8 12h8M8 16h5"></path>
            </svg>

            <span>Community</span>
        </a>

        <!-- Document Request -->
        <a href="{{ url('/resident-document-request') }}"
           class="nav-item">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6 3h9l4 4v14H6z"></path>
                <path d="M15 3v5h4M9 12h7M9 16h7"></path>
            </svg>

            <span>Requests</span>
        </a>

        <!-- Incident Reports -->
        <a href="{{ url('/resident-reports') }}"
           class="nav-item">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3 22 21H2z"></path>
                <path d="M12 9v5M12 17h.01"></path>
            </svg>

            <span>Reports</span>
        </a>

        <!-- About -->
        <a href="{{ url('/about') }}"
           class="nav-item">

            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21a8 8 0 0 1 16 0"></path>
            </svg>

            <span>About</span>
        </a>

    </nav>

</div>

</body>
</html>
