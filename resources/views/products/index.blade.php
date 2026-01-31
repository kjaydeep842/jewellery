@extends('layouts.master')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-[#FDFBF7] py-16 md:py-24 overflow-hidden">
        <!-- Background decorative elements -->
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-amber-50/50 rounded-full blur-3xl -z-10 transform translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-amber-50/30 rounded-full blur-3xl -z-10 transform -translate-x-1/3 translate-y-1/3">
        </div>

        <div class="container mx-auto px-4 md:px-8 relative z-10 text-center">

            <p class="font-Alexandria text-[#C34A37] text-sm md:text-base tracking-widest uppercase mb-3">Our Collection</p>
            <h1 class="font-Outfit font-medium text-4xl md:text-6xl text-[#CBA65A] mb-6 leading-tight">
                All Products
            </h1>
            <div class="flex justify-center items-center gap-4 mb-4">
                <img src="{{ asset('assets/Design.png') }}" class="h-6 opacity-80" alt="decoration">
            </div>
            <p class="font-Outfit text-zinc-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Discover our exquisite range of jewelry, crafted with passion and precision.
            </p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4 md:px-8">

            @if($products->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                    @foreach($products as $product)
                        <div class="flex flex-col gap-4 group">
                            <!-- Image Card -->
                            <a href="{{ route('product.details', $product->slug) }}" class="block">
                                <div
                                    class="bg-[#FDFBF7] relative w-full aspect-square border border-[#EAEAEA] rounded-[20px] overflow-hidden transition-all duration-500 hover:shadow-xl hover:border-[#CBA65A]/30">
                                    <!-- Badges -->
                                    @if($product->created_at->diffInDays(now()) < 30)
                                        <span
                                            class="absolute top-4 left-4 bg-black text-white text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full z-20">New</span>
                                    @endif

                                    <!-- Wishlist Btn -->
                                    <button
                                        class="absolute bottom-4 right-4 bg-white w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-[#C34A37] hover:bg-[#FFF5F5] transition-all z-20 shadow-md transform hover:scale-110">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>

                                    <!-- Images -->
                                    <div class="w-full h-full flex items-center justify-center p-6 relative">
                                        <img src="{{ $product->images->first()->url ?? asset('assets/ring.png') }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-contain mix-blend-multiply transition-transform duration-700 ease-in-out group-hover:scale-110 group-hover:opacity-0">

                                        <img src="{{ $product->images->get(1)->url ?? $product->images->first()->url ?? asset('assets/ring.png') }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-contain mix-blend-multiply absolute inset-0 p-6 opacity-0 transition-all duration-700 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                                    </div>
                                </div>
                            </a>

                            <!-- Info -->
                            <div class="text-center">
                                <h3
                                    class="font-Outfit text-lg text-[#1A1A1A] mb-2 group-hover:text-[#CBA65A] transition-colors line-clamp-1">
                                    <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="flex items-center justify-center gap-3">
                                    <span class="font-bold font-Outfit text-[#1A1A1A] text-lg">₹
                                        {{ number_format($product->price, 2) }}</span>
                                    @if($product->compare_price > $product->price)
                                        <span class="text-gray-400 line-through text-sm">₹
                                            {{ number_format($product->compare_price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-16 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <img src="{{ asset('assets/empty-box.png') }}" alt="No products" class="h-32 mx-auto mb-6 opacity-50">
                    <h3 class="text-2xl font-Outfit text-gray-800 mb-2">No Products Found</h3>
                    <p class="text-gray-500 mb-8">We couldn't find any products in our collection yet.</p>
                    <a href="{{ route('home') }}"
                        class="inline-block px-8 py-3 bg-[#CBA65A] text-white rounded-full font-bold hover:bg-[#B5934B] transition-colors">
                        Back to Home
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection