<x-layouts.frontend>

    <!-- Hero Section -->
    <!-- Hero Section -->
    <div class="relative bg-gray-900 h-[600px]">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Placeholder for Hero Image -->
            <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=2070&auto=format&fit=crop"
                alt="Luxury Jewelry" class="w-full h-full object-cover opacity-70">
            <div class="absolute inset-0 bg-black/40"></div> <!-- Dark Overlay -->
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="font-serif text-5xl md:text-7xl font-bold mb-6 leading-tight drop-shadow-md">
                    Timeless Elegance <br> <span class="text-[#D4AF37] italic">Defined</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-100 mb-8 font-light tracking-wide drop-shadow-sm">
                    Discover our exclusive collection of handcrafted jewelry, designed to capture the essence of your
                    most cherished moments.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-[#D4AF37] text-black font-bold uppercase tracking-widest py-4 px-8 hover:bg-white hover:text-black transition-all duration-300 shadow-lg">
                        Shop Collection
                    </a>
                    <a href="#"
                        class="border-2 border-white text-white font-bold uppercase tracking-widest py-4 px-8 hover:bg-white hover:text-black transition-all duration-300 backdrop-blur-sm">
                        View Lookbook
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features / Trust Badges -->
    <div class="bg-gray-50 py-12 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <div class="text-[#D4AF37] mx-auto w-10 h-10 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-gray-900">Certified Authenticity</h3>
                </div>
                <div class="space-y-2">
                    <div class="text-[#D4AF37] mx-auto w-10 h-10 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-gray-900">Lifetime Warranty</h3>
                </div>
                <div class="space-y-2">
                    <div class="text-[#D4AF37] mx-auto w-10 h-10 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-gray-900">Secure Payment</h3>
                </div>
                <div class="space-y-2">
                    <div class="text-[#D4AF37] mx-auto w-10 h-10 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-gray-900">Free Shipping</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900 mb-4">Shop by Category</h2>
                <div class="w-24 h-1 bg-[#D4AF37] mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <a href="#" class="group relative h-[400px] overflow-hidden block shadow-lg">
                        <!-- Image Background -->
                        <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-300">
                        </div>

                        <!-- Content -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                            <h3
                                class="font-serif text-3xl font-bold text-white mb-2 tracking-wide group-hover:-translate-y-2 transition-transform duration-300">
                                {{ $category->name }}
                            </h3>
                            <span
                                class="text-sm text-white uppercase tracking-widest border-b-2 border-[#D4AF37] pb-1 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 transition-all duration-300 delay-75">
                                Explore Collection
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-[#FDFDFC] py-20"> <!-- Slightly off-white background -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900 mb-4">New Arrivals</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Explore our latest additions, meticulously crafted to
                    perfection.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div
                        class="group bg-white border border-gray-100 p-4 hover:shadow-xl transition-shadow duration-300 relative">
                        <!-- Product Image -->
                        <div class="relative overflow-hidden aspect-square bg-gray-100 mb-4">
                            @if($product->images->isNotEmpty())
                                <img src="{{ Str::startsWith($product->images->first()->image_path, 'http') ? $product->images->first()->image_path : asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Badges -->
                            @if($loop->first)
                                <span
                                    class="absolute top-2 left-2 bg-black text-white text-[10px] font-bold uppercase py-1 px-2 tracking-widest">New</span>
                            @endif

                            <!-- Overlay Actions -->
                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-2">
                                <a href="{{ route('product.details', $product->slug) }}"
                                    class="bg-white text-gray-900 p-2 rounded-full hover:bg-[#D4AF37] hover:text-white transition-colors"
                                    title="View Details">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <div class="wishlist-btn cursor-pointer bg-white text-gray-900 p-2 rounded-full hover:bg-[#D4AF37] hover:text-white transition-colors {{ Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id) ? 'bg-[#D4AF37] text-white' : '' }}"
                                    data-product-id="{{ $product->id }}" title="Add to Wishlist">
                                    <svg class="w-5 h-5"
                                        fill="{{ Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id) ? 'currentColor' : 'none' }}"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="text-center space-y-1">
                            <p class="text-xs text-[#D4AF37] font-bold uppercase tracking-wider">
                                {{ $product->category->name }}
                            </p>
                            <h3
                                class="font-serif font-bold text-gray-900 group-hover:text-[#D4AF37] transition-colors truncate">
                                <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-900 font-bold">${{ number_format($product->base_price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-block border-2 border-gray-900 text-gray-900 font-bold uppercase tracking-widest py-3 px-8 hover:bg-gray-900 hover:text-white transition-all duration-300">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- CTA / Banner -->
    <div class="bg-gray-900 py-20 relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1584302179602-e4c3d3fd6625?q=80&w=2070&auto=format&fit=crop"
            class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay">
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center text-white">
            <h2 class="font-serif text-3xl md:text-5xl font-bold mb-6">Create Your Custom Design</h2>
            <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                Have a unique vision? Our master jewelers can bring your dream piece to life. Schedule a consultation
                today.
            </p>
            <a href="#"
                class="inline-block bg-[#D4AF37] text-black font-bold uppercase tracking-widest py-4 px-10 hover:bg-white hover:text-black transition-all duration-300">
                Start Bespoke Journey
            </a>
        </div>
    </div>

</x-layouts.frontend>