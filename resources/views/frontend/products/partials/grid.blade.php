<div id="product-count-data" data-total="{{ $products->total() }}" class="hidden"></div>
<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImages: [], zoomIndex: 0 }">
    <!-- Grid Container -->
    <div id="products-grid" class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6 px-0">
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