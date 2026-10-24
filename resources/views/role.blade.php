<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role - Brgy. Sibul Springs</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 font-sans antialiased vh-100 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <!-- Centered Card Container -->
    <div class="card border-0 shadow-lg rounded-4 p-4 text-center bg-white" style="width: 360px; max-width: 90%; min-height: 420px;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            
            <!-- Logo Container -->
            <div class="d-flex justify-content-center mb-3">
                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" style="width: 72px; height: 72px;">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Brgy. Sibul Logo" class="w-100 h-100 object-fit-contain rounded-circle">
                </div>
            </div>

            <!-- Header Titles -->
            <h5 class="fw-extrabold text-dark tracking-wide mb-1" style="font-size: 0.9rem;">BRGY. SIBUL SPRINGS</h5>
            <p class="text-secondary fw-medium mb-4" style="font-size: 10px;">Community Information and Document Request System</p>

            <!-- Role Action Buttons -->
            <div class="w-100 d-flex flex-column gap-3 mt-2 px-2">
                <!-- Admin Button -->
                <a href="{{ route('login') }}" class="btn text-white fw-bold py-2 px-4 rounded-3 shadow-sm text-decoration-none border-0" style="background: linear-gradient(180deg, #0000d1 0%, #00008b 100%); letter-spacing: 0.5px; font-size: 0.85rem;">
                    ADMIN
                </a>

                <!-- Resident Button -->
                <a href="{{ route('user_login') }}" class="btn text-dark fw-bold py-2 px-4 rounded-3 shadow-sm text-decoration-none border-0" style="background: linear-gradient(180deg, #00f2fe 0%, #00c9a7 100%); color: #004d40 !important; letter-spacing: 0.5px; font-size: 0.85rem;">
                    RESIDENT
                </a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>