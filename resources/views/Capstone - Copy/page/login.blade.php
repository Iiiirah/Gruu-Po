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
            <form id="loginForm" method="POST" action="#">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="text" id="name" name="name" placeholder="Name" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <a href="{{ route('verification') }}">Forgot Password?</a>
                <button type="submit">Login</button>
            </form>
            <p>
                Don't have an account?
                <a href="{{ route('signup') }}">Click here.</a>
            </p>
        </div>
    </div>

    <script src="{{ asset('Capstone - Copy/sources/login.js') }}"></script>
</body>
</html>