<div class="flex-1 overflow-y-auto p-5 space-y-6">
    <!-- New Arrivals -->
    <div class="mobile-dropdown group">
        <button
            class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
            onclick="toggleMobileDropdown('menu-new-arrivals', this)">
            New Arrivals <i
                class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
        </button>
        <div id="menu-new-arrivals" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
            <!-- Links omitted for brevity as per original file, or added if present in original -->
            <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Diamond Rings</a>
            <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Gold Necklaces</a>
        </div>
    </div>

    <!-- Best Seller -->
    <div class="mobile-dropdown">
        <button
            class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
            onclick="toggleMobileDropdown('menu-best-seller', this)">
            Best Seller <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
        </button>
        <div id="menu-best-seller" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
            <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Top Rated</a>
        </div>
    </div>

    <!-- Ready To Stock -->
    <div class="mobile-dropdown">
        <button
            class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
            onclick="toggleMobileDropdown('menu-ready-stock', this)">
            Ready To Stock <i
                class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
        </button>
        <div id="menu-ready-stock" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
            <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Necklaces</a>
        </div>
    </div>

    <!-- Buy It Again -->
    <div class="mobile-dropdown">
        <button
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
            onclick="toggleMobileDropdown('menu-buy-again', this)">
            Buy It Again <i
                class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
        </button>
        <div id="menu-buy-again" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
            <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Previously Ordered</a>
        </div>
    </div>

    <!-- Contact Us & Others -->
    <div class="mobile-dropdown">
        <button
            class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
            onclick="toggleMobileDropdown('menu-contact', this)">
            Contact Us <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
        </button>
    </div>
</div>
<!-- Footer Info -->
<div class="bg-gray-50 p-5 border-t border-gray-100">
    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
        <span><i class="fa-solid fa-flag-usa mr-2"></i> USA (USD)</span>
    </div>
    <a href="#"
        class="block w-full bg-black text-white text-center py-3 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#5C4522] transition-colors">Sign
        In / Register</a>
</div>