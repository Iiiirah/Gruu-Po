<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_NewpassController extends Controller
{
    public function user_newpass()
    {
        $data = 'Hello, World!';
        return view('user_newpass', ['data' => $data]);
    }
}