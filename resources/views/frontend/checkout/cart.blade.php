@extends('frontend.checkout.layouts.app', ['activeStep' => 'cart'])

@section('content')
    <!-- Main Content -->
    <main class="max-w-[1920px] mx-auto px-4 lg:px-6 py-8 flex flex-col lg:flex-row gap-8">

        @if($cartItems->isEmpty())
            <div class="w-full text-center py-20 bg-white shadow-sm rounded-lg flex flex-col items-center justify-center">
                <p class="text-gray-500 text-lg mb-6">Your bag is currently empty.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-[#CBA65A] text-white font-bold uppercase tracking-widest py-3 px-8 hover:bg-[#b08d45] transition-colors rounded">
                    Continue Shopping
                </a>
            </div>
        @else

            <!-- Left Column: Bag Items -->
            <div class="w-full lg:w-2/3 flex flex-col gap-6">

                <!-- Address Banner -->
                <div
                    class="box-border flex flex-row justify-between items-center p-[20px] gap-[20px] w-full lg:w-[910px] h-auto lg:h-[106px] bg-[rgba(219,179,88,0.1)] border border-[#EFE4CD] rounded-[10px] flex-none order-0 self-stretch grow-0">
                    <div>
                        <p class="text-gray-500 text-sm">Deliver To : <span class="font-semibold text-gray-900">Guest</span></p>
                        <p class="text-gray-500 text-xs mt-1">Login to see saved addresses</p>
                    </div>
                    <a href="{{ route('checkout.address') }}"
                        class="text-[#CBA65A] border border-[#CBA65A] px-4 py-1.5 rounded text-sm font-medium hover:bg-[#CBA65A] hover:text-white transition-colors whitespace-nowrap bg-white">
                        Change Address
                    </a>
                </div>

                <!-- Product Selection Container -->
                <div
                    class="flex flex-col items-start p-0 gap-[10px] w-full lg:w-[910px] h-auto flex-none order-1 self-stretch grow-0">

                    <!-- Selection Header -->
                    <div
                        class="flex flex-row justify-between items-center p-[20px] gap-[20px] w-full h-[88px] rounded-[10px] flex-none order-0 self-stretch grow-0">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" class="custom-checkbox" checked>
                            <span class="font-bold text-[#1A1A1A] font-Outfit text-[18px]">{{ $cartItems->count() }} items
                                selected</span>
                        </label>
                        <button
                            class="text-[#7D8FAB] hover:text-red-500 text-[16px] font-medium transition-colors font-Outfit">Remove
                            Selected</button>
                    </div>

                    <!-- Cart Items Loop -->
                    @foreach($cartItems as $item)
                        <!-- Product Card Container -->
                        <div
                            class="box-border flex flex-row items-center p-0 gap-[10px] w-full lg:w-[910px]  border border-[#CFD5E3] rounded-[4px] flex-none order-1 self-stretch grow-0 relative group transition-colors overflow-hidden mb-4">

                            <!-- Close Button -->
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                class="absolute top-[10px] right-[10px] lg:top-[30px] lg:right-[30px] z-20">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fa-solid fa-xmark text-xl"></i>
                                </button>
                            </form>

                            <!-- Image Section (Left Side) -->
                            <div
                                class="relative w-[120px] md:w-[324px] h-[120px] md:h-[324px] bg-[#FDFBF7] flex-shrink-0 flex items-center justify-center">
                                <!-- Checkbox anchored top-left -->
                                <div class="absolute top-[10px] left-[10px] md:top-[24px] md:left-[24px] z-10">
                                    <input type="checkbox" class="custom-checkbox" checked>
                                </div>
                                @if($item->product->images->isNotEmpty())
                                    <img src="{{ Str::startsWith($item->product->images->first()->image_path, 'http') ? $item->product->images->first()->image_path : asset('storage/' . $item->product->images->first()->image_path) }}"
                                        alt="{{ $item->product->name }}" class="w-[95%] h-[95%] object-contain mix-blend-multiply">
                                @else
                                    <img src="{{ asset('assets/ring.png') }}" alt="Product"
                                        class="w-[95%] h-[95%] object-contain mix-blend-multiply">
                                @endif
                            </div>

                            <!-- Product Info (Right Side) -->
                            <div
                                class="flex-grow flex flex-col gap-[8px] h-full p-[10px] md:pt-[30px] md:pr-[30px] md:pb-[30px] md:pl-[10px]">
                                <h3
                                    class="font-medium text-[#1A1A1A] text-[16px] md:text-[20px] leading-[24px] md:leading-[28px] pr-8 font-Outfit w-[90%]">
                                    <a href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->name }}</a>
                                </h3>

                                <div class="text-[18px] md:text-[24px] font-bold text-[#1A1A1A] font-Outfit mt-1">
                                    ₹{{ number_format($item->price, 2) }}</div>

                                <div class="flex flex-wrap items-center gap-[12px] text-sm mt-3">
                                    @if($item->variant)
                                        <div
                                            class="bg-[#d2d2d2] px-[16px] py-[8px] rounded-[4px] text-[#1A1A1A] font-Outfit text-[15px] font-medium min-w-[100px] text-center">
                                            Variant: {{ $item->variant->name }}</div>
                                    @endif
                                    <!-- Quantity Dropdown -->
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        class="relative quantity-dropdown-container">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                        <button type="button" onclick="toggleQuantityMenu(this)"
                                            class="bg-[#d2d2d2] px-[16px] py-[8px] rounded-[4px] text-[#1A1A1A] font-Outfit text-[15px] font-medium flex items-center gap-2 cursor-pointer min-w-[90px] justify-between z-20 relative">
                                            <span class="qty-display">Qty: {{ $item->quantity }}</span> <i
                                                class="fa-solid fa-chevron-down text-xs text-[#1A1A1A] transition-transform duration-200"></i>
                                        </button>
                                        <!-- Dropdown Menu -->
                                        <div
                                            class="absolute top-[100%] left-0 w-full bg-white border border-[#d2d2d2] rounded-[4px] shadow-lg mt-1 hidden z-30 overflow-hidden text-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="cursor-pointer hover:bg-[#FDFBF7] py-2 text-sm text-[#1A1A1A] font-medium"
                                                    onclick="selectQuantity(this, {{ $i }})">{{ $i }}</div>
                                            @endfor
                                        </div>
                                    </form>
                                </div>

                                <div
                                    class="flex flex-wrap gap-x-[24px] gap-y-1 text-[16px] text-[#1A1A1A] mt-4 font-Outfit hidden md:flex">
                                    <p class="flex items-center gap-2"><span class="text-[#1A1A1A] font-bold">Metal:</span>
                                        <span class="text-[#7D8FAB] font-medium">14KT</span>
                                    </p>
                                    <p class="flex items-center gap-2"><span class="text-[#1A1A1A] font-bold">Metal
                                            Color:</span>
                                        <span class="w-5 h-5 rounded-full bg-[#E6C6B6] block border border-gray-200"></span>
                                        <span class="text-[#1A1A1A] font-medium">Rose</span>
                                    </p>
                                </div>
                                <div class="flex flex-wrap gap-x-[24px] text-[16px] text-[#1A1A1A] font-Outfit mb-2 hidden md:flex">
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
                <div class="rounded-lg p-6 sticky top-28 bg-white border border-gray-100">
                    <h3 class="font-medium text-gray-900 text-lg mb-4">Price Details ({{ $cartItems->count() }} Item)</h3>

                    <div class="space-y-3 pb-4 mb-4 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total MRP</span>
                            <span>₹{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Discount on MRP</span>
                            <span>₹0.00</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Platform Fee</span>
                            <span>₹20</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center font-bold text-gray-900 text-lg mb-6">
                        <span>Total Amount</span>
                        <span>₹{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity) + 20, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.address') }}"
                        class="flex flex-row justify-center items-center px-4 py-[18px] gap-[10px] w-full h-[74px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] rounded-[100px] flex-none order-1 self-stretch grow-0 text-white font-medium text-lg shadow-md hover:opacity-90 transition-opacity">
                        Place Order
                    </a>
                </div>
            </div>
        @endif

    </main>

    <!-- Similar Jewellery Product Section -->
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
            <!-- Note: Keeping static items for now to strictly match requested design until dynamic logic is requested -->
            <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">
                <!-- Product Card 1 -->
                <div class="flex flex-col gap-3">
                    <div
                        class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                        <span
                            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                            Seller</span>
                        <div class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                class="w-full h-full object-contain-full mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                            <img src="{{ asset('assets/hover_image_p.png') }}"
                                class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                        </div>
                    </div>
                    <div class="text-center font-['Outfit']">
                        <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage Ring</h3>
                        <div class="flex items-center justify-center gap-2 text-xs">
                            <span class="font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
                            <span class="text-[#999999] line-through">₹ 949.00</span>
                        </div>
                    </div>
                </div>
                <!-- Product Card 2 -->
                <div class="flex flex-col gap-3">
                    <div
                        class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                                class="w-full h-full object-contain-full mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                            <img src="{{ asset('assets/hover_image_p.png') }}"
                                class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                        </div>
                    </div>
                    <div class="text-center font-['Outfit']">
                        <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage Ring</h3>
                        <div class="flex items-center justify-center gap-2 text-xs">
                            <span class="font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
                            <span class="text-[#999999] line-through">₹ 949.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection