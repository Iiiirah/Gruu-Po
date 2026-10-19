<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Brgy. Sibul Springs | Signup</title>
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

    .form-group {
      margin-bottom: 10px;
    }

    .form-input {
      width: 100%;
      padding: 9px 12px;
      font-size: 12px;
      border: 1px solid #cccccc;
      border-radius: 5px;
      outline: none;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.08);
    }

    .form-input:focus {
      border-color: #0099bb;
    }


    .signup-btn {
      width: 90px;
      padding: 8px 0;
      background-color: #a4e5ee;
      border: 1px solid #7eccd8;
      border-radius: 5px;
      color: #1a3c6d;
      font-weight: bold;
      font-size: 13px;
      cursor: pointer;
      margin-bottom: 14px;
      transition: background-color 0.2s ease;
    }

    .signup-btn:hover {
      background-color: #83dbe6;
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

      <form action="#" method="POST">
        <div class="form-group">
          <input type="email" class="form-input" placeholder="Email" required>
        </div>

        <div class="form-group">
          <input type="text" class="form-input" placeholder="Name" required>
        </div>

        <div class="form-group">
          <input type="password" class="form-input" placeholder="Password" required>
        </div>



        <button type="submit" class="signup-btn">Signup</button>
      </form>

    </div>


  </div>

</body>
</html>