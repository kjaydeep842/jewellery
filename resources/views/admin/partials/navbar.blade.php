<header class="flex items-center justify-between bg-white px-6 py-3 shadow-sm">
    <h1 class="text-2xl font-semibold text-gray-700">@yield('title', 'Dashboard')</h1>

    <div class="flex items-center space-x-3">
        <span class="text-gray-600">Hello, {{ Auth::user()->name }}</span>
        <div class="w-9 h-9 flex items-center justify-center bg-indigo-600 text-white rounded-full">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
    </div>
</header>
