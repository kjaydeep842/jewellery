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
    class="bg-white border border-[#CFD4E3] rounded-[8px] p-3 md:p-[20px] hover:shadow-[0_8px_25px_rgba(0,0,0,0.08)] transition-all duration-300 overflow-hidden flex flex-col h-full group gap-3 md:gap-[18px]">

    <!-- Image Area -->
    <div
        class="w-full aspect-square flex items-center justify-center relative bg-[#F9F9F9] group/image border border-[#D7D7DA] rounded-[6px] overflow-hidden">

        @if($product->is_bestseller)
            <div
                class="absolute top-3 left-0 z-10 bg-[#BC511B] text-white text-[11px] md:text-[13px] pl-3 pr-2 py-1 rounded-r-sm font-['Outfit'] font-normal tracking-wide">
                Best Seller
            </div>
        @endif

        <!-- X button for wishlist -->
        <form action="{{ route('wishlist.destroy', $wishlist_item_id) }}" method="POST"
            class="absolute top-4 right-4 z-20">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-[0_2px_12px_rgba(0,0,0,0.12)] text-gray-400 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-xmark text-[14px]"></i>
            </button>
        </form>

        <!-- Image with Link -->
        <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-6 md:p-8"
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

        <!-- Slider Arrows -->
        <template x-if="images.length > 1">
            <div
                class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-2 opacity-0 group-hover/image:opacity-100 transition-opacity pointer-events-none">
                <button @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                    class="w-8 h-8 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center text-[#CBA65A] shadow-md cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-left text-[12px]"></i>
                </button>
                <button @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                    class="w-8 h-8 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center text-[#CBA65A] shadow-md cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-right text-[12px]"></i>
                </button>
            </div>
        </template>

        <!-- Action Bar On Hover -->
        <div
            class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center justify-center gap-3 z-20 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 w-[90%] mx-auto">
            <!-- Heart icon -->
            <div
                class="w-10 h-10 flex-shrink-0 bg-white rounded-full flex items-center justify-center shadow-[0_4px_12px_rgba(0,0,0,0.12)] cursor-pointer">
                <i class="fa-solid fa-heart text-[#CBA65A] text-[18px]"></i>
            </div>

            <!-- Add to Cart -->
            <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                class="flex-grow h-10 text-white text-[14px] shadow-[0_4px_12px_rgba(0,0,0,0.12)] bg-[#BE933C] font-['Outfit'] rounded-[6px] font-medium flex items-center justify-center transition-colors hover:bg-[#A98940]">
                Add to Cart
            </button>

            <!-- Expand Button -->
            <div @click.prevent.stop="zoomImages = images; zoomIndex = activeImage; zoomOpen = true"
                class="w-10 h-10 flex-shrink-0 bg-white rounded-full flex items-center justify-center shadow-[0_4px_12px_rgba(0,0,0,0.12)] cursor-pointer text-[#6B6B75]">
                <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-4 h-4 object-contain">
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="flex flex-col flex-grow bg-white px-1">
        <a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}"
            class="text-[#252528] hover:text-[#BE933C] transition-colors font-['Outfit'] text-[18px] md:text-[22px] font-medium leading-[1.3] mb-2 md:mb-3 h-auto md:h-[60px] line-clamp-2">
            {{ $product->name }}
        </a>
        <div class="mt-auto h-[35px] flex items-end">
            <p class="text-[22px] md:text-[28px] font-bold text-[#0D0D0E] font-['Outfit'] leading-none">
                ₹{{ number_format($product->selling_price, 2) }}
            </p>
        </div>
    </div>
</div>