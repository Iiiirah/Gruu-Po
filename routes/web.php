<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Resident Dashboard
Route::view('/resident-dashboard', 'resident-dashboard');

// Resident Community Information
Route::view(
    '/resident-community-information',
    'resident-community-information'
);

// Resident Document Request
Route::view(
    '/resident-document-request',
    'resident-document-request'
);

// Resident Incident Reports
Route::view('/resident-reports', 'resident-reports');

// Resident About Page
Route::view('/resident-about', 'resident-about')
    ->name('resident-about');

// Logout
Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');