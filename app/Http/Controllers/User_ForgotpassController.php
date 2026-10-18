<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_ForgotpassController extends Controller
{
    public function user_forgotpass()
    {
        $data = 'Hello, World!';
        return view('user_forgotpass', ['data' => $data]);
    }
}