<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // robust admin detection:
        // - path checks
        // - route prefix (if route exists)
        // - route name prefix
        $pathIsAdmin = $request->is('admin') || $request->is('admin/*') || str_starts_with($request->getPathInfo(), '/admin');
        $routePrefix = $request->route()?->getPrefix() ?? '';
        $routeName = $request->route()?->getName() ?? '';
        $routeIsAdmin = str_starts_with($routePrefix, 'admin') || str_starts_with($routeName, 'admin.');

        if ($pathIsAdmin || $routeIsAdmin) {
            return route('admin.login');
        }

        return route('login');
    }
}
