@extends('frontend.layouts.master')

@section('content')
<!-- Discover Collection Banner -->
<section class="w-full bg-[#EFE4D6] py-8 md:py-10">
    <div class="max-w-[1920px] mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-5xl font-['Outfit'] font-medium text-[#5C4522] mb-4">Discover our Collection</h1>
        <p class="max-w-2xl mx-auto text-sm md:text-base text-gray-700 font-['Inter'] leading-relaxed">
            Find a new reason to shine with our Solitaires. Explore our wide range of jewelry collections designed to make every moment special.
        </p>
    </div>
</section>

<!-- Main Content : All Collection -->
<main class="w-full max-w-[1440px] mx-auto px-6 lg:px-12 py-8 font-['Outfit'] flex flex-col gap-2.5">

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
    <div class="w-full flex flex-col lg:flex-row gap-8 mt-4">

        <aside class="w-full lg:w-[280px] flex-shrink-0 space-y-6">
            <form id="filterForm" action="{{ route('products.index') }}" method="GET">
                <!-- Preserve Search -->
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <!-- Preserve Sort -->
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <!-- Filter Header -->
                <div class="flex items-center justify-between mb-4 font-medium text-lg">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-gray-600"></i> Filters
                    </div>
                    <a href="{{ route('products.index') }}" class="text-xs text-amber-600 hover:underline">Clear All</a>
                </div>

                <!-- Filter Item: Category -->
                @if($categories->count() > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Category</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
                        @foreach($categories as $category)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="category[]" value="{{ $category }}"
                                {{ is_array(request('category')) && in_array($category, request('category')) ? 'checked' : '' }}
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $category }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Filter Item: Gender -->
                @if($genders->count() > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Gender</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
                        @foreach($genders as $gender)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="gender[]" value="{{ $gender }}"
                                {{ is_array(request('gender')) && in_array($gender, request('gender')) ? 'checked' : '' }}
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $gender }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Filter Item: Metal Color -->
                @if($metalColors->count() > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Metal Color</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
                        @foreach($metalColors as $color)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="metal_color[]" value="{{ $color }}"
                                {{ is_array(request('metal_color')) && in_array($color, request('metal_color')) ? 'checked' : '' }}
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $color }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Filter Item: Metal Purity -->
                @if($metalPurities->count() > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Metal Purity</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
                        @foreach($metalPurities as $purity)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="metal_purity[]" value="{{ $purity }}"
                                {{ is_array(request('metal_purity')) && in_array($purity, request('metal_purity')) ? 'checked' : '' }}
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $purity }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Filter Item: Size -->
                @if(count($sizes) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Size</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 filter-content">
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($sizes as $size)
                                <label class="relative flex items-center justify-center">
                                    <input type="checkbox" name="size[]" value="{{ $size }}"
                                        {{ is_array(request('size')) && in_array($size, request('size')) ? 'checked' : '' }}
                                        class="filter-checkbox sr-only peer">
                                    <span class="w-full text-center py-2 text-xs border border-gray-200 rounded-md cursor-pointer hover:border-amber-600 peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-600 transition-all select-none">{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Filter Item: Weight Range -->
                @if(count($weightRanges) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Weight Ranges</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
                        @foreach($weightRanges as $value => $label)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="weight[]" value="{{ $value }}"
                                {{ is_array(request('weight')) && in_array($value, request('weight')) ? 'checked' : '' }}
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Filter Item: Price Range -->
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800">Price Range</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon rotate-180" style="transform: rotate(180deg)"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content">
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
            </form>
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
                @include('frontend.products.partials.grid')
            </div>
        </div>

    </div>
</main>

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
            updateProducts();
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
