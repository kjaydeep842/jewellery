@php
    $imageUrls = collect();
    if ($product->image) {
        $imageUrls->push(asset('storage/' . $product->image));
    }
    foreach ($product->images as $image) {
        $imageUrls->push(asset('storage/' . $image->image_path));
    }
    $allImages = $imageUrls->unique()->values();
@endphp
<div x-data="{
        activeImage: 0,
        images: {{ $allImages->toJson() }}
    }"
    class="bg-white border border-[#D7D7DA] transition-all duration-300 rounded-[8px] overflow-hidden p-[6px] md:p-[10px] relative group flex flex-col h-full">

    <!-- Image Area -->
    <div
        class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-[6px] overflow-hidden bg-[#F9F9F9] group/image">
        @if($product->is_bestseller)
            <div
                class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[10px] sm:text-[12px] pl-2 pr-1.5 sm:pl-3 sm:pr-2 py-0.5 sm:py-1 rounded-l-full font-['Alexandria'] font-normal tracking-wide">
                Best Seller
            </div>
        @endif

        @if(isset($wishlist_item_id))
            <!-- Remove from Wishlist Form -->
            <form action="{{ route('wishlist.destroy', $wishlist_item_id) }}" method="POST"
                class="absolute top-2 left-2 z-20">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-6 h-6 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow-sm text-gray-400 hover:text-red-500 transition-colors backdrop-blur-sm cursor-pointer border border-[#E8E1D5]">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </form>
        @endif

        <!-- Image with Link -->
        <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-2 md:p-4"
            title="{{ $product->name }}">
            <!-- Alpine Image Binding -->
            <template x-if="images.length > 0 && images[activeImage]">
                <img :src="images[activeImage]" alt="{{ $product->name }}"
                    class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
            </template>
            <template x-if="images.length === 0 || !images[activeImage]">
                <div class="w-full h-full flex items-center justify-center bg-gray-50/50">
                    {{-- No Fallback Image --}}
                </div>
            </template>
        </a>

        <!-- Slider Arrows (Visible on Hover) -->
        <template x-if="images.length > 1">
            <div
                class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between transition-opacity duration-300 opacity-0 group-hover:opacity-100 pointer-events-none z-10">
                <button @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                    class="w-[20px] h-[24px] md:w-[24px] md:h-[30px] bg-[#D7D7DA] hover:bg-[#CBA65A] rounded-r-full flex items-center justify-center shadow-sm cursor-pointer pointer-events-auto transition-colors group/btn">
                    <i
                        class="fa-solid fa-chevron-left text-[10px] md:text-[12px] pr-0.5 text-[#8E95A5] group-hover/btn:text-white transition-colors"></i>
                </button>
                <button @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                    class="w-[20px] h-[24px] md:w-[24px] md:h-[30px] bg-[#D7D7DA] hover:bg-[#CBA65A] rounded-l-full flex items-center justify-center shadow-sm cursor-pointer pointer-events-auto transition-colors group/btn">
                    <i
                        class="fa-solid fa-chevron-right text-[10px] md:text-[12px] pl-0.5 text-[#8E95A5] group-hover/btn:text-white transition-colors"></i>
                </button>
            </div>
        </template>

        <!-- Action Bar -->
        <div
            class="absolute bottom-1 sm:bottom-3 inset-x-1 sm:inset-x-3 flex items-center justify-between gap-1 sm:gap-2 z-20">
            <!-- Wishlist Button -->
            @if(!isset($wishlist_item_id))
                <div class="w-6 h-6 sm:w-9 sm:h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors wishlist-btn"
                    data-product-id="{{ $product->id }}">
                    @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                        <i class="fa-solid fa-heart text-[#CBA65A] text-[10px] sm:text-sm"></i>
                    @else
                        <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist"
                            class="w-3 h-3 sm:w-4 sm:h-4 object-contain">
                    @endif
                </div>
            @else
                <div class="w-6 h-6 sm:w-9 sm:h-9 flex-shrink-0"></div> <!-- Placeholder to retain spacing -->
            @endif

            <!-- Add to Cart (Restored on hover) -->
            <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                class="flex-grow h-6 sm:h-9 text-white text-[9px] sm:text-xs shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-['Outfit'] whitespace-nowrap"
                style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%), #D5D9E2; border-radius: 6px;">
                Add to Cart
            </button>

            <!-- Expand Button -->
            <div @click.prevent.stop="zoomImages = images; zoomIndex = activeImage; zoomOpen = true"
                class="w-6 h-6 sm:w-9 sm:h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors">
                <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-3 h-3 sm:w-4 sm:h-4 object-contain">
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="space-y-0.5 md:space-y-1 flex flex-col flex-grow pt-1">
        <p
            class="text-[12px] md:text-[14px] lg:text-[16px] xl:text-[20px] text-[#252529] font-normal leading-[1.2] font-['Outfit'] line-clamp-2 min-h-[30px] md:min-h-[36px] xl:min-h-[50px] mb-0.5">
            <a href="{{ route('product.details', $product->slug) }}"
                title="{{ $product->name }}">{{ $product->name }}</a>
        </p>
        <div class="mt-auto">
            <p
                class="text-[14px] md:text-[16px] lg:text-[18px] xl:text-[24px] font-medium text-[#0D0D0E] font-['Outfit'] leading-[1.2] mb-1">
                ₹{{ number_format($product->selling_price, 2) }}
            </p>

            <!-- Color Swatches -->
            <div class="flex items-center gap-[4px] md:gap-[6px] xl:gap-[8px] mt-1 xl:mt-2">
                <div class="w-[16px] h-[16px] md:w-[20px] md:h-[20px] lg:w-[24px] lg:h-[24px] xl:w-[32px] xl:h-[32px] rounded-full bg-[#E5C365] border border-gray-200 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                    title="Yellow Gold"></div>
                <div class="w-[16px] h-[16px] md:w-[20px] md:h-[20px] lg:w-[24px] lg:h-[24px] xl:w-[32px] xl:h-[32px] rounded-full bg-[#D4D4D4] border border-gray-200 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                    title="White Gold"></div>
                <div class="w-[16px] h-[16px] md:w-[20px] md:h-[20px] lg:w-[24px] lg:h-[24px] xl:w-[32px] xl:h-[32px] rounded-full bg-[#E0A499] border border-gray-200 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                    title="Rose Gold"></div>
            </div>
        </div>
    </div>
</div>