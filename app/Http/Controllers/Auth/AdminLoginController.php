<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    // Ipakita ang Admin Login Page
    public function create()
    {
        return view('auth.login');
    }

    // I-proseso ang Admin Login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Alamin kung ang nilagay ay email o username/account ID
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_account';

        // Kung sakaling username column ang ginagamit sa database, pwede ring icheck ang 'username' o 'name'
        // Dito sinusubukan nating i-match sa email o user_account
        $loginData = [
            $fieldType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($loginData, $request->filled('remember'))) {
            $request->session()->regenerate();

            // I-check kung Admin ang nag-login o Resident
            if (Auth::user()->role === 'Admin') {
                return redirect()->intended(route('dashboard'));
            } else {
                Auth::logout();
                return back()->withErrors(['login_error' => 'Access denied. Admin credentials required.']);
            }
        }

        // Subukan din natin i-check kung sakaling 'name' ang tinutukoy bilang username
        if (Auth::attempt(['name' => $request->login, 'password' => $request->password])) {
            if (Auth::user()->role === 'Admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }
        }

        return back()->withErrors([
            'login_error' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('login'));
    }
}