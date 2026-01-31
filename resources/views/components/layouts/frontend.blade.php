<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LuxeGems') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .font-serif {
            family-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Lato', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-gray-800 antialiased bg-white selection:bg-[#D4AF37] selection:text-white">

    <!-- Header / Navigation -->
    <header x-data="{ mobileMenuOpen: false, searchOpen: false }"
        class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-[#D4AF37]/20 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-gray-800 hover:text-[#D4AF37] focus:outline-none transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div
                    class="flex-shrink-0 flex items-center justify-center md:justify-start w-full md:w-auto absolute md:static left-0">
                    <a href="{{ route('home') }}" class="group flex items-center gap-2">
                        <!-- Placeholder Logo Icon -->
                        <div
                            class="w-8 h-8 bg-[#D4AF37] text-white flex items-center justify-center rounded-sm font-serif font-bold text-xl group-hover:bg-gray-900 transition-colors">
                            L
                        </div>
                        <span
                            class="font-serif text-2xl font-bold tracking-wider text-gray-900 group-hover:text-[#D4AF37] transition-colors">
                            LUXE<span class="text-[#D4AF37] group-hover:text-gray-900 transition-colors">GEMS</span>
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}"
                        class="uppercase text-sm font-bold tracking-widest text-gray-900 hover:text-[#D4AF37] transition-colors border-b-2 border-transparent hover:border-[#D4AF37] py-1">Home</a>
                    <a href="#"
                        class="uppercase text-sm font-bold tracking-widest text-gray-600 hover:text-[#D4AF37] transition-colors border-b-2 border-transparent hover:border-[#D4AF37] py-1">Rings</a>
                    <a href="#"
                        class="uppercase text-sm font-bold tracking-widest text-gray-600 hover:text-[#D4AF37] transition-colors border-b-2 border-transparent hover:border-[#D4AF37] py-1">Necklaces</a>
                    <a href="#"
                        class="uppercase text-sm font-bold tracking-widest text-gray-600 hover:text-[#D4AF37] transition-colors border-b-2 border-transparent hover:border-[#D4AF37] py-1">Best
                        Sellers</a>
                </nav>

                <!-- Right Icons -->
                <div class="hidden md:flex items-center space-x-6">
                    <!-- Search -->
                    <button @click="searchOpen = !searchOpen"
                        class="text-gray-600 hover:text-[#D4AF37] transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Account -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-[#D4AF37] transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#D4AF37] transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}"
                        class="text-gray-600 hover:text-[#D4AF37] transition-colors relative">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-[#D4AF37] text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount ?? 0 }}</span>
                    </a>
                </div>

                <!-- Mobile Actions (Cart only) -->
                <div class="flex items-center md:hidden">
                    <a href="{{ route('cart.index') }}"
                        class="text-gray-600 hover:text-[#D4AF37] transition-colors relative">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-[#D4AF37] text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount ?? 0 }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Bar Overlay -->
        <div x-show="searchOpen" x-transition.opacity
            class="absolute top-20 left-0 w-full bg-white border-b border-gray-100 p-4 shadow-lg"
            @click.away="searchOpen = false" x-cloak>
            <div class="max-w-3xl mx-auto relative">
                <input type="text" placeholder="Search for jewelry..."
                    class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-none focus:outline-none focus:border-[#D4AF37] font-serif">
                <button class="absolute right-3 top-2.5 text-gray-400 hover:text-[#D4AF37]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition.origin.top class="md:hidden bg-white border-b border-gray-100"
            @click.away="mobileMenuOpen = false" x-cloak>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-900 bg-gray-50 border-l-4 border-[#D4AF37]">Home</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37] hover:bg-gray-50 border-l-4 border-transparent hover:border-[#D4AF37]">Rings</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37] hover:bg-gray-50 border-l-4 border-transparent hover:border-[#D4AF37]">Necklaces</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37] hover:bg-gray-50 border-l-4 border-transparent hover:border-[#D4AF37]">Best
                    Sellers</a>
                <div class="border-t border-gray-200 my-2"></div>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37]">My Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37]">Logout</a>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37]">Log In</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-[#D4AF37]">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20 min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#111] text-white pt-16 pb-8 border-t border-[#D4AF37]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 text-sm">
                <!-- Brand -->
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="block font-serif text-2xl font-bold tracking-wider text-white">
                        LUXE<span class="text-[#D4AF37]">GEMS</span>
                    </a>
                    <p class="text-gray-400 leading-relaxed max-w-xs">
                        Crafting eternal moments with the finest gemstones and precious metals. Experience luxury that
                        lasts forever.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Social Icons Placeholders -->
                        <a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors"><span
                                class="sr-only">Facebook</span>FB</a>
                        <a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors"><span
                                class="sr-only">Instagram</span>IG</a>
                        <a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors"><span
                                class="sr-only">Twitter</span>TW</a>
                    </div>
                </div>

                <!-- Shop -->
                <div>
                    <h3 class="font-serif text-lg text-white mb-6 tracking-wide">Shop</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">All Jewelry</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Engagement
                                Rings</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Necklaces &
                                Pendants</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Earrings</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Bracelets</a></li>
                    </ul>
                </div>

                <!-- Customer Care -->
                <div>
                    <h3 class="font-serif text-lg text-white mb-6 tracking-wide">Customer Care</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Shipping &
                                Returns</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Size Guide</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors">Track Order</a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="font-serif text-lg text-white mb-6 tracking-wide">Stay Updated</h3>
                    <p class="text-gray-400 mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form class="space-y-2">
                        <input type="email" placeholder="Enter your email"
                            class="w-full bg-[#222] border-none text-white focus:ring-1 focus:ring-[#D4AF37] placeholder-gray-500 py-3 px-4">
                        <button type="button"
                            class="w-full bg-[#D4AF37] text-black font-bold uppercase tracking-widest py-3 px-4 hover:bg-[#b08d26] transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-gray-800 text-center text-gray-500 text-xs">
                <p>&copy; {{ date('Y') }} LuxeGems. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>