<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_ConfirmcodeController extends Controller
{
    public function user_confirmcode()
    {
        $data = 'Hello, World!';
        return view('user_confirmcode', ['data' => $data]);
    }
}