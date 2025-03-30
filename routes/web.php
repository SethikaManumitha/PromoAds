<?php

use App\Http\Controllers\AboutController;
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
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecommendationController;

use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\TrackPromoViews;
use Vonage\Verify\Check;

// Default route
Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/index', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect()->route('index');
})->name('logout');


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

Route::get('/recommend/{user_id}', [RecommendationController::class, 'getRecommendations']);
Route::get('/specialPromo', [PromoController::class, 'getSpecialPromo'])->name('specialPromo');

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

Route::prefix('product')->group(function () {
    Route::get('/viewproduct', [ProductController::class, 'getAllProduct'])->name('viewproduct');
    Route::get('/addproduct', [ProductController::class, 'showForm'])->name('addproduct');
    Route::get('/product/add', [ProductController::class, 'showForm'])->name('product.add');
    Route::post('/product/add', [ProductController::class, 'addProduct'])->name('product.add');
    Route::put('/updateproduct/{promotion}', [ProductController::class, 'update'])->name('product.update');
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


Route::get('/download-cart-pdf', [CartController::class, 'downloadCartPDF'])->name('downloadCartPDF');

Route::post('/notifications/send/{userId}', [NotificationController::class, 'sendRequest'])->name('notifications.send');
Route::get('/notifications', [NotificationController::class, 'getUserNotifications'])->name('notifications.index');
Route::patch('/notifications/{id}/confirm', [NotificationController::class, 'confirm'])->name('notifications.confirm');

Route::get('/banner', [BannerController::class, 'showForm'])->name('banner.index');
Route::post('/banner', [BannerController::class, 'addBanner'])->name('banner.add');

Route::get('/about', [AboutController::class, 'showForm'])->name('about');
Route::post('/about', [AboutController::class, 'addAbout'])->name('about.add');

Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkoutSubmit'])->name('checkout.submit');


Route::get('/orders', [CheckoutController::class, 'showOrders'])->name('orders');
Route::get('/driver-orders', [CheckoutController::class, 'showOrdersDriver'])->name('orders.driver');

Route::post('/orders/{order}/cancel', [CheckoutController::class, 'cancelOrder'])->name('orders.cancel');
Route::post('/orders/{order}/prepare', [CheckoutController::class, 'prepareOrder'])->name('orders.prepare');
Route::post('/orders/{order}/process', [CheckoutController::class, 'processOrder'])->name('orders.processed');


Route::post('/orders/{order}/driver/accept', [CheckoutController::class, 'acceptOrder'])->name('orders.driver.accept');
Route::post('/orders/{order}/driver/cancel', [CheckoutController::class, 'cancelDriverOrder'])->name('orders.driver.cancel');
Route::post('/orders/{order}/driver/delivered', [CheckoutController::class, 'deliveredOrder'])->name('orders.driver.delivered');


Route::get('/showpromo/{userId}', [QRController::class, 'showPromo'])
    ->name('showpromo')
    ->middleware(TrackPromoViews::class);

Route::get('/order-success', function () {
    return view('orderSuccess');
})->name('orderSuccess');


Route::get('/driver', [DriverController::class, 'showDashboard'])->name('driver');
Route::post('/custom-orders', [CustomOrderController::class, 'store'])->name('custom_orders.store');
Route::get('/custom-orders', [CustomOrderController::class, 'index'])->name('custom_orders.index');
