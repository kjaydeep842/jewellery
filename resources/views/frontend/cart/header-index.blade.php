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

    <style>
        /* Custom Checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: white;
            width: 20px;
            height: 20px;
            border: 2px solid #CBA65A;
            border-radius: 4px;
            /* Rounded corners */
            display: grid;
            place-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .custom-checkbox:checked {
            background-color: #CBA65A;
            border-color: #CBA65A;
        }

        .custom-checkbox::before {
            content: "";
            width: 10px;
            height: 10px;
            transform: scale(0);
            box-shadow: inset 1em 1em white;
            transform-origin: center;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
            transition: 120ms transform ease-in-out;
        }

        .custom-checkbox:checked::before {
            transform: scale(1);
        }

        /* Hide scrollbar for cleaner look */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Hide Default Header Elements on this page only */
        /* Note: we target ID to be specific */
        #header-placeholder,
        .ticker-wrapper {
            display: none !important;
        }
    </style>

    <!-- Top Promo Bar (Re-included here since we hide global one to control order/style if needed, or remove if identical) -->
    <!-- User's design has Ticker. Master has Ticker. If we hide .ticker-wrapper globally for this page, we hide BOTH. 
             We should rename this ticker wrapper or accept Master's. 
             User's ticker text is identical. Let's use Master's ticker? 
             Wait, User's HTML has ticker *above* header. Master has ticker *above* header.
             If I hide master header (#header-placeholder), I keep master ticker?
             Master Ticker is separate div .ticker-wrapper.
             If I hide .ticker-wrapper, I hide both.
             Decision: Hide Master Ticker and Header, render everything fresh here to match exact design requested.
        -->
    <div class="ticker-wrapper" style="display: block !important;">
        <div class="ticker">
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        </div>
    </div>

    <!-- Header Section (Specific to Bag Page) -->
    <header class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-[1920px] mx-auto px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-4">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-800 hover:text-[#CBA65A] transition-colors">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="w-[120px]">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/logo_black.png') }}" alt="Tattsvi" class="w-full h-auto">
                    </a>
                </div>
            </div>

            <!-- Stepper -->
            <div class="hidden md:flex items-center gap-4 text-sm font-medium tracking-wide">
                <a href="{{ route('cart.index') }}" class="text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1">BAG</a>
                <div class="text-gray-300">----------</div>
                <div class="text-gray-400">ADDRESS</div>
                <div class="text-gray-300">----------</div>
                <div class="text-gray-400">PAYMENT</div>
            </div>

            <!-- Secure Badge -->
            <div class="flex items-center gap-2 text-green-600 font-medium text-sm">
                <img src="{{ asset('assets/L- Brand Logo.png') }}" alt="Secure" class="h-6 w-auto object-contain"> 100%
                SECURE
            </div>
        </div>

        <!-- Navigation Bar (Standard) -->
    <nav
        class="hidden lg:flex items-center justify-center space-x-6 min-[2000px]:space-x-12 text-[15px] min-[2000px]:text-2xl font-['Outfit'] font-medium tracking-wide bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] w-full py-[14px] text-white">
        <div class="relative group">
            <a href="{{ route('page.new-arrivals') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">New Arrivals</a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.best-seller') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Best Seller</a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.18kt') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">18KT Jewellery</a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.tattsvisfavourite') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Tattsvi's Favourite</a>
        </div>
            {{-- <div class="relative group">
                <a href="{{ route('page.exhibition') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Exhibition</a>
            </div> --}}
        <div class="relative group">
            <a href="{{ route('page.readytostock') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Ready To Stock</a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.contact') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Contact Us</a>
        </div>
        <div class="relative group">
            <a href="{{ route('page.about') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">About Us</a>
        </div>
    </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-[1920px] mx-auto px-4 lg:px-6 py-8 flex flex-col lg:flex-row gap-8 min-h-[600px]">

        @if($cartItems->isEmpty())
            <div class="w-full flex flex-col items-center justify-center p-[40px] gap-6 rounded-[10px]"
                style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
                <div class="relative">
                    <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="Empty Bag Icon"
                        class="object-contain h-[80px] w-auto opacity-80">
                </div>
                <div class="text-center space-y-2">
                    <h2 class="text-2xl font-['Outfit'] font-bold text-[#1A1A1A]">Your Bag Is Empty</h2>
                    <p class="text-base text-[#6E6E77] max-w-md mx-auto font-['Outfit']">
                        Add items that you like to your bag.
                    </p>
                </div>
                <a href="{{ route('home') }}" style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);"
                    class="px-10 py-4 rounded-full text-white font-['Outfit'] font-medium text-lg shadow-md hover:opacity-90 transition-all">
                    Start Shopping
                </a>
            </div>
        @else

            <!-- Left Column: Bag Items -->
            <div class="w-full lg:w-2/3 flex flex-col gap-6 h-[calc(100vh-150px)] overflow-y-auto pr-2 custom-scrollbar">

                <!-- Address Banner (Simplified - showing default or prompt) -->
                @php
                    $defaultAddress = Auth::check() ? (Auth::user()->addresses()->where('is_default', true)->first() ?? Auth::user()->addresses()->latest()->first()) : null;
                @endphp
                <div
                    class="box-border flex flex-row justify-between items-center p-[20px] gap-[20px] w-full lg:w-[910px] h-auto lg:h-[106px] bg-[rgba(219,179,88,0.1)] border border-[#EFE4CD] rounded-[10px] flex-none order-0 self-stretch grow-0">
                    <div>
                        @if($defaultAddress)
                            <p class="text-gray-500 text-sm">Deliver To : <span
                                    class="font-semibold text-gray-900">{{ $defaultAddress->name }} ,
                                    {{ $defaultAddress->zip }}</span></p>
                            <p class="text-gray-500 text-xs mt-1">
                                {{ Str::limit($defaultAddress->address_line_1 . ', ' . $defaultAddress->city, 60) }}</p>
                        @else
                            <p class="text-gray-500 text-sm">Deliver To : <span class="font-semibold text-gray-900">Select
                                    Address</span></p>
                            <p class="text-gray-500 text-xs mt-1">Please add or select an address for delivery.</p>
                        @endif
                    </div>
                    <a href="{{ route('checkout.address') }}"
                        class="text-[#CBA65A] border border-[#CBA65A] px-4 py-1.5 rounded text-sm font-medium hover:bg-[#CBA65A] hover:text-white transition-colors whitespace-nowrap bg-white">
                        Change Address
                    </a>
                </div>

                <!-- Product Selection Container -->
                <div class="flex flex-col items-start p-0 gap-[10px] w-full lg:w-[910px] flex-none order-1 self-stretch grow-0">

                    <!-- Selection Header -->
                    <div
                        class="flex flex-row justify-between items-center p-[20px] gap-[20px] w-full h-[88px] rounded-[10px] flex-none order-0 self-stretch grow-0">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" class="custom-checkbox" checked>
                            <span
                                class="font-bold text-[#1A1A1A] font-Outfit text-[18px]">{{ $cartItems->count() }}/{{ $cartItems->count() }}
                                products selected</span>
                        </label>
                        <!-- <button
                                class="text-[#7D8FAB] hover:text-red-500 text-[16px] font-medium transition-colors font-Outfit">Remove</button> -->
                    </div>

                    @foreach($cartItems as $item)
                        <!-- Product Card Container -->
                        <div
                            class="box-border flex flex-row items-start p-0 gap-[10px] w-full lg:w-[910px] h-auto lg:h-[324px]  border border-[#CFD5E3] rounded-[4px] flex-none order-1 self-stretch grow-0 relative group transition-colors overflow-hidden mb-4">

                            <!-- Close Button (Remove Item) -->
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                class="absolute top-[30px] right-[30px] z-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fa-solid fa-xmark text-xl"></i>
                                </button>
                            </form>

                            <!-- Image Section (Left Side) -->
                            <div class="relative w-[324px] h-full bg-[#FDFBF7] flex-shrink-0 flex items-center justify-center">
                                <!-- Checkbox anchored top-left -->
                                <div class="absolute top-[24px] left-[24px] z-10">
                                    <input type="checkbox" class="custom-checkbox" checked>
                                </div>
                                @php
                                    $imagePath = $item->product->images->first()
                                        ? (Str::startsWith($item->product->images->first()->image_path, 'http')
                                            ? $item->product->images->first()->image_path
                                            : asset('storage/' . $item->product->images->first()->image_path))
                                        : asset('assets/ring.png');
                                @endphp
                                <img src="{{ $imagePath }}" alt="{{ $item->product->name }}"
                                    class="w-[95%] h-[95%] object-contain mix-blend-multiply">
                            </div>

                            <!-- Product Info (Right Side) -->
                            <div class="flex-grow flex flex-col gap-[8px] h-full pt-[30px] pr-[30px] pb-[30px] pl-[10px]">
                                <h3 class="font-medium text-[#1A1A1A] text-[20px] leading-[28px] pr-8 font-Outfit w-[80%]">
                                    <a href="{{ route('product.details', $item->product->slug) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>

                                <div class="text-[24px] font-bold text-[#1A1A1A] font-Outfit mt-1">
                                    ₹{{ number_format($item->price, 2) }}</div>

                                <div class="flex flex-wrap items-center gap-[12px] text-sm mt-3">
                                    @if($item->variant)
                                        <div
                                            class="bg-[#d2d2d2] px-[16px] py-[8px] rounded-[4px] text-[#1A1A1A] font-Outfit text-[15px] font-medium min-w-[100px] text-center">
                                            Size: {{ $item->variant->size }}</div>
                                    @endif

                                    <!-- Quantity Dropdown -->
                                    <div class="relative quantity-dropdown-container">
                                        <button onclick="toggleQuantityMenu(this)"
                                            class="bg-[#d2d2d2] px-[16px] py-[8px] rounded-[4px] text-[#1A1A1A] font-Outfit text-[15px] font-medium flex items-center gap-2 cursor-pointer min-w-[90px] justify-between z-20 relative">
                                            <span class="qty-display">Qty: {{ $item->quantity }}</span> <i
                                                class="fa-solid fa-chevron-down text-xs text-[#1A1A1A] transition-transform duration-200"></i>
                                        </button>
                                        <!-- Dropdown Menu -->
                                        <div
                                            class="absolute top-[100%] left-0 w-full bg-white border border-[#d2d2d2] rounded-[4px] shadow-lg mt-1 hidden z-30 overflow-hidden text-center">
                                            <!-- Form for updating quantity -->
                                            @foreach([1, 2, 3, 4, 5] as $q)
                                                <div class="cursor-pointer hover:bg-[#FDFBF7] py-2 text-sm text-[#1A1A1A] font-medium"
                                                    onclick="updateQuantity({{ $item->id }}, {{ $q }})">{{ $q }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-x-[24px] gap-y-1 text-[16px] text-[#1A1A1A] mt-4 font-Outfit">
                                    <p class="flex items-center gap-2"><span class="text-[#1A1A1A] font-bold">Metal:</span>
                                        <span class="text-[#7D8FAB] font-medium">14KT</span> <!-- Dynamic if available -->
                                    </p>
                                    <p class="flex items-center gap-2"><span class="text-[#1A1A1A] font-bold">Metal
                                            Color:</span>
                                        <span class="w-5 h-5 rounded-full bg-[#E6C6B6] block border border-gray-200"></span>
                                        <span class="text-[#1A1A1A] font-medium">Rose</span>
                                    </p>
                                </div>
                                <div class="flex flex-wrap gap-x-[24px] text-[16px] text-[#1A1A1A] font-Outfit mb-2">
                                    <p class="flex items-center gap-2"><span class="text-[#1A1A1A] font-bold">Weight:</span>
                                        <span class="text-[#7D8FAB] font-medium">0.786 gm</span>
                                    </p>
                                </div>

                                <div class="flex items-center gap-2 text-[#008F5D] text-[16px] font-bold mt-auto font-Outfit">
                                    <img src="{{ asset('assets/true_sign.png') }}" alt="Express" class="w-5 h-5 object-contain">
                                    Express
                                    Delivery in 2 Days
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Right Column: Price Details -->
            <div class="w-full lg:w-1/3 flex-shrink-0">
                <div class="rounded-lg p-6 sticky top-28">
                    <h3 class="font-medium text-gray-900 text-lg mb-4">Price Details ({{ $cartItems->count() }} Item)</h3>

                    <div class="space-y-3 pb-4 mb-4 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total MRP</span>
                            <span>₹{{ number_format($totalMrp, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Discount on MRP</span>
                            <span>₹{{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Platform Fee</span>
                            <span>₹{{ number_format($platformFee, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center font-bold text-gray-900 text-lg mb-6">
                        <span>Total Amount</span>
                        <span>₹{{ number_format($totalAmount, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.address') }}"
                        class="flex flex-row justify-center items-center px-4 py-[18px] gap-[10px] w-full h-[74px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] rounded-[100px] flex-none order-1 self-stretch grow-0 text-white font-medium text-lg shadow-md hover:opacity-90 transition-opacity">
                        Place Order
                    </a>
                </div>
            </div>
        @endif

    </main>

    <!-- Similiar Jewellery Product Section -->
    @if(isset($similarProducts) && $similarProducts->isNotEmpty())
        <section class="max-w-[1920px] mx-auto px-4 py-12 font-Outfit">
            <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
                <img src="{{ asset('assets/Design.png') }}"
                    class="h-auto w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
                <div class="text-center flex flex-col items-center">
                    <p style="font-family: 'Alexandria', sans-serif;"
                        class="text-[15px] min-[2000px]:text-xl text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">
                        Similar</p>
                    <h2
                        class="font-['Outfit'] font-medium text-[28px] md:text-[40px] min-[2000px]:text-5xl leading-tight md:leading-[50px] min-[2000px]:leading-[1.2] text-[#CBA65A]">
                        Jewellery Product</h2>
                </div>
                <img src="{{ asset('assets/Design (1).png') }}"
                    class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
                <!-- Left Banner Card -->
                <div
                    class="lg:col-span-1 bg-[#111111] h-full w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden">
                    <img src="{{ asset('assets/neckless.png') }}" alt="Necklace"
                        class="w-full h-full object-contain object-center">

                </div>

                <!-- Right Grid -->
                <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">
                    @foreach($similarProducts as $product)
                        @php
                            $img = $product->images->first()
                                ? (Str::startsWith($product->images->first()->image_path, 'http') ? $product->images->first()->image_path : asset('storage/' . $product->images->first()->image_path))
                                : asset('assets/ring.png');
                        @endphp
                        <!-- Product Card -->
                        <div class="flex flex-col gap-3">
                            <div
                                class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                                <span
                                    class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                                    Seller</span>
                                <a href="{{ route('product.details', $product->slug) }}"
                                    class="w-full h-full flex items-center justify-center">
                                    <img src="{{ $img }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-contain-full mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                                    <img src="{{ $img }}"
                                        class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                                </a>
                            </div>
                            <div class="text-center font-['Outfit']">
                                <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">{{ $product->name }}</h3>
                                <div class="flex items-center justify-center gap-2 text-xs">
                                    <span class="font-['outfit'] text-[#1A1A1A]">₹{{ number_format($product->price, 2) }}</span>
                                    <!-- <span class="text-[#999999] line-through">₹ 949.00</span> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>

    <!-- Hidden Form for Quantity Update -->
    <form id="update-quantity-form" action="" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="quantity" id="update-quantity-input">
    </form>

    <script>
        // Global listener to close dropdowns when clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.quantity-dropdown-container')) {
                document.querySelectorAll('.quantity-dropdown-container > div').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });

        function toggleQuantityMenu(button) {
            const dropdown = button.nextElementSibling;
            const isHidden = dropdown.classList.contains('hidden');

            // Close all other dropdowns
            document.querySelectorAll('.quantity-dropdown-container > div').forEach(el => {
                el.classList.add('hidden');
            });

            // Toggle current
            if (isHidden) {
                dropdown.classList.remove('hidden');
            }
        }

        function updateQuantity(itemId, quantity) {
            const form = document.getElementById('update-quantity-form');
            // Use Laravel route helper to get the base URL
            const baseRoute = "{{ route('cart.index') }}";
            // route('cart.index') returns .../cart. Appending /id gives .../cart/{id}
            form.action = baseRoute + "/" + itemId;

            document.getElementById('update-quantity-input').value = quantity;
            form.submit();
        }
    </script>

@endsection