<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Capstone - Copy/style/OTP.css') }}">
    <title>Classroom Monitoring System</title>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <img src="{{ asset('Capstone - Copy/imgs/icslogo.jpg') }}" alt="Institute Logo">
            <h1>Institute of Computer Studies</h1>
            <p>Classroom Monitoring System</p>
            <form id="otpForm" class="OTP" method="POST" action="{{ route('OTP') }}">
                @csrf
                <div class="otp-boxes">
                    @for ($i = 0; $i < 4; $i++)
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" aria-label="OTP digit {{ $i + 1 }}" />
                    @endfor
                </div>
                <a href="{{ route('resendotp') }}">Resend OTP</a><br><br><br><br><br>
                <button type="submit">Verify</button>
            </form>
            
        </div>
    </div>

    <script src="{{ asset('Capstone - Copy/sources/OTP.js') }}"></script>
</body>
</html>