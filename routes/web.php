<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\QRController;

// Default route
Route::get('/', function () {
    return view('index');
});

// Authentication and Role Routes
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::get('/role', function () {
    return view('role');
})->name('role');

// Business Sign-Up Routes
Route::get('/businessSignUp', function () {
    return view('businessSignUp');
})->name('businessSignUp');

// OTP Related Routes
Route::get('/otpSender', function () {
    return view('otpSender');
})->name('otpSender');

Route::get('/otpVerification', function () {
    return view('verification');
})->name('otpVerification');

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('sendOtp');

// Business Dashboard Routes
Route::get('/businessDashboard', function () {
    return view('businessDashboard');
})->name('businessDashboard');

Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');

Route::get('/business/success', [SuccessController::class, 'generateQRCode'])->name('genQR');

// Login Routes
Route::get('/login', function () {
    return view('signin');
})->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.post');

// Promotion Routes
Route::get('/viewpromo', [PromoController::class, 'getPromo'])->name('viewpromo');
Route::get('/addpromo', [PromoController::class, 'showForm'])->name('addpromo');
Route::get('/promo/add', [PromoController::class, 'showForm'])->name('promo.add');
Route::post('/promo/add', [PromoController::class, 'addPromo'])->name('promo.add');

// QR Code Routes
Route::get('/getqr', [QRController::class, 'getQRCode'])->name('getqr');
Route::get('/showpromo/{userId}', [QRController::class, 'showPromo'])->name('showpromo');
