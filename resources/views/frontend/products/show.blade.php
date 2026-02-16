@extends('frontend.layouts.master')

@section('content')

    <!-- Image and Interaction Scripts -->
    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;
        }

        function selectSize(btn, variantId) {
            // Remove active class from all size buttons
            document.querySelectorAll('#size-container button').forEach(b => {
                b.classList.remove('border-amber-400', 'bg-amber-50');
                b.classList.add('border-gray-200', 'bg-white');
            });

            // Add active class to clicked button
            btn.classList.remove('border-gray-200', 'bg-white');
            btn.classList.add('border-amber-400', 'bg-amber-50');

            // Update hidden input if form exists (future implementation)
            const size = btn.textContent.trim();
            console.log("Selected Size:", size);
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
    </script>

    <main
        class="max-w-[1600px] xl:max-w-[1800px] 2xl:max-w-[2000px] min-[2000px]:max-w-[2400px] mx-auto px-3 sm:px-4 md:px-6 lg:px-8 pt-20 sm:pt-24 md:pt-28 lg:pt-32">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.5fr_1fr] gap-6 sm:gap-8 md:gap-10 xl:gap-12">

            <!-- Product Images -->
            <div class="space-y-2 sm:space-y-3 md:space-y-4" style="border-radius: 0;">
                <!-- Main Image Container -->
                <div class="w-full max-w-full lg:max-w-[1143px] mx-auto" style="border-radius: 0;">
                    <div class="relative w-full bg-white" style="aspect-ratio: 1143 / 1319; border-radius: 0;">
                        @if($product->images->count() > 0)
                            <img id="main-image" src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}"
                                class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10">
                        @else
                            <img id="main-image" src="{{ asset('assets/ring.png') }}" alt="{{ $product->name }}"
                                class="absolute inset-0 w-full h-full object-contain p-4 sm:p-6 md:p-8 lg:p-10">
                        @endif
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                @if($product->images->count() > 1)
                    <div class="w-full max-w-full lg:max-w-[1143px] mx-auto">
                        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-5 lg:grid-cols-5 gap-[10px]">
                            @foreach($product->images as $image)
                                <div class="cursor-pointer bg-white transition-all duration-200" style="aspect-ratio: 1 / 1;"
                                    onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')">
                                    <div class="w-full h-full flex items-center justify-center p-2 sm:p-3">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="object-contain w-full h-full"
                                            alt="Product thumbnail">
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
                        <span
                            class="font-['Outfit'] font-semibold text-[28px] sm:text-[32px] xl:text-[36px] 2xl:text-[42px] min-[2000px]:text-[48px] leading-[34px] sm:leading-[40px] xl:leading-[44px] 2xl:leading-[50px] text-[#0D0D0E]">
                            ₹{{ number_format($product->selling_price, 2) }}
                        </span>
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <span
                                class="ml-2 text-base sm:text-lg xl:text-xl text-gray-400 line-through">₹{{ number_format($product->price, 2) }}</span>
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

                <!-- Attributes Grid -->
                <div
                    class="grid grid-cols-3 w-full h-auto bg-[rgba(219,179,88,0.1)] rounded-[10px] overflow-hidden font-['Outfit'] border border-[rgba(219,179,88,0.2)]">
                    <!-- Row 1 -->
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Diamond Shape</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ optional($product->diamondShape)->name ?? '-' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Diamond Quality</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ $product->diamond_clarity ?? '-' }}/{{ $product->diamond_color ?? '-' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center border-b-2 border-[#DBB358]/20 p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Diamond Carat</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ $product->diamond_carat ? $product->diamond_carat . ' ct' : '-' }}
                        </p>
                    </div>

                    <!-- Row 2 -->
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Metal Color</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ optional($product->metalColor)->name ?? '-' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Metal Purity</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ $product->metal_purity ?? '-' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-2 sm:p-3 md:p-4 xl:p-5 text-center">
                        <p
                            class="text-[#3D3D42] text-[10px] sm:text-xs md:text-sm xl:text-base 2xl:text-lg min-[2000px]:text-xl mb-0.5 sm:mb-1">
                            Metal Type</p>
                        <p
                            class="font-bold text-[#1A1A1A] text-xs sm:text-sm md:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-2xl">
                            {{ $product->metal_type ?? '-' }}
                        </p>
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
                @if($product->variants->where('size', '!=', null)->count() > 0)
                    <div class="mt-6 sm:mt-8">
                        <div class="flex justify-between items-center mb-3 sm:mb-4">
                            <h3
                                class="text-sm sm:text-base xl:text-lg 2xl:text-xl min-[2000px]:text-xl text-gray-900 font-['Outfit']">
                                Select Size</h3>
                        </div>
                        <div id="size-container" class="flex font-['Outfit'] flex-wrap gap-2">
                            @foreach($product->variants->sortBy('size') as $index => $variant)
                                <button onclick="selectSize(this)"
                                    class="{{ $index >= 10 ? 'extra-size hidden' : '' }} px-4 py-1.5 sm:px-6 sm:py-2 xl:px-7 xl:py-2.5 text-[10px] sm:text-xs xl:text-sm tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400 transition-all">
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

                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="w-[50px] h-[50px] sm:w-[60px] sm:h-[60px] xl:w-[70px] xl:h-[70px] 2xl:w-[75px] 2xl:h-[75px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105">
                            @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                                <i class="fa-solid fa-heart text-[#CBA65A] text-lg sm:text-xl xl:text-2xl"></i>
                            @else
                                <img src="{{ asset('assets/ic_wishlist.png') }}"
                                    class="h-5 w-5 sm:h-[24px] sm:w-[24px] xl:h-[28px] xl:w-[28px] 2xl:h-[30px] 2xl:w-[30px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]"
                                    alt="wishlist">
                            @endif
                        </button>
                    </form>

                    <button
                        class="w-[50px] h-[50px] sm:w-[60px] sm:h-[60px] xl:w-[70px] xl:h-[70px] 2xl:w-[75px] 2xl:h-[75px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105">
                        <img src="{{ asset('assets/share_icon.png') }}"
                            class="h-5 w-5 sm:h-[24px] sm:w-[24px] xl:h-[28px] xl:w-[28px] 2xl:h-[30px] 2xl:w-[30px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]"
                            alt="share">
                    </button>
                </div>

                <!-- Delivery Info -->
                <div class="mt-6 sm:mt-8 pt-3 sm:pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <h4
                            class="text-xs sm:text-sm xl:text-base font-['Outfit'] font-medium flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-truck-fast text-[#CBA65A] text-sm sm:text-base xl:text-lg"></i> Estimated
                            Delivery
                        </h4>
                    </div>

                    <div class="relative flex items-center max-w-sm">
                        <input type="text" placeholder="Enter Pincode" maxlength="6"
                            class="w-full border border-gray-300 text-black rounded-md py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm xl:text-base focus:outline-none focus:ring-1 focus:ring-[#CBA65A] focus:border-[#CBA65A]">
                        <button
                            class="absolute right-2 font-Outfit px-3 sm:px-4 py-1 sm:py-1.5 bg-white text-gray-500 font-bold text-[10px] sm:text-xs xl:text-sm border-l border-gray-200 uppercase hover:text-[#CBA65A] transition-colors">
                            Check
                        </button>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div
                    class="w-full h-auto mt-6 sm:mt-8 bg-[#FAF5F5] rounded-xl p-4 sm:p-6 xl:p-8 flex flex-col md:flex-row items-center justify-between gap-4 sm:gap-6 md:gap-8 xl:gap-0 border border-[#F2F4F7]">
                    <div class="flex flex-col items-center text-center gap-1.5 sm:gap-2">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 xl:w-12 xl:h-12 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-rotate-left text-[#CBA65A] text-sm sm:text-base xl:text-lg"></i>
                        </div>
                        <p
                            class="text-xs sm:text-[14px] xl:text-base 2xl:text-lg min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            30 Day
                            Returns</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-1.5 sm:gap-2">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 xl:w-12 xl:h-12 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-arrows-rotate text-[#CBA65A] text-sm sm:text-base xl:text-lg"></i>
                        </div>
                        <p
                            class="text-xs sm:text-[14px] xl:text-base 2xl:text-lg min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            Lifetime
                            Exchange</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-1.5 sm:gap-2">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 xl:w-12 xl:h-12 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-certificate text-[#CBA65A] text-sm sm:text-base xl:text-lg"></i>
                        </div>
                        <p
                            class="text-xs sm:text-[14px] xl:text-base 2xl:text-lg min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            Certified
                            Jewellery</p>
                    </div>
                </div>
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
                        @if($product->images->count() > 0)
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply">
                        @else
                            <img src="{{ asset('assets/ring.png') }}" alt="{{ $product->name }}"
                                class="w-full h-full object-contain mix-blend-multiply">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Price Breakup Content (Hidden by default) -->
            <div id="content-price"
                class="w-full max-w-[1374px] mx-auto hidden transition-opacity duration-300 font-['Outfit'] flex flex-row gap-[20px]">
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

                        // GST Amount
                        $gstAmount = $subTotal * ($gstPercentage / 100);

                        // Grand Total
                        $grandTotal = $subTotal + $gstAmount;
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
                                    <td class="py-4 px-6 text-right font-medium">
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
                                    <td class="py-4 px-6 text-right font-medium">
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
                                    <td class="py-4 px-6 text-right font-medium">
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
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($subTotal, 2) }}
                                    </td>
                                </tr>
                                <!-- Row 8 -->
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">GST ({{ $gstPercentage }}%)</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($gstAmount, 2) }}</td>
                                </tr>
                                <!-- Row 9 -->
                                <tr class="bg-white">
                                    <td class="py-4 px-6 font-bold">Grand Total</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-bold text-lg">
                                        ₹{{ number_format($grandTotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Accordion Container -->
            <div id="content-details"
                class="w-full max-w-[1374px] mx-auto font-['Outfit'] flex flex-col items-center gap-[20px] hidden">

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
        <section
            class="h-full w-full max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto py-8 sm:py-10 md:py-12 lg:py-16 font-sans px-4 sm:px-6 md:px-8 lg:px-8">
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-8 md:gap-10 lg:gap-6 xl:gap-8">
                <!-- Left Side: Summary -->
                <div class="w-full lg:w-1/3 flex flex-col items-center lg:items-start py-6 md:py-8 gap-5 md:gap-6">
                    <div class="flex items-center gap-3 md:gap-4 justify-center lg:justify-start w-full">
                        <div
                            class="hidden md:flex flex-row justify-end gap-[9px] w-auto lg:w-[180px] xl:w-[200px] h-[22px] md:h-[25px]">
                            <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain">
                        </div>
                        <div class="text-center lg:text-left flex flex-col justify-center items-center lg:items-start">
                            <span
                                class="text-[14px] md:text-[16px] lg:text-[17px] xl:text-[18px] min-[2000px]:text-3xl text-[#5C4522] block font-['Alexandria'] leading-none">Ratings
                                &</span>
                            <h2
                                class="text-[28px] md:text-[30px] lg:text-[32px] xl:text-[36px] min-[2000px]:text-5xl text-[#CBA65A] font-medium font-['Outfit'] leading-tight">
                                Reviews
                            </h2>
                        </div>
                        <div
                            class="hidden md:flex lg:hidden flex-row justify-start gap-[9px] w-auto lg:w-[180px] xl:w-[200px] h-[22px] md:h-[25px]">
                            <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain"
                                style="transform: scaleX(-1);">
                        </div>
                    </div>


                    <div class="flex items-center gap-3 justify-center lg:justify-start">
                        <div class="flex items-center gap-1 text-[#F5B800]">
                            @php $rating = $product->reviews->avg('rating') ?? 0; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    <i class="fas fa-star text-lg md:text-xl lg:text-2xl"></i>
                                @elseif($i == ceil($rating) && $rating - floor($rating) >= 0.5)
                                    <i class="fas fa-star-half-alt text-lg md:text-xl lg:text-2xl"></i>
                                @else
                                    <i class="far fa-star text-lg md:text-xl lg:text-2xl"></i>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="font-['Outfit'] text-[30px] md:text-[32px] lg:text-[36px] text-[#1A1A1A]">{{ number_format($rating, 1) }}</span>
                    </div>


                    <button onclick="openReviewModal()"
                        class="self-center lg:self-start ml-0 lg:ml-[60px] xl:ml-[100px] w-auto px-8 md:px-9 lg:px-10 py-2 md:py-2.5 border border-[#CBA65A] text-[#CBA65A] text-sm rounded-full hover:bg-[#CBA65A] hover:text-white transition-all font-['Outfit'] tracking-wide">
                        Write Review
                    </button>
                </div>

                <!-- Right Side: Reviews Card -->
                <div class="w-full lg:w-2/3" x-data="{ 
                                                                        current: 0, 
                                                                        total: {{ ceil($product->reviews->count() / 3) }},
                                                                        next() { this.current = (this.current + 1) % this.total },
                                                                        prev() { this.current = (this.current - 1 + this.total) % this.total }
                                                                    }">
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-[#F2F4F7] overflow-hidden shadow-sm">
                        <!-- Card Header -->
                        <div class="bg-white border-b border-[#F2F4F7] px-4 sm:px-6 md:px-8 py-4 sm:py-5">
                            <h3 class="text-[#5C4522] font-bold font-['Outfit'] text-base sm:text-lg md:text-xl">Customers
                                Review</h3>
                        </div>

                        <!-- Card Body (Reviews List) -->
                        <div
                            class="bg-[#FAF8F1] px-4 sm:px-6 md:px-8 py-4 sm:py-5 md:py-6 h-[280px] sm:h-[320px] md:h-[350px] lg:h-[380px] overflow-y-auto space-y-4 sm:space-y-5 md:space-y-6 custom-scrollbar relative">
                            @forelse($product->reviews->chunk(3) as $index => $chunk)
                                <div x-show="current === {{ $index }}"
                                    class="space-y-4 sm:space-y-5 md:space-y-6 transition-opacity duration-300"
                                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100">
                                    @foreach($chunk as $review)
                                        <div class="border-b border-[#E8E1D5] pb-4 sm:pb-5 md:pb-6 last:border-0 last:pb-0">
                                            <p
                                                class="text-[#3D3D42] text-[13px] sm:text-[14px] md:text-[15px] leading-relaxed mb-3 sm:mb-4 font-['Outfit'] italic text-left">
                                                "{{ $review->comment }}"
                                            </p>
                                            <div
                                                class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between gap-2 sm:gap-0">
                                                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                                    <span
                                                        class="text-[#1A1A1A] font-['Outfit'] text-xs sm:text-sm font-bold">{{ $review->user->name ?? 'Anonymous' }}</span>
                                                    <div
                                                        class="border border-[#D7D7DA] rounded px-2 py-0.5 bg-white text-[10px] sm:text-xs flex items-center gap-1">
                                                        <span class="font-bold">{{ $review->rating }}</span>
                                                        <i class="fas fa-star text-yellow-500 text-[8px] sm:text-[10px]"></i>
                                                        <span
                                                            class="text-[#808080] border-l-2 pl-1 ml-1 font-['Outfit']">{{ $review->created_at->format('d M Y') }}</span>
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
        <section class="relative w-full h-auto mt-8 sm:mt-10 mb-8 sm:mb-10"
            x-data="{ 
                                                                                                                                                                                                                                                                                                                                                                                                                                            currentSlide: 0, 
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
                <img src="{{ asset('assets/Design.png') }}\" \n
                    class="h-auto w-[60px] sm:w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[350px] xl:max-w-[400px]"
                    alt="">
                <div class="text-center flex flex-col items-center">
                    <p style="font-family: 'Alexandria', sans-serif;" \n
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
                    <img src="{{ asset('assets/neckless.png') }}" alt="Necklace"
                        class="w-full h-full object-contain object-center">
                </div>

                <!-- Right Grid -->
                <div class="col-span-1 lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-5 content-start">
                    @foreach($relatedProducts as $related)
                        <div class="flex flex-col gap-3">
                            <div
                                class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] min-[2000px]:max-w-none border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                                <span
                                    class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                                    Seller</span>
                                <button
                                    class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
                                    <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="">
                                </button>
                                <a href="{{ route('product.details', $related->slug) }}"
                                    class="w-full h-full flex items-center justify-center block">
                                    @if($related->images->count() > 0)
                                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                                            alt="{{ $related->name }}"
                                            class="w-full h-full object-contain mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                                        @if($related->images->count() > 1)
                                            <img src="{{ asset('storage/' . $related->images[1]->image_path) }}"
                                                class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                                        @else
                                            <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                                                class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/ring.png') }}" alt="{{ $related->name }}"
                                            class="w-full h-full object-contain mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                                    @endif
                                </a>
                            </div>
                            <div class="text-center font-['Outfit']">
                                <h3 class="text-sm min-[2000px]:text-xl font-['outfit'] text-[#1A1A1A] mb-1 truncate px-2">
                                    {{ $related->name }}
                                </h3>
                                <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-lg">
                                    <span class="font-['outfit'] text-[#1A1A1A]">₹
                                        {{ number_format($related->selling_price, 2) }}</span>
                                    @if($related->original_price > $related->selling_price)
                                        <span class="text-[#999999] line-through">₹
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
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 hidden transition-opacity duration-300 opacity-0 px-3 sm:px-4 md:px-0">
        <div
            class="bg-[#FDFBF7] rounded-[16px] sm:rounded-[20px] w-full sm:w-[90%] md:w-full max-w-[600px] xl:max-w-[700px] 2xl:max-w-[750px] min-[2000px]:max-w-[800px] p-4 sm:p-5 md:p-8 xl:p-10 min-[2000px]:p-12 relative shadow-2xl transform scale-95 transition-transform duration-300 max-h-[85vh] sm:max-h-[80vh] overflow-y-auto overscroll-contain">
            <!-- Close Button -->
            <button onclick="closeReviewModal()"
                class="absolute top-4 right-4 sm:top-5 sm:right-5 xl:top-6 xl:right-6 min-[2000px]:top-8 min-[2000px]:right-8 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fa-solid fa-xmark text-lg sm:text-xl xl:text-2xl min-[2000px]:text-3xl"></i>
            </button>

            <!-- Header -->
            <h2
                class="font-['Outfit'] font-bold text-lg sm:text-xl md:text-2xl xl:text-3xl min-[2000px]:text-4xl text-[#1A1A1A] mb-1">
                Rate This
                Product</h2>
            <p class="font-['Outfit'] text-xs sm:text-sm xl:text-base min-[2000px]:text-xl text-[#5C5C5C] mb-4 sm:mb-6">
                {{ $product->name }}
            </p>

            <form action="{{ route('reviews.store') }}\" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="rating" id="rating-input" value="0">

                <!-- Review Text -->
                <div class="mb-4 sm:mb-6">
                    <label
                        class="block font-['Outfit'] font-bold text-xs sm:text-sm xl:text-base min-[2000px]:text-xl text-[#1A1A1A] mb-2">Review</label>
                    <textarea name="comment" placeholder="Write product review here" required
                        class="w-full h-[100px] sm:h-[120px] xl:h-[140px] min-[2000px]:h-[200px] bg-white border border-[#E6E6E6] rounded-xl p-3 sm:p-4 xl:p-5 min-[2000px]:p-6 text-xs sm:text-sm xl:text-base min-[2000px]:text-xl font-['Outfit'] outline-none focus:border-[#CBA65A] resize-none"></textarea>
                </div>

                <!-- Rating Stars -->
                <div class="flex justify-center gap-3 sm:gap-4 xl:gap-5 min-[2000px]:gap-6 mb-4 sm:mb-6" id="star-rating">
                    <button type="button"
                        class="stars text-[#E6E6E6] hover:text-[#CBA65A] transition-colors text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl focus:outline-none"
                        onclick="rateProduct(1)"><i class="fas fa-star"></i></button>
                    <button type="button"
                        class="stars text-[#E6E6E6] hover:text-[#CBA65A] transition-colors text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl focus:outline-none"
                        onclick="rateProduct(2)"><i class="fas fa-star"></i></button>
                    <button type="button"
                        class="stars text-[#E6E6E6] hover:text-[#CBA65A] transition-colors text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl focus:outline-none"
                        onclick="rateProduct(3)"><i class="fas fa-star"></i></button>
                    <button type="button"
                        class="stars text-[#E6E6E6] hover:text-[#CBA65A] transition-colors text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl focus:outline-none"
                        onclick="rateProduct(4)"><i class="fas fa-star"></i></button>
                    <button type="button"
                        class="stars text-[#E6E6E6] hover:text-[#CBA65A] transition-colors text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl focus:outline-none"
                        onclick="rateProduct(5)"><i class="fas fa-star"></i></button>
                </div>

                <!-- Consent Text -->
                <p
                    class="text-center font-['Outfit'] text-[10px] sm:text-[11px] xl:text-sm min-[2000px]:text-lg text-[#808080] mb-4 sm:mb-6 leading-relaxed">
                    By submitting review you give us consent to publish and process personal information in accordance with
                    <a href="#" class="underline text-[#5C4522]">Terms of use</a> and <a href="#"
                        class="underline text-[#5C4522]">Privacy Policy</a>
                </p>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#CBA65A] hover:bg-[#B39359] text-white font-['Outfit'] font-medium text-base sm:text-lg xl:text-xl min-[2000px]:text-2xl py-2.5 sm:py-3 xl:py-4 min-[2000px]:py-5 rounded-full transition-colors shadow-md">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal() {
            const modal = document.getElementById('review-modal');
            const content = modal.querySelector('div');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeReviewModal() {
            const modal = document.getElementById('review-modal');
            const content = modal.querySelector('div');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        function rateProduct(rating) {
            const stars = document.querySelectorAll('#star-rating .stars');
            document.getElementById('rating-input').value = rating;
            stars.forEach((star, index) => {
                // Clear previous classes
                star.className = "stars focus:outline-none transition-colors " +
                    (index < rating ? "text-[#CBA65A]" : "text-[#E6E6E6] hover:text-[#CBA65A]") +
                    " text-2xl sm:text-3xl xl:text-4xl min-[2000px]:text-5xl";
            });
        }
    </script>
@endsection