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

            <h2 class="text-2xl font-bold tracking-wide"
                style="background: linear-gradient(to right, #fde68a, #f59e0b, #d97706); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent; font-family: 'Inter', sans-serif;">
                {{ $settings->site_name ?? 'Tattsvi' }}
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
    'name' => 'Master',
    'path' => 'M4 6h16M4 10h16M4 14h16M4 18h16',
    'children' => [
    [
    'name' => 'Banners',
    'route' => 'admin.banners.index',
    'path' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'
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
    'name' => 'Brands',
    'route' => 'admin.brands.index',
    'path' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'
    ],
    [
    'name' => 'Tags',
    'route' => 'admin.tags.index',
    'path' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'
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
    'name' => 'Features',
    'route' => 'admin.features.index',
    'path' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
    [
    'name' => 'Diamond Quality',
    'route' => 'admin.diamond_qualities.index',
    'path' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
    ],
    [
    'name' => 'Metal Color',
    'route' => 'admin.metal_colors.index',
    'path' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'
    ],
    [
    'name' => 'Sizes',
    'route' => 'admin.sizes.index',
    'path' => 'M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12'
    ],
    [
    'name' => 'Metals',
    'route' => 'admin.metals.index',
    'path' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
    ],
    [
    'name' => 'Units',
    'route' => 'admin.units.index',
    'path' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'
    ],
    [
    'name' => 'Colors',
    'route' => 'admin.colors.index',
    'path' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'
    ]
    ]
    ],
    [
    'name' => 'Products',
    'route' => 'admin.products.index',
    'path' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'
    ],
    [
    'name' => 'Orders',
    'route' => 'admin.orders.index',
    'path' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'
    ],
    [
    'name' => 'Customer Service',
    'path' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z',
    'children' => [
    [
    'name' => 'FAQs',
    'route' => 'admin.faqs.index',
    'path' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
    [
    'name' => 'Return & Exchange',
    'route' => 'admin.returns.index',
    'path' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'
    ],
    [
    'name' => 'Contact Us',
    'route' => 'admin.contacts.index',
    'path' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
    ],
    [
    'name' => 'Legal Pages',
    'route' => 'admin.legal-pages.index',
    'path' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
    ]
    ]
    ],
    [
    'name' => 'About Us',
    'path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
    'children' => [
    [
    'name' => 'Our Story',
    'route' => 'admin.our_stories.index',
    'path' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
    ],
    [
    'name' => 'Blogs',
    'route' => 'admin.blogs.index',
    'path' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'
    ]
    ]
    ],
    [
    'name' => 'Users',
    'route' => 'admin.users.index',
    'path' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'
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

        {{-- HARDCODED DASHBOARD LINK --}}
        <a href="{{ route('admin.dashboard') }}"
            class="group flex items-center px-4 py-3 text-sm font-medium rounded-2xl transition-all duration-300 mb-1
                  {{ request()->routeIs('admin.dashboard') 
                     ? 'shadow-[0_4px_15px_rgba(234,171,12,0.4)]' 
                     : 'text-zinc-400 hover:bg-white/5 hover:text-white' }}"
            style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #eaab0c; color: black;' : '' }}">
            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? '' : 'text-zinc-500 group-hover:text-white' }}"
                style="{{ request()->routeIs('admin.dashboard') ? 'color: black;' : '' }}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        @foreach ($menu as $item)
        @if (isset($item['children']))

        @php
        $isActive = collect($item['children'])->contains(function($child) {
        // Match main route or resource sub-routes (e.g. admin.features.create)
        $resourceName = \Illuminate\Support\Str::beforeLast($child['route'], '.index');
        return request()->routeIs($child['route']) || request()->routeIs($resourceName . '.*');
        });
        @endphp
        <div x-data="{ open: {{ $isActive ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300
                            {{ $isActive 
                                ? 'shadow-[0_4px_15px_rgba(234,171,12,0.4)]' 
                                : 'text-zinc-400 hover:bg-zinc-900 hover:text-[#eaab0c]' }}"
                style="{{ $isActive ? 'background-color: #eaab0c; color: black;' : '' }}">
                <div class="flex items-center">
                    <svg class="mr-3 h-5 w-5 {{ $isActive ? '' : 'text-zinc-500' }}"
                        style="{{ $isActive ? 'color: black;' : '' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['path'] }}" />
                    </svg>
                    {{ $item['name'] }}
                </div>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200 {{ $isActive ? '' : 'text-zinc-500' }}"
                    style="{{ $isActive ? 'color: black;' : '' }}"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="pl-4 mt-2 space-y-1" x-transition>
                @foreach ($item['children'] as $child)
                @php
                $isChildActive = request()->routeIs($child['route']) || request()->routeIs(\Illuminate\Support\Str::beforeLast($child['route'], '.index') . '.*');

                @endphp
                <a href="{{ route($child['route']) }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-300
                                                 {{ $isChildActive
                                ? 'shadow-[0_2px_10px_rgba(234,171,12,0.3)]'
                                : 'text-zinc-500 hover:text-white hover:bg-white/5' }}"
                    style="{{ $isChildActive ? 'background-color: #eaab0c; color: black;' : '' }}">
                    <svg class="mr-3 h-4 w-4 {{ $isChildActive ? '' : 'text-zinc-600' }} transition-colors"
                        style="{{ $isChildActive ? 'color: black;' : '' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $child['path'] }}" />
                    </svg>
                    {{ $child['name'] }}
                </a>
                @endforeach
            </div>
        </div>
        @else

        <a href="{{ route($item['route']) }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-2xl transition-all duration-300
                                    {{ request()->routeIs($item['route']) || request()->routeIs(\Illuminate\Support\Str::beforeLast($item['route'], '.index') . '.*')
                    ? 'shadow-[0_4px_15px_rgba(234,171,12,0.4)]'
                    : 'text-zinc-400 hover:bg-white/5 hover:text-white' }}"
            style="{{ (request()->routeIs($item['route']) || request()->routeIs(\Illuminate\Support\Str::beforeLast($item['route'], '.index') . '.*')) ? 'background-color: #eaab0c; color: black;' : '' }}">
            <svg class="mr-3 h-5 w-5 {{ (request()->routeIs($item['route']) || request()->routeIs(\Illuminate\Support\Str::beforeLast($item['route'], '.index') . '.*')) ? '' : 'text-zinc-500 group-hover:text-white' }} transition-colors"
                style="{{ (request()->routeIs($item['route']) || request()->routeIs(\Illuminate\Support\Str::beforeLast($item['route'], '.index') . '.*')) ? 'color: black;' : '' }}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['path'] }}" />
            </svg>
            {{ $item['name'] }}
        </a>
        @endif
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