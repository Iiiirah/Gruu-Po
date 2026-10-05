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
            <form id="changePasswordForm">
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Confirm New Password" required> <br><br><br><br>
                <button type="button" id="submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            window.location.href = "{{ route('login') }}";
        });
    </script>
</body>
</html>