<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Brgy. Sibul Springs</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 font-sans antialiased d-flex align-items-center justify-content-center vh-100 m-0" style="background-image: url('{{ asset('images/BG2.png') }}'); background-size: cover; background-position: center;">
    <div class="card shadow-lg border-0 rounded-4 p-5 w-100" id="loginCard" style="max-width: 400px; background-color: rgba(255, 255, 255, 0.95);">
        
        <!-- Logo & Header -->
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center mb-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle p-1">
                </div>
            </div>
            <h4 class="fw-extrabold text-dark tracking-wide fs-5 mb-1">BRGY. SIBUL SPRINGS</h4>
            <p class="text-muted small mb-0" style="font-size: 10px;">Community Information and Document Request System</p>
        </div>

        <!-- Popup Alert kapag may error sa pag-login -->
        @if($errors->has('login_error') || $errors->has('email') || $errors->has('username'))
            <div class="alert alert-danger py-2 px-3 text-center mb-3" style="font-size: 11px;" role="alert">
                {{ $errors->first('login_error') ?? $errors->first('email') ?? $errors->first('username') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label text-xs fw-bold text-dark">Email or Username</label>
                <input type="text" id="login" name="login" class="form-control form-control-sm rounded-3 py-2" value="{{ old('login') }}" placeholder="Enter email or username" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-xs fw-bold text-dark">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control form-control-sm rounded-start-3 py-2 border-end-0" placeholder="Enter password" required>
                    <button class="btn btn-outline-secondary btn-sm rounded-end-3 border-start-0 bg-white" type="button" id="togglePassword" style="border-color: #dee2e6;">
                        <!-- SVG Eye Icon -->
                        <svg id="eyeIcon" viewBox="0 0 24 24" width="16" height="16" fill="#666666">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold text-sm shadow-sm" style="background-color: #c25e00; border: none;">
                Log In
            </button>
        </form>
    </div>

    <!-- JavaScript para sa Password Visibility Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Palitan ang kulay ng eye icon kapag naka-show/hide ang password
                if (type === 'text') {
                    eyeIcon.style.fill = '#c25e00';
                } else {
                    eyeIcon.style.fill = '#666666';
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>