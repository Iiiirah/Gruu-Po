
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About | Brgy. Sibul Springs</title>

    <link rel="stylesheet" href="{{ asset('css/resident-about.css') }}">
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
            <h2>About Us</h2>
            <p>Learn more about our barangay, its mission, and its officials.</p>
        </section>

        <!-- OFFICIAL PROFILE -->
        <section class="about-card profile-card">
            <div class="section-heading">
                <div>
                    <h3>Official Profile</h3>
                    <p>Our community at a glance</p>
                </div>
            </div>

            <div class="profile-content">
                <h4>Barangay Sibul Springs</h4>

                <p>
                    A community in San Miguel, Bulacan, dedicated to serving
                    its residents and promoting a safe, organized, and
                    supportive neighborhood.
                </p>

                <div class="profile-detail">
                    <span class="detail-label">Location</span>
                    <span class="detail-value">San Miguel, Bulacan</span>
                </div>
            </div>
        </section>

        <!-- VISION -->
        <section class="about-card">
            <div class="section-heading">
                <div>
                    <h3>Our Vision</h3>
                    <p>What we aspire to become</p>
                </div>
            </div>

            <p class="section-description">
                To build a peaceful, progressive, and united community where
                residents enjoy a safe environment, accessible public
                services, and opportunities for a better quality of life.
            </p>
        </section>

        <!-- MISSION -->
        <section class="about-card">
            <div class="section-heading">
                <div>
                    <h3>Our Mission</h3>
                    <p>How we serve our residents</p>
                </div>
            </div>

            <p class="section-description">
                To provide responsive and reliable public service, promote
                community participation, maintain peace and order, and ensure
                that residents receive timely and accessible barangay
                information and services.
            </p>
        </section>

        <!-- ORGANIZATIONAL HIERARCHY -->
        <section class="about-card officials-card">
            <div class="section-heading">
                

                <div>
                    <h3>Organizational Hierarchy</h3>
                    <p>Barangay officials and personnel</p>
                </div>
            </div>

            <div class="hierarchy">
                <div class="hierarchy-level">
                    <div class="official-card chairman">
                        <div class="official-avatar">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </div>

                        <span class="official-role">Barangay Chairman</span>
                        <h4>Official Name</h4>
                    </div>
                </div>

                <div class="hierarchy-connector"></div>

                <div class="official-grid">
                    <div class="official-card">
                        <div class="official-avatar">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </div>

                        <span class="official-role">Secretary</span>
                        <h4>Official Name</h4>
                    </div>

                    <div class="official-card">
                        <div class="official-avatar">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </div>

                        <span class="official-role">Treasurer</span>
                        <h4>Official Name</h4>
                    </div>

                    <div class="official-card">
                        <div class="official-avatar">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21a8 8 0 0 1 16 0"></path>
                            </svg>
                        </div>

                        <span class="official-role">Barangay Tanod</span>
                        <h4>Official Name</h4>
                    </div>
                </div>
            </div>

            <p class="officials-note">
                Official names and photos can be updated when the verified
                barangay information is available.
            </p>
        </section>

        <!-- ACCOUNT -->
        <section class="about-card account-card">
            <div class="section-heading">
                <div class="section-icon logout-icon">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M10 17l5-5-5-5"></path>
                        <path d="M15 12H3"></path>
                        <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"></path>
                    </svg>
                </div>

                <div>
                    <h3>Account</h3>
                    <p>Manage your current session</p>
                </div>
            </div>

            <button type="button" class="logout-button" id="openLogoutModal">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10 17l5-5-5-5"></path>
                    <path d="M15 12H3"></path>
                    <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"></path>
                </svg>

                <span>Logout</span>

                <svg class="logout-arrow" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </button>
        </section>

    </main>

    <!-- LOGOUT CONFIRMATION MODAL -->
    <div class="modal-overlay" id="logoutModal" hidden>
        <div
            class="logout-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="logoutModalTitle"
        >
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10 17l5-5-5-5"></path>
                    <path d="M15 12H3"></path>
                    <path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7"></path>
                </svg>
            </div>

            <h3 id="logoutModalTitle">Confirm Logout</h3>

            <p>Are you sure you want to log out of your account?</p>

            <div class="modal-actions">
                <button type="button" class="cancel-button" id="cancelLogout">
                    Cancel
                </button>

                <form method="POST" action="{{ url('/logout') }}">
                    @csrf

                    <button type="submit" class="confirm-logout-button">
                        Yes, Logout
                    </button>
                </form>
            </div>
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

        <a href="{{ url('/resident-reports') }}" class="nav-item">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 3 22 21H2z"></path>
                <path d="M12 9v5M12 17h.01"></path>
            </svg>
            <span>Reports</span>
        </a>

        <a
            href="{{ url('/resident-about') }}"
            class="nav-item active"
            aria-current="page"
        >
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
    const logoutModal = document.getElementById('logoutModal');
    const openLogoutModal = document.getElementById('openLogoutModal');
    const cancelLogout = document.getElementById('cancelLogout');

    function showLogoutModal() {
        logoutModal.hidden = false;
        cancelLogout.focus();
    }

    function hideLogoutModal() {
        logoutModal.hidden = true;
        openLogoutModal.focus();
    }

    openLogoutModal.addEventListener('click', showLogoutModal);
    cancelLogout.addEventListener('click', hideLogoutModal);

    logoutModal.addEventListener('click', function (event) {
        if (event.target === logoutModal) {
            hideLogoutModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !logoutModal.hidden) {
            hideLogoutModal();
        }
    });
});
</script>

</body>
</html>
