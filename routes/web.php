<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedulemanagement', function () {
    return view('schedulemanagement');
});
