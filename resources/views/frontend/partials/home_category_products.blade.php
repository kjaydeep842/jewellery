@if(isset($products) && $products->count() > 0)
    @foreach($products as $product)
        <div class="flex flex-col gap-3">
            <div
                class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden shadow-md hover:shadow-xl">
                <span
                    class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                    Seller</span>
                <button
                    class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
                    <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
                </button>
                <div class="w-full h-full flex items-center justify-center">
                    <img src="{{ $product->images->first()->url ?? '' }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                    <img src="{{ $product->images->get(1)->url ?? '' }}"
                        class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                </div>
            </div>
            <div class="text-center font-['Outfit']">
                <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">{{ $product->name }}</h3>
                <div class="flex items-center justify-center gap-2 text-xs">
                    <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ {{ number_format($product->price, 2) }}</span>
                    <span class="text-[#999999] line-through">₹ {{ number_format($product->price * 1.2, 2) }}</span>
                </div>
            </div>
        </div>
    @endforeach
@else
    <!-- Fallback/Skeleton (optional) -->
    <div class="col-span-full text-center py-10">
        <p class="text-gray-500 font-['Outfit']">No products found in this category.</p>
    </div>
@endif