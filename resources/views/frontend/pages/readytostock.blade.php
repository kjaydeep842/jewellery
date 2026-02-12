@extends('frontend.layouts.master')

@section('content')
<!-- Ready to Stock Banner -->
<section class="w-full bg-[#EFE4D6] py-8 md:py-10">
    <div class="w-full px-4 md:px-8 text-center">
        <h1 class="text-3xl md:text-5xl font-['Outfit'] font-medium text-[#5C4522] mb-4">Ready to Stock</h1>
        <p class="max-w-2xl mx-auto text-sm md:text-base text-gray-700 font-['Inter'] leading-relaxed">
            Discover our collection of ready-to-ship jewellery, crafted with precision and available for immediate delivery.
        </p>
    </div>
</section>

<!-- Main Content : All Collection -->
<main class="w-full px-4 md:px-6 py-8 font-['Outfit'] flex flex-col gap-2.5">

    <!-- Breadcrumb & Title -->
    <div class="w-full flex flex-col gap-1 self-start">
        <div class="text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-amber-600 cursor-pointer">Home</a> / <span
                class="text-gray-800 font-medium">Ready to Stock</span>
        </div>
        <div class="text-sm text-gray-500 mt-2">
            Showing : {{ $products->total() }} Products
        </div>
    </div>

    <!-- Layout: Sidebar + Grid -->
    <div class="w-full flex flex-col lg:flex-row gap-8 mt-4 relative">

        <!-- Mobile Filter Button (Visible < lg) -->
        <div class="lg:hidden flex justify-between items-center mb-4">
             <button id="mobile-filter-btn" class="flex items-center gap-2 text-gray-800 font-medium border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-50 transition-colors">
                <i class="fa-solid fa-sliders text-gray-600"></i> Filters
            </button>
        </div>

        <!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
        <div id="filter-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity opacity-0"></div>

        <aside id="filter-sidebar" class="fixed inset-y-0 left-0 w-[300px] bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:static lg:transform-none lg:w-[280px] lg:block flex-shrink-0 shadow-2xl lg:shadow-none h-full lg:h-auto overflow-y-auto lg:overflow-visible">
            <div class="p-5 lg:p-0">
                <div class="flex justify-between items-center mb-6 lg:hidden">
                    <span class="text-lg font-medium text-gray-900">Filters</span>
                    <button id="close-filter-btn" class="text-gray-500 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <form id="filterForm" action="{{ route('page.readytostock') }}" method="GET">
                    <!-- Preserve Sort -->
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- Filter Header (Desktop) -->
                    <div class="hidden lg:flex items-center justify-between mb-4 font-medium text-lg">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-gray-600"></i> Filters
                        </div>
                        <a href="{{ route('page.readytostock') }}" class="text-xs text-amber-600 hover:underline">Clear All</a>
                    </div>

                    <!-- Filter Item: Category -->
                    @if(count($categories) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Category</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
                            @foreach($categories as $category)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="category[]" value="{{ $category }}"
                                        {{ in_array($category, request('category', [])) ? 'checked' : '' }}
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $category }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Gender -->
                    @if(count($genders) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Gender</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
                            @foreach($genders as $gender)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="gender[]" value="{{ $gender }}"
                                        {{ in_array($gender, request('gender', [])) ? 'checked' : '' }}
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ ucfirst($gender) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Metal Color -->
                    @if(count($metalColors) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Metal Color</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
                            @foreach($metalColors as $color)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="metal_color[]" value="{{ $color }}"
                                        {{ in_array($color, request('metal_color', [])) ? 'checked' : '' }}
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $color }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Metal Purity -->
                    @if(count($metalPurities) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Metal Purity</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
                            @foreach($metalPurities as $purity)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="metal_purity[]" value="{{ $purity }}"
                                        {{ in_array($purity, request('metal_purity', [])) ? 'checked' : '' }}
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $purity }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Size -->
                    @if(count($sizes) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Size</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 filter-content hidden">
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($sizes as $size)
                                    <label class="relative flex items-center justify-center">
                                        <input type="checkbox" name="size[]" value="{{ $size }}"
                                            {{ in_array($size, request('size', [])) ? 'checked' : '' }}
                                            class="filter-checkbox sr-only peer">
                                        <span class="w-full text-center py-2 text-xs border border-gray-200 rounded-md cursor-pointer hover:border-amber-600 peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-600 transition-all select-none">{{ $size }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Weight Range -->
                    @if(count($weightRanges) > 0)
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Weight Range</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
                            @foreach($weightRanges as $value => $label)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="weight[]" value="{{ $value }}"
                                        {{ in_array($value, request('weight', [])) ? 'checked' : '' }}
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Price Range -->
                    <div class="border-b border-gray-100 py-4 filter-container">
                        <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                            <span class="font-medium text-gray-800">Price Range</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180"></i>
                        </div>
                        <div class="mt-4 space-y-3 filter-content hidden">
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
                                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $range }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Mobile Apply Button -->
                    <div class="mt-6 lg:hidden">
                        <button type="button" onclick="document.getElementById('filterForm').submit();" class="w-full bg-[#CBA65A] text-white py-3 rounded-lg font-medium hover:bg-[#b39359] transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="flex-grow">
            <!-- Sort By -->
            <div class="flex justify-end mb-6 relative z-30">
                <div class="relative inline-block text-left" id="sort-dropdown-container">
                    <button type="button" id="sort-button"
                        class="group inline-flex justify-between items-center min-w-[200px] px-4 py-2.5 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-200 rounded-md focus:outline-none transition-all shadow-sm"
                        aria-expanded="true" aria-haspopup="true">
                        <span class="flex items-center">
                            <span class="text-gray-500 mr-2 font-normal">Sort by:</span>
                            <span id="selected-sort" class="text-gray-900 font-medium">
                                @switch(request('sort'))
                                    @case('price_low_high') Price: Low to High @break
                                    @case('price_high_low') Price: High to Low @break
                                    @case('popularity') Popularity @break
                                    @default What's New
                                @endswitch
                            </span>
                        </span>
                        <i class="fa-solid fa-chevron-down ml-3 text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200"
                            id="sort-icon"></i>
                    </button>

                    <div id="sort-menu"
                        class="hidden absolute right-0 mt-2 w-[220px] rounded-md shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 origin-top-right transform transition-all duration-200 ease-in-out"
                        role="menu" aria-orientation="vertical" aria-labelledby="sort-button" tabindex="-1">
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
            </div>

            <!-- Grid Container -->
            <div id="products-container">
                @include('frontend.pages.partials.readytostock-grid')
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
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const productsContainer = document.getElementById('products-container');
    const loader = document.getElementById('page-loader');
    const sortButton = document.getElementById('sort-button');
    const sortMenu = document.getElementById('sort-menu');
    const selectedSortText = document.getElementById('selected-sort');
    const sortIcon = document.getElementById('sort-icon');

    // Mobile Filter Drawer Logic
    const mobileFilterBtn = document.getElementById('mobile-filter-btn');
    const closeFilterBtn = document.getElementById('close-filter-btn');
    const filterSidebar = document.getElementById('filter-sidebar');
    const filterOverlay = document.getElementById('filter-overlay');

    function openMobileFilters() {
        filterSidebar.classList.remove('-translate-x-full');
        filterOverlay.classList.remove('hidden');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            filterOverlay.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeMobileFilters() {
        filterSidebar.classList.add('-translate-x-full');
        filterOverlay.classList.add('opacity-0');
        setTimeout(() => {
            filterOverlay.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }

    if (mobileFilterBtn) mobileFilterBtn.addEventListener('click', openMobileFilters);
    if (closeFilterBtn) closeFilterBtn.addEventListener('click', closeMobileFilters);
    if (filterOverlay) filterOverlay.addEventListener('click', closeMobileFilters);

    function updateProducts() {
        if (loader) loader.classList.remove('hidden');
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);

        fetch(`${filterForm.action}?${params.toString()}`, {
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



    // Sort Selection
    document.querySelectorAll('.sort-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const sort = this.dataset.sort;
            selectedSortText.textContent = this.textContent;
            
            let sortInput = filterForm.querySelector('input[name="sort"]');
            if (!sortInput) {
                sortInput = document.createElement('input');
                sortInput.type = 'hidden';
                sortInput.name = 'sort';
                filterForm.appendChild(sortInput);
            }
            sortInput.value = sort;
            
            sortMenu.classList.add('hidden');
            sortIcon.classList.remove('rotate-180');
            updateProducts();
        });
    });

    // Checkbox Changes
    filterForm.addEventListener('change', function(e) {
        if (e.target.classList.contains('filter-checkbox')) {
            // Only auto-update on desktop
            if (window.innerWidth >= 1024) {
                 updateProducts();
            }
        }
    });


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
});
</script>
@endsection