<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SuccessController;

Route::get('/', function () {
    return view('index');
});

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::get('/role', function () {
    return view('role');
})->name('role'); 

Route::get('/businessSignUp', function () {
    return view('businessSignUp');
})->name('businessSignUp'); 

Route::get('/otpSender', function () {
    return view('otpSender');
})->name('otpSender'); 

Route::get('/otpVerification', function () {
    return view('verification');
})->name('otpVerification'); 

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('sendOtp');

Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');

Route::get('/business/success', [SuccessController::class, 'generateQRCode'])->name('genQR');
