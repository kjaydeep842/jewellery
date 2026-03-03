<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('general_settings')) {
            $settings = \App\Models\GeneralSetting::first();
            \Illuminate\Support\Facades\View::share('settings', $settings);
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
            $categories = \App\Models\Category::all();
            \Illuminate\Support\Facades\View::share('categories', $categories);
        }

        \Illuminate\Support\Facades\View::composer(['components.layouts.frontend', 'frontend.partials.header'], function ($view) {

            $cartCount = 0;
            $wishlistCount = 0;

            if (\Illuminate\Support\Facades\Auth::check()) {
                $userId = \Illuminate\Support\Facades\Auth::id();

                // Cart Count
                $cart = \App\Models\Cart::where('user_id', $userId)
                    ->where('status', 'active')
                    ->first();
                $cartCount = $cart ? $cart->items()->sum('quantity') : 0;

                // Wishlist Count
                $wishlistCount = \App\Models\Wishlist::where('user_id', $userId)->count();

            } else {
                // Cart Count for Guest
                $sessionId = session()->get('cart_session_id');
                if ($sessionId) {
                    $cart = \App\Models\Cart::where('session_id', $sessionId)
                        ->where('status', 'active')
                        ->first();
                    $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
                }
            }

            $view->with('cartCount', $cartCount);
            $view->with('wishlistCount', $wishlistCount);

            // Top Search Categories with product images
            $topSearchCategories = \App\Models\Category::whereHas('products', function ($q) {
                $q->where('status', 'active');
            })->take(6)->get()->map(function ($cat) {
                $product = $cat->products()->where('status', 'active')->whereNotNull('image')->first();
                $cat->product_image = $product ? $product->image : null;
                return $cat;
            });
            $view->with('topSearchCategories', $topSearchCategories);
        });
    }
}
