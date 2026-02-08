<!-- Top Promo Bar -->
<div class="ticker-wrapper">
    <div class="ticker">
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
    </div>
</div>
<!-- Header Section -->
<header class="bg-white sticky top-0 z-50 shadow-sm">
    <div
        class="max-w-7xl mx-auto px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-y-4 lg:gap-0">
        <div class="flex items-center gap-2 order-1">
            <button id="mobile-menu-btn" class="lg:hidden mr-1  text-gray-800 hover:text-[#B39359]">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="w-[212px] h-[46.6px]  flex items-center justify-center">
                <img src="{{ asset('assets/logo_black.png') }}" alt="logo">
            </div>

        </div>

        <div class="flex-grow max-w-xl w-full lg:w-1/2 order-3 lg:order-2">
            <div class="relative group w-full max-w-[350px] mx-auto">
                <input type="text"
                    class="w-full h-[50px] bg-gray-100 border border-transparent focus:border-[#B39359]/30 focus:bg-white rounded-full py-2 pl-5 pr-12 text-sm transition-all outline-none"
                    placeholder="Search for products">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#B39359]">
                    <img src="{{ asset('assets/ic_search.png') }}" alt="search" class="w-5 h-5">
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-5 text-gray-600 order-2 lg:order-3">

            <button class="hover:text-gold"><img src="{{ asset('assets/ic_User.png') }}" alt="user"
                    class="w-5 h-5"></button>
            <a href="{{ route('wishlist.index') }}" class="relative hover:text-gold">
                <img src="{{ asset('assets/ic_wishlist.png') }}" alt="wishlist" class="w-5 h-5">
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-[9px] rounded-full w-4 h-4 flex items-center justify-center">{{ $wishlistCount ?? 0 }}</span>
            </a>
            <a href="{{ route('cart.index') }}" class="relative hover:text-gold">
                <img src="{{ asset('assets/ic_bag_black.png') }}" alt="bag" class="w-5 h-5">
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-[9px] rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount ?? 0 }}</span>
            </a>
        </div>
    </div>
    <!-- Navigation Bar -->


    <nav class="hidden lg:flex items-center justify-center space-x-8 text-[15px] font-medium uppercase tracking-wider">

        <div class="relative group text-center">
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-1 hover:text-gold py-4 focus:outline-none">
                New Arrivals
            </a>
        </div>

        <div class="relative group">
            <a href="{{ route('page.best-seller') }}" class="flex items-center gap-1 hover:text-gold py-4">
                Best Seller
            </a>
        </div>

        <div class="relative group">
            <a href="{{ route('page.ready-to-stock') }}" class="flex items-center gap-1 hover:text-gold py-4">
                Ready To Stock
            </a>
        </div>

        <div class="relative group">
            <a href="{{ route('page.buy-it-again') }}" class="flex items-center gap-1 hover:text-gold py-4">
                Buy It Again
            </a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.contact') }}" class="flex items-center gap-1 hover:text-gold py-4">
                Contact Us
            </a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.exhibition') }}" class="flex items-center gap-1 hover:text-gold py-4">
                Exhibition
            </a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.about') }}" class="flex items-center gap-1 hover:text-gold py-4">
                About Us
            </a>
        </div>
    </nav>
</header>