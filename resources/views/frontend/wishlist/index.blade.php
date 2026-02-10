@extends('frontend.layouts.master')


@section('content')
    <!-- Main Content -->
    <main class="flex-grow w-full">
        <!-- Breadcrumbs -->
        <div class="max-w-[1600px] mx-auto px-6 py-4">
            <p class="text-xs text-gray-500 font-['Outfit'] mb-2">
                <a href="{{ route('home') }}">Home</a> / <span class="text-gray-900 font-medium">
                    @if($wishlists->isEmpty())
                        Discover our Collection
                    @else
                        Wishlist
                    @endif
                </span>
            </p>
            <p class="text-xs text-gray-400 font-['Outfit']">Showing : {{ $wishlists->count() }} Products</p>
        </div>

        @if($wishlists->isEmpty())
            <!-- Empty State Section -->
            <div class="bg-[#F3EFE6] w-full min-h-[624px] flex flex-col items-center justify-center gap-6">

                <!-- Icon -->
                <div class="relative">
                    <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="Empty Wishlist Icon"
                        class="object-contain h-[80px] w-auto">
                </div>

                <!-- Text Frame 2147238770 -->
                <div
                    style="display: flex; flex-direction: column; align-items: center; padding: 0px; gap: 6px; width: 100%; max-width: 1350px; height: auto;">
                    <h2 class="text-[28px] font-['Alexandria'] font-semibold leading-tight m-0 text-[#1A1A1A]">Your Wishlist
                        Is Empty</h2>
                    <p class="text-base text-[#6E6E77] text-center font-['outfit'] leading-relaxed m-0">
                        Add items that you like to your wishlist. <br>
                        Review them anytime and easily move them to the bag.
                    </p>
                </div>

                <!-- Button Frame 2147238958 -->
                <a href="{{ route('home') }}"
                    style="display: flex; flex-direction: row; justify-content: center; align-items: center; padding: 16px 42px; gap: 10px; width: 245px; height: 62px; background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%); border-radius: 100px;"
                    class="text-white font-['Outfit'] font-medium text-lg hover:opacity-90 transition-opacity no-underline shadow-sm">
                    Start Shopping
                </a>
            </div>
        @else
            <!-- Wishlist Grid Section -->
            <div class="max-w-[1600px] mx-auto px-6 pb-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">

                    @foreach($wishlists as $item)
                        <!-- Card -->
                        <div
                            class="bg-[#FAF8F1] border border-[#E8E1D5] hover:shadow-lg transition-shadow rounded-sm overflow-hidden p-2 relative group">
                            <div
                                class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-sm overflow-hidden bg-white">

                                <!-- Remove from Wishlist -->
                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST"
                                    class="absolute top-2 right-2 z-10">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-md text-gray-400 hover:text-red-500 transition-colors duration-300">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </button>
                                </form>

                                <div
                                    class="absolute top-2 right-1 z-10 w-[80px] h-[28px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-end px-[8px] py-[4px] gap-[10px] text-white text-[13px] font-medium font-['Outfit'] opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-sm transition-delay-75 hidden">
                                    Best Seller
                                </div>

                                @if($item->product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300 group-hover:opacity-0">
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                        alt="{{ $item->product->name }} Hover"
                                        class="absolute inset-0 w-full h-full object-contain mix-blend-multiply opacity-0 transition-opacity duration-300 group-hover:opacity-100 scale-105">
                                @else
                                    <img src="{{ asset('assets/ring.png') }}" alt="{{ $item->product->name }}"
                                        class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300 group-hover:opacity-0">
                                @endif

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-x-0 bottom-0 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity z-20 gap-3 w-full h-[50px] bg-white rounded-t-[20px] px-4">
                                    <button
                                        class="w-9 h-9 bg-[#F3EFE6] rounded-full flex items-center justify-center text-[#8B6A45] hover:bg-[#E6DCC6] transition-colors text-sm shadow-sm">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>

                                    <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="bg-[#CBA65A] text-white text-[15px] font-medium w-full h-[32px] rounded-sm shadow-sm hover:bg-[#B39359] transition-colors font-['Outfit']">
                                            Add to Cart
                                        </button>
                                    </form>

                                    <button
                                        class="w-9 h-9 bg-[#F3EFE6] rounded-full flex items-center justify-center text-[#8B6A45] hover:bg-[#E6DCC6] transition-colors text-sm shadow-sm">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <a href="{{ route('product.details', $item->product->slug) }}">
                                    <p
                                        class="text-sm text-gray-800 font-medium leading-tight font-['Outfit'] hover:text-[#B39359] line-clamp-2 min-h-[40px]">
                                        {{ $item->product->name }}
                                    </p>
                                </a>
                                <p class="text-base font-bold text-[#1A1A1A] font-['Outfit']">
                                    @if($item->product->category && $item->product->category->name == 'Diamond')
                                        ₹{{ number_format($item->product->price * 84, 2) }}
                                    @else
                                        ₹{{ number_format($item->product->sale_price ?? $item->product->price, 2) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif
    </main>

    <!-- Know More Section -->
    <div class="w-full bg-[#E9D3D6] py-3 flex items-center justify-center">
        <span class="text-[#0D0D0E] font-['Outfit'] text-[15px] font-medium">Know More About Tattsvi</span>
    </div>
@endsection