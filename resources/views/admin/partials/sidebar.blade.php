<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    style="background-color: {{ $settings->secondary_color ?? '#000000' }};"
    class="fixed inset-y-0 left-0 z-[60] w-64 bg-zinc-950 text-amber-50 shadow-2xl transition-transform duration-300 ease-in-out border-r border-zinc-800 flex flex-col">

    {{-- TOP SECTION --}}
    <div style="background-color: rgba(0,0,0,0.2);"
        class="h-20 flex items-center justify-between px-6 border-b border-zinc-800 relative">
        <div class="flex items-center space-x-3">
            <!-- Logo Image -->
            @if($settings->logo_path)
            <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="{{ $settings->site_name }}"
                class="h-10 w-auto object-contain drop-shadow-[0_0_10px_rgba(234,179,8,0.5)]">
            @else
            <img src="{{ asset('img/logo.png') }}" alt="{{ $settings->site_name }}"
                class="h-10 w-auto object-contain drop-shadow-[0_0_10px_rgba(234,179,8,0.5)]">
            @endif

            <h2
                class="text-xl font-bold bg-gradient-to-r from-amber-200 via-amber-400 to-amber-600 bg-clip-text text-transparent tracking-wide">
                {{ $settings->site_name ?? 'LuxeGems' }}
            </h2>
        </div>

        {{-- Close Button for Mobile --}}
        <button @click="sidebarOpen = false" class="md:hidden text-zinc-400 hover:text-white focus:outline-none">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- DYNAMIC MENU --}}
    @php
    $menu = [
    [
    'name' => 'Dashboard',
    'route' => 'admin.dashboard',
    'path' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
    ],
    [
    'name' => 'Products',
    'route' => 'admin.products.index',
    'path' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
    ],
    [
    'name' => 'Categories',
    'route' => 'admin.categories.index',
    'path' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'
    ],
    [
    'name' => 'Subcategories',
    'route' => 'admin.subcategories.index',
    'path' => 'M4 6h16M4 10h16M4 14h16M4 18h16'
    ],
    [
    'name' => 'Tags',
    'route' => 'admin.tags.index',
    'path' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'
    ],
    [
    'name' => 'Orders',
    'route' => 'admin.orders.index',
    'path' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'
    ],
    [
    'name' => 'Users',
    'route' => 'admin.users.index',
    'path' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'
    ],
    [
    'name' => 'Banners',
    'route' => 'admin.banners.index',
    'path' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'
    ],
    [
    'name' => 'Unique Styles',
    'route' => 'admin.styles.index',
    'path' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'
    ],
    [
    'name' => 'Shapes',
    'route' => 'admin.shapes.index',
    'path' => 'M12 2L2 12l10 10 10-10L12 2z'
    ],
    [
    'name' => 'General Settings',
    'route' => 'admin.settings.index',
    'path' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
    ]
    ];
    @endphp

    <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
        <p class="px-3 text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Main Menu</p>
        @foreach ($menu as $item)
        <a href="{{ route($item['route']) }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300
                            {{ request()->routeIs($item['route'])
            ? 'bg-gradient-to-r from-amber-600 to-amber-500 text-black shadow-[0_0_15px_rgba(245,158,11,0.4)] border border-amber-400/50'
            : 'text-zinc-400 hover:bg-zinc-900 hover:text-amber-400 hover:border-l-4 hover:border-amber-500' }}">

            <svg class="mr-3 h-5 w-5 {{ request()->routeIs($item['route']) ? 'text-black' : 'text-zinc-500 group-hover:text-amber-400' }} transition-colors"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['path'] }}" />
            </svg>

            {{ $item['name'] }}
        </a>
        @endforeach
    </nav>

    {{-- LOGOUT --}}
    <div class="p-4 border-t border-zinc-800 bg-black/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-2 text-sm text-zinc-400 hover:text-red-400 hover:bg-zinc-900 rounded-lg transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-3 text-zinc-500 group-hover:text-red-500 transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Sign Out
            </button>
        </form>
    </div>

</aside>