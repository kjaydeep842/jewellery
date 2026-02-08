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

        <div class="flex-grow max-w-xl w-full lg:w-1/2 order-3 lg:order-2 relative z-50">
            <div class="relative group w-full max-w-[500px] mx-auto">
                <!-- Search Input Container -->
                <div id="search-container" class="relative w-full">
                    <input type="text" id="search-input"
                        class="w-full h-[50px] min-[2000px]:h-[70px] bg-gray-100 border border-transparent focus:border-[#B39359]/30 focus:bg-white rounded-full py-2 pl-5 pr-12 text-sm min-[2000px]:text-2xl transition-all outline-none font-['Outfit'] shadow-sm"
                        placeholder="Search for products">

                    <!-- Close/Clear Icon (Hidden by default) -->
                    <button id="search-clear-btn"
                        class="absolute right-12 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                        <i class="fa-solid fa-circle-xmark text-lg"></i>
                    </button>

                    <!-- Search Icon -->
                    <button id="search-icon-btn"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#B39359]">
                        <img src="{{ asset('assets/ic_search.png') }}" alt="search"
                            class="w-5 h-5 min-[2000px]:w-8 min-[2000px]:h-8">
                    </button>
                </div>

                <style>
                    /* Custom Scrollbar for Search Dropdown */
                    #search-dropdown::-webkit-scrollbar {
                        width: 4px;
                    }

                    #search-dropdown::-webkit-scrollbar-track {
                        background: transparent;
                    }

                    #search-dropdown::-webkit-scrollbar-thumb {
                        background-color: #D7D7DA;
                        border-radius: 20px;
                    }
                </style>
                <!-- Search Dropdown (Hidden by default) -->
                <div id="search-dropdown"
                    class="absolute top-full left-1/2 -translate-x-1/2 w-[600px] h-[334px] bg-white rounded-[4px] border-[1.5px] border-[#D7D7DA] mt-4 hidden z-[60] overflow-y-auto overflow-x-hidden shadow-sm flex flex-col">

                    <!-- Default View (Trending & Top Searches) -->
                    <div id="search-default-view">
                        <!-- Trending Searches Header -->
                        <div
                            class="flex flex-row items-center p-4 w-[600px] h-[55px] box-border justify-between flex-shrink-0">
                            <h3
                                class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide whitespace-nowrap">
                                Trending Searches</h3>
                        </div>

                        <!-- Trending Chips -->
                        <div class="px-4 pb-4 flex flex-wrap gap-4 flex-shrink-0">
                            <button
                                class="flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] w-[91px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                    <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Gold</span>
                            </button>
                            <button
                                class="flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                    <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Rose
                                    Gold</span>
                            </button>
                            <button
                                class="flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                    <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Silver</span>
                            </button>
                        </div>

                        <!-- Top Searches Header -->
                        <div class="flex flex-row items-center px-4 pt-2 w-[600px] box-border flex-shrink-0">
                            <h3 class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide">Top Searches</h3>
                        </div>

                        <!-- Top Searches Items Container -->
                        <div
                            class="flex flex-row flex-wrap items-center content-start p-[14px_16px] gap-[12px] w-[600px] min-h-[152px] box-border flex-shrink-0">
                            <!-- Item 1 -->
                            <button
                                class="flex items-center gap-2.5  border border-[#E6E6E6]  hover:border-[#D4AF37] rounded-2xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Mangalsutra</span>
                            </button>

                            <!-- Item 2 -->
                            <button
                                class="flex items-center gap-2.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply gap-4 ">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Rings</span>
                            </button>

                            <!-- Item 3 -->
                            <button
                                class="flex items-center gap-1.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Rings</span>
                            </button>

                            <!-- Item 4 -->
                            <button
                                class="flex items-center gap-2.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Rings</span>
                            </button>

                            <!-- Item 5 -->
                            <button
                                class="flex items-center gap-2.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Rings</span>
                            </button>

                            <!-- Item 6 -->
                            <button
                                class="flex items-center gap-2.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                <div
                                    class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                        class="w-9 h-9 object-contain mix-blend-multiply">
                                </div>
                                <span
                                    class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Rings</span>
                            </button>
                        </div>
                    </div>

                    <!-- Suggestions View (Hidden by default) -->
                    <div id="search-suggestions-view" class="hidden w-full h-full flex-col">
                        <!-- Suggestions Header -->
                        <div class="px-5 py-4">
                            <h3 class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide">Suggestions</h3>
                        </div>

                        <!-- Suggestions List -->
                        <div id="suggestions-list" class="flex-1 flex flex-col overflow-y-auto">
                            <!-- Dynamic Content -->
                        </div>

                        <!-- Search For Footer -->
                        <button id="search-for-btn"
                            class="w-full px-5 py-4 mt-auto border-t border-gray-100 flex items-center justify-between hover:bg-gray-50 transition-colors group bg-[#FFFCF8]">
                            <span class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium">Search For "<span
                                    id="search-query-text" class="font-semibold"></span>"</span>
                            <i
                                class="fa-solid fa-arrow-right text-gray-400 group-hover:text-[#B39359] transition-colors"></i>
                        </button>
                    </div>
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