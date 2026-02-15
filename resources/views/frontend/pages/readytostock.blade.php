@extends('frontend.layouts.master')

@section('content')
    <!-- Ready to Stock Banner -->
    <section class="w-full bg-[#EFE4D6] py-8 md:py-10">
        <div class="w-full px-4 md:px-8 text-center">
            <h1 class="text-3xl md:text-5xl font-['Outfit'] font-medium text-[#5C4522] mb-4">Ready to Stock</h1>
            <p class="max-w-2xl mx-auto text-sm md:text-base text-gray-700 font-['Inter'] leading-relaxed">
                Discover our collection of ready-to-ship jewellery, crafted with precision and available for immediate
                delivery.
            </p>
        </div>
    </section>

    <!-- Main Content : All Collection -->
    <main class="w-full px-4 md:px-6 py-8 font-['Outfit'] flex flex-col gap-2.5">

        <!-- Breadcrumb & Title -->
        <div class="w-full flex flex-col gap-1 self-start">
            <div class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-amber-600 cursor-pointer">Home</a> / <span
                    class="text-gray-800 font-medium">Ready to Stock</span>
            </div>
            <div class="text-sm text-gray-500 mt-2">
                Showing : {{ $products->total() }} Products
            </div>
        </div>

        <!-- Layout: Sidebar + Grid -->
        <div class="w-full flex flex-col lg:flex-row gap-8 mt-4 relative">

            <!-- Mobile Filter Button & Sort (Combined Row) -->
            <div class="flex flex-row justify-between items-center mb-4 relative z-30 gap-2 lg:hidden">
                <!-- Filter Button (Visible < lg) -->
                <button id="mobile-filter-btn"
                    class="flex items-center gap-2 text-gray-800 font-medium border border-gray-300 px-4 py-2.5 rounded-md hover:bg-gray-50 transition-colors whitespace-nowrap">
                    <i class="fa-solid fa-sliders text-gray-600"></i> Filters
                </button>

                <!-- Sort ByDropdown (Mobile) -->
                @include('frontend.partials.sort-dropdown')
            </div>

            <!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
            @include('frontend.partials.filter-sidebar', ['route' => 'page.readytostock'])

            <!-- Products Grid -->
            <div class="flex-grow">
                <!-- Sort By (Desktop Only) -->
                <div class="hidden lg:flex justify-end mb-6 relative z-30">
                    @include('frontend.partials.sort-dropdown')
                </div>

                <!-- Grid Container -->
                <div id="products-container">

                    <!-- Grid Container -->
                    <div id="products-container">
                        @include('frontend.pages.partials.readytostock-grid')
                    </div>
                </div>

            </div>
    </main>

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>



@endsection