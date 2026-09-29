<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['GET', 'POST'], '/login', function () {
    return view('Capstone - Copy.page.login');
})->name('login');

Route::match(['GET', 'POST'], '/signup', function () {
    return view('Capstone - Copy.page.signup');
})->name('signup');

Route::match(['GET', 'POST'], '/forgotpassword', function () {
    return view('Capstone - Copy.page.forgotpassword');
})->name('forgotpassword');

Route::match(['GET', 'POST'], '/OTP', function () {
    return view('Capstone - Copy.page.OTP');
})->name('OTP');
