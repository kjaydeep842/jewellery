@extends('frontend.layouts.master')

@section('content')
<!-- Discover Collection Banner -->
<section class="w-full bg-[#EFE4D6] py-8 md:py-10">
    <div class="max-w-[1600px] mx-auto px-6 text-center">
        <h1 class="text-3xl md:text-5xl font-['Outfit'] font-medium text-[#5C4522] mb-4">Discover our Collection</h1>
        <p class="max-w-2xl mx-auto text-sm md:text-base text-gray-700 font-['Inter'] leading-relaxed">
            Find a new reason to shine with our Solitaires. Explore our wide range of jewelry collections designed to make every moment special.
        </p>
    </div>
</section>

<!-- Main Content : All Collection -->
<main class="w-full max-w-[1600px] mx-auto px-6 py-8 font-['Outfit'] flex flex-col gap-2.5">

    <!-- Breadcrumb & Title -->
    <div class="w-full flex flex-col gap-1 self-start">
        <div class="text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-amber-600 cursor-pointer">Home</a> / <span
                class="text-gray-800 font-medium">Discover our Collection</span>
        </div>
        <div class="text-sm text-gray-500 mt-2">
            Showing : {{ $products->total() }} Products
        </div>
    </div>

    <!-- Layout: Sidebar + Grid -->
    <div class="w-full flex flex-col lg:flex-row gap-8 mt-4 relative">

        <!-- Mobile Filter Button -->
        <div class="lg:hidden flex items-center mb-6">
            <button id="mobile-filter-btn" class="flex items-center gap-2 border border-gray-300 rounded px-5 py-2.5 bg-white text-sm font-['Outfit'] hover:border-[#CBA65A] transition-colors shadow-sm">
                <img src="{{ asset('assets/ic_setting.png') }}" alt="filter" class="w-4 h-4 object-contain opacity-70">
                <span class="font-medium">Filters</span>
            </button>
        </div>

        <div id="filter-backdrop" class="fixed inset-0 bg-black/50 z-[90] hidden transition-opacity duration-300 opacity-0 lg:hidden"></div>

        <aside id="filter-sidebar"
            class="fixed inset-0 z-[100] w-full h-full bg-white transition-transform duration-300 -translate-x-full lg:static lg:w-[280px] lg:h-auto lg:bg-transparent lg:block lg:shadow-none lg:translate-x-0 lg:z-auto flex-shrink-0 flex flex-col">

            <form id="filterForm" action="{{ route('products.index') }}" method="GET" class="h-full flex flex-col">
                <!-- Mobile Header: Back Arrow, Title, Reset -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 lg:hidden flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <button type="button" id="close-filter-btn" class="text-gray-800 hover:text-gray-600 focus:outline-none">
                            <i class="fa-solid fa-arrow-left text-xl"></i>
                        </button>
                        <span class="font-medium text-lg text-gray-800">Filters</span>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800 uppercase">RESET</a>
                </div>

                <!-- Scrollable Content Area -->
                <div class="flex-grow overflow-y-auto p-5 lg:p-0 space-y-6 pb-24 lg:pb-0">
                    <!-- Desktop Filter Header -->
                    <div class="hidden lg:flex items-center gap-2 mb-6 font-semibold text-[18px] text-[#878787] font-['Outfit']">
                        <img src="{{ asset('assets/ic_setting.png') }}" alt="filter" class="w-5 h-5 text-[#878787] object-contain">
                        Filters
                    </div>

                    <!-- Preserve Search -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <!-- Preserve Sort -->
                    <input type="hidden" name="sort" id="hidden-sort" value="{{ request('sort', 'newest') }}">

                    <!-- Filter Item: Category -->
                    @if($categories->count() > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Category</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content {{ is_array(request('category')) && count(request('category')) > 0 ? '' : 'hidden' }}">
                            @foreach($categories as $category)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="category[]" value="{{ $category }}"
                                    {{ is_array(request('category')) && in_array($category, request('category')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $category }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Gender -->
                    @if($genders->count() > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Gender</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
                            @foreach($genders as $gender)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="gender[]" value="{{ $gender }}"
                                    {{ is_array(request('gender')) && in_array($gender, request('gender')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $gender }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Metal Color -->
                    @if($metalColors->count() > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Metal Color</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
                            @foreach($metalColors as $color)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="metal_color[]" value="{{ $color }}"
                                    {{ is_array(request('metal_color')) && in_array($color, request('metal_color')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $color }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Metal Purity -->
                    @if($metalPurities->count() > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Metal Purity</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
                            @foreach($metalPurities as $purity)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="metal_purity[]" value="{{ $purity }}"
                                    {{ is_array(request('metal_purity')) && in_array($purity, request('metal_purity')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $purity }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Diamond Shape -->
                    @if($shapes->count() > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Diamond Shape</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
                            @foreach($shapes as $index => $shape)
                            <label class="flex items-center gap-2 cursor-pointer group {{ $index >= 5 ? 'hidden extra-shape' : '' }}">
                                <input type="checkbox" name="diamond_shape[]" value="{{ $shape }}"
                                    {{ is_array(request('diamond_shape')) && in_array($shape, request('diamond_shape')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $shape }}</span>
                            </label>
                            @endforeach
                            
                            @if($shapes->count() > 5)
                            <button type="button" class="text-xs text-[#CBA65A] hover:underline mt-2 ml-7 view-more-shapes">
                                + View More
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Size -->
                    @if(count($sizes) > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Size</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 filter-content hidden">
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($sizes as $size)
                                <label class="relative flex items-center justify-center">
                                    <input type="checkbox" name="size[]" value="{{ $size }}"
                                        {{ is_array(request('size')) && in_array($size, request('size')) ? 'checked' : '' }}
                                        class="filter-checkbox sr-only peer">
                                    <span class="w-full text-center py-2 text-xs border border-gray-200 rounded-md cursor-pointer hover:border-[#CBA65A] peer-checked:bg-[#CBA65A] peer-checked:text-white peer-checked:border-[#CBA65A] transition-all select-none font-['Outfit']">{{ $size }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Weight Range -->
                    @if(count($weightRanges) > 0)
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Weight Ranges</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
                            @foreach($weightRanges as $value => $label)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="weight[]" value="{{ $value }}"
                                    {{ is_array(request('weight')) && in_array($value, request('weight')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Filter Item: Price -->
                    <div class="pb-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-semibold text-[#1A1A1A] text-[16px] font-['Outfit']">Price Range</span>
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-[#CBA65A] transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-3 space-y-2 filter-content hidden">
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
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="price[]" value="{{ $range }}"
                                    {{ is_array(request('price')) && in_array($range, request('price')) ? 'checked' : '' }}
                                    class="filter-checkbox w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A] price-checkbox">
                                <span class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors font-['Outfit']">{{ $range }}</span>
                            </label>
                            @endforeach

                            <!-- Custom Price Slider -->
                            <div class="px-2 mt-4">
                                <label class="text-sm font-semibold text-gray-800 mb-2 block font-['Outfit']">Custom Price</label>
                                <div class="price-slider-container w-full pt-4 pb-2">
                                    <div class="relative w-full h-1 bg-gray-200 rounded-full">
                                        <div id="price-track" class="absolute h-full bg-[#CBA65A] rounded-full"></div>
                                        <input type="range" id="min-price-input" min="0" max="100000" value="{{ request('min_price', 0) }}" step="1000"
                                            class="absolute w-full h-1 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                                        <input type="range" id="max-price-input" min="0" max="100000" value="{{ request('max_price', 100000) }}" step="1000"
                                            class="absolute w-full h-1 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                                    </div>
                                    <div class="flex justify-between items-center mt-4">
                                        <span id="min-price-display" class="font-medium text-sm text-gray-700 font-['Outfit']">₹ 0</span>
                                        <span id="max-price-display" class="font-medium text-sm text-gray-700 font-['Outfit']">₹ 100,000+</span>
                                    </div>
                                    <input type="hidden" name="min_price" id="hidden-min-price" value="{{ request('min_price', 0) }}">
                                    <input type="hidden" name="max_price" id="hidden-max-price" value="{{ request('max_price', 100000) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Footer: Apply Button -->
                <div class="lg:hidden fixed bottom-0 left-0 w-full p-4 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-10 flex-shrink-0">
                    <button type="button" id="apply-filter-btn" class="w-full bg-[#E35442] hover:bg-[#d04532] text-white font-medium py-3 rounded uppercase tracking-wide transition-colors font-['Outfit']">
                        APPLY
                    </button>
                </div>
            </form>
        </aside>

        <!-- Products Grid -->
        <div class="flex-grow">
            <!-- Sort By -->
            <div class="flex justify-end mb-6 relative z-30">
                <div class="relative group" id="sort-dropdown-container">
                    <button type="button" id="sort-button"
                        class="flex items-center gap-2 border border-gray-300 rounded px-4 py-2 bg-white text-sm font-['Outfit'] hover:border-[#CBA65A] transition-colors focus:outline-none">
                        <span class="text-gray-500">Sort by:</span>
                        <span id="selected-sort" class="text-[#1A1A1A] font-medium">
                            @switch(request('sort'))
                                @case('price_low_high') Price: Low to High @break
                                @case('price_high_low') Price: High to Low @break
                                @case('popularity') Popularity @break
                                @default What's New
                            @endswitch
                        </span>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400 ml-2 transition-transform duration-200" id="sort-icon"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="sort-menu"
                        class="absolute right-0 top-full mt-1 w-48 bg-white border border-gray-100 shadow-lg rounded-md hidden z-50">
                        <div class="py-1">
                            <button type="button" data-sort="newest"
                                class="sort-item w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F1] hover:text-[#CBA65A] font-['Outfit']">What's
                                New</button>
                            <button type="button" data-sort="price_low_high"
                                class="sort-item w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F1] hover:text-[#CBA65A] font-['Outfit']">Price:
                                Low to High</button>
                            <button type="button" data-sort="price_high_low"
                                class="sort-item w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F1] hover:text-[#CBA65A] font-['Outfit']">Price:
                                High to Low</button>
                            <button type="button" data-sort="popularity"
                                class="sort-item w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-[#FAF8F1] hover:text-[#CBA65A] font-['Outfit']">Popularity</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Container -->
            <div id="products-container">
                @include('frontend.products.partials.grid')
            </div>
        </div>

    </div>
</main>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const productsContainer = document.getElementById('products-container');
    const loader = document.getElementById('page-loader');
    
    // Sort Elements
    const sortButton = document.getElementById('sort-button');
    const sortMenu = document.getElementById('sort-menu');
    const selectedSortText = document.getElementById('selected-sort');
    const sortIcon = document.getElementById('sort-icon');
    const hiddenSort = document.getElementById('hidden-sort');

    // Mobile Sidebar Elements
    const mobileFilterBtn = document.getElementById('mobile-filter-btn');
    const closeFilterBtn = document.getElementById('close-filter-btn');
    const filterSidebar = document.getElementById('filter-sidebar');
    const filterBackdrop = document.getElementById('filter-backdrop');
    const applyFilterBtn = document.getElementById('apply-filter-btn');

    function updateProducts() {
        if (loader) loader.classList.remove('hidden');
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);

        fetch(`{{ route('products.index') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            productsContainer.innerHTML = html;
            window.scrollTo({ top: 0, behavior: 'smooth' });
            if (loader) loader.classList.add('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            if (loader) loader.classList.add('hidden');
        });
    }

    // Toggle Mobile Sidebar
    function toggleSidebar(show) {
        if (!filterSidebar || !filterBackdrop) return;
        if (show) {
            filterSidebar.classList.remove('-translate-x-full');
            filterBackdrop.classList.remove('hidden');
            setTimeout(() => filterBackdrop.classList.remove('opacity-0'), 10);
            document.body.style.overflow = 'hidden';
        } else {
            filterSidebar.classList.add('-translate-x-full');
            filterBackdrop.classList.add('opacity-0');
            setTimeout(() => {
                filterBackdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }
    }

    if (mobileFilterBtn) mobileFilterBtn.addEventListener('click', () => toggleSidebar(true));
    if (closeFilterBtn) closeFilterBtn.addEventListener('click', () => toggleSidebar(false));
    if (filterBackdrop) filterBackdrop.addEventListener('click', () => toggleSidebar(false));
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', () => {
            toggleSidebar(false);
            updateProducts();
        });
    }

    // Sort Selection
    if (sortButton && sortMenu) {
        sortButton.addEventListener('click', (e) => {
            e.stopPropagation();
            sortMenu.classList.toggle('hidden');
            sortIcon.classList.toggle('rotate-180');
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#sort-dropdown-container')) {
                sortMenu.classList.add('hidden');
                sortIcon.classList.remove('rotate-180');
            }
        });

        document.querySelectorAll('.sort-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sort = this.dataset.sort;
                selectedSortText.textContent = this.textContent;
                
                if (hiddenSort) hiddenSort.value = sort;
                
                sortMenu.classList.add('hidden');
                sortIcon.classList.remove('rotate-180');
                updateProducts();
            });
        });
    }

    // Accordion Logic
    document.querySelectorAll('.filter-accordion-header').forEach(header => {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.accordion-icon');
            if (content) content.classList.toggle('hidden');
            if (icon) icon.classList.toggle('rotate-180');
        });
    });

    // Checkbox Changes
    filterForm.addEventListener('change', function(e) {
        if (e.target.classList.contains('filter-checkbox')) {
             if (window.innerWidth >= 1024) {
                updateProducts();
            }
        }
    });

    // Price Slider Logic
    const minPriceInput = document.getElementById('min-price-input');
    const maxPriceInput = document.getElementById('max-price-input');
    const minPriceDisplay = document.getElementById('min-price-display');
    const maxPriceDisplay = document.getElementById('max-price-display');
    const priceTrack = document.getElementById('price-track');
    const hiddenMinPrice = document.getElementById('hidden-min-price');
    const hiddenMaxPrice = document.getElementById('hidden-max-price');

    if (minPriceInput && maxPriceInput) {
        function updatePriceSlider() {
            const min = parseInt(minPriceInput.value);
            const max = parseInt(maxPriceInput.value);
            const range = maxPriceInput.max - maxPriceInput.min;
            
            if (min > max - 1000) {
                minPriceInput.value = max - 1000;
            }

            const percent1 = ((minPriceInput.value - minPriceInput.min) / range) * 100;
            const percent2 = ((maxPriceInput.value - maxPriceInput.min) / range) * 100;

            priceTrack.style.left = percent1 + '%';
            priceTrack.style.width = (percent2 - percent1) + '%';

            minPriceDisplay.textContent = '₹ ' + parseInt(minPriceInput.value).toLocaleString();
            maxPriceDisplay.textContent = '₹ ' + parseInt(maxPriceInput.value).toLocaleString() + (maxPriceInput.value == maxPriceInput.max ? '+' : '');

            hiddenMinPrice.value = minPriceInput.value;
            hiddenMaxPrice.value = maxPriceInput.value;
        }

        updatePriceSlider();
        minPriceInput.addEventListener('input', updatePriceSlider);
        maxPriceInput.addEventListener('input', updatePriceSlider);

        const triggerFilter = () => {
             document.querySelectorAll('.price-checkbox').forEach(cb => cb.checked = false);
             if (window.innerWidth >= 1024) {
                 updateProducts();
             }
        };

        minPriceInput.addEventListener('change', triggerFilter);
        maxPriceInput.addEventListener('change', triggerFilter);
    }

    // Pagination AJAX
    document.addEventListener('click', function(e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            const url = e.target.closest('a').href;
            if (loader) loader.classList.remove('hidden');
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                productsContainer.innerHTML = html;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                if (loader) loader.classList.add('hidden');
            });
        }
    });

    // View More Shapes Toggle
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-more-shapes')) {
            const btn = e.target;
            const container = btn.closest('.filter-content');
            const extraShapes = container.querySelectorAll('.extra-shape');
            
            extraShapes.forEach(shape => {
                shape.classList.toggle('hidden');
            });

            btn.textContent = btn.textContent.trim() === '+ View More' ? '- View Less' : '+ View More';
        }
    });
});
</script>
@endsection
