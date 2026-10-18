<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Login Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/role', function () {
    return view('role');
})->name('role');

// Change Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword']);

//dashboard Route
Route::match(['get', 'post'], '/dashboard', function () {
    // your dashboard logic or view return
    return view('dashboard');
})->name('dashboard');

// About Route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Community Information Route
Route::get('/community-information', function () {
    return view('community-information');
})->name('community.information');

// Online Document Request Route
Route::get('/online-document-request', function () {
    return view('documentsrequest');
})->name('documentsrequest');

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Incident Reports Route
Route::get('/incident-reports', function () {
    return view('incident-reports');
})->name('incident.reports');

// User Management Route
Route::get('/user-management', function () {
    return view('user-management');
})->name('user.management');

// Settings Route
Route::get('/settings', function () {
    return view('settings');
})->name('settings');

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Announcement Routes
Route::get('/announcements/{id}', function ($id) {
    return "Viewing announcement details for ID: " . $id;
})->name('announcements.show');

Route::delete('/announcements/{id}', function ($id) {
    // Add your delete logic here (e.g., Announcement::findOrFail($id)->delete();)
    return back()->with('success', 'Announcement deleted successfully.');
})->name('announcements.destroy');

// Report Routes
Route::get('/reports/{id}', function ($id) {
    return "Viewing report details for ID: " . $id;
})->name('reports.show');

Route::delete('/reports/{id}', function ($id) {
    // Add your delete logic here
    return back()->with('success', 'Report deleted successfully.');
})->name('reports.destroy');

Route::get('/community/drafts', function () {
    return view('community-drafts'); // Name of your Drafts blade file
})->name('community.drafts');

Route::get('/community/archives', function () {
    return view('community-archives'); // Name of your Archives blade file
})->name('community.archives');