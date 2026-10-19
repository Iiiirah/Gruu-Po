<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin() {
        return view('login');
    }

    // Handle Login Submission
    public function processLogin(Request $request) {
        return redirect()->route('login')->with('success', 'Logged in successfully!');
    }

    // Show Change Password Page
    public function showForgotPassword() {
        return view('forgotpassword');
    }

    // Handle Password Update Submission (Stores data temporarily in session)
    public function processForgotPassword(Request $request) {
        // Validate that the fields match
        $request->validate([
            'password' => 'required|min:6|same:password_confirmation',
        ]);

        // Temporarily stores the password in a session variable 
        session(['temp_new_password' => $request->password]);

        // Redirect back to login with a success alert
        return redirect()->route('login')->with('success', 'Password changed successfully and stored in session!');
    }
}
