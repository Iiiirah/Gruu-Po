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
<body class="bg-gray-900 font-sans antialiased d-flex align-items-center justify-content-center vh-100 m-0" style="background-image: url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center;">

    <div class="card shadow-lg border-0 rounded-4 p-5 w-100" id="loginCard" style="max-width: 400px; background-color: rgba(255, 255, 255, 0.95);">
        
        <!-- Logo & Header -->
        <div class="text-center mb-4">
            <div class="d-flex justify-content-center mb-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle p-1">
                </div>
            </div>
            <h4 class="fw-extrabold text-dark tracking-wide fs-5 mb-1">BRGY. SIBUL SPRINGS</h4>
            <p class="text-muted small mb-0" style="font-size: 10px;">Community Information and Document Request System</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label text-xs fw-bold text-dark">Email Address</label>
                <input type="email" id="email" name="email" class="form-control form-control-sm rounded-3 py-2" placeholder="Enter email" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-xs fw-bold text-dark">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-sm rounded-3 py-2" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold text-sm shadow-sm">
                Log In
            </button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>