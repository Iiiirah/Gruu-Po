<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Brgy. Sibul Springs | Confirm Code</title>
        @vite(['resources/js/app.js'])
        <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #121212; /* Dark outer background */
    }

    /* Mobile Device Wrapper */
    .phone-container {
      width: 100%;
      max-width: 380px;
      height: 740px;
      background-image: url(Images/BG2.png);
      backround-size: cover;
      background-position: right bottom;
      background-repeat: no-repeat;
      border-radius: 36px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
      padding: 20px;
    }

    /* Mobile Status Bar (Simulated top notch area) */
    .status-bar {
      position: absolute;
      top: 0;
      width: 100%;
      height: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
    }

    /* White Login Card */
    .login-card {
      background: #ffffff;
      padding: 28px 22px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      width: 88%;
      text-align: center;
    }

    .logo-container {
      margin-bottom: 10px;
    }

    .logo {
      width: 90px;
      height: 90px;
      object-fit: contain;
    }

    .title {
      font-size: 14px;
      font-weight: 700;
      color: #222222;
      margin-bottom: 3px;
    }

    .subtitle {
      font-size: 11px;
      color: #666666;
      margin-bottom: 18px;
    }

    .success-icon {
        margin-top: 52px;
        width: 78px;
        height: 78px;
        border-radius: 50%;
        background: #5bc0d8;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .success-icon svg {
        width: 52px;
        height: 52px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Responsive adjustments */
    @media (max-width: 360px) {
        .success-card {
        width: 76%;
        height: 320px;
        }
    }

    /* Mobile Home Indicator (Bottom Bar) */
    .home-indicator {
      position: absolute;
      bottom: 8px;
      width: 120px;
      height: 4px;
      background-color: rgba(255, 255, 255, 0.5);
      border-radius: 2px;
    }

    .tab {
        display: inline-block;
        width: 80px;
    }
  </style>


</head>
<body>

  <!-- Phone Screen Frame -->
  <div class="phone-container">
    
    <!-- Top Status Bar -->
    <div class="status-bar">
    </div>

    <!-- Login Box -->
    <div class="login-card">
        <div class="logo-container">
            <!-- Replace 'logo.png' with your actual logo image file path -->
            <img src="{{ asset('Images/Logo Sibul.png') }}" alt="Sibul Logo" class="logo">
        </div>

        <h2 class="title">BRGY. SIBUL SPRINGS</h2>
        <p class="subtitle">Community Information and Document Request System</p>

        <div class="tab">
        <div class="success-icon">
            <svg viewBox="0 0 60 60"
                 aria-label="Success">
                <path d="M15 30 L25 40 L45 20"
                      fill="none"
                      stroke="white"
                      stroke-width="7"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </div>
    
    </div>


  </div>

</body>
</html>