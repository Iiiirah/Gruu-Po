<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_loginController extends Controller
{
    public function user_login()
    {
        $data = 'Hello, World!';
        return view('user_login', ['data' => $data]);
    }
}
