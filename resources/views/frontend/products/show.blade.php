@extends('frontend.layouts.master')

@section('content')

    <!-- Image and Interaction Scripts -->
    <script>
        function isMediaVideo(url) {
            if (!url) return false;
            try {
                const ext = url.split('?')[0].split('.').pop().toLowerCase();
                return ['mp4', 'webm', 'ogg', 'mov'].includes(ext);
            } catch (e) {
                return false;
            }
        }

        // Image swap functionality
        document.addEventListener('DOMContentLoaded', function () {
            const thumbnails = document.querySelectorAll('.thumbnail-item');

            thumbnails.forEach(function (thumbnail) {
                thumbnail.addEventListener('click', function () {
                    const newSrc = this.getAttribute('data-image-src');
                    const mainMedia = document.getElementById('main-image');
                    if (!mainMedia) return;

                    const currentMainSrc = mainMedia.getAttribute('src');
                    if (newSrc === currentMainSrc) return;

                    // 1. Replace Main Media
                    const mainContainer = document.getElementById('main-media-container');
                    if (isMediaVideo(newSrc)) {
                        mainContainer.innerHTML = `<video id="main-image" src="${newSrc}" autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10 transition-transform duration-100 ease-out pointer-events-none origin-center"></video>`;
                    } else {
                        mainContainer.innerHTML = `<img id="main-image" src="${newSrc}" alt="Product image" class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10 transition-transform duration-100 ease-out pointer-events-none origin-center">`;
                    }

                    // 2. Replace Clicked Thumbnail Media
                    const thumbnailMediaContainer = this.querySelector('.thumb-media-container');
                    if (thumbnailMediaContainer) {
                        if (isMediaVideo(currentMainSrc)) {
                            thumbnailMediaContainer.innerHTML = `<video src="${currentMainSrc}" class="object-contain w-full h-full" autoplay loop muted playsinline></video>`;
                        } else {
                            thumbnailMediaContainer.innerHTML = `<img src="${currentMainSrc}" class="object-contain w-full h-full" alt="Product thumbnail">`;
                        }
                    }

                    // 3. Update data attribute
                    this.setAttribute('data-image-src', currentMainSrc);
                });
            });
        });

        function selectSize(btn, variantId) {
            // Remove active class from all size buttons
            document.querySelectorAll('#size-container button').forEach(b => {
                b.classList.remove('border-[#CBA65A]', 'text-[#CBA65A]');
                b.classList.add('border-[#D7D7DA]', 'text-[#0D0D0E]');
            });

            // Add active class to clicked button
            btn.classList.remove('border-[#D7D7DA]', 'text-[#0D0D0E]');
            btn.classList.add('border-[#CBA65A]', 'text-[#CBA65A]');

            // Update hidden input if form exists (future implementation)
            const size = btn.textContent.trim();
            console.log("Selected Size:", size);
            selections.size = size; // Ch        anged sizeValue to size
            recalculatePrice();
        }

        let selections = {
            size: '',
            metal_purity: '',
            diamond_quality: '',
            shape: '',
            metal_color: ''
        };

        document.addEventListener('DOMContentLoaded', () => {
            const sizeBtn = document.querySelector('#size-container button.border-\\[\\#CBA65A\\]');
            if (sizeBtn) selections.size = sizeBtn.innerText.trim();

            const metalBtn = document.querySelector('.metal-container button.border-\\[\\#CBA65A\\]');
            if (metalBtn) selections.metal_purity = metalBtn.innerText.trim();

            const qualityBtn = document.querySelector('.quality-container button.border-\\[\\#CBA65A\\]');
            if (qualityBtn) selections.diamond_quality = qualityBtn.innerText.trim();

            const shapeBtn = document.querySelector('.shape-container button.border-\\[\\#CBA65A\\]');
            if (shapeBtn) selections.shape = shapeBtn.innerText.trim();

            const colorBtn = document.querySelector('.color-container button.border-\\[\\#CBA65A\\]');
            if (colorBtn) {
                const nameSpan = colorBtn.querySelector('span:last-child');
                if (nameSpan) selections.metal_color = nameSpan.innerText.trim();
            }
            // Initial price calculation with default selections
            // recalculatePrice(        ); 
        });

        function selectOption(btn, containerClass, type, value) {
            const container = btn.closest('.' + containerClass);
            if (!container) return;

            const buttons = container.querySelectorAll('button');

            buttons.forEach(b => {
                if (containerClass === 'color-container') {
                    b.classList.remove('border-[1.8px]', 'border-[#CBA65A]', 'text-[#CBA65A]', 'bg-white');
                    b.classList.add('border-none', 'text-[#0D0D0E]', 'bg-[#F2F2F3]');
                } else {
                    b.classList.remove('border-[1.5px]', 'sm:border-[2.3px]', 'border-[#CBA65A]', 'text-[#CBA65A]');
                    b.classList.add('border-[#D7D7DA]', 'text-[#0D0D0E]');
                }
            });

            if (containerClass === 'color-container') {
                btn.classList.remove('border-none', 'text-[#0D0D0E]', 'bg-[#F2F2F3]');
                btn.classList.add('border-[1.8px]', 'border-[#CBA65A]', 'text-[#CBA65A]', 'bg-white');
            } else {
                btn.classList.remove('border-[#D7D7DA]', 'text-[#0D0D0E]');
                btn.classList.add('border-[1.5px]', 'sm:border-[2.3px]', 'border-[#CBA65A]', 'text-[#CBA65A]');
            }
            console.log("Selected Option:", btn.textContent.trim());

            // Store value in state
            if (type) {
                selections[type] = value;
                recalculatePrice();
            }
        }

        function recalculatePrice() {
            const productId = '{{ $product->id }}';
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch(`/ajax/product/${productId}/calculate-price`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    size: selections.size,
                    color: selections.metal_color,
                    purity: selections.metal_purity,
                    diamond_quality: selections.diamond_quality,
                    shape: selections.shape
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Update Breakdown Table
                        // Update Breakdown Table Components
                        const goldEl = document.getElementById('price-gold-rate');
                        if (goldEl) goldEl.innerText = '₹' + formatNumber(data.data.productGoldRate);

                        const diamondEl = document.getElementById('price-diamond');
                        if (diamondEl) diamondEl.innerText = '₹' + formatNumber(data.data.productDiamondAmount);

                        const makingEl = document.getElementById('price-making');
                        if (makingEl) makingEl.innerText = '₹' + formatNumber(data.data.productMakingCharge);

                        const subEl = document.getElementById('price-subtotal');
                        if (subEl) subEl.innerText = '₹' + formatNumber(parseFloat(data.data.rawGrandTotal) / 1.03);

                        const gstEl = document.getElementById('price-gst-full');
                        if (gstEl) gstEl.innerText = '₹' + formatNumber(data.data.productGSTCharge);

                        const grandEl = document.getElementById('price-grand-full');
                        if (grandEl) grandEl.innerText = '₹' + formatNumber(data.data.rawGrandTotal);

                        // Update Top Level Price Header
                        const mainPriceEl = document.getElementById('main-selling-price');
                        if (mainPriceEl) mainPriceEl.innerText = '₹' + formatNumber(data.data.rawGrandTotal);
                    }
                })
                .catch(error => console.error('Error calculating price:', error));
        }

        function formatNumber(num) {
            return new Intl.NumberFormat('en-IN', {
                maximumFractionDigits: 0
            }).format(num);
        }

        function toggleSizes() {
            const extraSizes = document.querySelectorAll('.extra-size');
            const btn = document.getElementById('view-more-btn');

            extraSizes.forEach(size => {
                size.classList.toggle('hidden');
            });

            if (btn.textContent.trim() === 'View More') {
                btn.textContent = 'View Less';
            } else {
                btn.textContent = 'View More';
            }
        }

        function toggleViewMore(btn, extraClass) {
            const extraItems = document.querySelectorAll('.' + extraClass);
            extraItems.forEach(item => {
                item.classList.toggle('hidden');
            });

            if (btn.textContent.trim() === 'View More') {
                btn.textContent = 'View Less';
            } else {
                btn.textContent = 'View More';
            }
        }

        function switchTab(tabName, btn) {
            // Hide all tabs
            document.getElementById('content-about').classList.add('hidden');
            document.getElementById('content-details').classList.add('hidden');
            document.getElementById('content-price').classList.add('hidden');

            // Show selected tab
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Reset button styles
            const buttons = btn.parentElement.querySelectorAll('button');
            buttons.forEach(b => {
                b.classList.remove('bg-black', 'text-white', 'border-black');
                b.classList.add('border-[#E8E1D5]', 'text-gray-600', 'bg-white');
            });

            // Set active button style
            btn.classList.remove('border-[#E8E1D5]', 'text-gray-600', 'bg-white');
            btn.classList.add('bg-black', 'text-white', 'border-black');
        }

        function toggleAccordion(btn) {
            const content = btn.nextElementSibling;
            const icon = btn.querySelector('.accordion-icon i');

            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0px';
                content.style.opacity = '0';
                content.classList.add('overflow-hidden');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                content.style.opacity = '1';
                content.classList.remove('overflow-hidden');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }

        function zoomImageHover(e) {
            const container = document.getElementById('image-zoom-container');
            const img = document.getElementById('main-image');
            if (!img) return;

            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;

            img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            img.style.transform = 'scale(2.5)';
        }

        function resetZoomHover() {
            const img = document.getElementById('main-image');
            if (!img) return;
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)';
        }
    </script>

    <main
        class="max-w-[1600px] xl:max-w-[1800px] 2xl:max-w-[2000px] min-[2000px]:max-w-[2400px] mx-auto px-3 sm:px-4 md:px-6 lg:px-8 pt-4 sm:pt-6 md:pt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.5fr_1fr] gap-6 sm:gap-8 md:gap-10 xl:gap-12">

            <!-- Product Images -->
            <div class="space-y-2 sm:space-y-3 md:space-y-4" style="border-radius: 0;">
                <!-- Main Image Container -->
                <div class="w-full max-w-full lg:max-w-[1143px] mx-auto" style="border-radius: 0;">
                    <div id="image-zoom-container" class="relative w-full bg-white overflow-hidden cursor-zoom-in"
                        style="aspect-ratio: 1143 / 1319; border-radius: 0;" onmousemove="zoomImageHover(event)"
                        onmouseleave="resetZoomHover()">
                        <div id="main-media-container" class="w-full h-full leading-none hidden sm:block">
                            @php
                                $pMainImagePath = $product->image ?: ($product->images->first() ? $product->images->first()->image_path : null);
                                $isMainVideo = false;
                                if ($pMainImagePath) {
                                    $extension = strtolower(pathinfo(parse_url($pMainImagePath, PHP_URL_PATH), PATHINFO_EXTENSION));
                                    $isMainVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                                }
                            @endphp
                            @if($pMainImagePath)
                                @if($isMainVideo)
                                    <video id="main-image" src="{{ $pMainImagePath }}" autoplay loop muted playsinline
                                        class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10 transition-transform duration-100 ease-out pointer-events-none origin-center"></video>
                                @else
                                    <img id="main-image" src="{{ $pMainImagePath }}" alt="{{ $product->name }}"
                                        class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10 transition-transform duration-100 ease-out pointer-events-none origin-center">
                                @endif
                            @else
                                <div
                                    class="absolute inset-0 w-full h-full flex items-center justify-center bg-gray-50/50 pointer-events-none">
                                    {{-- No Fallback Image --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                @if($product->images->count() > 1)
                    <div class="w-full max-w-full lg:max-w-[1143px] mx-auto">
                        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-5 lg:grid-cols-5 gap-[10px]">
                            @foreach($product->images as $image)
                                @php
                                    $isThumbVideo = false;
                                    if ($image->image_path) {
                                        $thumbExt = strtolower(pathinfo(parse_url($image->image_path, PHP_URL_PATH), PATHINFO_EXTENSION));
                                        $isThumbVideo = in_array($thumbExt, ['mp4', 'webm', 'ogg', 'mov']);
                                    }
                                @endphp
                                <div class="thumbnail-item cursor-pointer bg-white transition-all duration-200 hover:border-2 hover:border-[#CBA65A] rounded-lg"
                                    style="aspect-ratio: 1 / 1;" data-image-src="{{ $image->image_path }}">
                                    <div
                                        class="thumb-media-container w-full h-full flex items-center justify-center p-2 sm:p-3 pointer-events-none">
                                        @if($isThumbVideo)
                                            <video src="{{ $image->image_path }}" class="object-contain w-full h-full" autoplay loop
                                                muted playsinline></video>
                                        @else
                                            <img src="{{ $image->image_path }}" class="object-contain w-full h-full"
                                                alt="Product thumbnail">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <!-- Rating -->
                    <div
                        class="flex items-center justify-center box-border px-2 sm:px-[10px] py-1 sm:py-[4px] gap-1 sm:gap-[6px] w-auto sm:w-[151.67px] xl:w-[170px] 2xl:w-[185px] min-[2000px]:w-[200px] h-auto sm:h-[23px] xl:h-[28px] 2xl:h-[32px] min-[2000px]:h-[35px] bg-white border border-[#D7D7DA] rounded-[4px]">
                        <span
                            class="font-['Outfit'] font-bold text-[#1A1A1A] text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl">{{ number_format($product->reviews()->avg('rating') ?? 0, 1) }}</span>
                        <img src="{{ asset('assets/1star.png') }}"
                            class="h-3 w-3 xl:h-4 xl:w-4 2xl:h-[18px] 2xl:w-[18px] min-[2000px]:h-5 min-[2000px]:w-5"
                            alt="star">
                        <span
                            class="font-['Outfit'] text-[#8B8B8B] text-xs sm:text-sm xl:text-base 2xl:text-[17px] min-[2000px]:text-lg font-normal">|
                            {{ $product->reviews()->count() }} Ratings</span>
                    </div>

                    <!-- Title -->
                    <h1
                        class="mt-3 sm:mt-4 w-full font-['Outfit'] font-medium text-[22px] sm:text-[26px] xl:text-[32px] 2xl:text-[36px] min-[2000px]:text-[40px] leading-[26px] sm:leading-[30px] xl:leading-[38px] 2xl:leading-[44px] min-[2000px]:leading-[50px] text-[#0D0D0E]">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="mt-2 sm:mt-3">
                        <span id="main-selling-price"
                            class="font-['Outfit'] font-semibold text-[28px] sm:text-[32px] xl:text-[36px] 2xl:text-[42px] min-[2000px]:text-[48px] leading-[34px] sm:leading-[40px] xl:leading-[44px] 2xl:leading-[50px] text-[#0D0D0E]">
                            ₹{{ number_format($product->selling_price * 1.03, 0) }}
                        </span>
                        @if($product->price > $product->selling_price)
                            <span
                                class="ml-2 text-base sm:text-lg xl:text-xl text-gray-400 line-through">₹{{ number_format($product->price * 1.03, 0) }}</span>
                        @endif
                        <p
                            class="font-['Outfit'] text-[11px] sm:text-[12px] xl:text-[14px] 2xl:text-base min-[2000px]:text-lg leading-[16px] sm:leading-[18px] text-[#808080] mt-1">
                            (MRP
                            inclusive of all taxes)</p>
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center space-x-2 font-['Outfit'] mt-3 sm:mt-4">
                        <img src="{{ asset('assets/true_sign.png') }}" class="h-4 w-4 sm:h-5 sm:w-5 xl:h-6 xl:w-6" alt="">
                        <span
                            class="text-[13px] sm:text-[14px] xl:text-base 2xl:text-lg min-[2000px]:text-xl leading-tight text-[#3D3D42] font-medium">
                            {{ $product->stock > 0 ? 'In stock - ready to ship' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>

                <!-- Offers -->
                <p
                    class="font-['Outfit'] mt-4 sm:mt-6 text-[#1A1A1A] text-base sm:text-lg xl:text-xl 2xl:text-2xl min-[2000px]:text-3xl font-medium mb-0">
                    Offers For You
                </p>
                <div
                    class="w-full bg-[#F2F4F7] min-h-[50px] h-auto py-2 sm:py-3 xl:py-4 min-[2000px]:h-[70px] rounded-lg flex items-center justify-between cursor-pointer px-3 sm:px-4 xl:px-5 hover:bg-gray-200 transition-colors">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <img src="{{ asset('assets/5off.png') }}"
                            class="h-6 w-6 sm:h-8 sm:w-8 xl:h-10 xl:w-10 2xl:h-12 2xl:w-12 min-[2000px]:h-14 min-[2000px]:w-14"
                            alt="offer">
                        <div
                            class="font-['Outfit'] text-gray-700 text-xs sm:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl">
                            EXTRA 10% OFF on Silver Jewellery above ₹999
                        </div>
                    </div>
                    <i
                        class="fa-solid fa-angle-down text-[#3D3D42] text-sm sm:text-base xl:text-lg min-[2000px]:text-xl"></i>
                </div>

                <!-- Size Selection -->
                @php
                    $isRing = ($product->category && str_contains(strtolower($product->category->name), 'ring'));
                @endphp
                @if($isRing && $product->variants->where('size', '!=', null)->count() > 0)
                    <div class="mt-6 sm:mt-8">
                        <div class="flex justify-between items-center mb-3 sm:mb-4">
                            <h3
                                class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit']">
                                Select Size</h3>
                        </div>
                        <div id="size-container" class="flex font-['Outfit'] flex-wrap gap-2">
                            @foreach($product->variants->sortBy('size') as $index => $variant)
                                <button onclick="selectSize(this, '{{ $variant->size }}')"
                                    class="{{ $index >= 10 ? 'extra-size hidden' : '' }} px-4 py-1.5 sm:px-6 sm:py-2 xl:px-7 xl:py-2.5 text-[10px] sm:text-xs xl:text-sm tracking-wider rounded-full border-[1.8px] {{ $index === 0 ? 'border-[#CBA65A] text-[#CBA65A]' : 'border-[#D7D7DA] text-[#0D0D0E]' }} bg-white hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all">
                                    {{ $variant->size }}
                                </button>
                            @endforeach

                            @if($product->variants->count() > 10)
                                <button id="view-more-btn" onclick="toggleSizes()"
                                    class="text-[10px] sm:text-xs xl:text-sm font-Outfit text-gray-400 underline hover:text-amber-800 transition-colors ml-2">
                                    View More
                                </button>
                            @endif
                        </div>
                        <p class="text-[10px] sm:text-xs xl:text-sm text-gray-500 mt-2 font-['Outfit']">* Check availability for
                            your size</p>
                    </div>
                @endif

                <!-- Options Selection -->
                <div class="mt-6 sm:mt-8 space-y-5 sm:space-y-6">

                    <!-- Metal Selection -->
                    <div>
                        <h3
                            class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit'] mb-3 sm:mb-4">
                            Metal
                        </h3>
                        <div class="flex font-['Outfit'] flex-wrap gap-2 metal-container items-center">
                            @foreach($metals as $index => $metal)
                                <button onclick="selectOption(this, 'metal-container', 'metal_purity', '{{ $metal->name }}')"
                                    class="px-4 py-1.5 sm:px-6 sm:py-2 xl:px-7 xl:py-2.5 text-[10px] sm:text-xs xl:text-sm tracking-widest rounded-full border-[1.8px] {{ $index === 0 ? 'border-[#CBA65A] text-[#CBA65A]' : 'border-[#D7D7DA] text-[#0D0D0E]' }} bg-white hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all flex items-center justify-center {{ $index >= 4 ? 'hidden extra-metal' : '' }}">
                                    {{ $metal->name }}
                                </button>
                            @endforeach
                            @if($metals->count() > 4)
                                <div class="w-full">
                                    <button onclick="toggleViewMore(this, 'extra-metal')"
                                        class="text-[10px] sm:text-xs xl:text-sm font-Outfit text-gray-400 underline hover:text-[#CBA65A] transition-colors bg-transparent border-none p-0 cursor-pointer text-left block mt-1">
                                        View More
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Diamond Quality -->
                    <div>
                        <h3
                            class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit'] mb-3 sm:mb-4">
                            Diamond Quality
                        </h3>
                        <div class="flex font-['Outfit'] flex-wrap gap-2 quality-container items-center">
                            @foreach($diamondQualities as $index => $quality)
                                <button
                                    onclick="selectOption(this, 'quality-container', 'diamond_quality', '{{ $quality->name }}')"
                                    class="px-4 py-1.5 sm:px-6 sm:py-2 xl:px-7 xl:py-2.5 text-[10px] sm:text-xs xl:text-sm tracking-widest rounded-full border-[1.8px] {{ $index === 0 ? 'border-[#CBA65A] text-[#CBA65A]' : 'border-[#D7D7DA] text-[#0D0D0E]' }} bg-white hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all flex items-center justify-center {{ $index >= 4 ? 'hidden extra-quality' : '' }}">
                                    {{ $quality->name }}
                                </button>
                            @endforeach
                            @if($diamondQualities->count() > 4)
                                <div class="w-full">
                                    <button onclick="toggleViewMore(this, 'extra-quality')"
                                        class="text-[10px] sm:text-xs xl:text-sm font-Outfit text-gray-400 underline hover:text-[#CBA65A] transition-colors bg-transparent border-none p-0 cursor-pointer text-left block mt-1">
                                        View More
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Diamond Shape -->
                    <div>
                        <h3
                            class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit'] mb-3 sm:mb-4">
                            Diamond Shape
                        </h3>
                        <div class="flex font-['Outfit'] flex-wrap gap-2 shape-container items-center">
                            @foreach($shapes as $index => $shape)
                                <button onclick="selectOption(this, 'shape-container', 'shape', '{{ $shape->name }}')"
                                    class="px-4 py-1.5 sm:px-6 sm:py-2 xl:px-7 xl:py-2.5 text-[10px] sm:text-xs xl:text-sm tracking-widest rounded-full border-[1.8px] {{ $index === 0 ? 'border-[#CBA65A] text-[#CBA65A]' : 'border-[#D7D7DA] text-[#0D0D0E]' }} bg-white hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all flex items-center justify-center {{ $index >= 4 ? 'hidden extra-shape' : '' }}">
                                    {{ $shape->name }}
                                </button>
                            @endforeach
                            @if($shapes->count() > 4)
                                <div class="w-full">
                                    <button onclick="toggleViewMore(this, 'extra-shape')"
                                        class="text-[10px] sm:text-xs xl:text-sm font-Outfit text-gray-400 underline hover:text-[#CBA65A] transition-colors bg-transparent border-none p-0 cursor-pointer text-left block mt-1">
                                        View More
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Metal Color -->
                    <div>
                        <h3
                            class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit'] mb-3 sm:mb-4">
                            Metal Color
                        </h3>
                        <div class="flex font-['Outfit'] flex-wrap gap-4 sm:gap-6 color-container items-end pt-8">
                            @foreach($metalColors as $index => $color)
                                <button onclick="selectOption(this, 'color-container', 'metal_color', '{{ $color->name }}')"
                                    class="relative w-[70px] sm:w-[120px] h-[60px] sm:h-[70px] rounded-[10px] {{ $index === 0 ? 'border-[1.8px] border-[#CBA65A] text-[#CBA65A] bg-white' : 'border-none text-[#0D0D0E] bg-[#F2F2F3]' }} transition-all flex flex-col justify-end items-center pb-2.5 sm:pb-3 {{ $index >= 3 ? 'hidden extra-color' : '' }}">
                                    <span
                                        class="absolute -top-[20px] sm:-top-[26px] w-[40px] h-[40px] sm:w-[52px] sm:h-[52px] rounded-full border-[2px] sm:border-[2.31px] border-white shadow-sm inline-block"
                                        style="background: {{ $color->color_code ?? '#E9BB78' }};"></span>
                                    <span
                                        class="text-xs sm:text-base xl:text-lg font-medium tracking-wider">{{ $color->name }}</span>
                                </button>
                            @endforeach
                            @if($metalColors->count() > 3)
                                <button onclick="toggleViewMore(this, 'extra-color')"
                                    class="text-[10px] sm:text-xs xl:text-sm font-Outfit text-gray-400 underline hover:text-[#CBA65A] transition-colors ml-2 bg-transparent border-none p-0 cursor-pointer mb-2 w-full text-left mt-2 block">
                                    View More
                                </button>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="mt-6 sm:mt-8 flex flex-wrap w-full items-center gap-2 sm:gap-[10px] md:gap-[20px]">
                    <form action="{{ route('cart.store') }}" method="POST"
                        class="flex-1 w-full md:max-w-[465px] xl:max-w-[500px] 2xl:max-w-[550px] min-[2000px]:max-w-[600px]">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="w-full h-[50px] sm:h-[60px] xl:h-[70px] 2xl:h-[85px] min-[2000px]:h-[100px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] hover:bg-[#B38940] rounded-[100px] text-white py-3 sm:py-4 px-4 sm:px-[16px] flex items-center justify-center gap-2 sm:gap-3 xl:gap-[12px] shadow-sm transform hover:scale-[1.02] transition-transform">
                            <img src="{{ asset('assets/ic_bag.png') }}"
                                class="h-5 w-5 sm:h-[24px] sm:w-[24px] xl:h-[28px] xl:w-[28px] 2xl:h-[30px] 2xl:w-[30px] min-[2000px]:h-[32px] min-[2000px]:w-[32px] brightness-0 invert"
                                alt="bag">
                            <span
                                class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl font-medium font-['Outfit']">Add
                                to Cart</span>
                        </button>
                    </form>

                    <div class="wishlist-btn w-[50px] h-[50px] sm:w-[60px] sm:h-[60px] xl:w-[70px] xl:h-[70px] 2xl:w-[75px] 2xl:h-[75px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex md:shrink-0 items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105 cursor-pointer"
                        data-product-id="{{ $product->id }}">
                        @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                            <i class="fa-solid fa-heart text-[#CBA65A] text-lg sm:text-xl xl:text-2xl"></i>
                        @else
                            <img src="{{ asset('assets/ic_wishlist.png') }}"
                                class="h-5 w-5 sm:h-[24px] sm:w-[24px] xl:h-[28px] xl:w-[28px] 2xl:h-[30px] 2xl:w-[30px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]"
                                alt="wishlist">
                        @endif
                    </div>

                    <button
                        class="w-[50px] h-[50px] sm:w-[60px] sm:h-[60px] xl:w-[70px] xl:h-[70px] 2xl:w-[75px] 2xl:h-[75px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105">
                        <img src="{{ asset('assets/share_icon.png') }}"
                            class="h-5 w-5 sm:h-[24px] sm:w-[24px] xl:h-[28px] xl:w-[28px] 2xl:h-[30px] 2xl:w-[30px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]"
                            alt="share">
                    </button>
                </div>

                <!-- Trust Badges -->
                <div
                    class="w-full h-auto mt-6 sm:mt-8 flex flex-row flex-wrap sm:flex-nowrap items-start sm:items-center justify-between gap-2 sm:gap-6 md:gap-[18px]">
                    <div
                        class="flex flex-col items-center text-center gap-1.5 sm:gap-[6px] w-[30%] sm:w-full sm:max-w-[200px] flex-1">
                        <img src="{{ asset('assets/IC_product_safty.png') }}"
                            class="h-6 w-6 sm:h-8 sm:w-8 xl:h-[32px] xl:w-[32px] object-contain" alt="30 Day returnable">
                        <p
                            class="text-[10px] sm:text-sm xl:text-[16px] leading-[14px] sm:leading-[20px] font-medium font-['Outfit'] text-[#5C4522]">
                            30 Day returnable</p>
                    </div>
                    <div
                        class="flex flex-col items-center text-center gap-1.5 sm:gap-[6px] w-[30%] sm:w-full sm:max-w-[200px] flex-1">
                        <img src="{{ asset('assets/IC_product_safty.png') }}"
                            class="h-6 w-6 sm:h-8 sm:w-8 xl:h-[32px] xl:w-[32px] object-contain" alt="Lifetime Exchange">
                        <p
                            class="text-[10px] sm:text-sm xl:text-[16px] leading-[14px] sm:leading-[20px] font-medium font-['Outfit'] text-[#5C4522]">
                            Lifetime Exchange &<br>Buy-Back</p>
                    </div>
                    <div
                        class="flex flex-col items-center text-center gap-1.5 sm:gap-[6px] w-[30%] sm:w-full sm:max-w-[200px] flex-1">
                        <img src="{{ asset('assets/IC_product_safty.png') }}"
                            class="h-6 w-6 sm:h-8 sm:w-8 xl:h-[32px] xl:w-[32px] object-contain" alt="Certified Jewellery">
                        <p
                            class="text-[10px] sm:text-sm xl:text-[16px] leading-[14px] sm:leading-[20px] font-medium font-['Outfit'] text-[#5C4522]">
                            Certified Jewellery</p>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="mt-8 sm:mt-10 xl:mt-12 w-full max-w-[677px]">
                    <div class="flex items-center justify-between mb-3.5">
                        <h4
                            class="text-[16px] sm:text-[20px] xl:text-[22px] font-['Outfit'] font-normal text-[#0D0D0E] m-0 leading-[24px] sm:leading-[28px]">
                            Estimated Delivery Date
                        </h4>
                        <button
                            class="flex items-center justify-end gap-1 sm:gap-1.5 text-[#5C4522] hover:text-[#CBA65A] transition-colors leading-[20px] sm:leading-[25px]">
                            <img src="{{ asset('assets/ic_location.png') }}"
                                class="h-[18px] w-[18px] sm:h-[24px] sm:w-[24px]" alt="Locate Me">
                            <span class="text-[14px] sm:text-[18px] xl:text-[20px] font-['Outfit'] font-medium">Locate
                                Me</span>
                        </button>
                    </div>

                    <div
                        class="relative flex items-center w-full bg-[#F2F4F7] rounded-[8px] h-[56px] sm:h-[64px] overflow-hidden">
                        <input type="text" id="pincode-input" placeholder="Enter Pincode" maxlength="6"
                            onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"
                            class="w-full h-full bg-transparent border-none py-4 px-5 text-[16px] xl:text-[18px] font-['Outfit'] text-[#0D0D0E] placeholder:text-[#0D0D0E] focus:outline-none focus:ring-0">
                        <button id="pincode-check-btn" onclick="checkPincode()"
                            class="absolute right-4 font-['Outfit'] text-[#D7D7DA] font-normal text-[16px] xl:text-[18px] transition-colors flex items-center gap-2 hover:text-[#5C4522]">
                            <span id="pincode-btn-text">Confirm</span>
                            <svg id="pincode-spinner" class="hidden animate-spin h-4 w-4 text-[#CBA65A]"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Pincode Result -->
                    <div id="pincode-result" class="mt-2 text-[14px] font-['Outfit'] font-medium hidden"></div>

                    <p
                        class="font-['Outfit'] text-[14px] sm:text-[16px] xl:text-[18px] leading-[23px] text-[#56565D] mt-3.5 mb-0 font-normal">
                        Enter Pincode to get expected delivery date
                    </p>

                    <div class="mt-6 sm:mt-8 w-full text-center sm:text-left md:text-center">
                        <p
                            class="font-['Outfit'] font-light text-[14px] sm:text-[16px] xl:text-[20px] leading-[25px] text-[#3D3D42] m-0">
                            Any Questions? Please feel free to reach us at: <a href="tel:18004190066"
                                class="text-[#3D3D42] hover:text-[#1A1A1A]">18004190066</a>
                        </p>
                    </div>
                </div>

                <script>
                    function checkPincode() {
                        const input = document.getElementById('pincode-input');
                        const result = document.getElementById('pincode-result');
                        const spinner = document.getElementById('pincode-spinner');
                        const btnText = document.getElementById('pincode-btn-text');
                        const pincode = input.value.trim();

                        if (!pincode || pincode.length !== 6 || !/^\d{6}$/.test(pincode)) {
                            result.classList.add('hidden');
                            result.textContent = '';
                            input.classList.add('border-red-400', 'border');
                            setTimeout(() => input.classList.remove('border-red-400', 'border'), 1000);
                            return;
                        }

                        spinner.classList.remove('hidden');
                        btnText.textContent = '';
                        result.classList.add('hidden');
                        input.classList.remove('border-red-400', 'border');

                        setTimeout(() => {
                            spinner.classList.add('hidden');
                            btnText.textContent = 'Confirm';

                            result.className = "mt-3 text-[14px] font-['Outfit'] font-medium text-green-600 flex items-center gap-1";
                            result.innerHTML = '<i class="fa-solid fa-circle-check"></i>&nbsp;Delivery Available for pincode <strong>' + pincode + '</strong>';
                            result.classList.remove('hidden');
                        }, 1200);
                    }

                    document.getElementById('pincode-input').addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') checkPincode();
                    });

                    document.getElementById('pincode-input').addEventListener('input', function () {
                        const result = document.getElementById('pincode-result');
                        const btnText = document.getElementById('pincode-btn-text');
                        result.classList.add('hidden');
                        result.textContent = '';

                        if (this.value.trim().length === 6) {
                            btnText.classList.remove('text-[#D7D7DA]');
                            btnText.classList.add('text-[#0D0D0E]');
                        } else {
                            btnText.classList.add('text-[#D7D7DA]');
                            btnText.classList.remove('text-[#0D0D0E]');
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Product Details Tabs Section -->
        <div class="bg-[#FDFBF7] py-12 px-4 md:px-15 font-sans text-[#4A4A4A] mt-8 sm:mt-10 border-t border-gray-200">
            <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
                <img src="{{ asset('assets/Design.png') }}"
                    class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
                <div class="text-center flex flex-col items-center">
                    <p style="font-family: 'Alexandria', sans-serif;"
                        class="text-[12px] tracking-[0.2em] text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px] uppercase">
                        Detailed Info</p>
                    <h2
                        class="font-['Outfit'] font-medium text-[28px] md:text-[40px] leading-tight md:leading-[68px] text-[#CBA65A]">
                        Specification</h2>
                </div>
                <img src="{{ asset('assets/Design (1).png') }}"
                    class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
            </div>

            <div class="flex flex-wrap justify-center gap-2 mb-5 font-['Outfit']">
                <button onclick="switchTab('about', this)"
                    class="px-4 md:px-8 py-2 border border-black bg-black text-white text-sm rounded-full font-medium shadow-md transition duration-300">
                    About
                </button>
                <button onclick="switchTab('details', this)"
                    class="px-4 md:px-8 py-2 border border-[#E8E1D5] text-gray-600 text-sm rounded-full font-medium transition duration-300 hover:bg-black hover:text-white">
                    Diamond & Metal Details
                </button>
                <button onclick="switchTab('price', this)"
                    class="px-4 md:px-8 py-2 border border-[#E8E1D5] text-gray-600 text-sm rounded-full font-medium transition duration-300 hover:bg-black hover:text-white">
                    Price Breakup
                </button>
            </div>

            <!-- About Content (Visible by default) -->
            <div id="content-about" class="bg-[#FAF8F1] w-full max-w-[1120px] mx-auto transition-opacity duration-300">
                <div
                    class="bg-[#FAF8F1] flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-0 p-8 rounded-xl border border-[#F2F4F7]">
                    <div
                        class="bg-[#FAF8F1] flex-1 px-4 lg:pl-[20px] flex flex-col justify-center h-full text-center lg:text-left">
                        <span
                            class="text-[20px] leading-[20px] font-['Outfit'] text-gray-500 mb-3 min-[2000px]:text-2xl">About
                            Your</span>
                        <h3
                            class="text-[28px] leading-[36px] font-medium font-['Outfit'] text-[#1A1A1A] mb-4 min-[2000px]:text-4xl min-[2000px]:leading-[48px]">
                            {{ $product->name }}
                        </h3>
                        <p
                            class="text-[14px] leading-[22px] font-['Outfit'] text-[#808080] mb-8 w-full max-w-[500px] mx-auto lg:mx-0 min-[2000px]:text-lg min-[2000px]:max-w-[700px]">
                            {{ $product->description ?? 'No description available for this product.' }}
                        </p>
                        <div
                            class="w-full max-w-[580px] h-[52px] bg-[#FAF5F5] rounded-[8px] flex justify-between items-center px-6 shadow-sm mx-auto lg:mx-0">
                            <span
                                class="text-[14px] font-medium font-['Outfit'] text-[#1A1A1A] min-[2000px]:text-lg">Weight</span>
                            <span class="text-[14px] font-medium font-['Outfit'] text-[#1A1A1A] min-[2000px]:text-lg">
                                {{ $product->weight ?? 0 }} gram</span>
                        </div>
                    </div>
                    <div
                        class="w-full max-w-[300px] aspect-square rounded-[12px] border border-[#F2F4F7] flex items-center justify-center p-4 bg-white">
                        @php
                            $aMainImagePath = $product->image ?: ($product->images->first() ? $product->images->first()->image_path : null);
                            $isVideo = false;
                            if ($aMainImagePath) {
                                $extension = strtolower(pathinfo(parse_url($aMainImagePath, PHP_URL_PATH), PATHINFO_EXTENSION));
                                $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov']);
                            }
                        @endphp
                        @if($aMainImagePath)
                            @if($isVideo)
                                <video src="{{ $aMainImagePath }}" autoplay loop muted playsinline
                                    class="w-full h-full object-contain mix-blend-multiply"></video>
                            @else
                                <img src="{{ $aMainImagePath }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain mix-blend-multiply">
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50/50">
                                {{-- No Fallback Image --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Price Breakup Content (Hidden by default) -->
            <div id="content-price"
                class="w-full max-w-[1120px] mx-auto hidden transition-opacity duration-300 font-['Outfit'] flex flex-row gap-[20px]">
                <div class="bg-[#FAF8F1] w-full rounded-2xl border border-[#F2F4F7] overflow-hidden">
                    @php
                        $priceGoldValue = $product->price_gold_value ?? 0;
                        $priceDiamondValue = $product->price_diamond_value ?? 0;
                        $makingCharges = $product->making_charges ?? 0;
                        $gstPercentage = $product->tax_rate ?? 3;

                        // Base total from components
                        $baseTotal = $priceGoldValue + $priceDiamondValue + $makingCharges;

                        // Discount Amount
                        $discountAmount = 0;
                        if ($product->discount_price && $product->discount_price < $product->price) {
                            $discountAmount = $product->price - $product->discount_price;
                        }

                        // Sub Total (Taxable Amount)
                        $subTotal = $baseTotal - $discountAmount;
                        // Ensure subTotal is not negative
                        if ($subTotal < 0)
                            $subTotal = 0;

                        // GST Amount (3%)
                        $gstAmount = $subTotal * 0.03;

                        // Grand Total
                        $grandTotal = $subTotal * 1.03;
                    @endphp
                    <div class="bg-white p-6 border-b border-[#E8E1D5]">
                        <h3 class="text-[#5C4522] text-xl font-bold">Price Breakup</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-[#FAF8F1] text-[#5C4522] text-sm md:text-base border-b border-[#E8E1D5]">
                                    <th class="py-4 px-6 font-bold">Component</th>
                                    <th class="py-4 px-6 font-bold text-center">Rate</th>
                                    <th class="py-4 px-6 font-bold text-center">Weight</th>
                                    <th class="py-4 px-6 font-bold text-center">Discount</th>
                                    <th class="py-4 px-6 font-bold text-right">Final Value</th>
                                </tr>
                            </thead>
                            <tbody class="text-[#1A1A1A] text-sm md:text-base">
                                <!-- Row 1 -->
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">{{ $product->metal_type ?? 'Gold' }}
                                        {{ $product->metal_purity ?? '' }}
                                    </td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">{{ $product->weight ?? 0 }} gram</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-gold-rate" class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($priceGoldValue, 2) }}</td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Total Gold Value</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($priceGoldValue, 2) }}</td>
                                </tr>
                                <!-- Row 3 -->
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Diamonds</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">{{ $product->diamond_carat ?? 0 }} ct</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-diamond" class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($priceDiamondValue, 2) }}</td>
                                </tr>
                                <!-- Row 4 -->
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Total Diamond Value</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($priceDiamondValue, 2) }}</td>
                                </tr>
                                <!-- Row 5 -->
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Making Charges</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-making" class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($makingCharges, 2) }}</td>
                                </tr>
                                <!-- Row 6 -->
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Discount on Selling Price</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        {{ $discountAmount > 0 ? '₹' . number_format($discountAmount, 2) : '-' }}
                                    </td>
                                </tr>
                                <!-- Row 7 -->
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Sub Total</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-subtotal" class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($subTotal, 2) }}
                                    </td>
                                </tr>
                                <!-- Row 8 -->
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">GST ({{ $gstPercentage }}%)</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-gst-full" class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($gstAmount, 2) }}</td>
                                </tr>
                                <!-- Row 9 -->
                                <tr class="bg-white">
                                    <td class="py-4 px-6 font-bold">Grand Total</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td id="price-grand-full" class="py-4 px-6 text-right font-bold text-lg">
                                        ₹{{ number_format($grandTotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Accordion Container -->
            <div id="content-details"
                class="w-full max-w-[1120px] mx-auto font-['Outfit'] flex flex-col items-center gap-[20px] hidden">

                <!-- Diamond Details Accordion (Collapsed) -->
                @if($product->diamond_carat)
                    <div class="w-full border-2 border-[#F2F4F7] rounded-xl overflow-hidden bg-white shadow-sm">
                        <button onclick="toggleAccordion(this)"
                            class="w-full h-[70px] px-8 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors cursor-pointer text-left focus:outline-none">
                            <span class="text-[#5C4522] font-bold text-lg min-[2000px]:text-2xl font-['Outfit']">Diamond
                                Details</span>
                            <div class="accordion-icon w-8 h-8 rounded-full bg-[#FAF6F0] flex items-center justify-center">
                                <i class="fa-solid fa-plus text-[#CBA65A]"></i>
                            </div>
                        </button>
                        <div class="px-0 pb-6 transition-all duration-300 ease-in-out opacity-0 overflow-hidden"
                            style="max-height: 0px;">
                            <!-- Content -->
                            <div class="space-y-0 text-sm min-[2000px]:text-xl font-['Outfit']">
                                <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                    <span class="text-[#808080]">Total Weight</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_carat }} ct</span>
                                </div>
                                <div class="bg-[#FBF9F3] flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                    <span class="text-[#808080]">Clarity</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_clarity ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                    <span class="text-[#808080]">Color</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_color ?? '-' }}</span>
                                </div>
                                <div class="bg-[#FBF9F3] flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                    <span class="text-[#808080]">Count</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_count ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                    <span class="text-[#808080]">Shape</span>
                                    <span
                                        class="text-[#1A1A1A] font-medium">{{ optional($product->diamondShape)->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Metal Details Accordion (Active/Open) -->
                <div
                    class="w-full border border-[#F2F4F7] rounded-xl overflow-hidden bg-white shadow-sm transition-all duration-300">
                    <button onclick="toggleAccordion(this)"
                        class="w-full h-[70px] px-8 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors cursor-pointer text-left focus:outline-none">
                        <span class="text-[#5C4522] font-bold text-lg min-[2000px]:text-2xl font-['Outfit']">Metal
                            Details</span>
                        <div class="accordion-icon w-8 h-8 rounded-full bg-[#FAF6F0] flex items-center justify-center">
                            <i class="fa-solid fa-minus text-[#CBA65A]"></i>
                        </div>
                    </button>
                    <div class="px-0 transition-all duration-300 ease-in-out mt-4" style="max-height: 1000px;">
                        <!-- Metal Details Content -->
                        <div class="space-y-0 text-sm min-[2000px]:text-xl pb-6 font-['Outfit']">
                            <div class="bg-[#FBF9F3] flex justify-between py-4 border-b border-[#F2F4F7] px-4">
                                <span class="text-[#808080]"> Type</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->metal_type ?? 'Gold' }}</span>
                            </div>
                            <div class="flex justify-between py-4 px-4">
                                <span class="text-[#808080]">Purity</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->metal_purity ?? '-' }}</span>
                            </div>
                            <div class="bg-[#FBF9F3] flex justify-between py-4 px-4">
                                <span class="text-[#808080]">Weight</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->weight ?? 0 }} gram</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Ratings and reviews section -->
        <style>
            @media (max-width: 1023px) {
                .responsive-review-rating {
                    margin-left: 0 !important;
                    justify-content: center !important;
                    width: 100% !important;
                }

                .responsive-review-btn {
                    margin-left: 0 !important;
                    align-self: center !important;
                }
            }

            /* Tablet / Small Laptop (1024px) */
            @media (min-width: 1024px) and (max-width: 1279px) {
                .responsive-review-rating {
                    margin-left: 4rem !important;
                }

                .responsive-review-btn {
                    margin-left: 6rem !important;
                }
            }

            /* Standard Laptop/Desktop (1280px - 2559px) */
            @media (min-width: 1280px) and (max-width: 2559px) {
                .responsive-review-rating {
                    margin-left: 10.5rem !important;
                }

                .responsive-review-btn {
                    margin-left: 13rem !important;
                }
            }

            /* Big Screen / Ultra-wide (2560px+) */
            @media (min-width: 2560px) {
                .responsive-review-rating {
                    margin-left: 12.5rem !important;
                }

                .responsive-review-btn {
                    margin-left: 15.5rem !important;
                }
            }
        </style>
        <section
            class="h-full w-full max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto py-8 sm:py-10 md:py-12 lg:py-16 font-sans px-4 sm:px-6 md:px-8 lg:px-8">
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-8 md:gap-10 lg:gap-6 xl:gap-8">
                <!-- Left Side: Summary -->
                <div class="w-full lg:w-1/3 flex flex-col items-center lg:items-start py-6 md:py-8 gap-5 md:gap-6">
                    <div class="flex items-center gap-3 md:gap-4 justify-start w-full">
                        <div
                            class="flex-row justify-end gap-[9px] w-auto lg:w-[180px] xl:w-[200px] h-[22px] md:h-[25px] flex">
                            <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain">
                        </div>
                        <div class="text-left flex flex-col justify-center items-start">
                            <span
                                class="text-[14px] md:text-[16px] lg:text-[17px] xl:text-[18px] min-[2560px]:text-[24px] text-[#5C4522] block font-['Alexandria'] leading-none">Ratings
                                &</span>
                            <h2
                                class="text-[28px] md:text-[30px] lg:text-[32px] xl:text-[36px] min-[2560px]:text-[48px] text-[#CBA65A] font-medium font-['Outfit'] leading-tight">
                                Reviews
                            </h2>
                        </div>
                    </div>


                    <div
                        class="flex items-center justify-center lg:justify-start responsive-review-rating w-auto lg:w-[190px] h-[30px] gap-[10px]">
                        <div class="flex items-center gap-[10px] text-[#F5B800] h-full">
                            @php $rating = $product->reviews->avg('rating') ?? 0; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    <i class="fas fa-star text-xl lg:text-[24px] min-[2560px]:text-[32px]"></i>
                                @elseif($i == ceil($rating) && $rating - floor($rating) >= 0.5)
                                    <i class="fas fa-star-half-alt text-xl lg:text-[24px] min-[2560px]:text-[32px]"></i>
                                @else
                                    <i class="far fa-star text-xl lg:text-[24px] min-[2560px]:text-[32px]"></i>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="font-['Outfit'] font-medium text-[24px] md:text-[25px] lg:text-[26px] min-[2560px]:text-[36px] leading-none text-[#1A1A1A]">{{ number_format($rating, 1) }}</span>
                    </div>


                    <button onclick="openReviewModal()"
                        class="self-center lg:self-start responsive-review-btn w-auto px-8 md:px-9 lg:px-12 h-[50px] md:h-[55px] lg:h-[60px] min-[2560px]:h-[80px] border border-[#CBA65A] text-[#CBA65A] bg-transparent text-[18px] md:text-[20px] lg:text-[22px] min-[2560px]:text-[28px] font-medium leading-none rounded-full hover:bg-[#CBA65A] hover:text-white transition-all font-['Outfit'] tracking-normal flex items-center justify-center whitespace-nowrap">
                        Write Review
                    </button>
                </div>

                <!-- Right Side: Reviews Card -->
                <div class="w-full lg:w-2/3"
                    x-data="{ 
                                                                                                                                                                                                                                                                                                                            current: 0, 
                                                                                                                                                                                                                                                                                                                            total: {{ ceil($product->reviews->count() / 3) }},
                                                                                                                                                                                                                                                                                                                            next() { this.current = (this.current + 1) % this.total },
                                                                                                                                                                                                                                                                                                                            prev() { this.current = (this.current - 1 + this.total) % this.total }
                                                                                                                                                                                                                                                                                                                        }">
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-[#F2F4F7] overflow-hidden shadow-sm">
                        <!-- Card Header -->
                        <div class="bg-white border-b border-[#F2F4F7] px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                            <h3 class="text-[#5C4522] font-semibold font-['Outfit'] text-base sm:text-lg md:text-xl">
                                Customers
                                Review</h3>
                        </div>

                        <!-- Card Body (Reviews List) -->
                        <div
                            class="bg-[#FAF8F1] px-4 sm:px-6 md:px-8 py-4 sm:py-5 md:py-6 h-auto min-h-[400px] lg:min-h-[500px] space-y-4 sm:space-y-5 md:space-y-6 relative">
                            @forelse($product->reviews->chunk(3) as $index => $chunk)
                                <div x-show="current === {{ $index }}"
                                    class="space-y-4 sm:space-y-5 md:space-y-6 transition-opacity duration-300"
                                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100">
                                    @foreach($chunk as $review)
                                        <div class="border-b border-[#E8E1D5] pb-4 sm:pb-5 md:pb-6 last:border-0 last:pb-0">
                                            <p
                                                class="text-[#3D3D42] text-[14px] sm:text-[15px] md:text-[16px] leading-relaxed mb-3 sm:mb-4 font-['Outfit'] break-words overflow-hidden">
                                                "{{ $review->comment }}"
                                            </p>
                                            <div
                                                class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2 sm:gap-0">
                                                <div class="flex items-center gap-4">
                                                    <!-- Profile Avatar or Initials -->
                                                    @if($review->user && $review->user->profile_picture)
                                                        <img src="{{ asset('storage/' . $review->user->profile_picture) }}"
                                                            class="w-10 h-10 rounded-full object-cover border border-[#D7D7DA]"
                                                            alt="{{ $review->user->name ?? 'User' }}">
                                                    @else
                                                        <div
                                                            class="w-10 h-10 rounded-full bg-[#EFE4CD] flex items-center justify-center text-[#5C4522] font-['Outfit'] font-bold text-sm uppercase border border-[#EADDCC]">
                                                            {{ $review->user->initials ?? 'U' }}
                                                        </div>
                                                    @endif

                                                    <div class="flex flex-col">
                                                        <span
                                                            class="text-[#0D0D0E] font-['Outfit'] text-sm sm:text-base md:text-[18px] font-medium leading-none">{{ $review->user->name ?? 'Anonymous' }}</span>
                                                        <div
                                                            class="mt-2 border border-[#D7D7DA] rounded-lg px-3 py-1 bg-white text-[12px] sm:text-[14px] flex items-center gap-2 font-['Outfit'] w-fit">
                                                            <span class="font-bold text-[#1A1A1A]">{{ $review->rating }}</span>
                                                            <i class="fas fa-star text-[#F5B800] text-[10px] sm:text-[12px]"></i>
                                                            <span
                                                                class="text-[#808080] border-l border-[#D7D7DA] pl-2 ml-1 font-['Outfit']">{{ $review->created_at->format('d M Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center py-10">
                                    <p class="text-gray-500 font-['Outfit'] text-sm sm:text-base">No reviews yet. Be the first
                                        to review!</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                    <!-- Card Footer (Pagination) -->
                    @if($product->reviews->count() > 3)
                        <div
                            class="py-3 sm:py-4 px-4 sm:px-6 md:px-8 flex justify-center sm:justify-end items-center gap-2 sm:gap-3">
                            <button @click="prev()"
                                class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors focus:outline-none">
                                <i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i>
                            </button>
                            <button
                                class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full border border-[#CBA65A] text-[#CBA65A] font-medium bg-white shadow-sm text-xs sm:text-sm focus:outline-none">
                                <span x-text="current + 1"></span>
                            </button>
                            <button @click="next()"
                                class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors focus:outline-none">
                                <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        </section>
    </main>

    <!-- Full Width Banner with Alpine.js -->
    @if($banners->count() > 0)
        <section class="relative w-full h-auto mt-8 sm:mt-10 mb-8 sm:mb-10" x-data="{currentSlide: 0, 
            total: {{ $banners->count() }},
            interval: null,
            init() { 
                this.interval = setInterval(() => { this.next() }, 5000); 
            },
            next() { 
                this.currentSlide = (this.currentSlide + 1) % this.total; 
            },
            goTo(index) {
                this.currentSlide = index;
                clearInterval(this.interval);
                this.interval = setInterval(() => { this.next() }, 5000);
            }
            }">

            <div class="relative w-full ">
                @foreach($banners as $index => $banner)
                    <div class="w-full transition-opacity duration-1000 ease-in-out"
                        :class="currentSlide === {{ $index }} ? 'opacity-100 relative' : 'opacity-0 absolute top-0 left-0 pointer-events-none'">
                        <img src="{{ asset('storage/' . $banner->image) }}"
                            class="w-full h-auto min-h-[160px] sm:min-h-[200px] md:h-[350px] lg:h-[450px] xl:h-[550px] 2xl:h-[650px] object-contain md:object-cover object-center block"
                            alt="{{ $banner->title ?? 'Banner' }}">
                    </div>
                @endforeach
            </div>

            <!-- Dots -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex justify-center gap-2 z-20">
                <template x-for="i in total">
                    <button @click="goTo(i-1)" class="h-2 rounded-full transition-all duration-300"
                        :class="(currentSlide === i-1) ? 'bg-white w-6' : 'bg-white/50 w-2 hover:bg-white'">
                    </button>
                </template>
            </div>
        </section>
    @endif

    <main
        class="max-w-[1600px] xl:max-w-[1800px] 2xl:max-w-[2000px] min-[2000px]:max-w-[2400px] mx-auto px-3 sm:px-4 lg:px-8 pb-8 sm:pb-10">
        <!-- Similar Jewellery Product Section -->
        <section
            class="max-w-[1600px] xl:max-w-[1800px] 2xl:max-w-[2000px] min-[2000px]:max-w-[2400px] mx-auto py-8 sm:py-10 md:py-12 font-Outfit">
            <div class="flex items-center justify-center gap-2 md:gap-4 xl:gap-6 mb-6 sm:mb-8 w-full">
                <img src="{{ asset('assets/Design.png') }}"
                    class="h-auto w-[60px] sm:w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[350px] xl:max-w-[400px]"
                    alt="">
                <div class="text-center flex flex-col items-center">
                    <p style="font-family: 'Alexandria', sans-serif;"
                        class="text-[13px] sm:text-[15px] xl:text-[17px] text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">
                        Similar</p>
                    <h2
                        class="font-['Outfit'] font-medium text-[24px] sm:text-[28px] md:text-[32px] xl:text-[36px] 2xl:text-[40px] leading-tight md:leading-[45px] xl:leading-[50px] text-[#CBA65A]">
                        Jewellery Product</h2>
                </div>
                <img src="{{ asset('assets/Design (1).png') }}"
                    class="h-auto w-[50px] sm:w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[350px] xl:max-w-[400px]"
                    alt="">
            </div>

            <div
                class="grid grid-cols-[100px_1fr] sm:grid-cols-[130px_1fr] md:grid-cols-[220px_1fr] lg:grid-cols-5 gap-2 sm:gap-3 md:gap-5">
                <!-- Left Banner Card -->
                <div
                    class="col-span-1 h-auto min-h-[200px] w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden bg-[#111111]">
                    @if(isset($verticalBanner) && $verticalBanner)
                        <img src="{{ asset('storage/' . $verticalBanner->image) }}" alt="{{ $verticalBanner->title }}"
                            class="w-full h-full object-contain object-center">
                    @else
                        <img src="{{ asset('assets/neckless.png') }}" alt="Necklace"
                            class="w-full h-full object-contain object-center">
                    @endif
                </div>

                <!-- Right Grid -->
                <div class="col-span-1 lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-5 content-start">
                    @foreach($relatedProducts as $related)
                        <div class="flex flex-col gap-3">
                            <div
                                class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden shadow-md hover:shadow-xl">
                                <span
                                    class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                                    Seller</span>
                                <div class="absolute bottom-3 left-2 z-20 flex bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors shadow-sm cursor-pointer wishlist-btn hover:bg-[#FAF8F1]"
                                    data-product-id="{{ $related->id }}">
                                    @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $related->id))
                                        <i class="fa-solid fa-heart text-[#CBA65A] text-sm"></i>
                                    @else
                                        <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="Wishlist">
                                    @endif
                                </div>
                                <a href="{{ route('product.details', $related->slug) }}"
                                    class="w-full h-full flex items-center justify-center block">
                                    @php
                                        $rMainImagePath = $related->image ?: ($related->images->first() ? $related->images->first()->image_path : null);
                                    @endphp
                                    @if($rMainImagePath)
                                        <img src="{{ asset('storage/' . $rMainImagePath) }}" alt="{{ $related->name }}"
                                            class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:scale-110">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gray-50/50 text-gray-400 text-xs text-center">
                                            {{-- No Fallback Image --}}
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div class="text-center font-['Outfit'] px-2">
                                <h3 class="text-sm md:text-base lg:text-lg font-['outfit'] text-[#1A1A1A] mb-1 truncate w-full"
                                    title="{{ $related->name }}">
                                    <a href="{{ route('product.details', $related->slug) }}">{{ $related->name }}</a>
                                </h3>
                                <div class="flex flex-wrap items-center justify-center gap-2 text-xs md:text-sm lg:text-base">
                                    <span class="font-bold font-['outfit'] text-[#1A1A1A] whitespace-nowrap">₹
                                        {{ number_format($related->selling_price, 2) }}</span>
                                    @if($related->original_price > $related->selling_price)
                                        <span class="text-[#999999] line-through whitespace-nowrap">₹
                                            {{ number_format($related->original_price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>

    <!-- Review Modal -->
    <div id="review-modal"
        class="fixed inset-0 z-[100] bg-black/50 hidden transition-opacity duration-300 opacity-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
            <div id="review-modal-inner"
                class="bg-[#FDFBF7] rounded-2xl w-full max-w-[520px] relative shadow-2xl transform scale-95 transition-transform duration-300">

                <!-- Modal Header -->
                <div class="flex items-start justify-between px-6 pt-6 pb-4 border-b border-[#F0EDE5]">
                    <div>
                        <h2 class="font-['Outfit'] font-bold text-xl sm:text-2xl text-[#1A1A1A]">Rate This Product</h2>
                        <p class="font-['Outfit'] text-sm text-[#5C5C5C] mt-0.5">{{ $product->name }}</p>
                    </div>
                    <button onclick="closeReviewModal()"
                        class="ml-4 mt-1 text-gray-400 hover:text-gray-600 transition-colors flex-shrink-0">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="rating" id="rating-input" value="0">

                        <!-- Star Rating -->
                        <div class="mb-5 text-center">
                            <p class="font-['Outfit'] text-sm font-semibold text-[#1A1A1A] mb-3">Your Rating</p>
                            <div id="star-rating" class="flex justify-center gap-3">
                                <button type="button"
                                    class="stars text-[#E0E0E0] hover:text-[#CBA65A] transition-colors text-3xl focus:outline-none"
                                    onclick="rateProduct(1)"><i class="fas fa-star"></i></button>
                                <button type="button"
                                    class="stars text-[#E0E0E0] hover:text-[#CBA65A] transition-colors text-3xl focus:outline-none"
                                    onclick="rateProduct(2)"><i class="fas fa-star"></i></button>
                                <button type="button"
                                    class="stars text-[#E0E0E0] hover:text-[#CBA65A] transition-colors text-3xl focus:outline-none"
                                    onclick="rateProduct(3)"><i class="fas fa-star"></i></button>
                                <button type="button"
                                    class="stars text-[#E0E0E0] hover:text-[#CBA65A] transition-colors text-3xl focus:outline-none"
                                    onclick="rateProduct(4)"><i class="fas fa-star"></i></button>
                                <button type="button"
                                    class="stars text-[#E0E0E0] hover:text-[#CBA65A] transition-colors text-3xl focus:outline-none"
                                    onclick="rateProduct(5)"><i class="fas fa-star"></i></button>
                            </div>
                            <p id="rating-label" class="font-['Outfit'] text-xs text-[#CBA65A] mt-2 h-4"></p>
                        </div>

                        <!-- Review Text -->
                        <div class="mb-4">
                            <label class="block font-['Outfit'] font-semibold text-sm text-[#1A1A1A] mb-2">Review</label>
                            <textarea name="comment" placeholder="Share your experience with this product..." required
                                class="w-full h-[110px] bg-white border border-[#E6E6E6] rounded-xl p-3 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] resize-none transition-colors"></textarea>
                        </div>

                        <!-- Consent Text -->
                        <p class="text-center font-['Outfit'] text-[11px] text-[#808080] mb-5 leading-relaxed">
                            By submitting this review you consent to publish and process personal data in accordance with
                            <a href="#" class="underline text-[#5C4522]">Terms of use</a> and
                            <a href="#" class="underline text-[#5C4522]">Privacy Policy</a>
                        </p>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#D9BE87] to-[#BE933C] hover:opacity-90 text-white font-['Outfit'] font-semibold text-base py-3 rounded-full transition-all shadow-md">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openReviewModal() {
            const modal = document.getElementById('review-modal');
            const inner = document.getElementById('review-modal-inner');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                inner.classList.remove('scale-95');
                inner.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeReviewModal() {
            const modal = document.getElementById('review-modal');
            const inner = document.getElementById('review-modal-inner');
            modal.classList.add('opacity-0');
            inner.classList.remove('scale-100');
            inner.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        // Close on backdrop click
        document.getElementById('review-modal').addEventListener('click', function (e) {
            if (e.target === this || e.target.classList.contains('flex') && e.target.parentElement === this) {
                closeReviewModal();
            }
        });

        const ratingLabels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

        function rateProduct(rating) {
            const stars = document.querySelectorAll('#star-rating .stars');
            document.getElementById('rating-input').value = rating;
            document.getElementById('rating-label').textContent = ratingLabels[rating];
            stars.forEach((star, index) => {
                star.className = 'stars focus:outline-none transition-colors text-3xl ' +
                    (index < rating ? 'text-[#CBA65A]' : 'text-[#E0E0E0] hover:text-[#CBA65A]');
            });
        }
    </script>
@endsection