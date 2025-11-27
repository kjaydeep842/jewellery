<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {

            // If user is logged in
            if (Auth::guard($guard)->check()) {

                //  If admin user logged in -> go to admin dashboard
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.dashboard');
                }

                //  Normal user redirect to user dashboard
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
