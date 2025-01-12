<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\CartController;

// Default route
Route::get('/', [MainController::class, 'index']);

// Authentication and Role Routes
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::get('/role', function () {
    return view('role');
})->name('role');


// OTP routes
Route::get('/otpSender', function () {
    return view('otpSender');
})->name('otpSender');

Route::get('/otpVerification', function () {
    return view('verification');
})->name('otpVerification');

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('sendOtp');


// Admin dashboards
Route::prefix('admin')->group(function () {
    Route::get('/profile', [BusinessController::class, 'showProfile'])->name('admin.profile');
    Route::post('/profile', [BusinessController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::get('/businessDashboard', [BusinessController::class, 'showDashboard'])->name('admin.businessDashboard');
});


Route::prefix('signup')->group(function () {
    Route::get('/businessSignUp', function () {
        return view('signup.businessSignUp');
    })->name('businessSignUp');
    Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');
    Route::get('/business/success', [SuccessController::class, 'generateQRCode'])->name('genQR');
});


// Login Routes
Route::get('/login', function () {
    return view('signin');
})->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.post');

Route::prefix('promotions')->group(function () {
    Route::get('/viewpromo', [PromoController::class, 'getPromo'])->name('viewpromo');
    Route::get('/addpromo', [PromoController::class, 'showForm'])->name('addpromo');
    Route::get('/promo/add', [PromoController::class, 'showForm'])->name('promo.add');
    Route::post('/promo/add', [PromoController::class, 'addPromo'])->name('promo.add');
    Route::get('/editpromo/{promotion}', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/updatepromo/{promotion}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promotions/{promotion}', [PromoController::class, 'destroy'])->name('promo.destroy');
});

// QR Code Routes
Route::get('/getqr', [QRController::class, 'getQRCode'])->name('getqr');
Route::get('/showpromo/{userId}', [QRController::class, 'showPromo'])->name('showpromo');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
