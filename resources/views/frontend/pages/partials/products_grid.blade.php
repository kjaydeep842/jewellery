@forelse($products as $product)
@php
$mainImage = $product->images->first() ? 'storage/' . $product->images->first()->image_path : 'assets/ring.png';
$hoverImage = $product->images->count() > 1 ? 'storage/' . $product->images->skip(1)->first()->image_path : ($mainImage != 'assets/ring.png' ? $mainImage : 'assets/hover_image_p.png');
$isBestSeller = $product->is_bestseller;
$colors = $product->variants->pluck('color')->unique();
if ($colors->isEmpty() && $product->metalColor) {
$colors = collect([$product->metalColor->name]);
}

// Get all images for cycling
$allImages = $product->images->count() > 0
? $product->images->pluck('image_path')->map(fn($path) => asset('storage/' . $path))->values()
: collect([asset('assets/ring.png')]);
@endphp
<!-- Card -->
<div class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-shadow rounded-sm overflow-hidden p-2 relative group product-card"
    data-images='{{ $allImages->toJson() }}'
    data-current-index="0">
    <div class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden">
        @if($isBestSeller)
        <div class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[12px] pl-3 pr-2 py-1 rounded-l-full font-['Alexandria'] font-normal tracking-wide">
            Best Seller
        </div>
        @endif

        <!-- Navigation Buttons -->
        @if($allImages->count() > 1)
        <button class="absolute z-20 nav-prev-side hover:bg-[#C5C5C8] transition-colors cursor-pointer flex items-center justify-center" style="width: 18px; height: 30px; left: 0px; top: calc(50% - 38px); background: #D7D7DA; border-radius: 0px 100px 100px 0px;">
            <i class="fa-solid fa-chevron-left text-[10px] text-gray-500"></i>
        </button>
        <button class="absolute z-20 nav-next-side hover:bg-[#C5C5C8] transition-colors cursor-pointer flex items-center justify-center" style="width: 18px; height: 30px; right: 0px; top: calc(50% - 38px); background: #D7D7DA; border-radius: 100px 0px 0px 100px;">
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-500"></i>
        </button>
        @endif

        <!-- Product Images -->
        <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative">
            <img src="{{ asset($mainImage) }}" alt="{{ $product->name }}" loading="lazy"
                class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300 group-hover:opacity-0 main-product-image">
            <img src="{{ asset($hoverImage) }}" alt="{{ $product->name }} Hover" loading="lazy"
                class="absolute inset-0 w-full h-full object-contain mix-blend-multiply opacity-0 transition-opacity duration-300 group-hover:opacity-100 hover-product-image">
        </a>

        <!-- Action Bar -->
        <div class="absolute bottom-3 inset-x-3 flex items-center justify-between gap-2 z-20">
            <!-- Wishlist Button -->
            <div class="wishlist-btn w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors"
                data-product-id="{{ $product->id }}">
                <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist" class="w-4 h-4 object-contain">
            </div>

            <!-- Add to Cart -->
            <button class="add-to-cart-btn flex-grow h-9 text-white text-xs shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-['Outfit'] whitespace-nowrap"
                style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%), #D5D9E2; border-radius: 6px;"
                data-product-id="{{ $product->id }}">
                Add to Cart
            </button>

            <!-- Expand Button -->
            <div class="expand-btn w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors"
                data-image="{{ asset($mainImage) }}">
                <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-4 h-4 object-contain">
            </div>
        </div>
    </div>

    <!-- Product Info -->
    <div class="space-y-1">
        <p class="text-sm text-gray-800 font-medium leading-tight font-['Outfit']">
            <a href="{{ route('product.details', $product->slug) }}" class="hover:text-[#E9BB78] transition-colors">
                {{ $product->name }}
            </a>
        </p>
        <p class="text-base font-bold text-[#1A1A1A] font-['Outfit']">&#8377;{{ number_format($product->selling_price, 2) }}</p>

        <!-- Colors -->
        @if($colors->isNotEmpty())
        <div class="flex items-center gap-2 mt-2">
            @foreach($colors as $color)
            @php
            // Map color names to hex codes if needed, or use a default mapping
            $bgClass = match(strtolower($color)) {
            'rose' => 'bg-[#E0A499]',
            'white' => 'bg-[#D4D4D4]',
            'yellow' => 'bg-[#E5C365]',
            default => 'bg-gray-200'
            };
            @endphp
            <div class="w-4 h-4 rounded-full {{ $bgClass }} border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400" title="{{ $color }}"></div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@empty
<div class="col-span-full w-full h-[460px] flex flex-col justify-center items-center p-3 gap-3 rounded-[4px]"
    style="grid-column: 1 / -1; background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
    <div class="mb-4 relative w-16 h-16 flex items-center justify-center">
        <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="No Products Found"
            class="w-full h-full object-contain">
    </div>
    <div class="text-center">
        <h3 class="text-xl font-semibold text-gray-800 mb-1">No Products Found</h3>
        <p class="text-sm text-gray-500">We couldn't find any products matching your search.</p>
    </div>
</div>
@endforelse

@if($products->hasPages())
<div class="col-span-full mt-8 flex justify-center pagination" style="grid-column: 1 / -1;">
    {{ $products->links() }}
</div>
@endif