<div id="product-count-data" data-total="{{ $products->total() }}" class="hidden"></div>
<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImage: '' }">
    <!-- Grid Container -->
    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-0">
        @forelse ($products as $product)
            <div x-data="{
                                                activeImage: 0,
                                                images: [
                                                    '{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : asset('assets/ring.png') }}',
                                                    @foreach($product->images->skip(1) as $image)
                                                        '{{ asset('storage/' . $image->image_path) }}',
                                                    @endforeach
                                                ]
                                            }"
                class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-shadow rounded-sm overflow-hidden p-2 relative group flex flex-col h-full">

                <!-- Image Area -->
                <div
                    class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden bg-white/50 group/image">
                    @if($product->is_bestseller)
                        <div
                            class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[12px] pl-3 pr-2 py-1 rounded-l-full font-['Alexandria'] font-normal tracking-wide">
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
                            class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-1 opacity-0 group-hover/image:opacity-100 transition-opacity pointer-events-none z-10">
                            <button
                                @click.prevent.stop="activeImage = activeImage === 0 ? images.length - 1 : activeImage - 1"
                                class="w-7 h-7 bg-white/90 hover:bg-white rounded-full flex items-center justify-center text-gray-500 shadow-sm cursor-pointer pointer-events-auto transition-colors border border-gray-100">
                                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                            </button>
                            <button
                                @click.prevent.stop="activeImage = activeImage === images.length - 1 ? 0 : activeImage + 1"
                                class="w-7 h-7 bg-white/90 hover:bg-white rounded-full flex items-center justify-center text-gray-500 shadow-sm cursor-pointer pointer-events-auto transition-colors border border-gray-100">
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>
                    </template>

                    <!-- Action Bar (Replaces old strip and static buttons) -->
                    <div class="absolute bottom-3 inset-x-3 flex items-center justify-between gap-2 z-20">
                        <!-- Wishlist Button -->
                        <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors wishlist-btn"
                            data-product-id="{{ $product->id }}">
                            @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                                <i class="fa-solid fa-heart text-[#CBA65A] text-sm"></i>
                            @else
                                <img src="{{ asset('assets/ic_wishlist1.png') }}" alt="wishlist" class="w-4 h-4 object-contain">
                            @endif
                        </div>

                        <!-- Add to Cart (Visible on Hover) -->
                        <button onclick="window.location.href='{{ route('product.details', $product->slug) }}'"
                            class="flex-grow h-9 text-white text-xs shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 font-['Outfit'] whitespace-nowrap"
                            style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%), #D5D9E2; border-radius: 6px;">
                            Add to Cart
                        </button>

                        <!-- Expand Button -->
                        <div @click.prevent.stop="zoomImage = images[activeImage]; zoomOpen = true"
                            class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer hover:bg-gray-50 transition-colors">
                            <img src="{{ asset('assets/maximize.png') }}" alt="expand" class="w-4 h-4 object-contain">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-1 flex flex-col flex-grow pt-1">
                    <p
                        class="text-sm text-gray-800 font-medium leading-tight font-['Outfit'] line-clamp-2 min-h-[2.5rem] mb-0.5">
                        <a href="{{ route('product.details', $product->slug) }}"
                            title="{{ $product->name }}">{{ $product->name }}</a>
                    </p>
                    <div class="mt-auto">
                        <p class="text-base font-bold text-[#1A1A1A] font-['Outfit']">
                            ₹{{ number_format($product->selling_price, 2) }}
                        </p>

                        <!-- Color Swatches -->
                        <div class="flex items-center gap-2 mt-2">
                            <div class="w-4 h-4 rounded-full bg-[#E5C365] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                                title="Yellow Gold"></div>
                            <div class="w-4 h-4 rounded-full bg-[#D4D4D4] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                                title="White Gold"></div>
                            <div class="w-4 h-4 rounded-full bg-[#E0A499] border border-gray-300 cursor-pointer hover:ring-1 hover:ring-offset-1 hover:ring-gray-400"
                                title="Rose Gold"></div>
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