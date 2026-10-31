<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\ResidentDocumentRequestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\AdminLoginController;



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

// Logout Route
Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

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
Route::get('/resident-community-information', [CommunityController::class, 'residentIndex'])->name('resident.community.information');
Route::post('/community-information', [CommunityController::class, 'store'])->name('community.store');
Route::put('/community-information/{id}', [CommunityController::class, 'update'])->name('community.update'); // <--- Siguraduhing narito ito!
Route::delete('/community-information/{id}', [CommunityController::class, 'destroy'])->name('community.destroy');


// Setting at Controller (SettingController) para sa mga settings routes na ito.
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
Route::put('/settings/password', [SettingController::class, 'updatePassword'])->name('settings.password.update');

// Resident Document Request Routes
Route::get('/resident-document-request', [ResidentDocumentRequestController::class, 'index'])->name('resident.document.request');
Route::post('/resident-document-request', [ResidentDocumentRequestController::class, 'store'])->name('resident.document.store');
Route::put('/resident-document-request/{id}', [ResidentDocumentRequestController::class, 'update'])->name('resident.document.update');
Route::delete('/resident-document-request/{id}', [ResidentDocumentRequestController::class, 'destroy'])->name('resident.document.destroy');

Route::get('/role-selection', function () {
    return view('role');
})->name('role');

// Route para sa Logout (ito ang tinatawag ng form sa resident-about.blade.php)
Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

// Route para sa iyong roles.blade.php page
Route::get('/role', function () {
    return view('role');
})->name('role');

Route::get('/role', function () {
    return view('role');
})->name('role');

// Route para ipakita ang signup page
Route::get('/user_signup', [SignupController::class, 'create'])->name('user.signup');

// Route para tanggapin ang POST request at i-save sa database
Route::post('/user_signup', [SignupController::class, 'store'])->name('user.signup.store');

// User Login Routes
Route::get('/user_login', [UserLoginController::class, 'create'])->name('user.login');
Route::post('/user_login', [UserLoginController::class, 'store'])->name('user.login.store');

// Resident Dashboard Route
Route::get('/resident-dashboard', function () {
    return view('resident-dashboard');
})->middleware('auth')->name('resident.dashboard');


// Tiyaking may ->name('user_login') kung iyon ang hinahanap ng role.blade.php
Route::get('/user_login', [UserLoginController::class, 'create'])->name('user_login');

// O kung 'user.login' ang nakalagay sa iyong role.blade.php, gamitin ito:
Route::get('/user_login', [UserLoginController::class, 'create'])->name('user.login');


// Admin Login Routes
Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
Route::post('/admin/login', [AdminLoginController::class, 'store'])->name('admin.login.store');

// Admin Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


// Resident Incident Report Routes
use App\Http\Controllers\IncidentReportController;

// Resident Incident Report Routes
Route::get('/resident-reports', [IncidentReportController::class, 'residentIndex'])->name('resident.reports');
Route::post('/resident-reports', [IncidentReportController::class, 'store'])->name('resident.reports.store');
Route::put('/resident-reports/{id}', [IncidentReportController::class, 'update'])->name('resident.reports.update');
Route::delete('/resident-reports/{id}', [IncidentReportController::class, 'destroy'])->name('resident.reports.destroy');

// Admin Incident Report Routes (kung wala pa)
Route::get('/incident-reports', [IncidentReportController::class, 'adminIndex'])->name('incident.reports');
Route::put('/incident-reports/{id}/status', [IncidentReportController::class, 'updateStatus'])->name('incident.updateStatus');
Route::delete('/incident-reports/{id}', [IncidentReportController::class, 'destroy'])->name('incident.destroy');

// -------------------------END OF INCIDENT REPORT ROUTES-------------------------

// --- ADMIN ROUTES ---
Route::get('/online-document-request', [DocumentRequestController::class, 'adminIndex'])->name('documentsrequest');
Route::put('/online-document-request/{id}/status', [DocumentRequestController::class, 'updateStatus'])->name('documents.updateStatus');
Route::delete('/online-document-request/{id}', [DocumentRequestController::class, 'destroy'])->name('documents.destroy');

// --- RESIDENT ROUTES ---
Route::get('/resident-document-request', [DocumentRequestController::class, 'residentIndex'])->name('resident.documents');
Route::post('/resident-document-request', [DocumentRequestController::class, 'store'])->name('resident.documents.store');


// Para sa pag-save ng document request ng residente
Route::post('/resident-document-request', [DocumentRequestController::class, 'store'])->name('resident.document.store');

// Idagdag ang route na ito para sa pag-update ng status sa admin side
Route::patch('/admin/incident-reports/{id}/status', [IncidentReportController::class, 'updateStatus'])->name('admin.reports.updateStatus');

// Route sa DashboardController
// 1. Admin Dashboard Route (Kadalasan ay pinoprotektahan ng auth at admin middleware)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 2. Resident Dashboard Route
Route::get('/resident-dashboard', [DashboardController::class, 'residentDashboard'])->name('resident.dashboard');

use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');

use App\Http\Controllers\ResidentAboutController;

Route::get('/resident-about', [ResidentAboutController::class, 'index'])->name('resident.about');

?>

