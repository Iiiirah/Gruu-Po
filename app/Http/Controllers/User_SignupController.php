<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_SignupController extends Controller
{
    public function user_signup()
    {
        $data = 'Hello, World!';
        return view('user_signup', ['data' => $data]);
    }
}