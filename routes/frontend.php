<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC MARKETPLACE ROUTES
|--------------------------------------------------------------------------
*/

// Home & Static Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/filter-products', [HomeController::class, 'filterProducts'])->name('home.filter');

// Product Details
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.details');
Route::resource('products', ProductController::class); // Fallback resource if needed

// AJAX Helpers
Route::get('/ajax/products/category/{id}', [ProductController::class, 'fetchByCategory'])
    ->name('ajax.products.category');

/*
|--------------------------------------------------------------------------
| CART & CHECKOUT
|--------------------------------------------------------------------------
*/
// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Checkout (Auth Required)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/address', [CheckoutController::class, 'address'])->name('checkout.address');
    Route::post('/checkout/address', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');
    Route::get('/checkout/select-address/{id}', [CheckoutController::class, 'selectAddress'])->name('checkout.select-address');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
});

/*
|--------------------------------------------------------------------------
| USER ACCOUNT ROUTES
|--------------------------------------------------------------------------
*/

// Authentication (Login/Register/Password Reset)
require __DIR__ . '/auth.php';

// Authenticated User Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/orders', function () {
        return view('orders.index');
    })->name('orders.index');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

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
    if (!$user) return 'User not found!';
    $user->password = bcrypt('123456789');
    $user->save();
    return 'Admin password reset successfully!';
});
