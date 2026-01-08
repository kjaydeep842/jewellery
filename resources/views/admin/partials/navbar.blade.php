<header
    class="flex items-center justify-between bg-white/80 backdrop-blur-md px-8 py-4 sticky top-0 z-10 border-b border-gray-100">
    <div class="flex items-center">
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">@yield('title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center space-x-6">
        <!-- Notifications / Search placeholder could go here -->
        <button class="text-slate-400 hover:text-amber-500 transition-colors relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <div class="flex items-center space-x-3 pl-6 border-l border-gray-100">
            <div class="text-right hidden md:block">
                <span class="block text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</span>
                <span class="block text-xs text-slate-500">Administrator</span>
            </div>
            <div
                class="h-10 w-10 flex items-center justify-center bg-gradient-to-r from-slate-700 to-slate-900 text-amber-400 rounded-full shadow-md font-bold text-lg border-2 border-white ring-2 ring-gray-100">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </div>
</header>