<?php
// PHP logic will be added here later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Capstone - Copy/style/signup.css') }}">
    <title>Classroom Monitoring System</title>
</head>

<body>
    <div class="signup-container">
        <div class="signup-card" id="signupCard">
            <img src="{{ asset('Capstone - Copy/imgs/icslogo.jpg') }}" alt="Institute Logo">
            <h1>Institute of Computer Studies</h1>
            <p>Classroom Monitoring System</p>
            <form id="signupForm" method="GET" action="{{ route('login') }}">
                <input type="email" name="email" id="email" class="email" placeholder="Email" required>
                <input type="text" name="name" id="name" class="name" placeholder="Name" required>
                <input type="password" name="password" id="password" class="password" placeholder="Password" required>
                <button type="submit">Sign-Up</button>
            </form>
        </div>

        <div class="signup-card success-card" id="successCard">
            <img src="{{ asset('Capstone - Copy/imgs/icslogo.jpg') }}" alt="Institute Logo">
            <h1>Account Created!</h1>
            <p>Your account has been successfully created.</p>
            <div class="loader"></div>
            <span>Redirecting to login...</span>
        </div>
    </div>

    <script src="{{ asset('Capstone - Copy/sources/signup.js') }}"></script>

</body>
</html>