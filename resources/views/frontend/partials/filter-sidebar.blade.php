@php
$route = $route ?? 'page.new-arrivals';
@endphp


<aside id="filter-sidebar"
    class="fixed inset-y-0 left-0 z-[60] w-[85%] max-w-[300px] bg-white lg:bg-transparent h-full overflow-y-auto transition-transform duration-300 -translate-x-full shadow-2xl p-5 lg:p-0 lg:shadow-none lg:sticky lg:top-24 lg:h-[calc(100vh-6rem)] lg:translate-x-0 lg:w-[280px] lg:block flex-shrink-0 space-y-6 scrollbar-hide">

    <!-- Filter Header (Desktop & Mobile) -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2 font-medium text-[18px] text-[#878787]">
            <img src="{{ asset('assets/ic_setting.png') }}" alt="filter" class="w-5 h-5 object-contain lg:opacity-60"> Filters
        </div>
        <div class="flex items-center gap-3">
            <!-- Clear Button (Top) -->
            <button type="button" class="clear-filters-btn hidden text-sm font-semibold text-[#826230] hover:text-[#5C4522] underline cursor-pointer">Clear</button>
            <button type="button" id="close-filter-btn" class="lg:hidden text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
    </div>

    <form id="filterForm" action="{{ route($route) }}" method="GET" onsubmit="event.preventDefault(); window.updateProducts();">
        <!-- Preserve Sort -->
        @if(request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        <!-- Filter Item: Category -->
        @if(count($categories) > 0)
        <div class="pb-4">
            <div
                class="flex justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Category</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($categories as $category)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="category[]" value="{{ $category }}" {{ in_array($category, request('category', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $category }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Gender -->
        @if(count($genders) > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Gender</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($genders as $gender)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="gender[]" value="{{ $gender }}" {{ in_array($gender, request('gender', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ ucfirst($gender) }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Metal Color -->
        @if(count($metalColors) > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Metal Color</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($metalColors as $color)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="metal_color[]" value="{{ $color }}" {{ in_array($color, request('metal_color', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $color }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Metal Purity -->
        @if(count($metalPurities) > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Metal Purity</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($metalPurities as $purity)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="metal_purity[]" value="{{ $purity }}" {{ in_array($purity, request('metal_purity', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $purity }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Diamond Shape -->
        @if($shapes->count() > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Diamond Shape</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($shapes as $shape)
                @php
                $shapeValue = is_object($shape) ? $shape->shape_name : $shape; // Robustness
                @endphp
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="diamond_shape[]" value="{{ $shapeValue }}" {{ in_array($shapeValue, request('diamond_shape', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $shapeValue }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Size -->
        @if(isset($sizes) && count($sizes) > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Size</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($sizes as $size)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="size[]" value="{{ $size }}" {{ in_array($size, request('size', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $size }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Weight Ranges -->
        @if(isset($weightRanges) && count($weightRanges) > 0)
        <div class="pb-4">
            <div
                class="flex font-['Alexandria'] justify-between items-center cursor-pointer group filter-accordion-header select-none">
                <span class="font-medium text-[#1A1A1A] text-[16px]">Weight Ranges</span>
                <i
                    class="fa-solid fa-chevron-down text-xs text-gray-400 group-hover:text-amber-600 transition-transform duration-200 accordion-icon"></i>
            </div>
            <div class="mt-3 space-y-2 hidden">
                @foreach($weightRanges as $value => $label)
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="weight[]" value="{{ $value }}" {{ in_array($value, request('weight', [])) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="w-5 h-5 border-gray-300 rounded text-[#CBA65A] focus:ring-[#CBA65A] cursor-pointer accent-[#CBA65A]">
                    <span
                        class="text-sm text-gray-600 group-hover:text-[#CBA65A] transition-colors">{{ $label }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Filter Item: Price Range -->
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
                    <input type="checkbox" name="price[]" value="{{ $range }}" {{ is_array(request('price')) && in_array($range, request('price')) ? 'checked' : '' }}
                        onchange="window.updateProducts()"
                        class="filter-checkbox w-4 h-4 border-gray-300 rounded text-amber-600 focus:ring-amber-500 cursor-pointer price-checkbox">
                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $range }}</span>
                </label>
                @endforeach

                <!-- Custom Price Slider -->
                <div class="px-2 mt-4">
                    <label class="text-sm font-medium text-gray-800 mb-2 block">Custom Price</label>
                    <div class="price-slider-container w-full pt-4 pb-2 relative">
                        <div class="relative w-full h-1 bg-gray-200 rounded-full">
                            <div id="price-track" class="absolute h-full bg-[#CBA65A] rounded-full" style="left: 0%; right: 0%;"></div>
                            <input type="range" id="min-price-input" min="0" max="100000" value="{{ request('min_price', 0) }}" step="1000"
                                class="absolute top-[-6px] w-full h-4 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                            <input type="range" id="max-price-input" min="0" max="100000" value="{{ request('max_price', 100000) }}" step="1000"
                                class="absolute top-[-6px] w-full h-4 bg-transparent appearance-none pointer-events-none z-20 cursor-pointer [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-[1.5px] [&::-webkit-slider-thumb]:border-[#CBA65A] [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:shadow-md">
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <span id="min-price-display" class="font-medium text-sm text-gray-700">₹ {{ number_format(request('min_price', 0)) }}</span>
                            <span id="max-price-display" class="font-medium text-sm text-gray-700">₹ {{ number_format(request('max_price', 100000)) }}+</span>
                        </div>
                        <!-- Hidden Inputs for Form Submission -->
                        <input type="hidden" name="min_price" id="hidden-min-price" value="{{ request('min_price', 0) }}">
                        <input type="hidden" name="max_price" id="hidden-max-price" value="{{ request('max_price', 100000) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Apply / Clear Buttons (Sticky Bottom) -->
        <div class="mt-8 sticky bottom-0 bg-white pt-4 pb-4 border-t border-gray-100 flex flex-col gap-3 z-10 w-full mb-4">
            <button type="button" class="clear-filters-btn hidden w-full border border-[#826230] text-[#826230] font-medium py-2 rounded-md hover:bg-[#826230] hover:text-white transition-colors cursor-pointer">
                Clear Filters
            </button>
            <button type="button" onclick="closeFilter();" class="lg:hidden w-full bg-[#5C4522] text-white font-medium py-3 rounded-md hover:bg-[#4a371a] transition-colors cursor-pointer">
                Show Results
            </button>
        </div>
    </form>

</aside>