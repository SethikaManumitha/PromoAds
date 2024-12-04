<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;

Route::get('/', function () {
    return view('index');
});

Route::get('/signin', function () {
    return view('signin');
})->name('signin'); 

Route::get('/role', function () {
    return view('role');
})->name('role'); 

Route::get('/otpSender', function () {
    return view('otpSender');
})->name('otpSender'); 

Route::get('/otpVerification', function () {
    return view('verification');
})->name('otpVerification'); 

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('sendOtp');
