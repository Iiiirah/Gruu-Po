<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Capstone - Copy/style/login.css') }}">
    <title>Classroom Monitoring System</title>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <img src="{{ asset('Capstone - Copy/imgs/icslogo.jpg') }}" alt="Institute Logo">
            <h1>Institute of Computer Studies</h1>
            <p>Classroom Monitoring System</p>
            <form id="verificationForm" method="POST" action="{{ route('OTP') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <a href="{{ route('login') }}">Back to Login?</a><br><br><br><br><br>
                <button type="submit">Continue</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('Capstone - Copy/sources/verification.js') }}"></script>
</body>
</html>