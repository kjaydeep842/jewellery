@if(isset($products) && $products->count() > 0)
    @foreach($products as $product)
        <div
            class="flex flex-col gap-3 w-[calc(50%-10px)] md:w-[calc(25%-15px)] lg:w-[calc(20%-16px)] flex-shrink-0 snap-start">
            <div
                class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden shadow-md hover:shadow-xl">
                <span
                    class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                    Seller</span>
                <div class="absolute bottom-3 left-2 z-20 flex bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors shadow-sm cursor-pointer wishlist-btn hover:bg-[#FAF8F1]"
                    data-product-id="{{ $product->id }}">
                    @if(Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id))
                        <i class="fa-solid fa-heart text-[#CBA65A] text-sm"></i>
                    @else
                        <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="Wishlist">
                    @endif
                </div>
                <a href="{{ route('product.details', $product->slug) }}"
                    class="w-full h-full flex items-center justify-center block">
                    <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : '' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                    <img src="{{ $product->images->get(1) ? asset('storage/' . $product->images->get(1)->image_path) : '' }}"
                        class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                </a>
            </div>
            <div class="text-center font-['Outfit'] px-2">
                <h3 class="text-sm md:text-base lg:text-lg font-['outfit'] text-[#1A1A1A] mb-1 truncate w-full"
                    title="{{ $product->name }}">
                    <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                </h3>
                <div class="flex flex-wrap items-center justify-center gap-2 text-xs md:text-sm lg:text-base">
                    <span class="font-bold font-['outfit'] text-[#1A1A1A] whitespace-nowrap">₹
                        {{ number_format($product->price, 2) }}</span>
                    <span class="text-[#999999] line-through whitespace-nowrap">₹
                        {{ number_format($product->price * 1.2, 2) }}</span>
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