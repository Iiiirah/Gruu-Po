<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    // Ipakita ang user login form (GET)
    public function create()
    {
        return view('user_login'); 
    }

    // I-proseso ang user login authentication (POST)
    public function store(Request $request)
    {
        // 1. I-validate ang mga input (ginamit ang 'login' para sa email o username)
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // 2. Alamin kung email o username ang inilagay ng user
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Subukang i-authenticate ang user gamit ang natukoy na field type at password
        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();

            // Kondisyon 1: Kapag match, diretso sa resident dashboard
            return redirect()->route('resident.dashboard');
        }

        // Kondisyon 2: Kapag nagkamali o wala sa database / hindi rehistrado
        return back()->withErrors([
            'login' => 'It seems like you haven’t created your account yet or your login details are incorrect.',
        ])->onlyInput('login');
    }
}