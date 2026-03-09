@extends('frontend.layouts.master')

@section('content')
    <style>
        /* Custom Scrollbar for right-side content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
    <main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
        <div
            class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

            <!-- Sidebar -->
            @include('frontend.profile.partials.sidebar')

            <!-- Main Content -->
            <div class="flex-grow flex flex-col h-[calc(100vh-150px)] overflow-y-auto pr-1 md:pr-4 custom-scrollbar">
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
                            <p class="text-[13px] text-[#A2A2A9] font-['Outfit']">Showing : {{ $wishlists->count() }} Products
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 min-[1600px]:grid-cols-4 gap-4 md:gap-6"
                            x-data="{ zoomOpen: false, zoomImages: [], zoomIndex: 0 }">
                            @foreach($wishlists as $item)
                                @include('frontend.partials.wishlist-card', ['product' => $item->product, 'wishlist_item_id' => $item->id])
                            @endforeach

                            @include('frontend.partials.zoom-modal')
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