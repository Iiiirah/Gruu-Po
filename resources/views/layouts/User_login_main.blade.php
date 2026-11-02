<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Sibul Springs | Login</title>
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
      min-height: 100%;
      background-color: #121212; /* Dark outer background */
    }
    /* Mobile Device Wrapper */
    .phone-container {
      width: 100%;
      max-width: 100%;
      height: 1000px;
      background-image: url('Images/BG2.png');
      background-size: cover;
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
      margin-bottom: 14px;
    }
    /* Estilo para sa Success Prompt Box ("Account Created") */
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 8px 10px;
      border-radius: 5px;
      font-size: 11px;
      margin-bottom: 12px;
      text-align: center;
      font-weight: 600;
    }
    /* Estilo para sa Error Prompt Box */
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 8px 10px;
      border-radius: 5px;
      font-size: 10px;
      margin-bottom: 12px;
      text-align: left;
    }
    .form-group {
      margin-bottom: 10px;
      position: relative; /* Para sa posisyon ng toggle icon */
    }
    .form-input {
      width: 100%;
      padding: 9px 35px 9px 12px; /* Nilagyan ng padding sa kanan para hindi matakpan ng icon */
      font-size: 12px;
      border: 1px solid #cccccc;
      border-radius: 5px;
      outline: none;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.08);
    }
    .form-input:focus {
      border-color: #0099bb;
    }
    /* Styling para sa Password Toggle Icon */
    .password-toggle-icon {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      width: 18px;
      height: 18px;
      fill: #666666;
    }
    .login-btn {
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
    .login-btn:hover {
      background-color: #83dbe6;
    }
    .signup-text {
      font-size: 11px;
      color: #555555;
    }
    .signup-text a {
      color: #4a90e2;
      text-decoration: none;
    }
    .signup-text a:hover {
      text-decoration: underline;
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
    <div class="status-bar"></div>
    
    <!-- Login Box -->
    <div class="login-card">
      <div class="logo-container rounded-circle bg-white d-flex align-items-center justify-content-center mx-auto" style="width: 72px; height: 72px; overflow: hidden;">
        <img src="{{ asset('Images/LogoSibul.png') }}" alt="Sibul Logo" class="logo">
      </div>
      <h2 class="title">BRGY. SIBUL SPRINGS</h2>
      <p class="subtitle">Community Information and Document Request System</p>
      
      <!-- Pop-up Prompt kapag Tagumpay ang paggawa ng account -->
      @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif
      
      <!-- Pop-up Prompt kapag nagkamali sa pag-login -->
      @if($errors->any())
        <div class="alert-error">
          {{ $errors->first('login') }}
        </div>
      @endif

      <form action="{{ route('user.login.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <input type="text" name="login" class="form-input" value="{{ old('login') }}" placeholder="Email or Username" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
          <!-- SVG Eye Icon para sa Password Toggle -->
          <svg id="togglePassword" class="password-toggle-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
          </svg>
        </div>
        <button type="submit" class="login-btn">Log-In</button>
      </form>
      <p class="signup-text">
        Don't have an account? <a href="{{ route('user.signup') }}">Click here</a>
      </p>
    </div>

    <!-- Mobile Home Indicator -->
    <div class="home-indicator"></div>
  </div>

  <!-- JavaScript para sa pagpapalit ng password visibility -->
  <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // I-toggle ang type ng password field galing sa 'password' patungong 'text'
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Opsyonal: Palitan ang kulay ng icon kapag naka-active o nakabukas ang mata
        if (type === 'text') {
            this.style.fill = '#0099bb';
        } else {
            this.style.fill = '#666666';
        }
    });
  </script>
</body>
</html>