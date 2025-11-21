<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Front Side Controllers
use App\Http\Controllers\ProductController;

// Admin Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// 🚀 Fix missing LOGOUT route
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| NORMAL USER ROUTES (already existed — not removed)
|--------------------------------------------------------------------------
*/

Route::get('/productsss', [ProductController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);

Route::get('/orders', function () {
    return view('orders.index');
})->middleware(['auth'])->name('orders.index');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES  (🔥 Added all missing routes)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Admin Products CRUD
        //     Route::resource('products', AdminProductController::class);
        // Admin Products CRUD
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);


        // Admin Orders CRUD
        Route::resource('orders', AdminOrderController::class);

        // Admin Users CRUD
        Route::resource('users', AdminUserController::class);
    });

