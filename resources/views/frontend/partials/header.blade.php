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
<div id="header-placeholder">
    <header class="bg-white z-50 shadow-sm w-full transition-all duration-300">
        <div id="header-main-container"
            class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-y-4 lg:gap-0 transition-all duration-300">
            <div id="header-logo-section" class="flex items-center gap-2 order-1 transition-all duration-300">
                <button id="mobile-menu-btn" class="lg:hidden mr-1  text-gray-800 hover:text-[#B39359]">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div
                    class="w-[212px] h-[68px] min-[2000px]:w-[350px] min-[2000px]:h-auto flex items-center justify-center transition-all duration-300">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/logo_black.png') }}" alt="logo"
                            class="w-full h-auto transition-all duration-300">
                    </a>
                </div>

            </div>

            <div id="header-search-section"
                class="flex-grow max-w-xl w-full lg:w-1/2 order-3 lg:order-2 transition-all duration-300">
                <div class="relative group w-full max-w-[445px] mx-auto flex flex-row items-center justify-between p-[20px_29px] gap-[10px] h-[65px] bg-[#F2F2F3] border border-transparent focus-within:border-[#B39359]/30 rounded-[100px] transition-all duration-300"
                    id="search-container">
                    <input type="text" id="search-input"
                        class="flex-grow bg-transparent border-none outline-none text-[20px] font-Outfit text-center placeholder:text-[#A2A2A9] text-[#A2A2A9] leading-none min-[2000px]:text-2xl transition-all"
                        placeholder="Search for products">
                    <button id="search-btn"
                        class="flex-shrink-0 text-gray-400 group-focus-within:text-[#B39359] transition-all duration-300">
                        <img src="{{ asset('assets/ic_search.png') }}" alt="search"
                            class="w-6 h-6 min-[2000px]:w-8 min-[2000px]:h-8">
                    </button>
                    <!-- Search Dropdown (Hidden by default) -->
                    <div id="search-dropdown"
                        class="absolute top-full left-1/2 -translate-x-1/2 w-[90vw] max-w-[600px] h-[334px] bg-white rounded-[4px] border-[1.5px] border-[#D7D7DA] mt-4 hidden z-[60] overflow-y-auto overflow-x-hidden shadow-sm flex flex-col">

                        <div id="search-default-view">
                            <!-- Trending Searches Header -->
                            <div
                                class="flex flex-row items-center p-4 w-full h-[55px] box-border justify-between flex-shrink-0">
                                <h3
                                    class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide whitespace-nowrap">
                                    Trending Searches</h3>
                            </div>

                            <!-- Trending Chips -->
                            <div class="px-4 pb-4 flex flex-wrap gap-4 flex-shrink-0">
                                <button data-search="Gold"
                                    class="search-trending-btn flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] w-[91px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                    <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                        <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                    </div>
                                    <span
                                        class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Gold</span>
                                </button>
                                <button data-search="Rose Gold"
                                    class="search-trending-btn flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                    <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                        <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                    </div>
                                    <span
                                        class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Rose
                                        Gold</span>
                                </button>
                                <button data-search="Silver"
                                    class="search-trending-btn flex flex-row justify-center items-center p-[12px_20px_12px_12px] gap-[4px] h-[44px] bg-[#F2F2F3] rounded-[12px] hover:bg-[#E5E5E5] transition-colors group">
                                    <div class="w-[11.25px] h-[6.25px] flex items-center justify-center">
                                        <i class="fa-solid fa-arrow-trend-up text-[10px] text-[#B39359]"></i>
                                    </div>
                                    <span
                                        class="text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium whitespace-nowrap">Silver</span>
                                </button>
                            </div>

                            <!-- Top Searches Header -->
                            <div class="flex flex-row items-center px-4 pt-2 w-full box-border flex-shrink-0">
                                <h3 class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide">Top Searches
                                </h3>
                            </div>

                            <!-- Top Searches Items Container -->
                            <div
                                class="flex flex-row flex-wrap items-center content-start p-[14px_16px] gap-[12px] w-full min-h-[152px] box-border flex-shrink-0">
                                <!-- Item 1 -->
                                <button data-search="Mangalsutra"
                                    class="search-top-btn flex items-center gap-2.5  border border-[#E6E6E6]  hover:border-[#D4AF37] rounded-2xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
                                    <div
                                        class="w-[36px] h-[36px] rounded bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center group-hover:bg-white transition-colors">
                                        <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                            class="w-9 h-9 object-contain mix-blend-multiply">
                                    </div>
                                    <span
                                        class="text-[#1A1A1A] font-['Outfit'] text-[13px] font-medium group-hover:text-[#5C4522] whitespace-nowrap tracking-tight">Mangalsutra</span>
                                </button>

                                <!-- Item 2 -->
                                <button data-search="Rings"
                                    class="search-top-btn flex items-center gap-2.5 border border-[#E6E6E6] hover:border-[#D4AF37] rounded-xl p-1.5 pr-2 transition-all bg-white hover:shadow-md group h-[60px] w-[133px] flex-none">
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

                        <!-- Suggestions View (Hidden by default) - Preserved for JS Compatibility -->
                        <div id="search-suggestions-view" class="hidden w-full h-full flex-col">
                            <!-- Suggestions Header -->
                            <div class="px-5 py-4">
                                <h3 class="text-[#8B7E66] text-xs font-['Outfit'] uppercase tracking-wide">Suggestions
                                </h3>
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

                <!-- Hidden Search Form for POST submission -->
                <form id="searchForm" action="{{ route('products.index.post') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="search" id="searchFormInput" value="">
                </form>
            </div>

            <div id="header-icons-section"
                class="flex items-center h-[68px] gap-[20px] min-[2000px]:gap-8 text-gray-600 order-2 lg:order-3 transition-all duration-300">
                @auth
                    <div class="relative inline-block text-left" id="user-menu-container">
                        <button id="user-menu-btn" class="hover:text-gold focus:outline-none flex items-center">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ Auth::user()->profile_picture_url }}" alt="user"
                                    class="w-5 h-5 min-[2000px]:w-8 min-[2000px]:h-8 rounded-full object-cover">
                            @else
                                <div
                                    class="w-8 h-8 min-[2000px]:w-8 min-[2000px]:h-8 rounded-full bg-[#EFE4CD] flex items-center justify-center text-[8px] min-[2000px]:text-[12px] font-bold text-[#000000] uppercase border border-[#EADDCC]">
                                    {{ Auth::user()->initials }}
                                </div>
                            @endif
                        </button>

                        <!-- Dropdown menu for authenticated users -->
                        <div id="user-dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-[0px_4px_20px_0px_rgba(0,0,0,0.1)] ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden transform transition-all duration-200 origin-top-right">
                            <div class="py-1">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-['Outfit'] font-semibold text-[#1A1A1A]">{{ Auth::user()->name }}
                                    </p>
                                    @if(Auth::user()->phone)
                                        <p class="text-xs font-['Outfit'] text-gray-500">{{ Auth::user()->phone }}</p>
                                    @endif
                                </div>

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-3 text-sm text-[#1A1A1A] hover:bg-[#F2F2F2] transition-colors font-['Outfit'] font-medium">
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('frontend.auth.logout') }}">
                                    @csrf
                                    <a href="{{ route('frontend.auth.logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block px-4 py-3 text-sm text-red-600 hover:bg-[#F2F2F2] transition-colors font-['Outfit'] font-medium border-t border-gray-100">
                                        Logout
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('frontend.auth.mobile') }}" class="hover:text-gold flex items-center">
                        <img src="{{ asset('assets/ic_User.png') }}" alt="user"
                            class="w-5 h-5 min-[2000px]:w-8 min-[2000px]:h-8">
                    </a>
                @endauth

                <a href="{{ route('wishlist.header') }}" class="relative hover:text-gold">
                    <img src="{{ asset('assets/ic_wishlist.png') }}" alt="wishlist"
                        class="w-5 h-5 min-[2000px]:w-8 min-[2000px]:h-8">
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-[9px] min-[2000px]:text-sm min-[2000px]:w-6 min-[2000px]:h-6 rounded-full w-4 h-4 flex items-center justify-center">{{ $wishlistCount ?? 0 }}</span>
                </a>
                <a href="{{ route('cart.header') }}" class="relative hover:text-gold block">
                    <img src="{{ asset('assets/ic_bag_black.png') }}" alt="bag"
                        class="w-5 h-5 min-[2000px]:w-8 min-[2000px]:h-8"><span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-[9px] min-[2000px]:text-sm min-[2000px]:w-6 min-[2000px]:h-6 rounded-full w-4 h-4 flex items-center justify-center"
                        id="header-cart-count">{{ $cartCount ?? 0 }}</span>
                </a>
            </div>
        </div>
        <!-- Navigation Bar -->

        <nav id="main-navigation"
            class="hidden lg:flex items-center justify-center space-x-3 lg:space-x-4 min-[2000px]:space-x-12 text-[12px] lg:text-[13px] xl:text-[15px] min-[2000px]:text-2xl font-['Outfit'] font-medium tracking-wide transition-all duration-300">
            <div class="relative group">
                <a href="{{ route('page.new-arrivals') }}" class="flex items-center gap-1 hover:text-gold py-4">New
                    Arrivals</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.best-seller') }}" class="flex items-center gap-1 hover:text-gold py-4">Best
                    Seller</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.18kt') }}" class="flex items-center gap-1 hover:text-gold py-4">18KT
                    Jewellery</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.tattsvisfavourite') }}"
                    class="flex items-center gap-1 hover:text-gold py-4">Tattsvi's Favourite</a>
            </div>
            {{-- <div class="relative group">
                <a href="{{ route('page.exhibition') }}"
                    class="flex items-center gap-1 hover:text-gold py-4">Exhibition</a>
            </div> --}}
            <div class="relative group">
                <a href="{{ route('page.readytostock') }}" class="flex items-center gap-1 hover:text-gold py-4">Ready To
                    Stock</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.contact') }}" class="flex items-center gap-1 hover:text-gold py-4">Contact
                    Us</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.about') }}" class="flex items-center gap-1 hover:text-gold py-4">About Us</a>
            </div>
        </nav>
    </header>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const header = document.querySelector('header');
            const placeholder = document.getElementById('header-placeholder');
            const headerMainContainer = document.getElementById('header-main-container');
            const mainNav = document.getElementById('main-navigation');
            const searchSection = document.getElementById('header-search-section');
            const iconsSection = document.getElementById('header-icons-section');
            const logoSection = document.getElementById('header-logo-section');
            const logoImg = logoSection ? logoSection.querySelector('img') : null;
            const logoContainer = logoSection ? logoSection.querySelector('div') : null;

            let lastScrollTop = 0;
            const threshold = 40;
            const delta = 5;

            // Add transition to logo for smooth resizing
            if (logoImg) logoImg.classList.add('transition-all', 'duration-300');
            if (logoContainer) logoContainer.classList.add('transition-all', 'duration-300');

            function updateHeader() {
                const st = window.scrollY;

                // Make sure they scroll more than delta
                if (Math.abs(lastScrollTop - st) <= delta)
                    return;

                if (st > threshold) {
                    // We are scrolled past the top

                    // Ensure Fixed Positioning
                    if (!header.classList.contains('fixed')) {
                        if (placeholder) placeholder.style.height = header.offsetHeight + 'px';
                        header.classList.remove('relative');
                        header.classList.add('fixed', 'top-0', 'left-0');
                    }

                    // ALWAYS COMPACT (Scrolling Down OR Up, as long as not at top)
                    // Hide Search & Icons
                    if (searchSection) searchSection.classList.add('hidden');
                    if (iconsSection) iconsSection.classList.add('hidden');

                    // Shrink Logo (Targeting the container width)
                    if (logoContainer) {
                        logoContainer.classList.remove('w-[212px]', 'h-[68px]');
                        logoContainer.classList.add('w-[140px]', 'h-auto');
                    }

                    // --- NEW: INLINE LAYOUT ---
                    // Force header to be a flex row container, CENTERED
                    header.classList.add('flex', 'flex-row', 'flex-nowrap', 'items-center', 'justify-center', 'px-6', 'gap-10');

                    if (headerMainContainer) {
                        // Collapse the main container to just fit the logo
                        headerMainContainer.classList.remove('mx-auto', 'py-4', 'max-w-[1600px]', 'px-6', 'flex-wrap');
                        headerMainContainer.classList.add('w-auto', 'p-0', 'flex-nowrap');
                        // Ensure it doesn't take full width
                        headerMainContainer.style.width = 'auto';
                    }

                    if (mainNav) {
                        // Move nav to the LEFT (remove justify-center), keep normal visibility (hidden on mobile, flex on desktop)
                        mainNav.classList.remove('justify-center');
                        // Do NOT remove 'hidden' or force 'flex' indiscriminately. relying on existing classes.
                    }
                } else {
                    // AT TOP
                    // Reset Fixed Positioning
                    if (header.classList.contains('fixed')) {
                        header.classList.remove('fixed', 'top-0', 'left-0');
                        header.classList.add('relative');
                        if (placeholder) placeholder.style.height = 'auto';
                    }

                    // Show All
                    if (searchSection) searchSection.classList.remove('hidden');
                    if (iconsSection) iconsSection.classList.remove('hidden');

                    // Restore Logo
                    if (logoContainer) {
                        logoContainer.classList.add('w-[212px]', 'h-[68px]');
                        logoContainer.classList.remove('w-[140px]', 'h-auto');
                    }

                    // --- RESET LAYOUT ---
                    header.classList.remove('flex', 'flex-row', 'flex-nowrap', 'items-center', 'justify-center', 'px-6', 'gap-10');

                    if (headerMainContainer) {
                        headerMainContainer.classList.add('mx-auto', 'py-4', 'max-w-[1600px]', 'px-6', 'flex-wrap');
                        headerMainContainer.classList.remove('w-auto', 'p-0', 'flex-nowrap');
                        headerMainContainer.style.width = '';
                    }
                    if (mainNav) {
                        mainNav.classList.add('justify-center');
                    }
                }

                lastScrollTop = st;
            }

            window.addEventListener('scroll', function () {
                updateHeader();
            });
        });
    </script>
@endpush