@extends('frontend.layouts.master')

@section('content')
    <style>
        /* Custom Scrollbar for scrolling content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
    <!-- Discover Collection Banner -->
    <section class="w-full bg-[#EFE4D6] py-8 md:py-10">
        <div class="max-w-[1920px] mx-auto px-4 text-center">
            <h1
                class="w-auto mx-auto font-['Outfit'] font-medium text-[40px] md:text-[70px] leading-[1.2] md:leading-[88px] text-[#826230] mb-4 whitespace-normal lg:whitespace-nowrap">
                Discover our Collection</h1>
            <p class="max-w-2xl mx-auto text-sm md:text-base font-['Inter'] leading-relaxed">
                Find a new reason to shine with our Solitaires. Explore our wide range of jewelry collections designed to
                make every moment special.
            </p>
        </div>
    </section>

    <!-- Main Content : All Collection -->
    <main
        class="w-full max-w-[1920px] min-[2000px]:max-w-[2400px] mx-auto px-3 lg:px-8 py-8 font-['Outfit'] flex flex-col gap-2.5">

        <!-- Top Bar: Breadcrumb, Title & Sort -->
        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-end gap-4 self-start">
            <div class="flex flex-col gap-1">
                <div class="text-sm text-gray-500">
                    <a href="{{ route('home') }}" class="hover:text-amber-600 cursor-pointer">Home</a> / <span
                        class="text-gray-800 font-medium">Discover our Collection</span>
                </div>
                <div id="product-count-display" class="text-sm text-gray-500 mt-2">
                    Showing : {{ $products->total() }} Products
                </div>
            </div>

            <!-- Sort By Dropdown -->
            <div class="relative z-30">
                @include('frontend.partials.sort-dropdown')
            </div>
        </div>

        <!-- Layout: Sidebar + Grid -->
        <div class="w-full flex flex-col lg:flex-row lg:items-start gap-8 mt-4 relative">

            <!-- Mobile Filter Toggle (Visible < lg) -->
            <button id="mobile-filter-btn"
                class="lg:hidden flex items-center gap-2 mb-4 font-semibold text-[18px] text-[#878787]">
                <img src="{{ asset('assets/ic_setting.png') }}" alt="filter" class="w-5 h-5 object-contain"> Filters
            </button>
            <div id="filter-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="closeFilter()"></div>

            <!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
            @include('frontend.partials.filter-sidebar', ['route' => 'products.index'])

            <!-- Products Grid -->
            <div class="flex-grow h-[calc(100vh-180px)] overflow-y-auto pr-1 md:pr-4 custom-scrollbar">


                {{-- Active Filter Tags --}}
                @include('frontend.partials.filter-tags')

                <!-- Grid Container -->
                <div id="products-container">
                    @include('frontend.products.partials.grid')
                </div>
            </div>

        </div>
    </main>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('filterForm');
            const productsContainer = document.getElementById('products-container');
            const loader = document.getElementById('page-loader');

            // Sort Elements
            const sortButton = document.getElementById('sort-button');
            const sortMenu = document.getElementById('sort-menu');
            const selectedSortText = document.getElementById('selected-sort');
            const sortIcon = document.getElementById('sort-icon');
            const hiddenSort = document.getElementById('hidden-sort');

            window.updateProducts = function () {
                if (loader) loader.classList.remove('hidden');
                const formData = $(filterForm).serialize();

                $.ajax({
                    url: "{{ route('products.index') }}",
                    type: 'GET',
                    data: formData,
                    success: function (html) {
                        $(productsContainer).html(html);

                        // Update product count dynamically
                        const newTotal = $('#product-count-data').attr('data-total');
                        if (newTotal !== undefined) {
                            $('#product-count-display').text('Showing : ' + newTotal + ' Products');
                        }

                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        if (loader) loader.classList.add('hidden');
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr);
                        if (loader) loader.classList.add('hidden');
                    }
                });
            };

            // Sort Selection (Using Partial Classes and jQuery for consistency)
            const $sortButton = $('.sort-button');
            const $sortMenu = $('.sort-menu');

            $(document).on('click', '.sort-button', function (e) {
                e.stopPropagation();
                $sortMenu.toggleClass('hidden');
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('.sort-dropdown-container').length) {
                    $sortMenu.addClass('hidden');
                }
            });

            $(document).on('click', '.sort-item', function (e) {
                e.preventDefault();
                const sortValue = $(this).data('sort');
                const sortText = $(this).text();

                // Update UI
                $('.selected-sort-text').text(sortText);
                $sortMenu.addClass('hidden');

                // Update Form Input
                if (hiddenSort) hiddenSort.value = sortValue;

                // Trigger Update
                updateProducts();
            });

            // Accordion Logic
            document.querySelectorAll('.filter-accordion-header').forEach(header => {
                header.addEventListener('click', function () {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.accordion-icon');
                    if (content) content.classList.toggle('hidden');
                    if (icon) icon.classList.toggle('rotate-180');
                });
            });

            // === Clear Filters Logic ===
            window.toggleClearButton = function () {
                let hasFilters = false;
                if ($('#filterForm input[type="checkbox"]:checked').length > 0) {
                    hasFilters = true;
                }
                const hiddenMin = document.getElementById('hidden-min-price');
                const hiddenMax = document.getElementById('hidden-max-price');
                if ((hiddenMin && hiddenMin.value != 0) || (hiddenMax && hiddenMax.value != 100000)) {
                    hasFilters = true;
                }

                if (hasFilters) {
                    $('.clear-filters-btn').removeClass('hidden');
                } else {
                    $('.clear-filters-btn').addClass('hidden');
                }
            };

            $(document).on('click', '.clear-filters-btn', function () {
                $('#filterForm input[type="checkbox"]').prop('checked', false);

                // Reset price sliders
                $('#min-price-input').val(0);
                $('#max-price-input').val(100000);
                $('#hidden-min-price').val(0);
                $('#hidden-max-price').val(100000);

                // Reset visual track and display for slider
                if (typeof updatePriceSlider === 'function') {
                    updatePriceSlider();
                }

                window.toggleClearButton();
                window.updateProducts();
            });

            // run once on load
            window.toggleClearButton();

            // Checkbox Changes
            $('#filterForm').on('change', 'input[type="checkbox"]', function (e) {
                window.toggleClearButton();
                // Ensure desktop automatically triggers Ajax update on checkbox toggle
                if (window.innerWidth >= 1024) {
                    window.updateProducts();
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
                window.updatePriceSlider = function () {
                    let minVal = parseInt(minPriceInput.value) || 0;
                    let maxVal = parseInt(maxPriceInput.value) || 100000;
                    const maxPrice = 100000;

                    if (minVal > maxVal) {
                        const tmp = minVal;
                        minVal = maxVal;
                        maxVal = tmp;
                    }

                    const minPercent = (minVal / maxPrice) * 100;
                    const maxPercent = (maxVal / maxPrice) * 100;

                    priceTrack.style.left = minPercent + '%';
                    priceTrack.style.width = (maxPercent - minPercent) + '%';

                    minPriceDisplay.textContent = '₹ ' + minVal.toLocaleString();
                    maxPriceDisplay.textContent = '₹ ' + maxVal.toLocaleString() + (maxVal >= maxPrice ? '+' : '');

                    hiddenMinPrice.value = minVal;
                    hiddenMaxPrice.value = maxVal;
                };

                window.updatePriceSlider();
                minPriceInput.addEventListener('input', window.updatePriceSlider);
                maxPriceInput.addEventListener('input', window.updatePriceSlider);

                const triggerFilter = () => {
                    window.toggleClearButton();
                    if (window.innerWidth >= 1024) {
                        window.updateProducts();
                    }
                };

                minPriceInput.addEventListener('change', triggerFilter);
                maxPriceInput.addEventListener('change', triggerFilter);
            }

            // Pagination AJAX
            document.addEventListener('click', function (e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = e.target.closest('a').href;
                    if (loader) loader.classList.remove('hidden');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (html) {
                            $(productsContainer).html(html);

                            // Update product count dynamically
                            const newTotal = $('#product-count-data').attr('data-total');
                            if (newTotal !== undefined) {
                                $('#product-count-display').text('Showing : ' + newTotal + ' Products');
                            }

                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            if (loader) loader.classList.add('hidden');
                        }
                    });
                }
            });

            // View More Shapes Toggle
            document.addEventListener('click', function (e) {
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