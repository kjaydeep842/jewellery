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
    class="bg-white border border-[#CFD4E3] rounded-[4px] p-2 md:p-[12px] hover:shadow-[0_4px_15px_rgba(0,0,0,0.05)] transition-all duration-300 overflow-hidden flex flex-col h-full group gap-2 md:gap-[13px]">

    <!-- Image Area -->
    <div
        class="w-full aspect-[304/340] flex items-center justify-center relative bg-[#F9F9F9] group/image border border-[#D7D7DA] rounded-[2px] overflow-hidden">

        @if($product->is_bestseller)
            <div
                class="absolute top-2 left-0 z-10 bg-[#BC511B] text-white text-[10px] pl-2 pr-1.5 py-0.5 rounded-r-sm font-['Outfit'] font-normal tracking-wide">
                Best Seller
            </div>
        @endif

        <!-- X button for wishlist -->
        <form action="{{ route('wishlist.destroy', $wishlist_item_id) }}" method="POST"
            class="absolute top-3 right-3 z-20">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.1)] text-gray-400 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-xmark text-[10px]"></i>
            </button>
        </form>

        <!-- Image with Link -->
        <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-4"
            title="{{ $product->name }}">
            <!-- Alpine Image Binding -->
            <template x-if="images.length > 0 && images[activeImage]">
                <img :src="images[activeImage]" alt="{{ $product->name }}"
                    class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
            </template>
            <template x-if="images.length === 0 || !images[activeImage]">
                <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400 text-xs">
                    No Image
                </div>
            </template>
        </a>

        <!-- Slider Arrows -->
        <template x-if="images.length > 1">
            <div
                class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-1 opacity-0 group-hover/image:opacity-100 transition-opacity pointer-events-none">
                <button @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                    class="w-6 h-6 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center text-[#CBA65A] shadow-sm cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </button>
                <button @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                    class="w-6 h-6 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center text-[#CBA65A] shadow-sm cursor-pointer pointer-events-auto transition-colors">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>
        </template>

        <!-- Action Bar On Hover -->
        <div
            class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center justify-center gap-2.5 z-20 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 w-[90%] sm:w-[85%] mx-auto">
            <!-- Heart icon (since it's in wishlist already, showing filled icon to signify it is wishlisted) -->
            <div
                class="w-8 h-8 flex-shrink-0 bg-white rounded-full flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.1)] cursor-pointer">
                <i class="fa-solid fa-heart text-[#CBA65A] text-[14px]"></i>
            </div>

            <!-- Add to Cart -->
            <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                class="flex-grow h-8 text-white text-[12px] shadow-[0_2px_8px_rgba(0,0,0,0.1)] bg-[#BE933C] font-['Outfit'] rounded font-medium flex items-center justify-center transition-colors hover:bg-[#A98940]">
                Add to Cart
            </button>

            <!-- Expand Button -->
            <div @click.prevent.stop="zoomImages = images; zoomIndex = activeImage; zoomOpen = true"
                class="w-8 h-8 flex-shrink-0 bg-white rounded-full flex items-center justify-center shadow-[0_2px_8px_rgba(0,0,0,0.1)] cursor-pointer text-[#6B6B75]">
                <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-3 h-3 object-contain">
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="flex flex-col flex-grow bg-white">
        <a href="{{ route('product.details', $product->slug) }}" title="{{ $product->name }}"
            class="text-[#252528] hover:text-[#BE933C] transition-colors font-['Outfit'] text-[16px] md:text-[20px] font-normal leading-[1.2] md:leading-none mb-1 md:mb-0 h-auto md:h-[50px] line-clamp-2">
            {{ $product->name }}
        </a>
        <div class="mt-auto md:h-[30px] flex items-end">
            <p
                class="text-[18px] md:text-[24px] font-medium text-[#0D0D0E] font-['Outfit'] leading-none md:leading-[1.26]">
                ₹{{ number_format($product->selling_price, 2) }}
            </p>
        </div>
    </div>
</div>