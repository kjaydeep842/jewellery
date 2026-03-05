<div class="relative inline-block text-left sort-dropdown-container">
    <button type="button"
        class="sort-button group inline-flex justify-between items-center min-w-[200px] px-4 py-2.5 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-200 rounded-md focus:outline-none transition-all shadow-sm"
        aria-expanded="true" aria-haspopup="true">
        <span class="flex items-center">
            <span class="text-gray-500 mr-2 font-normal hidden sm:inline">Sort by:</span>
            <span class="selected-sort-text text-gray-900 font-medium">
                @switch(request('sort'))
                    @case('price_low_high') Price: Low to High @break
                    @case('price_high_low') Price: High to Low @break
                    @case('popularity') Popularity @break
                    @default What's New
                @endswitch
            </span>
        </span>
        <i class="sort-icon fa-solid fa-chevron-down ml-3 text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200"></i>
    </button>

    <div class="sort-menu hidden absolute right-0 mt-2 w-[220px] rounded-md shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 origin-top-right transform transition-all duration-200 ease-in-out"
        role="menu" aria-orientation="vertical" tabindex="-1">
        <div class="py-1" role="none">
            <a href="#" data-sort="newest"
                class="sort-item text-gray-700 block px-4 py-3 text-sm hover:bg-orange-50 hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors"
                role="menuitem" tabindex="-1">What's New</a>
            <a href="#" data-sort="popularity"
                class="sort-item text-gray-700 block px-4 py-3 text-sm hover:bg-orange-50 hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors"
                role="menuitem" tabindex="-1">Popularity</a>
            <a href="#" data-sort="price_high_low"
                class="sort-item text-gray-700 block px-4 py-3 text-sm hover:bg-orange-50 hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors"
                role="menuitem" tabindex="-1">Price: High to Low</a>
            <a href="#" data-sort="price_low_high"
                class="sort-item text-gray-700 block px-4 py-3 text-sm hover:bg-orange-50 hover:text-[#CBA65A] transition-colors"
                role="menuitem" tabindex="-1">Price: Low to High</a>
        </div>
    </div>
</div>
