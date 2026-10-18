<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Brgy. Sibul Springs | Welcome</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #121212; /* Dark outer background */
    }

    /* Mobile screen container */
    .phone-screen {
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

    /* Subtle background glow */
    .phone-screen::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 45%;
      bottom: 0;
      left: 0;
      background: linear-gradient(
        170deg,
        transparent 10%,
        rgba(30, 145, 255, 0.15) 30%,
        rgba(0, 115, 235, 0.6) 100%
      );
      pointer-events: none;
    }

    /* Main white card */
    .welcome-card {
        position: absolute;
        top: 0%;
        width: 88%;
        height: 450px;
        padding: 0px 20px;
        justify-content: space-between;
        position: relative;
        z-index: 1; 
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center; 
        background: #ffffff;
        border-radius: 19px;
        box-shadow: 0 12px 30px rgba(0, 45, 90, 0.22);  
        animation: fadeIn 0.7s ease-out;
    }

    /* Barangay logo */
    .logo-container {
      width: 90px;
      height: 90px;
      margin-bottom: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      border-radius: 50%;
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }



    .logo-placeholder .emblem {
      font-size: 34px;
      margin-top: 3px;
    }

    h2 {
      font-size: 18px;
      font-weight: 700;
      color: #292929;
      margin-bottom: 5px;
      line-height: 1.3;
    }

    .subtitle {
      font-size: 12px;
      line-height: 1.7;
      color: #666666;
      margin-bottom: 35px;
    }

    /* Role buttons */
    .role-button {
      width: 100%;
      height: 45px;
      border: none;
      border-radius: 5px;
      margin-bottom: 15px;

      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.4px;
      cursor: pointer;

      transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        filter 0.2s ease;
    }

    .admin-button {
      color: #ffffff;
      background: linear-gradient(110deg, #100080, #0800e9);
      box-shadow: 0 4px 8px rgba(0, 0, 100, 0.22);
    }

    .resident-button {
      color: #073b43;
      background: linear-gradient(110deg, #00e9e9, #00c7bd);
      box-shadow: 0 4px 8px rgba(0, 130, 130, 0.2);
    }

    .role-button:hover {
      transform: translateY(-2px);
      filter: brightness(1.05);
    }

    .role-button:active {
      transform: scale(0.98);
    }

    .role-button:focus-visible {
      outline: 3px solid #75bfff;
      outline-offset: 3px;
    }

    .footer-text {
      margin-top: 15px;
      font-size: 11px;
      color: #777777;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(15px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive layout */
    @media (max-width: 480px) {
      body {
        padding: 0;
        min-height: 100vh;
        min-height: 100dvh;
      }

      .phone-screen {
        max-width: none;
        width: 100%;
        height: 100vh;
        height: 100dvh;
        min-height: 560px;
        border-radius: 0;
      }

      .welcome-card {
        width: 74%;
        min-height: 335px;
        padding: 24px 20px;
      }

      .logo-container {
        width: 72px;
        height: 72px;
        margin-bottom: 12px;
      }

      .subtitle {
        margin-bottom: 28px;
      }
    }
  </style>
</head>

<body>

  <main class="phone-screen">

    <section class="welcome-card">

      <div class="logo-container">
        <img src="{{ asset('Images/Logo Sibul.png') }}" alt="Sibul Logo" class="logo">
        </div>

      <h2>BRGY. SIBUL SPRINGS</h2>

      <p class="subtitle">
        Community Information and Document
        Request System
      </p>

      <button
        type="button"
        class="role-button admin-button"
        onclick="selectRole('admin')">
        ADMIN
      </button>

      <button
        type="button"
        class="role-button resident-button"
        onclick="selectRole('resident')">
        RESIDENT
      </button>

      <p class="footer-text">
        Please select your account type
      </p>

    </section>

  </main>

  <script>
    function selectRole(role) {
      if (role === "admin") {
        // Change this to your admin login page.
        window.location.href = "admin-login.html";
      } else if (role === "resident") {
        // Change this to your resident login page.
        window.location.href = "User_login_main.blade.php";
      }
    }
  </script>

</body>
</html>