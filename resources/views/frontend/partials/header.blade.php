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
            class="md:max-w-[720px] lg:max-w-[900px] xl:max-w-[1000px] 2xl:max-w-[1250px] min-[2000px]:max-w-[1450px] mx-auto px-4 sm:px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-2 lg:gap-0 transition-all duration-300">
            <div id="header-logo-section"
                class="flex items-center gap-2 order-1 w-auto lg:flex-1 transition-all duration-300">
                <button id="mobile-menu-btn"
                    class="lg:hidden mr-0 sm:mr-1 text-gray-800 hover:text-[#B39359] flex-shrink-0">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div
                    class="w-[110px] sm:w-[130px] md:w-[180px] lg:w-[212px] h-auto min-[2000px]:w-[350px] flex items-center justify-center transition-all duration-300 flex-shrink-0">
                    <a href="{{ route('home') }}" class="block w-full">
                        <img src="{{ asset('assets/logo_black.png') }}" alt="logo"
                            class="w-full h-auto transition-all duration-300">
                    </a>
                </div>

            </div>

            <div id="header-search-section"
                class="flex-shrink-0 w-full lg:w-auto order-3 lg:order-2 transition-all duration-300 mt-2 lg:mt-0">
                <div class="relative group w-full lg:w-[445px] mx-auto flex flex-row items-center justify-between px-4 sm:px-6 gap-[10px] h-[48px] bg-[#F2F2F3] border border-transparent focus-within:border-[#B39359]/30 rounded-[100px] transition-all duration-300"
                    id="search-container">
                    <input type="text" id="search-input"
                        class="flex-grow bg-transparent border-none outline-none text-[14px] sm:text-[16px] font-Outfit text-left placeholder:text-[#A2A2A9] text-[#A2A2A9] leading-none min-[2000px]:text-xl transition-all"
                        placeholder="Search for products">
                    <button id="search-btn"
                        class="flex-shrink-0 text-gray-400 group-focus-within:text-[#B39359] transition-all duration-300">
                        <img src="{{ asset('assets/ic_search.png') }}" alt="search"
                            class="w-5 h-5 min-[2000px]:w-7 min-[2000px]:h-7">
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
                                class="flex flex-row flex-wrap items-center content-start p-[14px_16px] gap-[8px] w-full min-h-[120px] box-border flex-shrink-0">
                                @if(isset($topSearchCategories) && $topSearchCategories->count() > 0)
                                @foreach($topSearchCategories as $topCat)
                                <button data-search="{{ $topCat->name }}"
                                    class="search-top-btn flex items-center gap-[8px] border border-[#E6E6E6] hover:border-[#D4AF37] rounded-[16px] p-[8px] pr-[12px] transition-all bg-white hover:shadow-md group flex-none">
                                    <div
                                        class="w-[40px] h-[40px] rounded-[8px] bg-[#FAF7F2] flex flex-shrink-0 items-center justify-center overflow-hidden">
                                        @if($topCat->product_image)
                                        <img src="{{ asset('storage/' . $topCat->product_image) }}"
                                            alt="{{ $topCat->name }}"
                                            class="w-full h-full object-contain mix-blend-multiply">
                                        @else
                                        <img src="{{ asset('assets/logo.png') }}" alt="{{ $topCat->name }}"
                                            class="w-5 h-5 object-contain opacity-30">
                                        @endif
                                    </div>
                                    <span
                                        class="text-[#2E2E2E] font-['Outfit'] text-[12px] font-normal group-hover:text-[#5C4522] whitespace-nowrap">{{ $topCat->name }}</span>
                                </button>
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Suggestions View (Hidden by default) -->
                        <div id="search-suggestions-view" class="hidden w-full flex-col">
                            <!-- Suggestions Header -->
                            <div class="px-5 py-3 border-b border-gray-100">
                                <h3 class="text-[#888891] text-[18px] font-['Outfit'] font-normal">Suggestions</h3>
                            </div>

                            <!-- Suggestions List -->
                            <div id="suggestions-list" class="flex-1 flex flex-col overflow-y-auto">
                                <!-- Dynamic suggestion items rendered by JS -->
                            </div>

                            <!-- Search For Footer -->
                            <button id="search-for-btn"
                                class="w-full px-5 py-4 mt-auto border-t border-gray-100 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                                <span class="text-[#1A1A1A] font-['Outfit'] text-[20px] font-medium">Search For "<span
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
                class="flex items-center justify-end gap-[12px] sm:gap-[20px] min-[2000px]:gap-8 text-gray-600 order-2 w-auto lg:order-3 lg:flex-1 transition-all duration-300 flex-shrink-0">
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
            class="hidden lg:flex items-center justify-center flex-nowrap lg:gap-4 xl:gap-5 2xl:gap-[40px] min-[2000px]:gap-12 lg:text-[14px] xl:text-[15px] 2xl:text-[18px] min-[2000px]:text-2xl font-Alexandria font-normal tracking-normal leading-none transition-all duration-300 md:max-w-[720px] lg:max-w-[900px] xl:max-w-[1000px] 2xl:max-w-[1250px] min-[2000px]:max-w-[1450px] mx-auto">
            @foreach($navigationMenus as $menu)
            <div class="relative group">
                <a href="{{ $menu->route_name ? route($menu->route_name) : url($menu->url) }}"
                    class="flex items-center gap-1 text-[#0D0D0E] hover:text-gold py-2 whitespace-nowrap">{{ $menu->title }}</a>
            </div>
            @endforeach
        </nav>
    </header>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        function resetHeaderState() {
            // Return to normal unstuck state
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
                logoContainer.style.width = '';
                logoContainer.classList.remove('py-1');
            }

            // --- RESET LAYOUT ---
            header.classList.remove('flex', 'flex-row', 'flex-nowrap', 'items-center', 'justify-center', 'px-6', 'gap-10');

            if (logoSection) {
                logoSection.classList.remove('lg:ml-14');
            }

            if (headerMainContainer) {
                headerMainContainer.classList.add('mx-auto', 'py-4', 'max-w-[1600px]', 'px-4', 'sm:px-6', 'flex-wrap');
                headerMainContainer.classList.remove('w-auto', 'p-0', 'flex-nowrap', 'py-2');
                headerMainContainer.style.width = '';
            }
            if (mainNav) {
                mainNav.classList.add('justify-center');
            }
        }

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

                // Compact layout on mobile (hide search)
                if (window.innerWidth < 1024) {
                    if (searchSection) searchSection.classList.add('hidden');
                    if (logoContainer) {
                        logoContainer.style.width = '100px';
                    }
                    if (headerMainContainer) {
                        headerMainContainer.classList.remove('py-4');
                        headerMainContainer.classList.add('py-2');
                    }
                }

                // ALWAYS COMPACT (Scrolling Down OR Up, as long as not at top)
                // Only compact layout on desktop screens
                if (window.innerWidth >= 1024) {
                    // Hide Search & Icons
                    if (searchSection) searchSection.classList.add('hidden');
                    if (iconsSection) iconsSection.classList.add('hidden');

                    // Shrink Logo
                    if (logoContainer) {
                        logoContainer.style.width = '140px';
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

                    if (logoSection) {
                        // Move logo little bit right side as requested
                        logoSection.classList.add('lg:ml-14');
                    }

                    if (mainNav) {
                        // Move nav to the LEFT (remove justify-center), keep normal visibility (hidden on mobile, flex on desktop)
                        mainNav.classList.remove('justify-center');
                        // Do NOT remove 'hidden' or force 'flex' indiscriminately. relying on existing classes.
                    }
                }
            } else {
                resetHeaderState();
            }

            lastScrollTop = st;
        }

        window.addEventListener('scroll', function() {
            updateHeader();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth < 1024 && window.scrollY > threshold) {
                resetHeaderState(); // clears compact styles
                // immediately re-apply sticky behavior
                if (placeholder) placeholder.style.height = header.offsetHeight + 'px';
                header.classList.remove('relative');
                header.classList.add('fixed', 'top-0', 'left-0');
            } else if (window.innerWidth < 1024) {
                resetHeaderState();
            } else {
                updateHeader();
            }
        });
    });
</script>
@endpush