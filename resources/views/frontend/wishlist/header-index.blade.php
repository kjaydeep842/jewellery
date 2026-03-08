@extends('frontend.layouts.master')

@section('content')
    <!-- Main Content -->
    <main class="flex-grow w-full">
        <!-- Breadcrumbs -->
        <div class="max-w-[1920px] mx-auto px-4 md:px-[60px] min-[1400px]:px-[100px] py-4">
            <p class="text-xs text-gray-500 font-['Outfit'] mb-2">
                <a href="{{ route('home') }}" class="hover:text-gold">Home</a> / <span
                    class="text-gray-900 font-medium">Wishlist</span>
            </p>
            <p class="text-[13px] text-[#A2A2A9] font-['Outfit']">Showing : {{ $wishlists->count() }} Products</p>
        </div>

        <div class="max-w-[1920px] mx-auto px-4 md:px-[60px] min-[1400px]:px-[100px] pb-16">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 min-[1600px]:grid-cols-5 gap-4 md:gap-6 box-border"
                    x-data="{ zoomOpen: false, zoomImages: [], zoomIndex: 0 }">
                    @foreach($wishlists as $item)
                        @include('frontend.partials.wishlist-card', ['product' => $item->product, 'wishlist_item_id' => $item->id])
                    @endforeach

                    <!-- Image Zoom Modal (Shared for Grid) -->
                    @include('frontend.partials.zoom-modal')

                </div>
            @endif
        </div>
    </main>

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection