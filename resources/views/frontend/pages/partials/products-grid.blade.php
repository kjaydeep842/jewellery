<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImage: '' }">
    <!-- Grid Container -->
    <div id="products-grid"
        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 min-[1800px]:grid-cols-7 min-[2200px]:grid-cols-8 gap-3 md:gap-4 px-0">
        @forelse ($products as $product)
        <!-- Card -->
        <div
            class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-all rounded-sm overflow-hidden p-2 relative group flex flex-col h-full">

            <div
                class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden bg-white/50">
                @if($product->is_bestseller)
                <div
                    class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[10px] pl-3 pr-2 py-1 rounded-l-full font-medium font-['Outfit']">
                    Best Seller
                </div>
                @endif

                <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-4"
                    title="{{ $product->name }}">
                    @php
                    $mainImage = $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : asset('assets/ring.png');
                    $hoverImage = $product->images->count() > 1 ? asset('storage/' . $product->images->skip(1)->first()->image_path) : $mainImage;
                    @endphp
                    <img src="{{ $mainImage }}" alt="{{ $product->name }}"
                        class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-500 group-hover:opacity-0">
                    <img src="{{ $hoverImage }}" alt="{{ $product->name }} Hover"
                        class="absolute inset-0 w-full h-full object-contain p-4 mix-blend-multiply opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                </a>

                <!-- Hover Actions Panel -->
                <div
                    class="absolute inset-x-0 bottom-0 flex justify-center items-center translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-20 gap-1 w-full h-[55px] bg-white rounded-t-[16px] px-3 py-2.5">
                    <button
                        class="w-8 h-8 bg-[#FAF8F1] rounded-full flex items-center justify-center text-[#CBA65A] hover:bg-[#EDE5D3] shadow-sm">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    </button>
                    <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                        class="bg-[#CBA65A] text-white text-[11px] font-bold px-4 py-2 rounded-lg shadow-md hover:bg-[#b39359] transition-colors font-['Outfit'] flex-grow uppercase tracking-wider">
                        Add to Cart
                    </button>
                    <button
                        class="w-8 h-8 bg-[#FAF8F1] rounded-full flex items-center justify-center text-[#CBA65A] hover:bg-[#EDE5D3] shadow-sm">
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </button>
                </div>


                <div
                    class="absolute bottom-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm cursor-pointer lg:group-hover:opacity-0 transition-opacity">
                    <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-4 h-4 object-contain">
                </div>
            </div>

            <div class="px-1 pb-1 flex flex-col flex-grow">
                <p class="text-xs text-gray-500 font-['Outfit'] uppercase tracking-tight mb-1">
                    {{ $product->category->name ?? 'Jewellery' }}
                </p>
                <p class="text-[14px] text-gray-800 font-medium leading-tight font-['Outfit'] mb-1 line-clamp-1">
                    <a href="{{ route('product.details', $product->slug) }}"
                        title="{{ $product->name }}">{{ $product->name }}</a>
                </p>
                <div class="mt-auto flex justify-between items-center">
                    <p class="text-[16px] font-bold text-[#1A1A1A] font-['Outfit']">
                        ₹{{ number_format($product->selling_price, 2) }}</p>
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm cursor-pointer border border-gray-100 hover:bg-gray-50 wishlist-btn"
                        data-product-id="{{ $product->id }}">
                        @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                        <i class="fa-solid fa-heart text-[#CBA65A] text-lg"></i>
                        <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist"
                            class="w-4 h-4 object-contain hidden">
                        @else
                        <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist" class="w-4 h-4 object-contain">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full w-full h-[460px] flex flex-col justify-center items-center p-3 gap-3 rounded-[4px]"
            style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
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
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-12 flex justify-center pagination">
        {{ $products->links() }}
    </div>
    @endif

    <!-- Image Zoom Modal -->
    <div x-show="zoomOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[10000] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
        style="display: none;" @click="zoomOpen = false">

        <div class="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center" @click.stop>
            <button @click="zoomOpen = false"
                class="absolute -top-10 right-0 text-white hover:text-[#CBA65A] transition-colors">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
            <img :src="zoomImage" class="max-w-full max-h-[85vh] object-contain rounded-md shadow-2xl">
        </div>
    </div>
</div>