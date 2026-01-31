<x-layouts.frontend>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ 
        selectedImage: '{{ $product->images->isNotEmpty() ? (Str::startsWith($product->images->first()->image_path, 'http') ? $product->images->first()->image_path : asset('storage/' . $product->images->first()->image_path)) : '' }}',
        price: '{{ $product->base_price }}',
        selectedVariant: null,
        qty: 1
    }">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16">
            <!-- Left: Gallery -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="aspect-square bg-gray-50 overflow-hidden relative border border-gray-100 shadow-sm w-full">
                    @if($product->images->isNotEmpty())
                        <img :src="selectedImage" alt="{{ $product->name }}"
                            class="w-full h-full object-contain mix-blend-multiply">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-2"> <!-- Tighter gap -->
                        @foreach($product->images as $image)
                            @php
                                $imgSrc = Str::startsWith($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path);
                            @endphp
                            <button @click="selectedImage = '{{ $imgSrc }}'"
                                class="aspect-square bg-gray-50 border border-gray-200 overflow-hidden hover:border-[#D4AF37] transition-colors focus:outline-none ring-offset-1 focus:ring-1 focus:ring-[#D4AF37]"
                                :class="selectedImage === '{{ $imgSrc }}' ? 'border-[#D4AF37]' : ''">
                                <img src="{{ $imgSrc }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain mix-blend-multiply">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Product Info -->
            <div class="space-y-6"> <!-- Reduced vertical spacing -->
                <div>
                    <nav class="flex text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li><a href="{{ route('home') }}" class="hover:text-[#D4AF37]">Home</a></li>
                            <li>/</li>
                            <li><a href="#" class="hover:text-[#D4AF37]">{{ $product->category->name }}</a></li>
                            @if($product->subcategory)
                                <li>/</li>
                                <li><a href="#" class="hover:text-[#D4AF37]">{{ $product->subcategory->name }}</a></li>
                            @endif
                        </ol>
                    </nav>

                    <h1 class="font-serif text-3xl font-bold text-gray-900 leading-tight">{{ $product->name }}</h1>
                    <div class="mt-2 flex items-center justify-between">
                        <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>

                        <!-- Review Stars Placeholder -->
                        <div class="flex items-center">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="text-xs text-gray-500 ml-1">(2 Reviews)</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-b border-gray-100 py-4"> <!-- Reduced padding -->
                    <p class="text-3xl font-bold text-gray-900">$<span x-text="price"></span></p>
                    <p class="text-sm text-gray-500 mt-1">Includes all taxes and duties</p>
                </div>

                <!-- Short Description -->
                <div class="prose prose-sm text-gray-600">
                    <p>{{ Str::limit(strip_tags($product->description), 150) }}</p>
                </div>

                <!-- Variants Logic -->
                @if($product->variants->isNotEmpty())
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-900 uppercase tracking-wide">Size / Option</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->variants as $variant)
                                <button @click="selectedVariant = {{ $variant->id }}; price = '{{ $variant->price }}'"
                                    class="border border-gray-200 px-4 py-2 text-sm text-gray-700 hover:border-[#D4AF37] hover:text-[#D4AF37] transition-all bg-white min-w-[3rem]"
                                    :class="selectedVariant === {{ $variant->id }} ? 'border-[#D4AF37] bg-gray-50 text-[#D4AF37] font-bold ring-1 ring-[#D4AF37]' : ''">
                                    {{ $variant->attribute_value }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center space-x-4 pt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" :value="selectedVariant">

                    <div class="w-32 flex-shrink-0"> <!-- Fixed width for qty -->
                        <label class="sr-only">Quantity</label>
                        <div class="flex items-center border border-gray-300">
                            <button type="button" @click="qty > 1 ? qty-- : null"
                                class="px-3 py-3 text-gray-600 hover:bg-gray-100 focus:outline-none">-</button>
                            <input type="number" name="quantity" x-model="qty"
                                class="w-full text-center border-none p-0 focus:ring-0 text-gray-900 font-bold h-full appearance-none"
                                readonly>
                            <button type="button" @click="qty++"
                                class="px-3 py-3 text-gray-600 hover:bg-gray-100 focus:outline-none">+</button>
                        </div>
                    </div>

                    <button type="submit"
                        class="flex-1 bg-[#D4AF37] text-black font-bold uppercase tracking-widest py-3 px-6 hover:bg-black hover:text-white transition-all duration-300 whitespace-nowrap">
                        Add to Cart
                    </button>

                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="border border-gray-300 p-3 hover:border-[#D4AF37] hover:text-[#D4AF37] transition-colors flex-shrink-0 {{ Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id) ? 'bg-[#D4AF37] text-white border-[#D4AF37]' : '' }}">
                            <svg class="w-6 h-6"
                                fill="{{ Auth::check() && Auth::user()->wishlists->contains('product_id', $product->id) ? 'currentColor' : 'none' }}"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </form>
                </form>

                <!-- Trust Badges Small -->
                <div class="grid grid-cols-2 gap-4 text-xs text-gray-500 pt-4 border-t border-gray-50 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Secure Checkout</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <span>Free Shipping</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Tabs / Sections -->
        <div class="mt-20 border-t border-gray-200 pt-10" x-data="{ tab: 'desc' }">
            <div class="flex justify-center space-x-8 mb-10 border-b border-gray-200 pb-1">
                <button @click="tab = 'desc'"
                    :class="tab === 'desc' ? 'border-b-2 border-[#D4AF37] text-gray-900' : 'text-gray-500 hover:text-gray-900'"
                    class="pb-4 font-bold uppercase tracking-widest text-sm transition-all focus:outline-none">Description</button>
                <button @click="tab = 'specs'"
                    :class="tab === 'specs' ? 'border-b-2 border-[#D4AF37] text-gray-900' : 'text-gray-500 hover:text-gray-900'"
                    class="pb-4 font-bold uppercase tracking-widest text-sm transition-all focus:outline-none">Specifications</button>
                <button @click="tab = 'reviews'"
                    :class="tab === 'reviews' ? 'border-b-2 border-[#D4AF37] text-gray-900' : 'text-gray-500 hover:text-gray-900'"
                    class="pb-4 font-bold uppercase tracking-widest text-sm transition-all focus:outline-none">Reviews
                    ({{ $product->reviews->count() }})</button>
            </div>

            <!-- Description Tab -->
            <div x-show="tab === 'desc'" class="max-w-3xl mx-auto prose prose-gray">
                {!! $product->description !!}
            </div>

            <!-- Specs Tab -->
            <div x-show="tab === 'specs'" class="max-w-3xl mx-auto" x-cloak>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div class="flex justify-between border-b border-gray-100 py-2">
                        <span class="text-gray-500">Metal</span>
                        <span class="font-medium text-gray-900">{{ $product->metal_type ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 py-2">
                        <span class="text-gray-500">Purity</span>
                        <span class="font-medium text-gray-900">{{ $product->metal_purity ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 py-2">
                        <span class="text-gray-500">Gender</span>
                        <span class="font-medium text-gray-900">{{ $product->gender ?? 'Unisex' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 py-2">
                        <span class="text-gray-500">Occasion</span>
                        <span class="font-medium text-gray-900">{{ $product->occasion ?? 'Any' }}</span>
                    </div>
                </div>

                @if($product->stones->isNotEmpty())
                    <h3 class="font-serif text-xl font-bold mt-8 mb-4">Stone Details</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 font-medium uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3">Shape</th>
                                    <th class="px-4 py-3">Color/Clarity</th>
                                    <th class="px-4 py-3">Weight (ct)</th>
                                    <th class="px-4 py-3">Setting</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($product->stones as $stone)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $stone->stone_type }}</td>
                                        <td class="px-4 py-3">{{ $stone->shape }}</td>
                                        <td class="px-4 py-3">{{ $stone->color }}-{{ $stone->clarity }}</td>
                                        <td class="px-4 py-3">{{ $stone->carat_weight }}</td>
                                        <td class="px-4 py-3">{{ $stone->setting_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Reviews Tab -->
            <div x-show="tab === 'reviews'" class="max-w-3xl mx-auto" x-cloak>
                @if($product->reviews->isEmpty())
                    <p class="text-center text-gray-500 italic">No reviews yet. Be the first to review this product!</p>
                @else
                    <div class="space-y-8">
                        @foreach($product->reviews as $review)
                            <div class="border-b border-gray-100 pb-8 last:border-0">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-bold text-gray-900">{{ $review->user->name ?? 'Guest' }}</h4>
                                    <span class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 {{ $i < $review->rating ? 'text-[#D4AF37]' : 'text-gray-200' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <h5 class="font-bold text-sm text-gray-800 mb-1">{{ $review->title }}</h5>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $review->review }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
            <div class="mt-20 border-t border-gray-200 pt-16">
                <div class="text-center mb-12">
                    <h2 class="font-serif text-3xl font-bold text-gray-900 mb-2">You May Also Like</h2>
                    <div class="w-16 h-1 bg-[#D4AF37] mx-auto"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $related)
                        <!-- Simple Card Reuse -->
                        <div class="group bg-white border border-gray-100 p-4 hover:shadow-xl transition-shadow duration-300">
                            <div class="relative overflow-hidden aspect-square bg-gray-100 mb-4">
                                @if($related->images->isNotEmpty())
                                    <img src="{{ Str::startsWith($related->images->first()->image_path, 'http') ? $related->images->first()->image_path : asset('storage/' . $related->images->first()->image_path) }}"
                                        alt="{{ $related->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <h3
                                class="font-serif font-bold text-gray-900 group-hover:text-[#D4AF37] transition-colors truncate text-center">
                                <a href="{{ route('product.details', $related->slug) }}">{{ $related->name }}</a>
                            </h3>
                            <p class="text-center text-gray-900 font-bold mt-1">${{ number_format($related->base_price, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</x-layouts.frontend>