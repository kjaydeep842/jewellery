<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ShapeController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ReturnExchangeController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OurStoryController;
use App\Http\Controllers\Admin\StyleController;
use App\Http\Controllers\Admin\FeatureController;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LegalPageController;

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| REDIRECT /admin TO LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (AUTH + ADMIN MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Resources
        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubcategoryController::class);
        Route::resource('tags', TagController::class);

        // Product Import Routes
        Route::get('products/import', [\App\Http\Controllers\Admin\ProductImportController::class, 'showImportForm'])->name('products.import');
        Route::post('products/import', [\App\Http\Controllers\Admin\ProductImportController::class, 'processImport'])->name('products.import.process');
        Route::get('products/import/template', [\App\Http\Controllers\Admin\ProductImportController::class, 'downloadTemplate'])->name('products.import.template');

        Route::resource('products', AdminProductController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('styles', StyleController::class);
        Route::resource('shapes', ShapeController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('diamond_qualities', \App\Http\Controllers\Admin\DiamondQualityController::class);
        Route::resource('metal_colors', \App\Http\Controllers\Admin\MetalColorController::class);
        Route::resource('sizes', \App\Http\Controllers\Admin\SizeController::class);
        Route::resource('metals', \App\Http\Controllers\Admin\MetalController::class);
        Route::resource('units', \App\Http\Controllers\Admin\UnitController::class);
        Route::resource('colors', \App\Http\Controllers\Admin\ColorController::class);

        // Customer Service
        Route::resource('faqs', FaqController::class);
        Route::resource('returns', ReturnExchangeController::class);
        Route::resource('contacts', ContactController::class);

        // About Us
        Route::resource('our_stories', OurStoryController::class);
        Route::resource('blogs', BlogController::class);

        // AJAX / Custom Operations
        Route::get('categories/{category}/subcategories', [SubcategoryController::class, 'byCategory'])->name('categories.subcategories');
        Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggleStatus'])->name('banners.toggle');
        Route::patch('styles/{style}/toggle', [\App\Http\Controllers\Admin\StyleController::class, 'toggleStatus'])->name('styles.toggle');
        Route::patch('features/{feature}/toggle', [\App\Http\Controllers\Admin\FeatureController::class, 'toggleStatus'])->name('features.toggle');
        Route::patch('our_stories/{our_story}/toggle', [\App\Http\Controllers\Admin\OurStoryController::class, 'toggleStatus'])->name('our_stories.toggle');
        Route::patch('faqs/{faq}/toggle', [FaqController::class, 'toggleStatus'])->name('faqs.toggle');
        Route::patch('returns/{return}/toggle', [ReturnExchangeController::class, 'toggleStatus'])->name('returns.toggle');
        Route::patch('brands/{brand}/toggle', [BrandController::class, 'toggleStatus'])->name('brands.toggle');
        Route::patch('blogs/{blog}/toggle', [BlogController::class, 'toggleStatus'])->name('blogs.toggle');

        // Legal Pages (Terms & Privacy)
        Route::resource('legal-pages', LegalPageController::class);
        Route::patch('legal-pages/{legal_page}/toggle', [LegalPageController::class, 'toggleStatus'])->name('legal-pages.toggle');

        Route::patch('diamond_qualities/{diamond_quality}/toggle', [\App\Http\Controllers\Admin\DiamondQualityController::class, 'toggleStatus'])->name('diamond_qualities.toggle');
        Route::patch('metal_colors/{metal_color}/toggle', [\App\Http\Controllers\Admin\MetalColorController::class, 'toggleStatus'])->name('metal_colors.toggle');
        Route::patch('sizes/{size}/toggle', [\App\Http\Controllers\Admin\SizeController::class, 'toggleStatus'])->name('sizes.toggle');
        Route::patch('metals/{metal}/toggle', [\App\Http\Controllers\Admin\MetalController::class, 'toggleStatus'])->name('metals.toggle');
        Route::patch('units/{unit}/toggle', [\App\Http\Controllers\Admin\UnitController::class, 'toggleStatus'])->name('units.toggle');
        Route::patch('colors/{color}/toggle', [\App\Http\Controllers\Admin\ColorController::class, 'toggleStatus'])->name('colors.toggle');

        // Notifications
        Route::get('notifications/mark-read', [AdminController::class, 'markNotificationsRead'])->name('notifications.markRead');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
