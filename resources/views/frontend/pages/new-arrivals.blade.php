@extends('frontend.layouts.master')

@section('content')
<!-- New Arrivals Banner -->
<section class="w-full bg-[#EFE4CD] py-8 md:py-10">
    <div class="w-full px-4 md:px-8 text-center">
        <h1 class="text-3xl md:text-5xl font-['Outfit'] font-medium text-[#826230] mb-4">New Arrivals</h1>
        <p class="max-w-2xl mx-auto text-sm md:text-base text-[#3D3D42] font-['Outfit'] leading-relaxed">
            Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
        </p>
    </div>
</section>

<!-- Main Content : All Collection -->
<main class="w-full px-4 md:px-6 py-8 font-['Alexandria'] flex flex-col gap-2.5">

    <!-- Breadcrumb & Title -->
    <div class="w-full flex flex-col gap-1 self-start">
        <div class="text-[11px] uppercase tracking-widest text-[#888891] font-bold mb-1 font-['Outfit']">
            <a href="{{ route('home') }}" class="text-[#888891] cursor-pointer transition-colors">Home</a> / <span
                class="text-[#0D0D0E]">New Arrivals</span>
        </div>
        <div class="text-[13px] text-[#888891] font-['Inter']">
            Showing : {{ $products->total() }} Products
        </div>
    </div>

    <!-- Layout: Sidebar + Grid -->
    <div class="w-full flex flex-col lg:flex-row gap-8 mt-4 relative">

        <!-- Mobile Filter Button (Visible < lg) -->
        <div class="lg:hidden flex justify-between items-center mb-6">
            <button id="mobile-filter-btn" class="flex items-center gap-2 text-gray-900 font-medium text-xs uppercase tracking-widest border border-gray-200 px-5 py-3 rounded-[2px] bg-white hover:bg-gray-50 transition-all font-['Outfit'] shadow-sm">
                <i class="fa-solid fa-sliders text-[##888891]"></i> Filters
            </button>
        </div>

        <!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
        <div id="filter-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity opacity-0"></div>

        <aside id="filter-sidebar" class="fixed inset-y-0 left-0 w-[400px] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:static lg:transform-none lg:w-[280px] lg:block flex-shrink-0 shadow-2xl lg:shadow-none h-full lg:h-auto overflow-y-auto lg:overflow-visible">
            <div class="p-5 lg:p-0">
                <!-- Mobile Header -->
                <div class="flex justify-between items-center pb-4 mb-4 border-gray-100 lg:hidden">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-sliders text-[#888891] text-lg"></i>
                        <span class="text-lg font-bold text-gray-900 uppercase tracking-widest font-['Outfit']">Filters</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <button type="button" class="clear-all-btn text-[11px] font-bold text-[#CBA65A] uppercase tracking-widest hover:text-[#826230] transition-colors font-['Outfit']">
                            Clear All
                        </button>
                        <button id="close-filter-btn" class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-xmark text-2xl"></i>
                        </button>
                    </div>
                </div>

                <form id="filterForm" action="{{ route('page.new-arrivals') }}" method="GET">
                    <!-- Preserve Sort -->
                    @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- Filter Header (Desktop) -->
                    <div class="hidden lg:flex items-center justify-between pb-4 mb-6 border-gray-100 font-['Outfit']">
                        <div class="flex items-center gap-2.5 text-gray-900 font-medium text-lg uppercase tracking-widest">
                            <i class="fa-solid fa-sliders text-[#888891]"></i> Filters
                        </div>
                        <button type="button" class="clear-all-btn text-[11px] font-bold text-[#CBA65A] uppercase tracking-widest hover:text-[#826230] transition-colors">
                            Clear All
                        </button>
                    </div>

                    <!-- Filter Item: Category -->
                    @if(count($categories) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Category</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="category[]" value="{{ $category }}"
                                    {{ in_array($category, request('category', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $category }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Gender -->
                    @if(count($genders) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Gender</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($genders as $gender)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="gender[]" value="{{ $gender }}"
                                    {{ in_array($gender, request('gender', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ ucfirst($gender) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Metal Color -->
                    @if(count($metalColors) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Metal Color</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($metalColors as $color)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="metal_color[]" value="{{ $color }}"
                                    {{ in_array($color, request('metal_color', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $color }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Metal Purity -->
                    @if(count($metalPurities) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Metal Purity</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($metalPurities as $purity)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="metal_purity[]" value="{{ $purity }}"
                                    {{ in_array($purity, request('metal_purity', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $purity }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Diamond Shape -->
                    @if($shapes->count() > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Diamond Shape</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($shapes as $index => $shape)
                            <label class="flex items-center gap-3 cursor-pointer group {{ $index >= 5 ? 'hidden extra-shape' : '' }}">
                                <input type="checkbox" name="diamond_shape[]" value="{{ $shape }}"
                                    {{ in_array($shape, request('diamond_shape', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $shape }}</span>
                            </label>
                            @endforeach

                            @if($shapes->count() > 5)
                            <button type="button" class="text-[11px] font-medium text-[#CBA65A] uppercase tracking-wider hover:underline mt-2 ml-7 view-more-shapes">
                                + View More
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Size -->
                    @if(count($sizes) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Size</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 filter-content hidden">
                            <div class="grid grid-cols-5 gap-1.5">
                                @foreach($sizes as $size)
                                <label class="relative flex items-center justify-center aspect-square">
                                    <input type="checkbox" name="size[]" value="{{ $size }}"
                                        {{ in_array($size, request('size', [])) ? 'checked' : '' }}
                                        class="filter-checkbox sr-only peer">
                                    <span class="w-full h-full flex items-center justify-center text-[10px] sm:text-xs border border-gray-200 rounded-[2px] cursor-pointer hover:border-[#CBA65A] peer-checked:bg-[#CBA65A] peer-checked:text-white peer-checked:border-[#CBA65A] transition-all select-none font-['Inter'] text-gray-600">{{ $size }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Weight Range -->
                    @if(count($weightRanges) > 0)
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Weight Range</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            @foreach($weightRanges as $value => $label)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="weight[]" value="{{ $value }}"
                                    {{ in_array($value, request('weight', [])) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Price Range -->
                    <div class="border-gray-100 py-3.5 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-900 text-[15px] uppercase tracking-tight">Price Range</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-2.5 filter-content hidden">
                            <!-- Price Checkboxes -->
                            @php
                            $priceRanges = [
                            '₹ 0 - ₹ 10,000',
                            '₹ 10,000 - ₹ 20,000',
                            '₹ 20,000 - ₹ 30,000',
                            '₹ 30,000 - ₹ 40,000',
                            '₹ 40,000 - ₹ 50,000',
                            '₹ 50,000 - ₹ 100,000'
                            ];
                            @endphp
                            @foreach($priceRanges as $range)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="price[]" value="{{ $range }}"
                                    {{ is_array(request('price')) && in_array($range, request('price')) ? 'checked' : '' }}
                                    class="filter-checkbox w-3.5 h-3.5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer price-checkbox">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors font-['Inter']">{{ $range }}</span>
                            </label>
                            @endforeach

                            <!-- Custom Price Slider -->
                            <div class="px-2 mt-6">
                                <label class="text-[12px] font-bold text-gray-900 uppercase tracking-widest mb-4 block font-['Outfit']">Custom Price</label>
                                <div class="price-slider-container w-full pt-4 pb-2">
                                    <div class="relative w-full h-[2px] bg-gray-100 rounded-full">
                                        <div id="price-track" class="absolute h-full bg-[#CBA65A] rounded-full"></div>
                                        <input type="range" id="min-price-input" min="0" max="100000" value="{{ request('min_price', 0) }}" step="1000"
                                            class="absolute w-full h-[2px] bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-3.5 [&::-webkit-slider-thumb]:h-3.5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-sm">
                                        <input type="range" id="max-price-input" min="0" max="100000" value="{{ request('max_price', 100000) }}" step="1000"
                                            class="absolute w-full h-[2px] bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-3.5 [&::-webkit-slider-thumb]:h-3.5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-sm">
                                    </div>
                                    <div class="flex justify-between items-center mt-5">
                                        <span id="min-price-display" class="font-medium text-[13px] text-gray-800 font-['Inter']">₹ 0</span>
                                        <span id="max-price-display" class="font-medium text-[13px] text-gray-800 font-['Inter']">₹ 100,000+</span>
                                    </div>
                                    <!-- Hidden Inputs for Form Submission -->
                                    <input type="hidden" name="min_price" id="hidden-min-price" value="{{ request('min_price', 0) }}">
                                    <input type="hidden" name="max_price" id="hidden-max-price" value="{{ request('max_price', 100000) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Apply Button -->
                    <div class="mt-8 lg:hidden">
                        <button type="button" onclick="document.getElementById('filterForm').submit();" class="w-full bg-[#826230] text-white py-3.5 rounded-[2px] font-bold text-sm uppercase tracking-widest hover:bg-[#6d5228] transition-colors font-['Outfit']">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="flex-grow">
            <!-- Sort By -->
            <div class="flex justify-end mb-8 relative z-30">
                <div class="relative inline-block text-left" id="sort-dropdown-container">
                    <!-- Changed from button to div for better compatibility -->
                    <div id="sort-trigger" onclick="toggleSortMenu(event)"
                        class="group inline-flex justify-between items-center min-w-[210px] px-5 py-2.5 bg-white text-sm font-medium text-gray-800 hover:bg-gray-50 border border-gray-200 rounded-[2px] cursor-pointer transition-all shadow-sm font-['Outfit'] select-none">
                        <span class="flex items-center pointer-events-none">
                            <span class="text-gray-400 mr-2 font-normal text-xs uppercase tracking-wider">Sort by:</span>
                            <span id="selected-sort" class="text-gray-900 font-medium tracking-tight">
                                @switch(request('sort'))
                                @case('price_low_high') Price: Low to High @break
                                @case('price_high_low') Price: High to Low @break
                                @case('popularity') Popularity @break
                                @default What's New
                                @endswitch
                            </span>
                        </span>
                        <i class="fa-solid fa-chevron-down ml-3 text-[10px] text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-300 pointer-events-none"
                            id="sort-icon"></i>
                    </div>

                    <div id="sort-menu"
                        class="hidden absolute right-0 mt-2 w-[210px] rounded-[2px] shadow-2xl bg-white border border-gray-100 focus:outline-none z-50 origin-top-right transform transition-all duration-300 ease-in-out"
                        style="display: none;"> <!-- Added inline style for safer toggling -->
                        <div class="py-1">
                            <div onclick="selectSort('newest', `What's New`)"
                                class="sort-item cursor-pointer text-gray-700 block px-5 py-3 text-sm hover:bg-[#FCFBF7] hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors font-['Inter']">
                                What's New
                            </div>
                            <div onclick="selectSort('popularity', 'Popularity')"
                                class="sort-item cursor-pointer text-gray-700 block px-5 py-3 text-sm hover:bg-[#FCFBF7] hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors font-['Inter']">
                                Popularity
                            </div>
                            <div onclick="selectSort('price_high_low', 'Price: High to Low')"
                                class="sort-item cursor-pointer text-gray-700 block px-5 py-3 text-sm hover:bg-[#FCFBF7] hover:text-[#CBA65A] border-b border-gray-50 last:border-0 transition-colors font-['Inter']">
                                Price: High to Low
                            </div>
                            <div onclick="selectSort('price_low_high', 'Price: Low to High')"
                                class="sort-item cursor-pointer text-gray-700 block px-5 py-3 text-sm hover:bg-[#FCFBF7] hover:text-[#CBA65A] transition-colors font-['Inter']">
                                Price: Low to High
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Container -->
            <div id="products-container">
                @include('frontend.pages.partials.products-grid')
            </div>
        </div>

    </div>
</main>

<!-- Know More Section -->
<div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
    <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
</div>

<!-- Loader Overlay -->
<div id="page-loader" class="fixed inset-0 bg-white/80 z-[9999] flex items-center justify-center hidden backdrop-blur-sm">
    <div class="flex flex-col items-center">
        <img src="{{ asset('assets/logo_black.png') }}" alt="Tattsvi" class="w-32 h-auto animate-pulse grayscale opacity-20">
        <div class="mt-4 border-t-2 border-b-2 border-[#CBA65A] rounded-full w-8 h-8 animate-spin"></div>
    </div>
</div>

<script>
    // Global functions for direct access from HTML onclick attributes
    function toggleSortMenu(event) {
        if (event) event.stopPropagation();
        const menu = document.getElementById('sort-menu');
        const icon = document.getElementById('sort-icon');

        if (menu.style.display === 'none' || menu.classList.contains('hidden')) {
            menu.style.display = 'block';
            menu.classList.remove('hidden');
            if (icon) icon.style.transform = 'rotate(180deg)';
        } else {
            menu.style.display = 'none';
            menu.classList.add('hidden');
            if (icon) icon.style.transform = 'rotate(0deg)';
        }
    }

    function selectSort(value, label) {
        const selectedSortText = document.getElementById('selected-sort');
        const filterForm = document.getElementById('filterForm');

        if (selectedSortText) selectedSortText.textContent = label;

        // Update form input
        if (filterForm) {
            let sortInput = filterForm.querySelector('input[name="sort"]');
            if (!sortInput) {
                sortInput = document.createElement('input');
                sortInput.type = 'hidden';
                sortInput.name = 'sort';
                filterForm.appendChild(sortInput);
            }
            sortInput.value = value;

            // Trigger products update
            // We dispatch a custom event or call the update function if available
            // Since functions inside DOMContentLoaded aren't global, we'll implement the update logic here or rely on the form change
            // But for sort, we usually want immediate update

            // Close menu
            toggleSortMenu();

            // Trigger the update logic
            if (typeof window.updateProductsGlobal === 'function') {
                window.updateProductsGlobal();
            } else {
                // Fallback if global function not set yet
                filterForm.dispatchEvent(new Event('change'));
            }
        }
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const container = document.getElementById('sort-dropdown-container');
        if (container && !container.contains(e.target)) {
            const menu = document.getElementById('sort-menu');
            const icon = document.getElementById('sort-icon');
            if (menu) {
                menu.style.display = 'none';
                menu.classList.add('hidden');
            }
            if (icon) {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        /**
         * Core Elements
         */
        const filterForm = document.getElementById('filterForm');
        const productsContainer = document.getElementById('products-container');
        const loader = document.getElementById('page-loader');

        // Expose update function globally
        window.updateProductsGlobal = () => {
            if (loader) loader.classList.remove('hidden');
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData);

            const newUrl = `${window.location.pathname}?${params.toString()}`;
            window.history.pushState({
                path: newUrl
            }, '', newUrl);

            fetch(`${filterForm.action}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    productsContainer.innerHTML = html;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    if (loader) loader.classList.add('hidden');
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    if (loader) loader.classList.add('hidden');
                });
        };

        // Mobile Filter Elements
        const mobileFilterBtn = document.getElementById('mobile-filter-btn');
        const closeFilterBtn = document.getElementById('close-filter-btn');
        const filterSidebar = document.getElementById('filter-sidebar');
        const filterOverlay = document.getElementById('filter-overlay');

        function openMobileFilters() {
            if (filterSidebar && filterOverlay) {
                filterSidebar.classList.remove('-translate-x-full');
                filterOverlay.classList.remove('hidden');
                setTimeout(() => filterOverlay.classList.remove('opacity-0'), 10);
                document.body.style.overflow = 'hidden';
            }
        }

        function closeMobileFilters() {
            if (filterSidebar && filterOverlay) {
                filterSidebar.classList.add('-translate-x-full');
                filterOverlay.classList.add('opacity-0');
                setTimeout(() => {
                    filterOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        if (mobileFilterBtn) mobileFilterBtn.addEventListener('click', openMobileFilters);
        if (closeFilterBtn) closeFilterBtn.addEventListener('click', closeMobileFilters);
        if (filterOverlay) filterOverlay.addEventListener('click', closeMobileFilters);

        // Accordion
        document.querySelectorAll('.filter-accordion-header').forEach(header => {
            header.addEventListener('click', function() {
                const container = this.closest('.filter-container');
                const content = container ? container.querySelector('.filter-content') : null;
                const icon = this.querySelector('.accordion-icon');
                if (content) content.classList.toggle('hidden');
                if (icon) icon.classList.toggle('rotate-180');
            });
        });

        // Extras
        document.querySelectorAll('.view-more-shapes').forEach(btn => {
            btn.addEventListener('click', function() {
                const container = this.closest('.filter-content');
                if (container) {
                    container.querySelectorAll('.extra-shape').forEach(s => s.classList.toggle('hidden'));
                    this.textContent = this.textContent.trim() === '+ View More' ? '- View Less' : '+ View More';
                }
            });
        });

        // Price Slider
        const minPriceInput = document.getElementById('min-price-input');
        const maxPriceInput = document.getElementById('max-price-input');
        const minPriceDisplay = document.getElementById('min-price-display');
        const maxPriceDisplay = document.getElementById('max-price-display');
        const priceTrack = document.getElementById('price-track');
        const hiddenMinPrice = document.getElementById('hidden-min-price');
        const hiddenMaxPrice = document.getElementById('hidden-max-price');

        if (minPriceInput && maxPriceInput && priceTrack) {
            const updatePriceSlider = () => {
                const min = parseInt(minPriceInput.value);
                const max = parseInt(maxPriceInput.value);
                const range = parseInt(maxPriceInput.max) - parseInt(maxPriceInput.min);
                if (min > max - 1000) minPriceInput.value = max - 1000;

                const percent1 = ((minPriceInput.value - minPriceInput.min) / range) * 100;
                const percent2 = ((maxPriceInput.value - maxPriceInput.min) / range) * 100;

                priceTrack.style.left = percent1 + '%';
                priceTrack.style.width = (percent2 - percent1) + '%';

                if (minPriceDisplay) minPriceDisplay.textContent = '₹ ' + parseInt(minPriceInput.value).toLocaleString();
                if (maxPriceDisplay) maxPriceDisplay.textContent = '₹ ' + parseInt(maxPriceInput.value).toLocaleString() + (maxPriceInput.value == maxPriceInput.max ? '+' : '');

                if (hiddenMinPrice) hiddenMinPrice.value = minPriceInput.value;
                if (hiddenMaxPrice) hiddenMaxPrice.value = maxPriceInput.value;
            };

            updatePriceSlider();
            minPriceInput.addEventListener('input', updatePriceSlider);
            maxPriceInput.addEventListener('input', updatePriceSlider);

            const timerUpdate = () => {
                document.querySelectorAll('.price-checkbox').forEach(cb => cb.checked = false);
                if (window.innerWidth >= 1024) window.updateProductsGlobal();
            };
            minPriceInput.addEventListener('change', timerUpdate);
            maxPriceInput.addEventListener('change', timerUpdate);
        }

        // Clear all
        document.querySelectorAll('.clear-all-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                filterForm.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
                if (minPriceInput) {
                    minPriceInput.value = minPriceInput.min;
                    maxPriceInput.value = maxPriceInput.max;
                    if (priceTrack) { // visual reset
                        priceTrack.style.left = '0%';
                        priceTrack.style.width = '100%';
                    }
                    if (hiddenMinPrice) hiddenMinPrice.value = minPriceInput.min;
                    if (hiddenMaxPrice) hiddenMaxPrice.value = maxPriceInput.max;
                    if (minPriceDisplay) minPriceDisplay.textContent = '₹ ' + parseInt(minPriceInput.min).toLocaleString();
                    if (maxPriceDisplay) maxPriceDisplay.textContent = '₹ ' + parseInt(maxPriceInput.max).toLocaleString() + '+';
                }
                if (window.innerWidth < 1024) closeMobileFilters();
                window.updateProductsGlobal();
            });
        });

        // Filter Form Change
        if (filterForm) {
            filterForm.addEventListener('change', function(e) {
                if (e.target.classList.contains('filter-checkbox')) {
                    if (window.innerWidth >= 1024) window.updateProductsGlobal();
                }
            });
        }

        // Pagination
        document.addEventListener('click', function(e) {
            const paginationLink = e.target.closest('.pagination a');
            if (paginationLink) {
                e.preventDefault();
                if (loader) loader.classList.remove('hidden');

                window.history.pushState({
                    path: paginationLink.href
                }, '', paginationLink.href);

                fetch(paginationLink.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        productsContainer.innerHTML = html;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        if (loader) loader.classList.add('hidden');
                    });
            }
        });

    });
</script>
@endsection