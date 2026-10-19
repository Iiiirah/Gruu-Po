<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_VerificationController extends Controller
{
    public function user_verification()
    {
        $data = 'Hello, World!';
        return view('user_verification', ['data' => $data]);
    }
}