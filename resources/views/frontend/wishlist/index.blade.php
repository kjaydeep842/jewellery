<x-layouts.frontend>
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8 text-center">My Wishlist</h1>

            @if($wishlists->isEmpty())
                <div class="text-center py-20 bg-white shadow-sm rounded-lg">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <p class="text-gray-500 text-lg mb-6">Your wishlist is currently empty.</p>
                    <a href="{{ route('home') }}"
                        class="inline-block bg-[#D4AF37] text-white font-bold uppercase tracking-widest py-3 px-8 hover:bg-gray-900 transition-colors">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($wishlists as $item)
                        <div
                            class="bg-white border border-gray-100 p-4 hover:shadow-xl transition-shadow duration-300 relative group">
                            <!-- Image -->
                            <div class="relative overflow-hidden aspect-square bg-gray-50 mb-4">
                                @if($item->product->images->isNotEmpty())
                                    <img src="{{ Str::startsWith($item->product->images->first()->image_path, 'http') ? $item->product->images->first()->image_path : asset('storage/' . $item->product->images->first()->image_path) }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                @endif

                                <!-- Delete Button -->
                                <div class="absolute top-2 right-2">
                                    <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-white p-2 rounded-full shadow hover:bg-red-50 hover:text-red-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Details -->
                            <h3
                                class="font-serif font-bold text-gray-900 group-hover:text-[#D4AF37] transition-colors truncate text-center">
                                <a href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->name }}</a>
                            </h3>
                            <p class="text-center text-gray-900 font-bold mt-1">
                                ${{ number_format($item->product->sale_price ?? $item->product->price, 2) }}</p>

                            <!-- Add to Cart -->
                            <div class="mt-4">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="w-full bg-gray-900 text-white text-xs font-bold uppercase tracking-widest py-3 hover:bg-[#D4AF37] transition-colors">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.frontend>