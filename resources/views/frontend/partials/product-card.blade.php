<div x-data="{
    activeImage: 0,
    images: [
        '{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : asset('assets/ring.png') }}',
        @foreach($product->images->skip(1) as $image)
            '{{ asset('storage/' . $image->image_path) }}',
        @endforeach
    ]
}"
    class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-shadow rounded-sm overflow-hidden p-2 relative group">

    <!-- Image Area -->
    <div class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden">
        @if($product->is_bestseller)
            <div
                class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[11px] pl-3 pr-2 py-1 rounded-l-full font-medium font-['Outfit']">
                Best Seller
            </div>
        @endif

        <!-- Main Image -->
        <img :src="images[activeImage]" alt="{{ $product->name }}"
            class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">

        <!-- Navigation Arrows (Always Visible - Centered) -->
        <template x-if="images.length > 1">
            <div
                class="absolute inset-y-0 left-0 right-0 flex justify-between items-center px-2 pointer-events-none z-10">
                <button @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                    class="w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center text-[#CBA65A] shadow cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                    class="w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center text-[#CBA65A] shadow cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </template>

        <!-- Bottom Action Buttons Row (Always Visible) -->
        <div class="absolute bottom-3 left-0 right-0 flex justify-center items-center gap-2 px-3 z-20">
            <!-- Wishlist Button -->
            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow cursor-pointer wishlist-btn hover:bg-[#FAF8F1] transition-colors"
                data-product-id="{{ $product->id }}">
                @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                    <i class="fa-solid fa-heart text-[#CBA65A] text-sm"></i>
                @else
                    <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist" class="w-4 h-4 object-contain">
                @endif
            </div>

            <!-- Add to Cart Button (Smaller) -->
            <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                class="bg-[#CBA65A] text-white text-xs font-bold px-4 py-2 rounded-lg shadow-md hover:bg-[#b39359] transition-colors font-['Outfit'] whitespace-nowrap">
                Add to Cart
            </button>

            <!-- Zoom Button -->
            <button @click.prevent.stop="zoomImage = images[activeImage]; zoomOpen = true"
                class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow cursor-pointer hover:bg-[#FAF8F1] transition-colors">
                <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-4 h-4 object-contain">
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="space-y-1">
        <p class="text-sm text-gray-800 font-medium leading-tight font-['Outfit']">{{ $product->name }}</p>
        <p class="text-base font-bold text-[#1A1A1A] font-['Outfit']">₹{{ number_format($product->selling_price, 2) }}
        </p>
        <div class="flex items-center gap-2 mt-2">
            <div
                class="w-4 h-4 rounded-full bg-[#E5C365] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400">
            </div>
            <div
                class="w-4 h-4 rounded-full bg-[#D4D4D4] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400">
            </div>
            <div
                class="w-4 h-4 rounded-full bg-[#E0A499] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400">
            </div>
        </div>
    </div>
</div>