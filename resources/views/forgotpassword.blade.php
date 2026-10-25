<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Brgy. Sibul Springs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#121212] flex items-center justify-center min-h-screen m-0">

    <!-- Outer Wrapper with the blue gradient background effect -->
    <div class="relative w-full h-screen flex items-center justify-center overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <!-- Card Container -->
        <div class="relative z-10 bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl flex flex-col items-center mx-4">
            
            <!-- Logo -->
            <div class="mb-3 flex flex-col items-center">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2">
                    <img src="{{ asset('images/LogoSibul.png') }}" alt="Brgy Logo" class="w-14 h-14 object-contain rounded-full">
                </div>
                <h1 class="font-bold text-gray-800 text-lg tracking-wide uppercase">BRGY. SIBUL SPRINGS</h1>
                <p class="text-xs text-gray-500 text-center mt-0.5">Community Information and Document Request System</p>
            </div>

            <!-- Update your form tag to this -->
            <form id="changePasswordForm" action="{{ route('password.request') }}" method="POST" class="w-full mt-4 flex flex-col gap-4" onsubmit="handlePasswordChange(event);">
                @csrf
                
                <!-- New Password Input -->
                <div>
                    <input type="password" name="password" placeholder="New Password" required class="w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 shadow-sm">
                </div>

                <!-- Confirm New Password Input -->
                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" required class="w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 shadow-sm">
                </div>

                <!-- Submit Button -->
                <div class="mt-2">
                    <button type="submit" 
                        class="w-full py-2.5 px-4 bg-[#87CEEB] hover:bg-[#6cbce0] text-gray-800 font-medium text-sm rounded-lg shadow transition-all duration-200">
                        Submit
                    </button>
                </div>
            </form>
            
            <!-- Success Screen -->
            <div id="successScreen" class="hidden w-full mt-6 flex flex-col items-center justify-center py-6">
                <div class="w-16 h-16 bg-[#5bc0de] rounded-full flex items-center justify-center mb-4 shadow-md">
                    <!-- Checkmark SVG Icon -->
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium text-sm">Password Changed Successfully!</p>
            </div>

            <!-- Back to Login link (Hidden during success state) -->
            <div id="backToLoginContainer" class="mt-6 text-center">
                <p class="text-xs text-gray-600">
                    Remember your password? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login here.</a>
                </p>
            </div>

        </div>
    </div>

    <!-- Handles the animation and redirect -->
    <script>
    function handlePasswordChange(event) {
        // Temporarily stops the immediate native form submission
        event.preventDefault();
        const form = event.target;

        // Hides the form and the bottom link
        document.getElementById('changePasswordForm').classList.add('hidden');
        document.getElementById('backToLoginContainer').classList.add('hidden');

        // Shows the success checkmark screen
        document.getElementById('successScreen').classList.remove('hidden');

        // Wait for 1.5 seconds to show the animation, then submit the form programmatically
        setTimeout(function() {
            form.submit(); // sends the data to controller and triggers the backend redirect
        }, 1500);
    }
    </script>
</body>
</html>