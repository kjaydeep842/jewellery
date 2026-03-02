<div class="contents" x-data="{ zoomOpen: false, zoomImages: [], zoomIndex: 0 }">
    <div id="product-count-data" data-total="{{ $products->total() }}" class="hidden"></div>
    @forelse($products as $product)
        @include('frontend.partials.product-card', ['product' => $product])
    @empty
        <div class="col-span-full w-full h-[460px] flex flex-col justify-center items-center p-3 gap-3 rounded-[4px]"
            style="grid-column: 1 / -1; background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
            <div class="mb-4 relative w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="No Products Found"
                    class="w-full h-full object-contain">
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-1">No Products Found</h3>
                <p class="text-sm text-gray-500">We couldn't find any products matching your search.</p>
            </div>
        </div>
    @endforelse

    @if($products->hasPages())
        <div class="col-span-full mt-8 flex justify-center pagination" style="grid-column: 1 / -1;">
            {{ $products->links() }}
        </div>
    @endif

    @include('frontend.partials.zoom-modal')
</div>