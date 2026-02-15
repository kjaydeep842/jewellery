<div class="flex flex-col gap-6" x-data="{ zoomOpen: false, zoomImage: '' }">
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