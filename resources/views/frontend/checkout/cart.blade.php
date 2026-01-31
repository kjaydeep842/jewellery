<x-layouts.frontend>
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8 text-center">Your Shopping Bag</h1>

            @if($cartItems->isEmpty())
                <div class="text-center py-20 bg-white shadow-sm rounded-lg">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <p class="text-gray-500 text-lg mb-6">Your bag is currently empty.</p>
                    <a href="{{ route('home') }}"
                        class="inline-block bg-[#D4AF37] text-white font-bold uppercase tracking-widest py-3 px-8 hover:bg-gray-900 transition-colors">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Cart Items -->
                    <div class="flex-1">
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="p-6 space-y-6">
                                @foreach($cartItems as $item)
                                    <div
                                        class="flex flex-col sm:flex-row gap-6 border-b border-gray-100 last:border-0 pb-6 last:pb-0">
                                        <!-- Image -->
                                        <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-50 rounded-md overflow-hidden">
                                            @if($item->product->images->isNotEmpty())
                                                <img src="{{ Str::startsWith($item->product->images->first()->image_path, 'http') ? $item->product->images->first()->image_path : asset('storage/' . $item->product->images->first()->image_path) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-contain mix-blend-multiply p-2">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Details -->
                                        <div class="flex-1 flex flex-col justify-between">
                                            <div>
                                                <div class="flex justify-between items-start">
                                                    <h3 class="text-lg font-serif font-bold text-gray-900">
                                                        <a href="{{ route('product.details', $item->product->slug) }}"
                                                            class="hover:text-[#D4AF37]">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h3>
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-400 hover:text-red-500">
                                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="mt-1 text-sm text-gray-500 space-y-1">
                                                    @if($item->variant)
                                                        <p>Variant: {{ $item->variant->name }}</p>
                                                    @endif
                                                    <p class="font-bold text-[#D4AF37]">${{ number_format($item->price, 2) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-center mt-4">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                                    <div class="flex items-center border border-gray-300 rounded-sm">
                                                        <button type="button" onclick="decrement('quantity-{{ $item->id }}')"
                                                            class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                                        <input type="number" name="quantity" id="quantity-{{ $item->id }}"
                                                            value="{{ $item->quantity }}" min="1"
                                                            class="w-12 text-center border-none focus:ring-0 p-1 text-sm"
                                                            onchange="this.form.submit()">
                                                        <button type="button" onclick="increment('quantity-{{ $item->id }}')"
                                                            class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="w-full lg:w-96">
                        <div class="bg-white shadow-sm rounded-lg p-6 sticky top-24">
                            <h2 class="text-lg font-serif font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Order
                                Summary</h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span class="text-green-600">Free</span>
                                </div>
                                <div
                                    class="flex justify-between font-bold text-lg text-gray-900 pt-4 border-t border-gray-100">
                                    <span>Total</span>
                                    <span>${{ number_format($cartItems->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.address') }}"
                                class="block w-full bg-[#D4AF37] text-white text-center font-bold uppercase tracking-widest py-4 hover:bg-gray-900 transition-colors shadow-lg">
                                Proceed to Checkout
                            </a>

                            <div class="mt-6 text-center">
                                <p class="text-xs text-gray-400 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Secure Checkout
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function increment(id) {
            const input = document.getElementById(id);
            input.stepUp();
            input.dispatchEvent(new Event('change'));
        }
        function decrement(id) {
            const input = document.getElementById(id);
            input.stepDown();
            input.dispatchEvent(new Event('change'));
        }
    </script>
</x-layouts.frontend>