<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User_loginController;
use App\Http\Controllers\Role_SelectorController;
use App\Http\Controllers\User_SignupController;
use App\Http\Controllers\User_NewpassController;
use App\Http\Controllers\User_VerificationController;
use App\Http\Controllers\User_ForgotpassController;
use App\Http\Controllers\User_ConfirmcodeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\SettingController;


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

// Laravel's password broker routes use the built-in password_reset_tokens table.
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');

// Resident About Page
Route::view('/resident-about', 'resident-about')
    ->name('resident-about');

Route::get('/document-requests/{documentRequest}/status-history', [RequestStatusHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('document-requests.status-history');

// Logout
Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');


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


Route::get('/user_login', function () {
    return view('user_login', ['data' => $data]);
});

Route::get('/user_login', [User_loginController::class, 'user_login']) -> name('user_login');
Auth::routes();

Route::get('/role_selector', function () {
    return view('role_selector', ['data' => $data]);
});

Route::get('/role_selector', [Role_SelectorController::class, 'role_selector']) -> name('role_selector');
Auth::routes();

Route::get('/user_signup', function () {
    return view('user_signup', ['data' => $data]);
});

Route::get('/user_signup', [User_SignupController::class, 'user_signup']) -> name('user_signup');
Auth::routes();

Route::get('/user_newpass', function () {
    return view('user_newpass', ['data' => $data]);
});

Route::get('/user_newpass', [User_NewpassController::class, 'user_newpass']) -> name('user_newpass');
Auth::routes();


Route::get('/user_verification', function () {
    return view('user_verification', ['data' => $data]);
});

Route::get('/user_verification', [User_VerificationController::class, 'user_verification']) -> name('user_verification');
Auth::routes();


Route::get('/user_forgotpass', function () {
    return view('user_forgotpass', ['data' => $data]);
});

Route::get('/user_forgotpass', [User_ForgotpassController::class, 'user_forgotpass']) -> name('user_forgotpass');
Auth::routes();


Route::get('/user_confirmcode', function () {
    return view('user_confirmcode', ['data' => $data]);
});

Route::get('/user_confirmcode', [User_ConfirmcodeController::class, 'user_confirmcode']) -> name('user_confirmcode');
Auth::routes();


// User Management Routes
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user.management');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user.store');
Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user.destroy');

// Community Information Routes
Route::get('/community-information', [CommunityController::class, 'index'])->name('community.information');
Route::post('/community-information', [CommunityController::class, 'store'])->name('community.store');
Route::delete('/community-information/{id}', [CommunityController::class, 'destroy'])->name('community.destroy');

// Online Document Request Routes
Route::get('/online-document-request', [DocumentRequestController::class, 'index'])->name('documentsrequest');
Route::put('/online-document-request/{id}', [DocumentRequestController::class, 'update'])->name('documentsrequest.update');
Route::delete('/online-document-request/{id}', [DocumentRequestController::class, 'destroy'])->name('documentsrequest.destroy');
// Tandaan: Kailangan mo ring magkaroon ng Model (

// Setting at Controller (SettingController) para sa mga settings routes na ito.
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

?>