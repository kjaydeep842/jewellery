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

// Static Pages
use App\Http\Controllers\Frontend\PageController;
Route::get('/best-seller', [PageController::class, 'bestSeller'])->name('page.best-seller');
Route::get('/ready-to-stock', [PageController::class, 'readyToStock'])->name('page.ready-to-stock');
Route::get('/buy-it-again', [PageController::class, 'buyItAgain'])->name('page.buy-it-again');
Route::get('/contact-us', [PageController::class, 'contact'])->name('page.contact');
Route::get('/exhibition', [PageController::class, 'exhibition'])->name('page.exhibition');
Route::get('/about-us', [PageController::class, 'about'])->name('page.about');
Route::get('/faq', [PageController::class, 'faq'])->name('page.faq');
Route::get('/return-exchange', [PageController::class, 'returnExchange'])->name('page.return-exchange');
Route::get('/blog', [PageController::class, 'blog'])->name('page.blog');

// Product Details
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.details');
Route::resource('products', ProductController::class); // Fallback resource if needed

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
// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
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
    Route::get('/checkout/select-address/{id}', [CheckoutController::class, 'selectAddress'])->name('checkout.select-address');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    // The original `processOrder` route is replaced by the new `process` route above.
    // Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
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
    if (!$user)
        return 'User not found!';
    $user->password = bcrypt('123456789');
    $user->save();
    return 'Admin password reset successfully!';
});
