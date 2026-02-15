@php
    $route = $route ?? 'page.new-arrivals';
@endphp


<!-- Filter Sidebar (Desktop: Static | Mobile: Off-Canvas) -->
<div id="filter-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity opacity-0"
    onclick="closeFilter()"></div>

<aside id="filter-sidebar"
    class="fixed inset-y-0 left-0 w-[85%] max-w-[320px] bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:static lg:transform-none lg:w-[280px] lg:block flex-shrink-0 shadow-2xl lg:shadow-none h-full lg:h-auto overflow-y-auto lg:overflow-visible">
    <!-- Header -->
    <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-cream lg:hidden">
        <div class="flex items-center gap-2">
            <span class="serif text-xl tracking-tighter">Filters</span>
        </div>
        <button id="close-filter-btn" onclick="closeFilter()"
            class="w-8 h-8 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-red-500 shadow-sm transition-colors">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    <div class="p-5 lg:p-0">
        <!-- Desktop Header -->
        <div class="hidden lg:flex items-center justify-between mb-4 font-medium text-lg">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-sliders text-gray-600"></i> Filters
            </div>
            <a href="{{ route($route) }}" class="text-xs text-amber-600 hover:underline">Clear All</a>
        </div>

        <form id="filterForm" action="{{ route($route) }}" method="GET" onsubmit="event.preventDefault(); window.updateProducts();">
            <!-- Preserve Sort -->
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <!-- Mobile "Clear All" (Visible < lg) -->
            <div class="lg:hidden flex justify-end mb-4">
                <a href="{{ route($route) }}" class="text-sm font-medium text-amber-600 hover:underline">Clear All</a>
            </div>

            <!-- Filter Item: Category -->
            @if(count($categories) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Category</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group py-1">
                                <input type="checkbox" name="category[]" value="{{ $category }}" {{ in_array($category, request('category', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $category }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gender -->
            @if(count($genders) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Gender</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($genders as $gender)
                            <label class="flex items-center gap-3 cursor-pointer group py-1">
                                <input type="checkbox" name="gender[]" value="{{ $gender }}" {{ in_array($gender, request('gender', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ ucfirst($gender) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Metal Color -->
            @if(count($metalColors) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Metal Color</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($metalColors as $color)
                            <label class="flex items-center gap-3 cursor-pointer group py-1">
                                <input type="checkbox" name="metal_color[]" value="{{ $color }}" {{ in_array($color, request('metal_color', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $color }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Metal Purity -->
            @if(count($metalPurities) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Metal Purity</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($metalPurities as $purity)
                            <label class="flex items-center gap-3 cursor-pointer group py-1">
                                <input type="checkbox" name="metal_purity[]" value="{{ $purity }}" {{ in_array($purity, request('metal_purity', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $purity }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Diamond Shape -->
            @if($shapes->count() > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Diamond Shape</span>
                        <i
                            class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($shapes as $shape)
                            @php
                                $shapeValue = is_object($shape) ? $shape->shape_name : $shape;
                            @endphp
                            <label
                                class="flex items-center gap-3 cursor-pointer group py-1 {{ $loop->index >= 5 ? 'hidden extra-shape' : '' }}">
                                <input type="checkbox" name="diamond_shape[]" value="{{ $shapeValue }}" {{ in_array($shapeValue, request('diamond_shape', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span
                                    class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $shapeValue }}</span>
                            </label>
                        @endforeach
                        @if($shapes->count() > 5)
                            <button type="button"
                                class="text-amber-600 text-xs font-medium hover:underline mt-2 view-more-shapes">
                                + View More
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Size -->
            @if(isset($sizes) && count($sizes) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Size</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 filter-content hidden pl-2">
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($sizes as $size)
                                <label class="relative flex items-center justify-center">
                                    <input type="checkbox" name="size[]" value="{{ $size }}"
                                        {{ in_array($size, request('size', [])) ? 'checked' : '' }}
                                        onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                        class="filter-checkbox sr-only peer">
                                    <span class="w-full text-center py-2 text-xs border border-gray-200 rounded-md cursor-pointer hover:border-amber-600 peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-600 transition-all select-none">{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Weight Range -->
            @if(isset($weightRanges) && count($weightRanges) > 0)
                <div class="border-b border-gray-100 py-4 filter-container">
                    <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                        <span class="font-medium text-gray-800 text-[15px] tracking-wider">Weight Range</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                    </div>
                    <div class="mt-4 space-y-3 filter-content hidden pl-2">
                        @foreach($weightRanges as $value => $label)
                            <label class="flex items-center gap-3 cursor-pointer group py-1">
                                <input type="checkbox" name="weight[]" value="{{ $value }}"
                                    {{ in_array($value, request('weight', [])) ? 'checked' : '' }}
                                    onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                    class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer">
                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Price Range -->
            <div class="border-b border-gray-100 py-4 filter-container">
                <div class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                    <span class="font-medium text-gray-800 text-[15px] tracking-wider">Price Range</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-600 transition-transform duration-200 accordion-icon"></i>
                </div>
                <div class="mt-4 space-y-3 filter-content hidden pl-2">
                    <!-- Price Checkboxes -->
                    @php
                        $priceRanges = [
                            '₹ 0 - ₹ 10,000',
                            '₹ 10,000 - ₹ 20,000',
                            '₹ 20,000 - ₹ 30,000',
                            '₹ 30,000 - ₹ 40,000',
                            '₹ 40,000 - ₹ 50,000',
                            '₹ 50,000 - ₹ 100,000'
                        ];
                    @endphp
                    @foreach($priceRanges as $range)
                        <label class="flex items-center gap-3 cursor-pointer group py-1">
                            <input type="checkbox" name="price[]" value="{{ $range }}"
                                {{ is_array(request('price')) && in_array($range, request('price')) ? 'checked' : '' }}
                                onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer price-checkbox">
                            <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $range }}</span>
                        </label>
                    @endforeach

                    <!-- Custom Price Slider -->
                    <div class="px-2 mt-4">
                        <label class="text-sm font-medium text-gray-800 mb-2 block">Custom Price</label>
                        <div class="price-slider-container w-full pt-4 pb-2">
                             <div class="relative w-full h-1 bg-gray-200 rounded-full">
                                 <div id="price-track" class="absolute h-full bg-[#CBA65A] rounded-full"></div>
                                 <input type="range" id="min-price-input" min="0" max="100000" value="{{ request('min_price', 0) }}" step="1000"
                                     onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                     class="absolute w-full h-1 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                                 <input type="range" id="max-price-input" min="0" max="100000" value="{{ request('max_price', 100000) }}" step="1000"
                                     onchange="if(window.innerWidth >= 1024) window.updateProducts()"
                                     class="absolute w-full h-1 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                             </div>
                             <div class="flex justify-between items-center mt-4">
                                 <span id="min-price-display" class="font-medium text-sm text-gray-700">₹ 0</span>
                                 <span id="max-price-display" class="font-medium text-sm text-gray-700">₹ 100,000+</span>
                             </div>
                             <!-- Hidden Inputs for Form Submission -->
                             <input type="hidden" name="min_price" id="hidden-min-price" value="{{ request('min_price', 0) }}">
                             <input type="hidden" name="max_price" id="hidden-max-price" value="{{ request('max_price', 100000) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Auto-Submit Script (Removed in favor of inline onchange) -->
            <!-- Mobile Apply Button (AJAX Trigger) -->
            <div class="lg:hidden mt-8 sticky bottom-0 bg-white pt-4 pb-2 border-t border-gray-100">
                <button type="button" onclick="window.updateProducts(); closeFilter();" class="w-full bg-[#5C4522] text-white font-medium py-3 rounded-md hover:bg-[#4a371a] transition-colors">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>
</aside>
