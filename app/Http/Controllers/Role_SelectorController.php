<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Role_SelectorController extends Controller
{
    public function role_selector()
    {
        $data = 'Hello, World!';
        return view('role_selector', ['data' => $data]);
    }
}
