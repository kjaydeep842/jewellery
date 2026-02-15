@extends('frontend.layouts.master')

@section('content')
    <!-- Main Content -->
    <main class="flex-grow w-full">
        <!-- Breadcrumbs -->
        <div class="max-w-[1600px] mx-auto px-6 py-4">
            <p class="text-xs text-gray-500 font-['Outfit'] mb-2">
                <a href="{{ route('home') }}" class="hover:text-gold">Home</a> / <span
                    class="text-gray-900 font-medium">Wishlist</span>
            </p>
            <p class="text-xs text-gray-400 font-['Outfit']">Showing : {{ $wishlists->count() }} Products</p>
        </div>

        <div class="max-w-[1600px] mx-auto px-6 pb-16">
            @if($wishlists->isEmpty())
                <div class="flex-grow flex flex-col items-center justify-center p-[40px] gap-6 rounded-[10px]"
                    style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
                    <div class="relative">
                        <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="Empty Wishlist Icon"
                            class="object-contain h-[80px] w-auto opacity-80">
                    </div>
                    <div class="text-center space-y-2">
                        <h2 class="text-2xl font-['Outfit'] font-bold text-[#1A1A1A]">Your Wishlist Is Empty</h2>
                        <p class="text-base text-[#6E6E77] max-w-md mx-auto font-['Outfit']">
                            Add items that you like to your wishlist. Review them anytime and easily move them to the bag.
                        </p>
                    </div>
                    <a href="{{ route('home') }}" style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);"
                        class="px-10 py-4 rounded-full text-white font-['Outfit'] font-medium text-lg shadow-md hover:opacity-90 transition-all">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 min-[1800px]:grid-cols-7 min-[2200px]:grid-cols-8 gap-3 md:gap-4 box-border"
                    x-data="{ zoomOpen: false, zoomImage: '' }">
                    @foreach($wishlists as $item)
                        @php $product = $item->product; @endphp
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
                            class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-all rounded-sm overflow-hidden p-2 relative group flex flex-col h-full box-border">

                            <!-- Image Area -->
                            <div
                                class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden bg-white/50 group/image">

                                <!-- Best Seller Badge -->
                                @if($product->is_bestseller)
                                    <div
                                        class="absolute top-2 right-0 z-10 bg-[#BC511B] text-white text-[10px] pl-3 pr-2 py-1 rounded-l-full font-medium font-['Outfit']">
                                        Best Seller
                                    </div>
                                @endif

                                <!-- Remove (X) Button - Explicit Option at Top Left to avoid badge conflict -->
                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST"
                                    class="absolute top-2 left-2 z-20">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-6 h-6 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow-sm text-gray-400 hover:text-red-500 transition-colors backdrop-blur-sm">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </button>
                                </form>

                                <!-- Image with Link -->
                                <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full relative p-4"
                                    title="{{ $product->name }}">
                                    <!-- Alpine Image Binding -->
                                    <img :src="images[activeImage]" alt="{{ $product->name }}"
                                        class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
                                </a>

                                <!-- Slider Arrows -->
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
                                    class="absolute bottom-2 w-[95%] left-1/2 -translate-x-1/2 flex justify-between items-center px-1 z-20 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300">

                                    <!-- Wishlist (Remove) -->
                                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md cursor-pointer border border-[#E8E1D5] hover:bg-[#FAF8F1] transition-colors"
                                            title="Remove from Wishlist">
                                            <i class="fa-solid fa-heart text-[#CBA65A] text-xs"></i>
                                        </button>
                                    </form>

                                    <!-- Add to Cart (Center) -->
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex-grow mx-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="bg-[#CBA65A] text-white text-[10px] font-bold w-full h-8 rounded-full shadow-md hover:bg-[#b39359] transition-colors font-['Outfit'] uppercase tracking-wider whitespace-nowrap">
                                            Add to Cart
                                        </button>
                                    </form>

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
                                    <p class="text-[15px] font-bold text-[#1A1A1A] font-['Outfit']">
                                        ₹{{ number_format($product->selling_price, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Image Zoom Modal (Shared for Grid) -->
                    <div x-show="zoomOpen"
                        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">

                        <div class="relative w-full h-full flex items-center justify-center p-4" @click.away="zoomOpen = false">
                            <!-- Close Button -->
                            <button @click="zoomOpen = false"
                                class="absolute top-6 right-6 text-white hover:text-[#CBA65A] transition-colors z-50">
                                <i class="fa-solid fa-xmark text-4xl"></i>
                            </button>

                            <!-- Image Container -->
                            <div class="relative max-w-[90vw] max-h-[90vh]">
                                <img :src="zoomImage" alt="Zoomed Product"
                                    class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl">
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </main>

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection