<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImage: '' }">
    <!-- Grid Container -->
    <div id="products-grid"
        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 min-[1800px]:grid-cols-7 min-[2200px]:grid-cols-8 gap-3 md:gap-4 px-0">
        @forelse ($products as $product)
            <!-- Card -->
            <div x-data="{
                                    activeImage: 0,
                                    images: [
                                        '{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : asset('assets/ring.png') }}',
                                        @foreach($product->images->skip(1) as $image)
                                            '{{ asset('storage/' . $image->image_path) }}',
                                        @endforeach
                                    ]
                                }"
                class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-all rounded-sm overflow-hidden p-2 relative group flex flex-col h-full">

                <!-- Image Area -->
                <div
                    class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden bg-white/50 group/image">
                    @if($product->is_bestseller)
                        <div
                            class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[10px] pl-3 pr-2 py-1 rounded-l-full font-medium font-['Outfit']">
                            Best Seller
                        </div>
                    @endif

                    <!-- Image with Link -->
                    <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-4"
                        title="{{ $product->name }}">
                        <!-- Alpine Image Binding -->
                        <img :src="images[activeImage]" alt="{{ $product->name }}"
                            class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
                    </a>

                    <!-- Slider Arrows (Visible on Hover if multiple images) -->
                    <template x-if="images.length > 1">
                        <div
                            class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-1 opacity-0 group-hover/image:opacity-100 transition-opacity pointer-events-none">
                            <button
                                @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                                class="w-6 h-6 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-[#CBA65A] shadow-sm cursor-pointer pointer-events-auto transition-colors">
                                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                            </button>
                            <button
                                @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                                class="w-6 h-6 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-[#CBA65A] shadow-sm cursor-pointer pointer-events-auto transition-colors">
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>
                    </template>

                    <!-- Actions Overlay (Bottom) -->
                    <div
                        class="absolute bottom-2 w-[95%] left-1/2 -translate-x-1/2 flex justify-between items-center px-1 z-20">

                        <!-- Wishlist -->
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer border border-[#E8E1D5] hover:bg-[#FAF8F1] wishlist-btn transition-colors"
                            data-product-id="{{ $product->id }}">
                            @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                                <i class="fa-solid fa-heart text-[#CBA65A] text-xs"></i>
                            @else
                                <i class="fa-regular fa-heart text-[#CBA65A] text-xs"></i>
                            @endif
                        </div>

                        <!-- Add to Cart (Center) -->
                        <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                            class="bg-[#CBA65A] text-white text-[10px] font-bold px-3 h-8 rounded-full shadow-md hover:bg-[#b39359] transition-colors font-['Outfit'] uppercase tracking-wider whitespace-nowrap flex-grow mx-1">
                            Add to Cart
                        </button>

                        <!-- Expand / Zoom -->
                        <button @click.prevent.stop="zoomImage = images[activeImage]; zoomOpen = true"
                            class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer border border-[#E8E1D5] hover:bg-[#FAF8F1] transition-colors">
                            <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-3 h-3 object-contain">
                        </button>

                    </div>
                </div>

                <!-- Content -->
                <div class="px-1 pb-1 flex flex-col flex-grow">
                    <p class="text-[10px] text-gray-500 font-['Outfit'] uppercase tracking-tight mb-0.5">
                        {{ $product->category->name ?? 'Jewellery' }}
                    </p>
                    <p class="text-[13px] text-gray-800 font-medium leading-tight font-['Outfit'] mb-1 line-clamp-1">
                        <a href="{{ route('product.details', $product->slug) }}"
                            title="{{ $product->name }}">{{ $product->name }}</a>
                    </p>
                    <div class="mt-auto flex justify-between items-end">
                        <div class="flex flex-col">
                            <p class="text-[15px] font-bold text-[#1A1A1A] font-['Outfit']">
                                ₹{{ number_format($product->selling_price, 2) }}
                            </p>

                            <!-- Color Swatches -->
                            <div class="flex gap-1.5 mt-2">
                                <div class="w-2.5 h-2.5 rounded-full bg-[#E6C200] border border-gray-200 shadow-sm cursor-pointer hover:scale-110 transition-transform"
                                    title="Yellow Gold"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-[#E0E0E0] border border-gray-200 shadow-sm cursor-pointer hover:scale-110 transition-transform"
                                    title="White Gold"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-[#E0BFB8] border border-gray-200 shadow-sm cursor-pointer hover:scale-110 transition-transform"
                                    title="Rose Gold"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                @include('frontend.partials.no-products')
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