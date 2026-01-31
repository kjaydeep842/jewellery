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

        \Illuminate\Support\Facades\View::composer('components.layouts.frontend', function ($view) {
            $count = 0;
            if (\Illuminate\Support\Facades\Auth::check()) {
                $cart = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())
                    ->where('status', 'active')
                    ->first();
                $count = $cart ? $cart->items()->sum('quantity') : 0;
            } else {
                $sessionId = session()->get('cart_session_id');
                if ($sessionId) {
                    $cart = \App\Models\Cart::where('session_id', $sessionId)
                        ->where('status', 'active')
                        ->first();
                    $count = $cart ? $cart->items()->sum('quantity') : 0;
                }
            }
            $view->with('cartCount', $count);
        });
    }
}
