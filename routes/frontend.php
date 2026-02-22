<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\NewArrivalsController;
use App\Http\Controllers\Frontend\BestSellerController;
use App\Http\Controllers\Frontend\EighteenKTController;
use App\Http\Controllers\Frontend\TattsvisFavouriteController;
use App\Http\Controllers\Frontend\ReadyToStockController;
use App\Http\Controllers\Frontend\AuthController;

/*
|--------------------------------------------------------------------------
| FRONTEND AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

// Frontend OTP Authentication Routes
Route::prefix('auth')->name('frontend.auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/mobile', [AuthController::class, 'showMobileForm'])->name('mobile');
        Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send-otp');
        Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify-otp');
        Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp.submit');
        Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| PUBLIC MARKETPLACE ROUTES
|--------------------------------------------------------------------------
*/

// Home & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/filter-products', [HomeController::class, 'filterProducts'])->name('home.filter');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/return-exchange', [HomeController::class, 'returnExchange'])->name('return_exchange');

// Static Pages
Route::get('/best-seller', [BestSellerController::class, 'index'])->name('page.best-seller');
Route::get('/readytostock', [ReadyToStockController::class, 'index'])->name('page.readytostock');
Route::get('/buy-it-again', [PageController::class, 'buyItAgain'])->name('page.buy-it-again');
Route::get('/contact-us', [PageController::class, 'contact'])->name('page.contact');
Route::post('/contact-us', [PageController::class, 'storeContact'])->name('contact.store');
Route::get('/exhibition', [PageController::class, 'exhibition'])->name('page.exhibition');
Route::get('/about-us', [PageController::class, 'about'])->name('page.about');
Route::get('/faq', [PageController::class, 'faq'])->name('page.faq');
Route::get('/return-exchange', [PageController::class, 'returnExchange'])->name('page.return-exchange');
Route::get('/blog', [PageController::class, 'blog'])->name('page.blog');
Route::get('/blog/{slug}', [PageController::class, 'blogDetails'])->name('page.blog.details');
Route::get('/terms-conditions', [PageController::class, 'terms'])->name('page.terms');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('page.privacy');
Route::get('/new-arrivals', [NewArrivalsController::class, 'index'])->name('page.new-arrivals');
Route::get('/18kt', [EighteenKTController::class, 'index'])->name('page.18kt');
Route::get('/tattsvisfavourite', [TattsvisFavouriteController::class, 'index'])->name('page.tattsvisfavourite');

// Product Details
Route::post('/products', [ProductController::class, 'index'])->name('products.index.post');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.details');
Route::resource('products', ProductController::class)->except(['store']); // Exclude store to avoid conflict
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/reviews', [App\Http\Controllers\Frontend\ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

// AJAX Helpers
Route::get('/ajax/products/category/{id}', [ProductController::class, 'fetchByCategory'])
    ->name('ajax.products.category');
Route::get('/ajax/search-suggestions', [ProductController::class, 'searchSuggestions'])
    ->name('ajax.search.suggestions');

/*
|--------------------------------------------------------------------------
| CART & CHECKOUT
|--------------------------------------------------------------------------
*/
// Cart (Publicly accessible actions)
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Checkout (Auth Required)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success'); // Pass order ID

    Route::get('/checkout/address', [CheckoutController::class, 'address'])->name('checkout.address');
    Route::get('/checkout/address/create', [CheckoutController::class, 'createAddress'])->name('checkout.address.create');
    Route::post('/checkout/address', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');
    Route::get('/checkout/address/{id}/edit', [CheckoutController::class, 'editAddress'])->name('checkout.address.edit');
    Route::put('/checkout/address/{id}', [CheckoutController::class, 'updateAddress'])->name('checkout.address.update');
    Route::delete('/checkout/address/{id}', [CheckoutController::class, 'destroyAddress'])->name('checkout.address.destroy');
    Route::get('/checkout/select-address/{id}', [CheckoutController::class, 'selectAddress'])->name('checkout.select-address');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    // The original `processOrder` route is replaced by the new `process` route above.
    // Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');

    // Cart Index (Protected)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/my-cart', [CartController::class, 'headerIndex'])->name('cart.header');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/my-wishlist', [WishlistController::class, 'headerIndex'])->name('wishlist.header');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

/*
|--------------------------------------------------------------------------
| USER ACCOUNT ROUTES
|--------------------------------------------------------------------------
*/

// Authentication (Login/Register/Password Reset)
require __DIR__ . '/auth.php';

// Authenticated User Dashboard
Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('frontend.dashboard');

    // })->name('dashboard');

    Route::get('/orders', function () {
        $orders = Auth::user()->orders()->latest()->get();
        return view('frontend.orders.index', compact('orders'));
    })->name('orders.index');



    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| UTILITIES (Dev Tools)
|--------------------------------------------------------------------------
*/
Route::get('/fix-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return "Cache Cleared";
});

// Force Password Reset Utility (Keep only if strictly needed in dev)
Route::get('/force-fix-password', function () {
    $user = \App\Models\User::where('email', 'kjaydeep842@gmail.com')->first();
    if (!$user)
        return 'User not found!';
    $user->password = bcrypt('123456789');
    $user->save();
    return 'Admin password reset successfully!';
});
