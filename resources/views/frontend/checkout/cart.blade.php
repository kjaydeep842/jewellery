@extends('frontend.layouts.master')

@section('content')
    <main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
        <div
            class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

            <!-- Sidebar -->
            @include('frontend.profile.partials.sidebar')

            <!-- Main Content -->
            <div class="flex-grow min-h-[600px] flex flex-col">
                @if($cartItems->isEmpty())
                    <!-- Empty State Section -->
                    <div class="flex-grow flex flex-col items-center justify-center p-[40px] gap-6 rounded-[10px]"
                        style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
                        <div class="relative">
                            <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="Empty Bag Icon"
                                class="object-contain h-[80px] w-auto opacity-80">
                        </div>
                        <div class="text-center space-y-2">
                            <h2 class="text-2xl font-['Outfit'] font-bold text-[#1A1A1A]">Your Bag is Currently Empty</h2>
                            <p class="text-base text-[#6E6E77] max-w-md mx-auto font-['Outfit']">
                                Looks like you haven't added anything to your bag yet. Start exploring our collection and find
                                something beautiful today.
                            </p>
                        </div>
                        <a href="{{ route('home') }}" style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);"
                            class="px-10 py-4 rounded-full text-white font-['Outfit'] font-medium text-lg shadow-md hover:opacity-90 transition-all">
                            Continue Shopping
                        </a>
                    </div>
                @else
                    <!-- Bag Content -->
                    <div class="flex flex-col xl:flex-row gap-8 w-full">
                        <!-- Items List -->
                        <div class="flex-grow flex flex-col gap-6">
                            <div class="p-4 md:p-8 bg-white rounded-[10px] shadow-sm">
                                <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl min-[2000px]:text-3xl mb-8">My
                                    Bag ({{ $cartItems->count() }} items)</h2>

                                <div class="space-y-6">
                                    @foreach($cartItems as $item)
                                        <div
                                            class="flex flex-col md:flex-row gap-6 p-4 border border-gray-100 rounded-xl relative group hover:shadow-md transition-shadow">
                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                class="absolute top-4 right-4 z-10">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-xmark text-lg"></i>
                                                </button>
                                            </form>

                                            <!-- Image -->
                                            <div
                                                class="w-full md:w-48 aspect-square bg-[#FDFBF7] rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0">
                                                @if($item->product->images->isNotEmpty())
                                                    <img src="{{ Str::startsWith($item->product->images->first()->image_path, 'http') ? $item->product->images->first()->image_path : asset('storage/' . $item->product->images->first()->image_path) }}"
                                                        alt="{{ $item->product->name }}"
                                                        class="w-[90%] h-[90%] object-contain mix-blend-multiply">
                                                @endif
                                            </div>

                                            <!-- Details -->
                                            <div class="flex-grow flex flex-col py-2">
                                                <h3 class="font-['Outfit'] font-medium text-[#1A1A1A] text-lg mb-2 pr-8">
                                                    <a href="{{ route('product.details', $item->product->slug) }}"
                                                        class="hover:text-[#CBA65A]">{{ $item->product->name }}</a>
                                                </h3>
                                                <p class="font-['Outfit'] font-bold text-[#CBA65A] text-xl mb-4">
                                                    ₹{{ number_format($item->price, 2) }}</p>

                                                <div class="flex flex-wrap items-center gap-4 mt-auto">
                                                    @if($item->variant)
                                                        <span
                                                            class="px-4 py-2 bg-gray-50 rounded-lg text-sm font-medium text-gray-700 font-['Outfit']">
                                                            Variant: {{ $item->variant->name }}
                                                        </span>
                                                    @endif

                                                    <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-1">
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="quantity"
                                                                value="{{ max(1, $item->quantity - 1) }}">
                                                            <button type="submit"
                                                                class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#CBA65A]"
                                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                                        </form>
                                                        <span
                                                            class="w-8 text-center font-bold text-gray-800">{{ $item->quantity }}</span>
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                            <button type="submit"
                                                                class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#CBA65A]">+</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="w-full xl:w-[400px] flex-shrink-0">
                            <div class="p-6 md:p-8 bg-white rounded-[10px] shadow-sm sticky top-28 border border-gray-100">
                                <h3
                                    class="font-['Outfit'] font-semibold text-[#1A1A1A] text-lg mb-6 border-bottom pb-4 border-gray-50">
                                    Price Details</h3>

                                <div class="space-y-4 mb-8">
                                    <div class="flex justify-between text-gray-600 font-['Outfit']">
                                        <span>Bag Total</span>
                                        <span>₹{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600 font-['Outfit']">
                                        <span>Delivery Fee</span>
                                        <span class="text-green-600">FREE</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600 font-['Outfit']">
                                        <span>Platform Fee</span>
                                        <span>₹20.00</span>
                                    </div>
                                    <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                                        <span class="font-['Outfit'] font-bold text-lg text-[#1A1A1A]">Total Amount</span>
                                        <span
                                            class="font-['Outfit'] font-bold text-xl text-[#CBA65A]">₹{{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity) + 20, 2) }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('checkout.address') }}"
                                    style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);"
                                    class="flex justify-center items-center w-full py-4 rounded-full text-white font-['Outfit'] font-bold text-lg shadow-md hover:opacity-90 transition-all">
                                    Place Order
                                </a>

                                <p class="text-center text-xs text-gray-400 mt-4 font-['Outfit']">Secure payment options
                                    available</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>


    <!-- Similar Jewellery Product Section -->
    <!-- <section class="max-w-[1920px] mx-auto px-4 py-12 font-Outfit">
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

                <div
                    class="lg:col-span-1 bg-[#111111] h-full w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden">
                    <img src="{{ asset('assets/neckless.png') }}" alt="Necklace"
                        class="w-full h-full object-contain object-center">
                </div>


                <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">

                    <div class="flex flex-col gap-3">
                        <div
                            class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                            <span
                                class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                                Seller</span>
                            <div class="w-full h-full flex items-center justify-center">
                                {{-- No Fallback Image --}}
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

                    <div class="flex flex-col gap-3">
                        <div
                            class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center">
                                {{-- No Fallback Image --}}
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
        </section> -->

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection