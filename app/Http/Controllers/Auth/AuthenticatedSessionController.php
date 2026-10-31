<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Dito ito direktang mapupunta sa roles.blade.php (siguraduhing 'roles' ang pangalan o route ng iyong view)
    return redirect()->route('roles'); 
})->name('logout');