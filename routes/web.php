    <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    /*
    |--------------------------------------------------------------------------
    | FRONT CONTROLLERS
    |--------------------------------------------------------------------------
    */
    // use App\Http\Controllers\ProductController;
    use App\Http\Controllers\Frontend\ProductFrontendController;


    /*
    |--------------------------------------------------------------------------
    | AUTH + PROFILE CONTROLLERS
    |--------------------------------------------------------------------------
    */
    use App\Http\Controllers\ProfileController;

    /*
    |--------------------------------------------------------------------------
    | ADMIN CONTROLLERS
    |--------------------------------------------------------------------------
    */
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\SubcategoryController;
    use App\Http\Controllers\Admin\TagController;
    use App\Http\Controllers\Admin\ProductController as AdminProductController;
    use App\Http\Controllers\Admin\OrderController as AdminOrderController;
    use App\Http\Controllers\Admin\UserController as AdminUserController;
    use App\Http\Controllers\Admin\AuthController;

    /*
    |--------------------------------------------------------------------------
    | PUBLIC ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return view('home');
    });


    
    /*
    |--------------------------------------------------------------------------
    | Frontend side Route 
    |--------------------------------------------------------------------------
    */



    Route::get('/product-details', [ProductFrontendController::class, 'details'])
         ->name('product.details');




    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER AUTH PROFILE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/productsss', [ProductController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);

    Route::get('/orders', function () {
        return view('orders.index');
    })->middleware(['auth'])->name('orders.index');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AUTH ROUTES (NO AUTH REQUIRED)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/login', [AuthController::class, 'showLoginForm'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.submit');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });

    /*
    |--------------------------------------------------------------------------
    | FIX: Ensure /admin redirects to /admin/login instead of /login
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

            // Category CRUD
            Route::resource('categories', CategoryController::class);

            // Subcategory CRUD
            Route::resource('subcategories', SubcategoryController::class);

            // Tag CRUD
            Route::resource('tags', TagController::class);

            // Product CRUD
            Route::resource('products', AdminProductController::class);

            // Order CRUD
            Route::resource('orders', AdminOrderController::class);

            // User CRUD
            Route::resource('users', AdminUserController::class);

            // AJAX - Get subcategories by category
            Route::get('categories/{category}/subcategories', [SubcategoryController::class, 'byCategory'])->name('categories.subcategories');

            Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
            Route::patch('banners/{banner}/toggle', [\App\Http\Controllers\Admin\BannerController::class, 'toggleStatus'])->name('banners.toggle');
        });

    /*
    |--------------------------------------------------------------------------
    | TEST/UTILITY ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/fix-cache', function () {
        Artisan::call('optimize:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
    
        return "Cache Cleared";
    });

    Route::get('/test-auth', function () {
        $creds = [
            'email' => 'kjaydee842@gmail.com',
            'password' => '123456789'
        ];
    
        if (Auth::validate($creds)) {
            return 'VALID LOGIN';
        } else {
            return 'INVALID LOGIN';
        }
    });

    Route::get('/force-fix-password', function () {
        $user = \App\Models\User::where('email', 'kjaydeep842@gmail.com')->first();
    
        if (!$user) {
            return 'User not found!';
        }
    
        $user->password = bcrypt('123456789');
        $user->save();
    
        return 'Admin password reset successfully!';
    });
