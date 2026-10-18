<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_loginController;
use App\Http\Controllers\Role_SelectorController;
use App\Http\Controllers\User_SignupController;
use App\Http\Controllers\User_NewpassController;
use App\Http\Controllers\User_VerificationController;
use App\Http\Controllers\User_ForgotpassController;
use App\Http\Controllers\User_ConfirmcodeController;

Route::get('/', function () {
    return view('welcome');
});

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


