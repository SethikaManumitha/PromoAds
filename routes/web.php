<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;

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

Route::get('/businessDashboard', function () {
    return view('businessDashboard');
})->name('businessDashboard'); 

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('sendOtp');

Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');

Route::get('/business/success', [SuccessController::class, 'generateQRCode'])->name('genQR');

Route::get('/login', function () {
    return view('signin');
})->name('login');

Route::post('/login', [UserController::class, 'authenticate'])->name('login.post');

Route::get('/promo', function () {
    return view('promotion');
})->name('promo');

Route::get('/businessDashboard', function () {
    return view('businessDashboard');
})->name('businessDashboard');


Route::get('promo/add', [PromoController::class, 'showForm'])->name('promo.add');
Route::post('promo/add', [PromoController::class, 'addPromo'])->name('promo.add');