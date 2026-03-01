<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImages: [], zoomIndex: 0 }">
    <!-- Grid Container -->
    <div id="products-grid"
        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 min-[1800px]:grid-cols-7 min-[2200px]:grid-cols-8 gap-3 md:gap-4 px-0">
        @forelse ($products as $product)
            @include('frontend.partials.product-card', ['product' => $product])
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

    @include('frontend.partials.zoom-modal')
</div>