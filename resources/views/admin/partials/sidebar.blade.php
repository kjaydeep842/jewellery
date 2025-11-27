<aside class="w-64 bg-white shadow-md h-screen sticky top-0 flex flex-col">

    {{-- TOP SECTION --}}
    <div class="p-6 flex items-center space-x-2 border-b">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-6 w-6 text-indigo-500" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2l4 7H8l4-7zm0 2.75L9.25 9h5.5L12 4.75zM4 14l8 8 8-8H4z"/>
        </svg>
        <h2 class="text-xl font-semibold text-gray-700">Admin Panel</h2>
    </div>

    {{-- DYNAMIC MENU --}}
    @php
    $menu = [
        [
            'name' => 'Dashboard',
            'icon' => '📊',
            'route' => 'admin.dashboard',
        ],
        [
            'name' => 'Products',
            'icon' => '💎',
            'route' => 'admin.products.index',
        ],
        [
            'name' => 'Categories',
            'icon' => '📁',
            'route' => 'admin.categories.index',
        ],
        [
            'name' => 'Subcategories',
            'icon' => '📂',
            'route' => 'admin.subcategories.index',
        ],
        [
            'name' => 'Tags',
            'icon' => '🏷️',
            'route' => 'admin.tags.index',
        ],
        [
            'name' => 'Orders',
            'icon' => '🛒',
            'route' => 'admin.orders.index',
        ],
        [
            'name' => 'Users',
            'icon' => '👥',
            'route' => 'admin.users.index',
        ],
        [
            'name' => 'Banners',
            'icon' => '🖼️',
            'route' => 'admin.banners.index',
        ],
    ];
@endphp


    <nav class="flex-1 p-4 space-y-2">
        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}"
                class="flex items-center px-4 py-2 rounded-lg
                {{ request()->routeIs($item['route']) 
                    ? 'bg-indigo-100 text-indigo-600' 
                    : 'text-gray-600' }}
                hover:bg-indigo-100 hover:text-indigo-600">

                <span>{{ $item['icon'] }} {{ $item['name'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- LOGOUT --}}
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left text-red-600 hover:text-red-800 font-medium">
                Logout
            </button>
        </form>
    </div>

</aside>
