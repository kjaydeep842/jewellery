<div class="flex-1 overflow-y-auto p-5 space-y-6">
    <!-- New Arrivals -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.new-arrivals') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            New Arrivals
        </a>
    </div>

    <!-- Best Seller -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.best-seller') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            Best Seller
        </a>
    </div>

    <!-- 18KT Jewellery -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.18kt') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            18KT Jewellery
        </a>
    </div>

    <!-- Tattsvi's Favourite -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.tattsvisfavourite') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            Tattsvi's Favourite
        </a>
    </div>

    <!-- Exhibition -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.exhibition') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            Exhibition
        </a>
    </div>

    <!-- Ready To Stock -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.readytostock') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            Ready To Stock
        </a>
    </div>

    <!-- Contact Us -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.contact') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            Contact Us
        </a>
    </div>

    <!-- About Us -->
    <div class="mobile-dropdown">
        <a href="{{ route('page.about') }}"
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50">
            About Us
        </a>
    </div>

    <!-- User Navigation (Integrated) -->
    @auth
        <div class="pt-4 border-t border-gray-100">
            <!-- User Info (Small) -->
            <div class="mb-4 text-xs text-gray-500">
                Logged in as <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
            </div>

            <!-- Profile -->
            <div class="mobile-dropdown">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50 hover:text-[#B39359] transition-colors">
                    <i class="fa-regular fa-user text-lg w-6 text-center"></i>
                    My Profile
                </a>
            </div>

            <!-- Wishlist -->
            <div class="mobile-dropdown mt-4">
                <a href="{{ route('wishlist.index') }}"
                    class="flex items-center gap-3 w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50 hover:text-[#B39359] transition-colors">
                    <i class="fa-regular fa-heart text-lg w-6 text-center"></i>
                    Wishlist
                </a>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('frontend.auth.logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full text-[15px] font-medium tracking-wider text-red-600 pb-2 border-b border-gray-50 hover:text-red-700 transition-colors text-left">
                    <i class="fa-solid fa-arrow-right-from-bracket text-lg w-6 text-center"></i>
                    Logout
                </button>
            </form>
        </div>
    @else
        <div class="pt-4 border-t border-gray-100">
            <!-- Sign In / Register -->
            <div class="mobile-dropdown">
                <a href="{{ route('frontend.auth.mobile') }}"
                    class="flex items-center gap-3 w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50 hover:text-[#B39359] transition-colors">
                    <i class="fa-regular fa-user text-lg w-6 text-center"></i>
                    Sign In / Register
                </a>
            </div>
        </div>
    @endauth
</div>