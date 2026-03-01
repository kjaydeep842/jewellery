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
    <!-- Best Seller Banner -->
    <section class="w-full bg-[#EFE4D6] py-8 md:py-10">
        <div class="max-w-[1920px] mx-auto px-4 text-center">
            <h1
                class="w-auto mx-auto font-['Outfit'] font-medium text-[40px] md:text-[70px] leading-[1.2] md:leading-[88px] text-[#826230] mb-4 whitespace-normal lg:whitespace-nowrap">
                Best Seller</h1>
            <p class="max-w-2xl mx-auto text-sm md:text-base font-['Inter'] leading-relaxed">
                Discover our most loved and sought-after pieces, curated based on popularity and timeless appeal.
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
                        class="text-gray-800 font-medium">Best Seller</span>
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
        <div class="w-full flex flex-col lg:flex-row lg:items-start gap-8 mt-4">

            <!-- Mobile Filter Toggle (Visible < lg) -->
            <button id="mobile-filter-btn"
                class="lg:hidden flex items-center gap-2 mb-4 font-semibold text-[18px] text-[#878787]">
                <img src="{{ asset('assets/ic_setting.png') }}" alt="filter" class="w-5 h-5 object-contain"> Filters
            </button>
            <div id="filter-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="closeFilter()"></div>
            <!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
            @include('frontend.partials.filter-sidebar', ['route' => 'page.best-seller'])

            <!-- Products Grid -->
            <div class="flex-grow h-[calc(100vh-180px)] overflow-y-auto pr-1 md:pr-4 custom-scrollbar">
                {{-- Active Filter Tags --}}
                @include('frontend.partials.filter-tags')
                <!-- Grid Container -->
                <div id="products-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">
                    @include('frontend.pages.partials.products_grid')
                </div>
            </div>
    </main>

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {

            // --- 1. Global & Modal Logic ---

            // Close Modal
            function closeModal() {
                $('#product-modal').addClass('hidden');
            }
            $(document).on('click', '#modal-close, #product-modal', function (e) {
                if (e.target === this || e.target.id === 'modal-close' || $(e.target).closest('#modal-close').length) {
                    closeModal();
                }
            });
            $(document).on('keydown', function (e) {
                if (e.key === 'Escape' && !$('#product-modal').hasClass('hidden')) closeModal();
            });


            // --- 2. Filter Sidebar Accordions ---
            // Toggle Accordion Content
            $(document).on('click', '.filter-accordion-header', function () {
                const $header = $(this);
                const $content = $header.next();
                const $icon = $header.find('.accordion-icon');

                // Immediate icon toggle
                $icon.toggleClass('rotate-180');

                // Prepare for animation: swap 'hidden' class for inline display:none if needed
                if ($content.hasClass('hidden')) {
                    $content.removeClass('hidden').hide();
                }

                // Animate
                $content.stop(true, false).slideToggle(300, function () {
                    // Cleanup after animation
                    if (!$content.is(':visible')) {
                        $content.addClass('hidden'); // Restore hidden class
                        $icon.removeClass('rotate-180'); // Ensure sync
                    } else {
                        $icon.addClass('rotate-180'); // Ensure sync
                    }
                });
            });


            // --- 3. Mobile Filter Sidebar Removed (Now handled globally in app.js) ---


            // --- 4. AJAX Filtering & Sorting ---

            // State for AJAX and Debounce
            let activeXhr = null;
            let debounceTimer = null;

            // Function to fetch products
            function fetchProducts(url) {
                // Cancel previous request if pending
                if (activeXhr) {
                    activeXhr.abort();
                }

                const loader = document.getElementById('page-loader');

                // Show Loader
                if (loader) loader.classList.remove('hidden');
                $('#products-grid').css('opacity', '0.5');

                activeXhr = $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        if (loader) loader.classList.add('hidden');
                        $('#products-grid').html(data).css('opacity', '1');

                        // Update product count dynamically
                        const newCount = $('#product-count-data').attr('data-total');
                        if (newCount !== undefined) {
                            $('#product-count-display').text('Showing : ' + newCount + ' Products');
                        }


                        // Close mobile filter ONLY if on mobile (Disabled to let users see sync without closing)
                        // if (window.innerWidth < 1024 && !$filterSidebar.hasClass('-translate-x-full')) {
                        //     toggleFilterSidebar();
                        // }
                        activeXhr = null;
                    },
                    error: function (xhr, status, error) {
                        const loader = document.getElementById('page-loader');
                        if (loader) loader.classList.add('hidden');

                        // Ignore aborted requests (intentional cancellation)
                        if (status === 'abort') {
                            activeXhr = null;
                            return;
                        }

                        // Log genuine errors
                        console.error('AJAX Error:', status, error);

                        // Reset UI
                        $('#products-grid').css('opacity', '1');

                        // Show Error Message to User
                        $('#products-grid').html(`
                                                                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                                                                        <i class="fa-solid fa-circle-exclamation text-4xl text-red-400 mb-4"></i>
                                                                        <h3 class="text-lg font-medium text-gray-800">Unable to load products</h3>
                                                                        <p class="text-sm text-gray-500 mt-1">Please check your connection and try again.</p>
                                                                        <button onclick="window.updateProducts()" class="mt-4 px-6 py-2 bg-[#CBA65A] text-white rounded-md hover:bg-[#b08d45] transition-colors">
                                                                            Retry
                                                                        </button>
                                                                    </div>
                                                                `);

                        activeXhr = null;
                    }
                });
            }

            // Expose updateProducts for onchange attributes in Blade (with Debounce)
            window.updateProducts = function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    const $form = $('#filterForm');

                    // Safety check: if form is missing, log error
                    if ($form.length === 0) {
                        console.error('Filter form not found!');
                        return;
                    }

                    if (window.toggleClearButton) {
                        window.toggleClearButton();
                    }

                    // Use relative URL to avoid CORS issues (e.g. localhost vs 127.0.0.1)
                    const baseUrl = "{{ route('page.best-seller', [], false) }}";
                    const url = baseUrl + '?' + $form.serialize();
                    fetchProducts(url);
                }, 300); // 300ms debounce
            };

            // Sort Dropdown Logic
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
                let $input = $('input[name="sort"]');
                if ($input.length === 0) {
                    $input = $('<input>').attr({
                        type: 'hidden',
                        name: 'sort'
                    }).appendTo('#filterForm');
                }
                $input.val(sortValue);

                // Trigger Update
                window.updateProducts();
            });


            // --- 5. Product Grid Interactions (Event Delegation) ---

            // Initialize Card Data (Run on load and after AJAX)
            function initCardData() {
                $('#products-grid .group').each(function () {
                    const $card = $(this);
                    if ($card.data('init')) return; // Prevent double init

                    // Robustly get images
                    let images = $card.data('images');

                    // If jQuery auto-parsing failed or it's a string, try manual parse
                    if (typeof images === 'string') {
                        try {
                            images = JSON.parse(images);
                        } catch (e) {
                            console.error('Failed to parse images JSON', e);
                            images = [];
                        }
                    }

                    // If still not an array (e.g. null, undefined, or other type), fallback
                    if (!Array.isArray(images) || images.length === 0) {
                        // Fallback mechanism: grab existing src from DOM
                        const $imgs = $card.find('img.mix-blend-multiply');
                        images = [];
                        $imgs.each(function () {
                            const src = $(this).attr('src');
                            if (src) images.push(src);
                        });
                    }

                    // Update the data attribute with the valid array
                    $card.data('images', images);
                    $card.data('current-index', 0);
                    $card.data('init', true);
                });
            }

            // Listen for AJAX completion to re-init data where necessary
            $(document).ajaxComplete(function () {
                initCardData();
            });
            initCardData(); // Run on load

            // Arrow Click Handlers
            $(document).on('click', '.nav-prev-side', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const $card = $(this).closest('.group');

                let images = $card.data('images');
                // Double check type just in case
                if (typeof images === 'string') {
                    try {
                        images = JSON.parse(images);
                        $card.data('images', images);
                    } catch (e) { }
                }

                let idx = $card.data('current-index');
                if (idx === undefined) idx = 0;

                if (images && Array.isArray(images) && images.length > 1) {
                    console.log('Prev Click: Images found', images.length);
                    idx = (idx - 1 + images.length) % images.length;
                    console.log('New Index:', idx);
                    $card.data('current-index', idx);

                    // Update Main Image
                    const $mainImg = $card.find('.main-product-image');
                    if ($mainImg.length && images[idx]) {
                        $mainImg.attr('src', images[idx]);

                        // Disable hover swap effect to ensure main image is visible
                        $mainImg.removeClass('group-hover:opacity-0');
                        $card.find('.hover-product-image').removeClass('group-hover:opacity-100').addClass('opacity-0');
                    }

                    // Update Expand Button Data
                    const $expandBtn = $card.find('.expand-btn');
                    if ($expandBtn.length) {
                        $expandBtn.data('image', images[idx]);
                        $expandBtn.attr('data-image', images[idx]);
                        $expandBtn.data('index', idx); // Store index for modal
                    }
                }
            });

            $(document).on('click', '.nav-next-side', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const $card = $(this).closest('.group');

                let images = $card.data('images');
                if (typeof images === 'string') {
                    try {
                        images = JSON.parse(images);
                        $card.data('images', images);
                    } catch (e) { }
                }

                let idx = $card.data('current-index');
                if (idx === undefined) idx = 0;

                if (images && Array.isArray(images) && images.length > 1) {
                    console.log('Next Click: Images found', images.length);
                    idx = (idx + 1) % images.length;
                    console.log('New Index:', idx);
                    $card.data('current-index', idx);

                    // Update Main Image
                    const $mainImg = $card.find('.main-product-image');
                    if ($mainImg.length && images[idx]) {
                        $mainImg.attr('src', images[idx]);

                        // Disable hover swap effect to ensure main image is visible
                        $mainImg.removeClass('group-hover:opacity-0');
                        $card.find('.hover-product-image').removeClass('group-hover:opacity-100').addClass('opacity-0');
                    }

                    // Update Expand Button Data
                    const $expandBtn = $card.find('.expand-btn');
                    if ($expandBtn.length) {
                        $expandBtn.data('image', images[idx]);
                        $expandBtn.attr('data-image', images[idx]); // Ensure attribute updates
                        $expandBtn.data('index', idx); // Store index for modal
                    }
                }
            });

            // --- Wishlist Logic ---
            // Wishlist logic is now handled globally in app.js via event delegation

            // --- Add to Cart Logic ---
            $(document).on('click', '.add-to-cart-btn', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const $btn = $(this);
                const productId = $btn.data('product-id');
                const originalText = $btn.text();

                // Loading State
                $btn.text('Adding...').prop('disabled', true).addClass('opacity-75');

                $.ajax({
                    url: "{{ route('cart.store') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: 1,
                        _token: "{{ csrf_token() }}",
                        wants_json: true // Hint to backend if needed, though we check Accept header or X-Requested-With
                    },
                    success: function (response) {
                        $btn.text('Added!');
                        setTimeout(() => {
                            $btn.text(originalText).prop('disabled', false).removeClass('opacity-75');
                        }, 2000);

                        // Update Header Cart Count
                        if (response.cart_count !== undefined) {
                            $('#header-cart-count').text(response.cart_count);
                        }
                    },
                    error: function (xhr) {
                        console.error('Add to cart failed:', xhr);
                        $btn.text('Failed');
                        setTimeout(() => {
                            $btn.text(originalText).prop('disabled', false).removeClass('opacity-75');
                        }, 2000);
                        if (xhr.status === 401) {
                            window.location.href = "{{ route('frontend.auth.mobile') }}"; // Redirect to login if unauthorized
                        }
                    }
                });
            });

            // --- Expand / Quick View Logic with Gallery ---
            // Inject Modal if not exists (Updated HTML with Nav Buttons)
            if ($('#product-modal').length === 0) {
                const modalHTML = `
                                                        <div id="product-modal" class="fixed inset-0 z-[100] bg-black/80 hidden flex items-center justify-center p-4">
                                                            <button id="modal-close" class="absolute top-4 right-4 text-white hover:text-gray-300 z-[101]">
                                                                <i class="fa-solid fa-xmark text-4xl"></i>
                                                            </button>

                                                            <div class="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center p-4 group">
                                                                <!-- Modal Prev Button -->
                                                                <button id="modal-prev" class="absolute left-4 top-1/2 -translate-y-1/2 z-[102] w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition-colors">
                                                                    <i class="fa-solid fa-chevron-left"></i>
                                                                </button>

                                                                <img id="modal-image" src="" alt="Full View" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl bg-white">

                                                                <!-- Modal Next Button -->
                                                                <button id="modal-next" class="absolute right-4 top-1/2 -translate-y-1/2 z-[102] w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition-colors">
                                                                     <i class="fa-solid fa-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>`;
                $('body').append(modalHTML);
            }

            const $modal = $('#product-modal');
            const $modalImage = $('#modal-image');
            let currentModalImages = [];
            let currentModalIndex = 0;

            $(document).on('click', '.expand-btn', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const $btn = $(this);
                const $card = $btn.closest('.group');

                // Get images from card data
                let images = $card.data('images');
                if (typeof images === 'string') {
                    try {
                        images = JSON.parse(images);
                    } catch (e) {
                        images = [];
                    }
                }

                // Fallback if no images array
                if (!Array.isArray(images) || images.length === 0) {
                    const src = $btn.data('image');
                    if (src) images = [src];
                    else {
                        const $img = $card.find('img.mix-blend-multiply').first();
                        if ($img.length) images = [$img.attr('src')];
                    }
                }

                currentModalImages = images;
                // Get current index from button (synced with card) or default 0
                currentModalIndex = $btn.data('index') !== undefined ? $btn.data('index') : 0;

                // Validate index
                if (currentModalIndex >= currentModalImages.length) currentModalIndex = 0;

                if (currentModalImages.length > 0) {
                    updateModalImage();
                    $('#product-modal').removeClass('hidden');

                    // Show/Hide buttons based on count
                    if (currentModalImages.length > 1) {
                        $('#modal-prev, #modal-next').show();
                    } else {
                        $('#modal-prev, #modal-next').hide();
                    }
                }
            });

            function updateModalImage() {
                if (currentModalImages[currentModalIndex]) {
                    $('#modal-image').attr('src', currentModalImages[currentModalIndex]);
                }
            }

            $(document).on('click', '#modal-prev', function (e) {
                e.stopPropagation();
                if (currentModalImages.length > 1) {
                    currentModalIndex = (currentModalIndex - 1 + currentModalImages.length) % currentModalImages.length;
                    updateModalImage();
                }
            });

            $(document).on('click', '#modal-next', function (e) {
                e.stopPropagation();
                if (currentModalImages.length > 1) {
                    currentModalIndex = (currentModalIndex + 1) % currentModalImages.length;
                    updateModalImage();
                }
            });

            // --- 6. Price Slider Logic ---
            const $minInput = $('#min-price-input');
            const $maxInput = $('#max-price-input');
            const $priceTrack = $('#price-track');
            const $minDisplay = $('#min-price-display');
            const $maxDisplay = $('#max-price-display');
            const $hiddenMin = $('#hidden-min-price');
            const $hiddenMax = $('#hidden-max-price');
            const maxPrice = 100000;

            function updateSlider() {
                let minVal = parseInt($minInput.val()) || 0;
                let maxVal = parseInt($maxInput.val()) || maxPrice;

                // Ensure min <= max visually (logic in input event handles actual value)
                if (minVal > maxVal) {
                    const tmp = minVal;
                    minVal = maxVal;
                    maxVal = tmp;
                }

                // Update visuals
                const minPercent = (minVal / maxPrice) * 100;
                const maxPercent = (maxVal / maxPrice) * 100;

                $priceTrack.css({
                    'left': minPercent + '%',
                    'width': (maxPercent - minPercent) + '%'
                });

                // Update Text
                $minDisplay.text('₹ ' + minVal.toLocaleString());
                $maxDisplay.text('₹ ' + maxVal.toLocaleString() + (maxVal >= maxPrice ? '+' : ''));

                $hiddenMin.val(minVal);
                $hiddenMax.val(maxVal);
            }

            $minInput.on('input', function () {
                let minVal = parseInt($(this).val());
                let maxVal = parseInt($maxInput.val());

                if (minVal > maxVal - 0) { // Allow overlap or small gap? User asked for proper. 0 gap is fine for now.
                    minVal = maxVal;
                    $(this).val(minVal);
                }
                updateSlider();
            });

            $maxInput.on('input', function () {
                let minVal = parseInt($minInput.val());
                let maxVal = parseInt($(this).val());

                if (maxVal < minVal + 0) {
                    maxVal = minVal;
                    $(this).val(maxVal);
                }
                updateSlider();
            });

            // Trigger AJAX on change (drop)
            $minInput.on('change', function () {
                window.updateProducts();
            });
            $maxInput.on('change', function () {
                window.updateProducts();
            });

            // Initialize Slider
            if ($minInput.length) updateSlider();

            // --- 7. Clear Filters Logic ---
            window.toggleClearButton = function () {
                let hasFilters = false;
                if ($('#filterForm input[type="checkbox"]:checked').length > 0) {
                    hasFilters = true;
                }
                if ($('#hidden-min-price').val() != 0 || $('#hidden-max-price').val() != 100000) {
                    hasFilters = true;
                }

                if (hasFilters) {
                    $('.clear-filters-btn').removeClass('hidden');
                } else {
                    $('.clear-filters-btn').addClass('hidden');
                }
            };

            // Call on load
            toggleClearButton();

            // Add listener for checkbox changes to toggle the clear button visibility immediately
            $('#filterForm').on('change', 'input[type="checkbox"]', function () {
                toggleClearButton();
            });

            $(document).on('click', '.clear-filters-btn', function () {
                // Uncheck all checkboxes
                $('#filterForm input[type="checkbox"]').prop('checked', false);

                // Reset price sliders
                $('#min-price-input').val(0);
                $('#max-price-input').val(100000);
                $('#hidden-min-price').val(0);
                $('#hidden-max-price').val(100000);

                // Reset visual track and display for slider
                if (typeof updateSlider === 'function') {
                    updateSlider();
                }

                toggleClearButton();
                window.updateProducts();
            });

        });
    </script>
@endpush