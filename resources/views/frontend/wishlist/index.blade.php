@extends('frontend.layouts.master')


@section('content')
<main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
    <div
        class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

        <!-- Sidebar -->
        @include('frontend.profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-grow min-h-[600px] flex flex-col">
            @if($wishlists->isEmpty())
            <!-- Empty State Section -->
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
            <!-- Wishlist Content -->
            <div class="p-4 md:p-10 bg-white rounded-[10px] shadow-sm flex-grow">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl min-[2000px]:text-3xl">My Wishlist
                    </h2>
                    <p class="text-sm text-gray-400 font-['Outfit']">Showing : {{ $wishlists->count() }} Products</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlists as $item)
                    <!-- Product Card -->
                    <div
                        class="bg-white border border-gray-100 hover:shadow-md transition-shadow rounded-xl overflow-hidden p-3 relative group">
                        <div
                            class="w-full aspect-square flex items-center justify-center mb-3 relative rounded-lg overflow-hidden bg-[#FDFBF7]">
                            <!-- Remove from Wishlist -->
                            <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST"
                                class="absolute top-2 right-2 z-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fa-solid fa-xmark text-xs"></i>
                                </button>
                            </form>

                            @if($item->product->images->count() > 0)
                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                alt="{{ $item->product->name }}"
                                class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
                            @else
                            <img src="{{ asset('assets/ring.png') }}" alt="{{ $item->product->name }}"
                                class="w-full h-full object-contain mix-blend-multiply transition-opacity duration-300">
                            @endif

                            <!-- Hover Action: Add to Cart -->
                            <div
                                class="absolute inset-x-0 bottom-0 p-3 translate-y-full group-hover:translate-y-0 transition-transform bg-white/90 backdrop-blur-sm">
                                <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="bg-[#CBA65A] text-white text-sm font-medium w-full h-10 rounded-full shadow-sm hover:bg-[#B39359] transition-colors font-['Outfit']">
                                        Add to Bag
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="space-y-1 mt-1">
                            <a href="{{ route('product.details', $item->product->slug) }}">
                                <p
                                    class="text-sm text-gray-800 font-medium leading-tight font-['Outfit'] hover:text-[#B39359] line-clamp-2">
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
        </div>
    </div>
</main>

<!-- Know More Section -->
<div class="w-full bg-[#E9D3D6] py-4 flex items-center justify-center">
    <span class="text-[#0D0D0E] font-['Outfit'] text-base font-medium">Know More About Tattsvi</span>
</div>
@endsection