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

    <main class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-4 py-10 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-10">

            <!-- Product Images -->
            <div class="space-y-2">
                <div
                    class="w-full h-auto aspect-[4/5] lg:h-[990px] lg:aspect-[3/5] overflow-hidden flex justify-center items-center bg-white rounded-lg border border-gray-100">
                    @if($product->images->count() > 0)
                        <img id="main-image" src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                            alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply">
                    @else
                        <img id="main-image" src="{{ asset('assets/ring.png') }}" alt="{{ $product->name }}"
                            class="w-full h-full object-contain mix-blend-multiply">
                    @endif
                </div>

                @if($product->images->count() > 1)
                    <div class="grid grid-cols-5 gap-2">
                        @foreach($product->images as $image)
                            <div class="cursor-pointer border border-gray-200 hover:border-amber-400 rounded-md bg-white overflow-hidden aspect-square flex items-center justify-center transition-all"
                                onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="object-contain h-full w-full p-1">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <!-- Rating -->
                    <div
                        class="flex items-center justify-center box-border px-[10px] py-[4px] gap-[6px] w-[151.67px] min-[2000px]:w-[200px] h-[23px] min-[2000px]:h-[35px] bg-white border border-[#D7D7DA] rounded-[4px]">
                        <span
                            class="font-['Outfit'] font-bold text-[#1A1A1A] min-[2000px]:text-xl">{{ number_format($product->reviews()->avg('rating') ?? 0, 1) }}</span>
                        <img src="{{ asset('assets/1star.png') }}" class="h-3 w-3 min-[2000px]:h-5 min-[2000px]:w-5"
                            alt="star">
                        <span class="font-['Outfit'] text-[#8B8B8B] text-sm min-[2000px]:text-lg font-normal">|
                            {{ $product->reviews()->count() }} Ratings</span>
                    </div>

                    <!-- Title -->
                    <h1
                        class="mt-4 w-full font-['Outfit'] font-medium text-[26px] min-[2000px]:text-[40px] leading-[30px] min-[2000px]:leading-[50px] text-[#0D0D0E]">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="mt-3">
                        <span
                            class="font-['Outfit'] font-semibold text-[32px] min-[2000px]:text-[48px] leading-[40px] text-[#0D0D0E]">
                            ₹{{ number_format($product->selling_price, 2) }}
                        </span>
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <span
                                class="ml-2 text-lg text-gray-400 line-through">₹{{ number_format($product->price, 2) }}</span>
                        @endif
                        <p class="font-['Outfit'] text-[12px] min-[2000px]:text-lg leading-[18px] text-[#808080] mt-1">(MRP
                            inclusive of all taxes)</p>
                    </div>

                    <!-- Stock Status -->
                    <div class="flex items-center space-x-2 font-['Outfit'] mt-4">
                        <img src="{{ asset('assets/true_sign.png') }}" class="h-5 w-5" alt="">
                        <span class="text-[14px] min-[2000px]:text-xl leading-[10px] text-[#3D3D42] font-medium">
                            {{ $product->stock > 0 ? 'In stock - ready to ship' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>

                <!-- Attributes Grid -->
                <div
                    class="grid grid-cols-3 w-full h-auto bg-[rgba(219,179,88,0.1)] rounded-[10px] overflow-hidden font-['Outfit'] border border-[rgba(219,179,88,0.2)]">
                    <!-- Row 1 -->
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Diamond Shape</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ optional($product->diamondShape)->name ?? '-' }}
                        </p>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Diamond Quality</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->diamond_clarity ?? '-' }}/{{ $product->diamond_color ?? '-' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-2 border-[#DBB358]/20 p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Diamond Carat</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->diamond_carat ? $product->diamond_carat . ' ct' : '-' }}
                        </p>
                    </div>

                    <!-- Row 2 -->
                    <div class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Metal Color</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ optional($product->metalColor)->name ?? '-' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Metal Purity</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->metal_purity ?? '-' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-4 text-center">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Metal Type</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->metal_type ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Offers -->
                <p class="font-['Outfit'] mt-6 text-[#1A1A1A] text-lg min-[2000px]:text-3xl font-medium mb-0">Offers For You
                </p>
                <div
                    class="w-full bg-[#F2F4F7] h-[50px] min-[2000px]:h-[70px] rounded-lg flex items-center justify-between cursor-pointer px-4 hover:bg-gray-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/5off.png') }}" class="h-8 w-8 min-[2000px]:h-14 min-[2000px]:w-14"
                            alt="offer">
                        <div class="font-['Outfit'] text-gray-700 text-sm min-[2000px]:text-xl">
                            EXTRA 10% OFF on Silver Jewellery above ₹999
                        </div>
                    </div>
                    <i class="fa-solid fa-angle-down text-[#3D3D42] min-[2000px]:text-xl"></i>
                </div>

                <!-- Size Selection -->
                @if($product->variants->where('size', '!=', null)->count() > 0)
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-sm min-[2000px]:text-xl text-gray-900 font-['Outfit']">Select Size</h3>
                        </div>
                        <div id="size-container" class="flex font-['Outfit'] flex-wrap gap-2">
                            @foreach($product->variants->sortBy('size') as $index => $variant)
                                <button onclick="selectSize(this)"
                                    class="{{ $index >= 10 ? 'extra-size hidden' : '' }} px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400 transition-all">
                                    {{ $variant->size }}
                                </button>
                            @endforeach

                            @if($product->variants->count() > 10)
                                <button id="view-more-btn" onclick="toggleSizes()"
                                    class="text-xs font-Outfit text-gray-400 underline hover:text-amber-800 transition-colors ml-2">
                                    View More
                                </button>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-['Outfit']">* Check availability for your size</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-wrap w-full items-center gap-[10px] md:gap-[20px]">
                    <form action="{{ route('cart.store') }}" method="POST"
                        class="flex-1 md:w-[465px] min-[2000px]:w-[600px]">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="w-full h-[60px] min-[2000px]:h-[100px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] hover:bg-[#B38940] rounded-[100px] text-white py-[16px] px-[16px] flex items-center justify-center gap-[12px] shadow-sm transform hover:scale-[1.02] transition-transform">
                            <img src="{{ asset('assets/ic_bag.png') }}"
                                class="h-[24px] w-[24px] min-[2000px]:h-[32px] min-[2000px]:w-[32px] brightness-0 invert"
                                alt="bag">
                            <span class="text-[18px] min-[2000px]:text-2xl font-medium font-['Outfit']">Add to Cart</span>
                        </button>
                    </form>

                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="w-[60px] h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105">
                            @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                                <i class="fa-solid fa-heart text-[#CBA65A] text-xl"></i>
                            @else
                                <img src="{{ asset('assets/ic_wishlist.png') }}"
                                    class="h-[24px] w-[24px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]" alt="wishlist">
                            @endif
                        </button>
                    </form>

                    <button
                        class="w-[60px] h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors transform hover:scale-105">
                        <img src="{{ asset('assets/share_icon.png') }}"
                            class="h-[24px] w-[24px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]" alt="share">
                    </button>
                </div>

                <!-- Delivery Info -->
                <div class="mt-8 pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-['Outfit'] font-medium flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-truck-fast text-[#CBA65A]"></i> Estimated Delivery
                        </h4>
                    </div>

                    <div class="relative flex items-center max-w-sm">
                        <input type="text" placeholder="Enter Pincode" maxlength="6"
                            class="w-full border border-gray-300 text-black rounded-md py-3 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#CBA65A] focus:border-[#CBA65A]">
                        <button
                            class="absolute right-2 font-Outfit px-4 py-1.5 bg-white text-gray-500 font-bold text-xs border-l border-gray-200 uppercase hover:text-[#CBA65A] transition-colors">
                            Check
                        </button>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div
                    class="w-full h-auto mt-8 bg-[#FAF5F5] rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-0 border border-[#F2F4F7]">
                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-rotate-left text-[#CBA65A]"></i>
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">30 Day
                            Returns</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-arrows-rotate text-[#CBA65A]"></i>
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">Lifetime
                            Exchange</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-2">
                        <div class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm">
                            <i class="fa-solid fa-certificate text-[#CBA65A]"></i>
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">Certified
                            Jewellery</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs Section -->
        <div class="bg-[#FDFBF7] py-12 px-4 md:px-15 font-sans text-[#4A4A4A] mt-10 border-t border-gray-200">
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

            <!-- Tabs Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-10 font-['Outfit']">
                <button onclick="switchTab('price', this)"
                    class="px-6 md:px-8 py-2 border border-black bg-black text-white text-sm rounded-full font-medium shadow-md transition duration-300">
                    Price Breakup
                </button>
                <button onclick="switchTab('details', this)"
                    class="px-6 md:px-8 py-2 border border-[#E8E1D5] text-gray-600 text-sm rounded-full font-medium transition duration-300 hover:bg-black hover:text-white">
                    Diamond & Metal Details
                </button>
                <button onclick="switchTab('about', this)"
                    class="px-6 md:px-8 py-2 border border-[#E8E1D5] text-gray-600 text-sm rounded-full font-medium transition duration-300 hover:bg-black hover:text-white">
                    Description
                </button>
            </div>

            <!-- Price Breakup (Default Active) -->
            <div id="content-price" class="w-full max-w-[1000px] mx-auto transition-opacity duration-300 font-['Outfit']">
                <div class="bg-[#FAF8F1] w-full rounded-2xl border border-[#F2F4F7] overflow-hidden shadow-sm">
                    <div class="bg-white p-6 border-b border-[#E8E1D5]">
                        <h3 class="text-[#5C4522] text-xl font-bold">Price Breakup</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#FAF8F1] text-[#5C4522] text-sm md:text-base border-b border-[#E8E1D5]">
                                    <th class="py-4 px-6 font-bold">Component</th>
                                    <th class="py-4 px-6 font-bold text-center">Weight/Count</th>
                                    <th class="py-4 px-6 font-bold text-right">Value</th>
                                </tr>
                            </thead>
                            <tbody class="text-[#1A1A1A] text-sm md:text-base">
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Gold ({{ $product->metal_purity ?? '-' }})</td>
                                    <td class="py-4 px-6 text-center">{{ $product->weight ?? 0 }} g</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($product->price_gold_value ?? 0, 2) }}</td>
                                </tr>
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Diamonds</td>
                                    <td class="py-4 px-6 text-center">{{ $product->diamond_carat ?? 0 }} ct</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($product->price_diamond_value ?? 0, 2) }}</td>
                                </tr>
                                <tr class="bg-white border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">Making Charges</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($product->making_charges ?? 0, 2) }}</td>
                                </tr>
                                <tr class="bg-[#FAF6F0] border-b border-[#E8E1D5]">
                                    <td class="py-4 px-6">GST ({{ $product->tax_rate ?? 3 }}%)</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right font-medium">
                                        ₹{{ number_format($product->price_gst ?? 0, 2) }}</td>
                                </tr>
                                <tr class="bg-white font-bold text-lg">
                                    <td class="py-4 px-6 text-[#5C4522]">Grand Total</td>
                                    <td class="py-4 px-6 text-center">-</td>
                                    <td class="py-4 px-6 text-right text-[#CBA65A]">
                                        ₹{{ number_format($product->selling_price, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detailed Info (Hidden) -->
            <div id="content-details"
                class="w-full max-w-[1000px] mx-auto font-['Outfit'] flex flex-col items-center gap-[20px] hidden">
                <!-- Diamond Details -->
                @if($product->diamond_carat)
                    <div class="w-full border border-[#F2F4F7] rounded-xl overflow-hidden bg-white shadow-sm">
                        <button onclick="toggleAccordion(this)"
                            class="w-full h-[70px] px-8 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors cursor-pointer text-left focus:outline-none">
                            <span class="text-[#5C4522] font-bold text-lg min-[2000px]:text-2xl font-['Outfit']">Diamond
                                Details</span>
                            <div class="accordion-icon w-8 h-8 rounded-full bg-[#FAF6F0] flex items-center justify-center">
                                <i class="fa-solid fa-plus text-[#CBA65A]"></i>
                            </div>
                        </button>
                        <div class="px-0 transition-all duration-300 ease-in-out opacity-0 overflow-hidden"
                            style="max-height: 0px;">
                            <div class="space-y-0 text-sm min-[2000px]:text-xl font-['Outfit']">
                                <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                    <span class="text-gray-500">Total Weight In Carat</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_carat }} ct</span>
                                </div>
                                <div class="bg-gray-50 flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                    <span class="text-gray-500">Clarity</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_clarity ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                    <span class="text-gray-500">Color</span>
                                    <span class="text-[#1A1A1A] font-medium">{{ $product->diamond_color ?? '-' }}</span>
                                </div>
                                <div class="bg-gray-50 flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                    <span class="text-gray-500">Shape</span>
                                    <span
                                        class="text-[#1A1A1A] font-medium">{{ optional($product->diamondShape)->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Metal Details (Auto Expanded) -->
                <div class="w-full border border-[#F2F4F7] rounded-xl overflow-hidden bg-white shadow-sm">
                    <button onclick="toggleAccordion(this)"
                        class="w-full h-[70px] px-8 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors cursor-pointer text-left focus:outline-none">
                        <span class="text-[#5C4522] font-bold text-lg min-[2000px]:text-2xl font-['Outfit']">Metal
                            Details</span>
                        <div class="accordion-icon w-8 h-8 rounded-full bg-[#FAF6F0] flex items-center justify-center">
                            <i class="fa-solid fa-minus text-[#CBA65A]"></i>
                        </div>
                    </button>
                    <div class="px-0 transition-all duration-300 ease-in-out" style="max-height: 500px; opacity: 1;">
                        <div class="space-y-0 text-sm min-[2000px]:text-xl font-['Outfit'] pb-4">
                            <div class="bg-gray-50 flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                <span class="text-gray-500">Metal Type</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->metal_type ?? 'Gold' }}</span>
                            </div>
                            <div class="flex justify-between py-4 border-b border-[#F2F4F7] px-8">
                                <span class="text-gray-500">Purity</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->metal_purity ?? '-' }}</span>
                            </div>
                            <div class="bg-gray-50 flex justify-between py-4 px-8">
                                <span class="text-gray-500">Gross Weight</span>
                                <span class="text-[#1A1A1A] font-medium">{{ $product->weight ?? 0 }} g</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description (Hidden) -->
            <div id="content-about" class="w-full max-w-[1000px] mx-auto hidden transition-opacity duration-300">
                <div
                    class="bg-white p-8 rounded-xl border border-[#F2F4F7] shadow-sm text-center lg:text-left flex flex-col lg:flex-row items-center gap-8">
                    <div class="flex-1">
                        <h3 class="text-[24px] font-medium font-['Outfit'] text-[#1A1A1A] mb-4">About This Product</h3>
                        <p class="text-[15px] leading-relaxed font-['Outfit'] text-gray-600">
                            {{ $product->description ?? 'No description available.' }}
                        </p>
                    </div>
                    <div class="w-[200px] aspect-square rounded-lg border border-gray-100 p-4">
                        @if($product->images->count() > 0)
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply">
                        @else
                            <img src="{{ asset('assets/ring.png') }}" class="w-full h-full object-contain mix-blend-multiply">
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <!-- Ratings and reviews section -->
        <section class=" h-full w-full max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto py-16 font-sans">
            <div class="flex flex-col lg:flex-row items-center gap-2">
                <!-- Left Side: Summary -->
                <div class="w-full lg:w-1/3 flex flex-col py-8 gap-[20px]">
                    <div class="flex items-center gap-2 justify-center lg:justify-start lg:items-center md:gap-4 mb-2">
                        <div
                            class="flex md:flex flex-row justify-center md:justify-end gap-[9px] w-auto md:w-[200px] h-[25px]">
                            <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain">
                        </div>
                        <div class="text-center lg:text-left flex flex-col justify-center items-center lg:items-start">
                            <span
                                class="text-[14px] md:text-[17px] min-[2000px]:text-3xl text-[#5C4522] block font-['Alexandria'] leading-none">Ratings
                                &</span>
                            <h2
                                class="text-[24px] md:text-[32px] min-[2000px]:text-5xl text-[#CBA65A] font-medium font-['Outfit'] leading-tight">
                                Reviews</h2>
                        </div>
                        <div
                            class="flex md:hidden flex-row justify-center md:justify-start gap-[9px] w-auto md:w-[200px] h-[25px]">
                            <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain"
                                style="transform: scaleX(-1);">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 justify-center lg:justify-start">
                        <div class="flex items-center gap-1 text-[#F5B800]">
                            @php $rating = $product->reviews->avg('rating') ?? 0; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    <i class="fas fa-star text-lg"></i>
                                @elseif($i == ceil($rating) && $rating - floor($rating) >= 0.5)
                                    <i class="fas fa-star-half-alt text-lg"></i>
                                @else
                                    <i class="far fa-star text-lg"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="font-['Outfit'] text-[32px] text-[#1A1A1A]">{{ number_format($rating, 1) }}</span>
                    </div>

                    <button
                        class="self-center lg:self-start w-auto px-9 py-2 border border-[#CBA65A] text-[#CBA65A] text-sm rounded-full hover:bg-[#CBA65A] hover:text-white transition-all font-['Outfit'] tracking-wide">
                        Write Review
                    </button>
                </div>

                <!-- Right Side: Reviews Card -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-2xl border border-[#F2F4F7] overflow-hidden shadow-sm">
                        <div class="bg-white border-b border-[#F2F4F7] px-8 py-5">
                            <h3 class="text-[#5C4522] font-bold font-['Outfit'] text-xl">Customers Review</h3>
                        </div>

                        <div class="bg-[#FAF8F1] px-8 py-6 h-[350px] overflow-y-auto space-y-6 custom-scrollbar">
                            @forelse($product->reviews as $review)
                                <div class="border-b border-[#E8E1D5] pb-6 last:border-0 last:pb-0">
                                    <p class="text-[#3D3D42] text-[15px] leading-relaxed mb-4 font-['Outfit'] italic">
                                        "{{ $review->comment }}"
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="text-[#1A1A1A] font-['Outfit'] text-sm">{{ $review->user->name ?? 'Anonymous' }}</span>
                                            <div
                                                class="border border-[#D7D7DA] rounded px-2 py-0.5 bg-white text-xs flex items-center gap-1">
                                                <span class="font-bold">{{ $review->rating }}</span>
                                                <img src="{{ asset('assets/1star.png') }}" class="h-3 w-3" alt="">
                                                <span
                                                    class="text-[#808080] border-l-2 pl-2 ml-2 font-['Outfit']">{{ $review->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 py-10 font-['Outfit']">No reviews yet. Be the first to
                                    review!</p>
                            @endforelse
                        </div>
                    </div>
                    <!-- Pagination (Static for now) -->
                    <div class="py-4 px-8 flex justify-end items-center gap-3">
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors"><i
                                class="fa-solid fa-chevron-left text-xs"></i></button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-full border border-[#CBA65A] text-[#CBA65A] font-medium bg-white shadow-sm text-sm">1</button>
                        <button
                            class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors"><i
                                class="fa-solid fa-chevron-right text-xs"></i></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Image Slider (Banner Section) -->
        @if($banners->count() > 0)
            <div class="relative w-full h-[300px] md:h-[400px] lg:h-[500px] mx-auto overflow-hidden mt-10 mb-10">
                <div id="slides" class="relative w-full h-full">
                    @foreach($banners as $index => $banner)
                        <div class="absolute top-0 left-0 w-full h-full transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                            data-slide="{{ $index }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="w-full h-full object-cover block"
                                alt="{{ $banner->title ?? 'Banner' }}">
                        </div>
                    @endforeach
                </div>

                <!-- Dots navigation -->
                <div id="dots" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex justify-center gap-2 z-20">
                    @foreach($banners as $index => $banner)
                        <button onclick="goToSlide({{ $index }})"
                            class="h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-8 bg-[#CBA65A]' : 'w-3 bg-[#E8E1D5]' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            <script>
                let currentSlide = 0;
                const slides = document.querySelectorAll('#slides > div');
                const dots = document.querySelectorAll('#dots > button');
                const totalSlides = slides.length;

                function showSlide(n) {
                    slides.forEach((slide, index) => {
                        if (index === n) {
                            slide.classList.remove('opacity-0', 'z-0');
                            slide.classList.add('opacity-100', 'z-10');
                        } else {
                            slide.classList.remove('opacity-100', 'z-10');
                            slide.classList.add('opacity-0', 'z-0');
                        }
                    });

                    dots.forEach((dot, index) => {
                        if (index === n) {
                            dot.classList.remove('w-3', 'bg-[#E8E1D5]');
                            dot.classList.add('w-8', 'bg-[#CBA65A]');
                        } else {
                            dot.classList.remove('w-8', 'bg-[#CBA65A]');
                            dot.classList.add('w-3', 'bg-[#E8E1D5]');
                        }
                    });
                    currentSlide = n;
                }

                function nextSlide() {
                    showSlide((currentSlide + 1) % totalSlides);
                }

                function goToSlide(n) {
                    showSlide(n);
                    resetInterval();
                }

                let slideInterval = setInterval(nextSlide, 3000);

                function resetInterval() {
                    clearInterval(slideInterval);
                    slideInterval = setInterval(nextSlide, 3000);
                }
            </script>
        @endif

        <!-- Similar Jewellery Product Section -->
        <section class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-4 py-12 font-Outfit">
            <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
                <img src="{{ asset('assets/Design.png') }}"
                    class="h-auto w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
                <div class="text-center flex flex-col items-center">
                    <p style="font-family: 'Alexandria', sans-serif;"
                        class="text-[15px] text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">Similar</p>
                    <h2
                        class="font-['Outfit'] font-medium text-[28px] md:text-[40px] leading-tight md:leading-[50px] text-[#CBA65A]">
                        Jewellery Product</h2>
                </div>
                <img src="{{ asset('assets/Design (1).png') }}"
                    class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
                <!-- Left Banner Card -->
                <div
                    class="lg:col-span-1 h-full w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden bg-[#111111]">
                    <img src="{{ asset('assets/neckless.png') }}" alt="Necklace" class="w-full h-full object-cover object-center">
                        </div>

                        <!-- Right Grid -->
                        <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">
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
                                            {{ $related->name }}</h3>
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
@endsection