<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/home',[HomeController::class,'home'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
