<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;




// Default route
Route::get('/', [MainController::class, 'index'])->name('index');


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
    Route::post('/change-business-profile/{id}', [BusinessController::class, 'changeBusinessProfile'])->name('admin.changeBusinessProfile');
});


Route::prefix('signup')->group(function () {
    Route::get('/businessSignUp', function () {
        return view('signup.businessSignUp');
    })->name('businessSignUp');

    Route::get('/customerSignUp', function () {
        return view('signup.customerSignUp');
    })->name('customerSignUp');

    Route::get('/driverSignUp', function () {
        return view('signup.driverSignUp');
    })->name('driverSignUp');

    Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store');
    Route::get('/business/success', [SuccessController::class, 'generateQRCode'])->name('genQR');
    Route::post('/customer/insert', [CustomerController::class, 'insertCustomer'])->name('customer.insert');
    //Route::get('/customer/insert', [CustomerController::class, 'showSignUpForm']);
});


// Login Routes
Route::get('/login', function () {
    return view('signin');
})->name('login');


Route::post('/login', [UserController::class, 'authenticate'])->name('login.post');



Route::prefix('promotions')->group(function () {
    Route::get('/viewpromo', [PromoController::class, 'getAllPromo'])->name('viewpromo');
    Route::get('/addpromo', [PromoController::class, 'showForm'])->name('addpromo');
    Route::get('/promo/add', [PromoController::class, 'showForm'])->name('promo.add');
    Route::post('/promo/add', [PromoController::class, 'addPromo'])->name('promo.add');
    Route::get('/editpromo/{promotion}', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/updatepromo/{promotion}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promotions/{promotion}', [PromoController::class, 'destroy'])->name('promo.destroy');
    Route::post('/getpromotions/{promotion_id}', [PromoController::class, 'getPromo'])->name('promotions.view');
    Route::get('/getpromotions/{promotion_id}', [PromoController::class, 'getPromo'])->name('promotions.view');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
});

Route::prefix('services')->group(function () {
    Route::get('/viewpromo', [ServiceController::class, 'getAllService'])->name('viewservice');
    Route::get('/addservice', [ServiceController::class, 'showService'])->name('addservice');
    Route::get('/add', [ServiceController::class, 'showService'])->name('service.add');
    Route::post('/add', [ServiceController::class, 'addService'])->name('service.add');
    Route::get('/editservice/{promotion}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/updateservice/{promotion}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{promotion}', [ServiceController::class, 'destroy'])->name('service.destroy');
});
// QR Code Routes
Route::get('/getqr', [QRController::class, 'getQRCode'])->name('getqr');
Route::get('/showpromo/{userId}', [QRController::class, 'showPromo'])->name('showpromo');


Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
Route::post('/cart/update/{productId}', [CartController::class, 'updateCartQuantity'])->name('cart.update');
Route::get('/download-cart-pdf', [CartController::class, 'downloadCartPDF'])->name('downloadCartPDF');


Route::get('/admin/88906GH', [AdminController::class, 'index'])->name('getAdmin');
Route::post('/edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
Route::get('/admin/createBusiness', function () {
    return view('admin.createBusiness');
})->name('createBusiness');

Route::get('/admin/createDriver', function () {
    return view('admin.createDriver');
})->name('createDriver');
