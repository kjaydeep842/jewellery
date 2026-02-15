@extends('frontend.layouts.master')


@section('content')

  @php
    $firstCategory = $categories->first();
  @endphp

  {{-- HERO SECTION AND COLLECTIONS --}}
  <section>
    <!-- Product Image -->
    <div class="relative w-full h-full mx-auto overflow-hidden">
      <!-- Ghost Image for Height Stability -->
      <div class="w-full relative invisible pointer-events-none">
        @if(isset($banners) && $banners->count() > 0)
          <img src="{{ asset('storage/' . $banners->first()->image) }}" class="w-full h-auto block opacity-0" alt="Ghost">
        @else
          <img src="assets/Top Banner Section.png" class="w-full h-auto block opacity-0" alt="Ghost">
        @endif
      </div>

      <div id="slides" class="grid w-full h-full overflow-hidden absolute inset-0">

        @if(isset($banners) && $banners->count() > 0)
          @foreach($banners as $index => $banner)
            <div
              class="{{ $index == 0 ? 'col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out' : 'absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out' }}">
              <img src="{{ asset('storage/' . $banner->image) }}"
                class="{{ $index == 0 ? 'w-full h-auto block' : 'w-full h-full object-cover block' }}"
                alt="{{ $banner->title }}">
            </div>
          @endforeach
        @else
          <!-- Fallback Static Slides -->
          <!-- Slide 1 -->
          <div class="col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out">
            <img src="assets/Top Banner Section.png" class="w-full h-auto block" alt="Slide 1">
          </div>
          <!-- Slide 2 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/banner.png" class="w-full h-full object-cover block" alt="Slide 2">
          </div>
          <!-- Slide 3 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/Top Banner Section.png" class="w-full h-full object-cover block" alt="Slide 3">
          </div>
          <!-- Slide 4 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/banner.png" class="w-full h-full object-cover block" alt="Slide 4">
          </div>
        @endif
      </div>

      <!-- Dots navigation -->
      <div id="dots" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
        @if(isset($banners) && $banners->count() > 0)
          @foreach($banners as $index => $banner)
            <button
              class="w-8 h-1 rounded-[1px] {{ $index == 0 ? 'bg-white' : 'bg-white/50' }} hover:bg-white transition-all duration-300"
              aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
        @else
          <button class="w-8 h-1 rounded-[1px] bg-white hover:bg-white transition-all duration-300"
            aria-label="Slide 1"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 2"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 3"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 4"></button>
        @endif
      </div>
    </div>
  </section>

  <!-- Premium Collecions-->
  <section class="pt-8 pb-2 md:pt-20 md:pb-4 w-full max-w-[1600px] mx-auto px-6">
    <div class="flex items-center justify-center gap-2 md:gap-6 mb-6 md:mb-10 w-full">
      <!-- Left Arrow -->
      <img src="assets/Design.png" alt="Decoration" class="h-5 md:h-8 object-contain">

      <!-- Text Group -->
      <div class="flex flex-col items-center justify-center -space-y-1 md:-space-y-2">
        <!-- Premium -->
        <span
          class="font-['Alexandria'] font-normal text-sm md:text-2xl min-[2000px]:text-[40px] text-[#5C4522] leading-tight text-center z-10 relative">
          Premium
        </span>
        <!-- Collection -->
        <span
          class="font-['Outfit'] font-medium text-2xl md:text-[54px] min-[2000px]:text-[72px] text-[#CBA65A] leading-tight text-center">
          Collection
        </span>
      </div>

      <!-- Right Arrow -->
      <img src="assets/DesignRight.png" alt="Decoration" class="h-5 md:h-8 object-contain">
    </div>

    <div class=" items-center group/nav">
      <div id="jewellerySlider" class="flex gap-6 overflow-x-auto no-scrollbar">
        <!-- Hidden Form for Premium Collection Filtering via POST -->
        <form id="premiumCategoryForm" action="{{ route('products.index.post') }}" method="POST" class="hidden">
          @csrf
          <input type="hidden" name="category[]" id="premiumCategoryInput">
        </form>

        @if(isset($categories) && $categories->count() > 0)
          @foreach($categories as $category)
            <div
              class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
              <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
                <!-- Star Icon -->
                <div
                  class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl min-[2000px]:text-3xl z-20">
                  ✦
                </div>

                <div class="w-full h-full rounded-[999px] overflow-hidden relative">
                  <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/premium_c1.png') }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    alt="{{ $category->name }}">

                  <!-- Vertical Line (Visible initially) -->
                  <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
                  </div>

                  <!-- "Pill" (Visible initially) -->
                  <div
                    class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all whitespace-nowrap">
                    {{ $category->name }}
                  </div>
                  <!-- Hover Overlay & Button -->
                  <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <button type="button"
                      onclick="document.getElementById('premiumCategoryInput').value = '{{ $category->name }}'; document.getElementById('premiumCategoryForm').submit();"
                      class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522] transition-all duration-300 group cursor-pointer">
                      <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                      <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest">View More</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif

      </div>

      <div class="flex items-center justify-between mt-4">
        <div class="flex items-center gap-3">
          <span id="slideIndex" class="text-sm font-bold text-gray-900 transition-all">01</span>
          <span class="h-[1px] w-12 bg-gray-300"></span>
          <span
            class="text-sm font-medium text-gray-400">{{ isset($categories) ? str_pad($categories->count(), 2, '0', STR_PAD_LEFT) : '00' }}</span>
        </div>

        <div class="flex gap-4">
          <button onclick="slide('left')"
            class="w-11 h-11 rounded-full border border-gray-200 flex items-center justify-center text-[#CBA65A] hover:bg-[#CBA65A] hover:text-white active:bg-[#CBA65A] active:text-white transition-all shadow-sm">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button onclick="slide('right')"
            class="w-11 h-11 rounded-full border border-gray-200 flex items-center justify-center text-[#CBA65A] hover:bg-[#CBA65A] hover:text-white active:bg-[#CBA65A] active:text-white transition-all shadow-sm">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white pt-4 pb-8 md:pt-4 md:pb-16 px-6">
    <div class="max-w-[1600px] min-[2000px]:max-w-full mx-auto">

      <div class="flex items-center justify-center mb-6 md:mb-10 gap-2 md:gap-6">
        <img src="assets/Design.png" alt="design left" class="h-5 md:h-8 w-auto object-contain">
        <div class="text-center">
          <p class="text-[16px] md:text-2xl min-[2000px]:text-4xl font-Alexandria tracking-[0.1em] text-[#5C4522] mb-1">
            Find your
          </p>
          <h2
            class="font-Outfit text-[32px] md:text-[54px] min-[2000px]:text-[80px] font-medium text-[#CBA65A] whitespace-nowrap leading-tight">
            Perfect Shape</h2>
        </div>
        <img src="assets/DesignRight.png" alt="design right" class="h-5 md:h-8 w-auto object-contain">
      </div>
      <!-- Hidden Form for Shape Filtering via POST -->
      <form id="shapeFilterForm" action="{{ route('products.index.post') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="diamond_shape[]" id="shapeInput">
      </form>
      <!-- All shape -->
      <div id="diamond-shapes-container"
        class="flex overflow-x-auto snap-x snap-mandatory gap-4 items-center md:gap-8 no-scrollbar pb-4">
        @if(isset($shapes) && $shapes->count() > 0)
          @foreach($shapes as $shape)
            <div
              onclick="document.getElementById('shapeInput').value = '{{ $shape->name }}'; document.getElementById('shapeFilterForm').submit();"
              class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
              <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
                <img src="{{ asset('storage/' . $shape->image) }}" alt="{{ $shape->name }}"
                  class="w-full h-full object-contain grayscale reflection-img">
              </div>
              <span
                class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">{{ $shape->name }}</span>
            </div>
          @endforeach
        @else
          <!-- Round shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Round'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/round_shape.png" alt="Round" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Round</span>
          </div>
          <!-- Oval shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Oval'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/oval_shape.png" alt="Oval" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Oval</span>
          </div>
          <!-- Princess shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Princess'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/princess_shape.png" alt="Princess"
                class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Princess</span>
          </div>
          <!-- Emerald shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Emerald'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/embral.png" alt="Emerald" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Emerald</span>
          </div>
          <!-- Radiant shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Radiant'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/radiant.png" alt="Radiant" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Radiant</span>
          </div>
          <!-- Heart shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Heart'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/heart.png" alt="Heart" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Heart</span>
          </div>
          <!-- Cushion shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Cushion'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/cushion.png" alt="Cushion" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] group-hover:text-black transition-colors group-hover:order-first">Cushion</span>
          </div>
          <!-- Pear shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Pear'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/pear.png" alt="Pear" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Pear</span>
          </div>
          <!-- Marquise shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Marquise'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/marquies.png" alt="Marquise" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Marquise</span>
          </div>
          <!-- Asscher shape -->
          <div
            onclick="document.getElementById('shapeInput').value = 'Asscher'; document.getElementById('shapeFilterForm').submit();"
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/asscher.png" alt="Asscher" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Asscher</span>
          </div>
        @endif
      </div>
    </div>
  </section>

  <section class="bg-[#FAF9F6] pt-12 pb-8 md:pt-28 md:pb-16 px-6">
    <div class="max-w-[1600px] min-[2000px]:max-w-full mx-auto">
      <div class="flex items-center justify-center mb-6 md:mb-8 gap-2 md:gap-6">
        <img src="assets/Design.png" alt="design left" class="h-5 md:h-8 w-auto object-contain">
        <div class="text-center">
          <p class="text-[16px] md:text-2xl min-[2000px]:text-4xl font-Alexandria tracking-[0.1em] text-[#5C4522] mb-1">
            Explore by
          </p>
          <h2
            class="font-Outfit text-[32px] md:text-[54px] min-[2000px]:text-[80px] font-medium text-[#CBA65A] whitespace-nowrap leading-tight">
            Category</h2>
        </div>
        <img src="assets/DesignRight.png" alt="design right" class="h-5 md:h-8 w-auto object-contain">
      </div>

      <!-- Category Buttons: Horizontal Scroll on Mobile -->
      <div class="flex flex-nowrap justify-start overflow-x-auto no-scrollbar gap-3 mb-8 w-full md:mb-12 snap-x">
        <button onclick="filterProducts('all', this)"
          class="category-btn active flex-shrink-0 px-6 py-2 md:px-10 md:py-2 min-[2000px]:px-12 min-[2000px]:py-4 font-['Outfit'] md:gap-0 bg-black text-white border border-gray-200 text-xs md:text-sm min-[2000px]:text-xl tracking-widest rounded-full hover:bg-black hover:text-white snap-center transition-colors whitespace-nowrap"
          data-id="all" data-name="all">All</button>

        @foreach($categories as $category)
          <button onclick="filterProducts('{{ $category->id }}', this)"
            class="category-btn flex-shrink-0 px-6 py-2 md:px-8 md:py-2 min-[2000px]:px-12 min-[2000px]:py-4 font-['Outfit'] md:gap-0 bg-gray-100 border border-gray-200 hover:text-white text-xs md:text-sm min-[2000px]:text-xl tracking-widest rounded-full hover:bg-black snap-center transition-colors whitespace-nowrap"
            data-id="{{ $category->id }}" data-name="{{ $category->name }}">{{ $category->name }}</button>
        @endforeach
      </div>

      <script>
        function filterProducts(categoryId, btn) {
          // If called from slider (btn is null), find the matching button
          if (!btn) {
            btn = document.querySelector(`.category-btn[data-id="${categoryId}"]`);
          }

          // Update active state
          document.querySelectorAll('.category-btn').forEach(b => {
            b.classList.remove('bg-black', 'text-white');
            b.classList.add('bg-gray-100', 'text-black');
          });

          let categoryName = '';

          if (btn) {
            btn.classList.remove('bg-gray-100', 'text-black');
            btn.classList.add('bg-black', 'text-white');
            categoryName = btn.getAttribute('data-name');
          }

          // Update Hidden Form Input for Explore All Button
          const hiddenInput = document.getElementById('hiddenCategoryInput');
          if (hiddenInput) {
            if (categoryName === 'all' || categoryName === '') {
              // Remove the input name for 'All' to show all products
              hiddenInput.removeAttribute('name');
              hiddenInput.value = '';
            } else {
              // Add name attribute back and set value for specific category
              hiddenInput.setAttribute('name', 'category[]');
              hiddenInput.value = categoryName;
            }
          }

          console.log('Fetching products for category:', categoryId);

          // Show Global Loader
          const loader = document.getElementById('page-loader');
          if (loader) loader.classList.remove('hidden');

          // Fade out current products
          const productGrid = document.getElementById('product-grid');
          if (productGrid) {
            productGrid.style.opacity = '0.5';

            // AJAX Request - Using the new dedicated route
            const baseUrl = "{{ route('ajax.products.category', [':id']) }}";
            const url = baseUrl.replace(':id', categoryId) + `?t=${new Date().getTime()}`;

            fetch(url, {
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
              }
            })
              .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
              })
              .then(data => {
                console.log('Product data received, count:', data.count);
                productGrid.innerHTML = data.html;
                productGrid.style.opacity = '1';
                if (loader) loader.classList.add('hidden');
              })
              .catch(error => {
                console.error('Error fetching products:', error);
                productGrid.style.opacity = '1';
                if (loader) loader.classList.add('hidden');
              });
          }
        }
        window.filterProducts = filterProducts;

        function updateProductSlider(categoryId) {
          console.log('Fetching slider products for category:', categoryId);

          // Show Global Loader
          const loader = document.getElementById('page-loader');
          if (loader) loader.classList.remove('hidden');

          const productSlider = document.getElementById('productsliderGrid');
          if (productSlider) {
            productSlider.style.opacity = '0.5';

            // AJAX Request
            const baseUrl = "{{ route('ajax.products.category', [':id']) }}";
            const url = baseUrl.replace(':id', categoryId) + `?type=slider&t=${new Date().getTime()}`;

            fetch(url, {
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
              }
            })
              .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
              })
              .then(data => {
                console.log('Slider data received');
                productSlider.innerHTML = data.html;
                productSlider.style.opacity = '1';
                if (loader) loader.classList.add('hidden');
              })
              .catch(error => {
                console.error('Error fetching slider products:', error);
                productSlider.style.opacity = '1';
                if (loader) loader.classList.add('hidden');
              });
          }
        }
        window.updateProductSlider = updateProductSlider;
      </script>

      <!---category image 1-->
      <div id="product-grid" class="flex overflow-x-auto no-scrollbar gap-5 mb-10 transition-opacity duration-300">
        @include('frontend.partials.home_products')

      </div>

      <div class="flex justify-center w-full">
        <form id="exploreAllForm" action="{{ route('products.index.post') }}" method="POST">
          @csrf
          <input type="hidden" id="hiddenCategoryInput" value="">
          <button type="submit"
            class="group/btn relative inline-flex items-center gap-3 px-8 py-4 bg-[#CBA65A] text-white rounded-full transition-all duration-300 hover:bg-[#B69550] overflow-hidden shadow-md cursor-pointer border-0">
            <span class="relative z-10 font-medium font-['Outfit']">Explore All</span>
            <i
              class="fa-solid fa-arrow-right relative z-10 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
            <div
              class="absolute inset-0 bg-white/10 translate-y-full transition-transform duration-300 group-hover/btn:translate-y-0">
            </div>
          </button>
        </form>
      </div>
    </div>
    </div>
  </section>
  <!--Banner Section-->
  <section>
    <!-- Product Image -->
    <div class="relative w-full h-full mx-auto overflow-hidden">
      <!-- Ghost Image for Height Stability -->
      <div class="w-full relative invisible pointer-events-none">
        @if(isset($middleBanners) && $middleBanners->count() > 0)
          <img src="{{ url('storage/' . $middleBanners->first()->image) }}" class="w-full h-auto block opacity-0"
            alt="Ghost">
        @else
          <img src="assets/Top Banner Section.png" class="w-full h-auto block opacity-0" alt="Ghost">
        @endif
      </div>

      <div id="slides1" class="grid w-full h-full overflow-hidden absolute inset-0">
        @if(isset($middleBanners) && $middleBanners->count() > 0)
          @foreach($middleBanners as $index => $banner)
            <div
              class="{{ $index == 0 ? 'col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out' : 'absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out' }}">
              <img src="{{ url('storage/' . $banner->image) }}"
                class="{{ $index == 0 ? 'w-full h-auto block' : 'w-full h-full object-cover block' }}"
                alt="{{ $banner->title }}">
            </div>
          @endforeach
        @else
          <!-- Fallback Static Section if no active middle banners -->
          <!-- Slide 1 -->
          <div class="col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out">
            <img src="assets/Top Banner Section.png" class="w-full h-auto block" alt="Slide 1">
          </div>
          <!-- Slide 2 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/banner.png" class="w-full h-full object-cover block" alt="Slide 2">
          </div>
          <!-- Slide 3 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/Top Banner Section.png" class="w-full h-full object-cover block" alt="Slide 3">
          </div>
          <!-- Slide 4 -->
          <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
            <img src="assets/banner.png" class="w-full h-full object-cover block" alt="Slide 4">
          </div>
        @endif
      </div>

      <!-- Dots navigation -->
      <div id="dots1" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
        @if(isset($middleBanners) && $middleBanners->count() > 0)
          @foreach($middleBanners as $index => $banner)
            <button
              class="w-8 h-1 rounded-[1px] {{ $index == 0 ? 'bg-white' : 'bg-white/50' }} hover:bg-white transition-all duration-300"
              onclick="goToSlide1({{ $index }})" aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
        @else
          <button class="w-8 h-1 rounded-[1px] bg-white hover:bg-white transition-all duration-300"
            aria-label="Slide 1"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 2"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 3"></button>
          <button class="w-8 h-1 rounded-[1px] bg-white/50 hover:bg-white transition-all duration-300"
            aria-label="Slide 4"></button>
        @endif
      </div>
    </div>
  </section>

  <!-- heading section-->
  <div class="ticker-wrapper">
    <div class="ticker">
      <span>✦ Where Luxury Meets Legacy ✦</span>
      <span>✦ Where Luxury Meets Legacy ✦</span>
      <span>✦ Where Luxury Meets Legacy ✦</span>
      <span>✦ Where Luxury Meets Legacy ✦</span>
      <span>✦ Where Luxury Meets Legacy ✦</span>
      <span>✦ Where Luxury Meets Legacy ✦</span>
    </div>
  </div>

  <!--Category Section-->
  <section class="relative bg-white overflow-hidden">
    <!-- Background Color Block -->
    <div class="absolute bottom-0 left-0 w-full h-[35%] bg-[#F3E5E5] pointer-events-none z-0"></div>
    <div class="absolute bottom-0 left-0 w-full h-[40%] bg-[#F3E5E5]"></div>
    <div class="relative z-10 max-w-[1600px] mx-auto px-6">
      <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-10 md:gap-8 lg:gap-0">
        <!-- Text Content -->
        <div
          class="relative w-full md:w-1/2 lg:w-[50%] flex flex-col items-center md:items-start lg:items-start py-8 md:py-12 lg:py-16 gap-6 lg:gap-4 order-0 px-4 md:px-0">

          <!-- Heading Group -->
          <div class="flex items-center justify-center md:justify-start lg:justify-start gap-4 w-full">
            <!-- Decorative Line (Responsive) -->
            <div class="flex-none hidden sm:flex items-center w-[100px] md:w-[140px] lg:w-[280px]">
              <img src="assets/Design_new.png" alt="" class="w-full h-auto object-contain">
            </div>

            <!-- Main Title -->
            <div class="top-5 flex flex-col items-center md:items-start min-w-max">
              <p style="font-family: 'Alexandria'"
                class="font-normal text-lg md:text-xl lg:text-2xl text-[#5C4522] leading-tight mb-1">
                Explore by</p>
              <h2 id="exploreCategoryTitle" style="font-family: 'Outfit'"
                class="font-medium text-4xl md:text-5xl lg:text-6xl text-[#CBA65A] leading-tight">
                Category</h2>
            </div>
          </div>

          <!-- Description -->
          <div class="pl-0 md:pl-0 lg:pl-[310px] w-full text-center md:text-left mt-2 lg:mt-0">
            <p id="catDescription" style="font-family: 'Outfit'"
              class="font-normal text-base md:text-[18px] min-[2000px]:text-2xl leading-relaxed md:leading-[35px] text-[#3D3D42] max-w-lg md:max-w-xl mx-auto md:mx-0 lg:mx-0">
              Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are
              subtle yet elegant.
            </p>
          </div>
        </div>

        <!-- Slider Image -->
        <div
          class="relative w-full md:w-1/2 lg:w-[50%] h-auto lg:h-[600px] flex flex-col justify-start items-center lg:items-center pt-10 lg:pt-0 px-0 lg:pl-[20px] gap-[1px] grow flex-none order-1">
          <div class="relative group md:-translate-x-12 lg:-translate-x-20">

            <button onclick="changeSlide('prev')"
              class="absolute -left-6 md:-left-8 lg:-left-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#EAD8A6] border border-amber-100 flex items-center justify-center text-amber-800 shadow-xl hover:bg-amber-50 transition-all active:scale-90">
              <i class="fa-solid fa-angle-left"></i>
            </button>

            <div
              class="relative w-full max-w-[300px] md:max-w-[340px] lg:max-w-[380px] h-[420px] md:h-[500px] lg:h-[550px] bg-white rounded-b-full border-[10px] border-white shadow-2xl overflow-hidden mx-auto">
              <img id="mainCatImg" src="assets/Rectangle_sidebar.png"
                class="w-full h-full object-cover transition-opacity duration-500" alt="Category">

              <div class="absolute bottom-16 left-0 w-full text-center">
                <span id="mainCatTitle"
                  class="bg-white/90 backdrop-blur-md px-8 py-2.5 min-[2000px]:px-12 min-[2000px]:py-4 rounded-full text-amber-900 font-serif italic min-[2000px]:text-4xl shadow-sm border border-amber-50 tracking-wide">Rings</span>
              </div>
            </div>

            <button onclick="changeSlide('next')"
              class="absolute -right-6 md:-right-8 lg:-right-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#EAD8A6] border border-amber-100 flex items-center justify-center text-amber-800 shadow-xl hover:bg-amber-50 transition-all active:scale-90">
              <i class="fa-solid fa-angle-right"></i>
            </button>

            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-amber-50/50 rounded-full blur-3xl -z-10">
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Product Images-->
  <!---category image 1-->
  <!-- Product Images Section with Gradient -->
  <!-- Product Images Section with Gradient -->
  <section class="w-full pb-12 pt-6 md:pt-10" style="background: linear-gradient(180deg, #F3E5E5 0%, #FDFBF7 100%);">
    <div id="productsliderGrid"
      class="flex overflow-x-auto no-scrollbar gap-4 md:gap-6 px-4 md:px-[60px] lg:px-[100px] snap-x snap-mandatory pb-8">
      @if(isset($products) && $products->count() > 0)
        @foreach($products as $product)
          <!-- Dynamic Product Item -->
          <div
            class="flex flex-col gap-3 w-[calc(50%-8px)] md:w-[calc(33.33%-16px)] lg:w-[calc(25%-18px)] xl:w-[calc(20%-20px)] flex-shrink-0 snap-start">
            <div
              class="bg-white box-border relative w-full aspect-square rounded-[14px] shadow-[0_2px_8px_rgba(0,0,0,0.08)] group transition-all duration-300 hover:shadow-lg overflow-hidden">
              <span
                class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
                Seller</span>
              <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute bottom-3 left-2 z-20">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                  class="flex bg-white h-[32px] w-[32px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                  <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="Wishlist">
                </button>
              </form>
              <a href="{{ route('product.details', $product->slug) }}"
                class="w-full h-full flex items-center justify-center block p-4">
                <!-- Dynamic Image with Fallback -->
                <img src="{{ $product->images->first()->url ?? asset('assets/ring.png') }}" alt="{{ $product->name }}"
                  class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                <img src="{{ $product->images->skip(1)->first()->url ?? asset('assets/hover_image_p.png') }}"
                  class="w-full h-full object-cover mix-blend-multiply absolute inset-0 p-4 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
              </a>
            </div>
            <div class="text-center font-['Outfit'] px-1">
              <!-- Dynamic Name -->
              <h3
                class="text-sm md:text-base font-medium text-[#1A1A1A] mb-1 truncate w-full hover:text-[#C34A37] transition-colors"
                title="{{ $product->name }}">
                <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
              </h3>
              <div class="flex flex-wrap items-center justify-center gap-2 text-xs md:text-sm">
                <!-- Dynamic Price -->
                <span class="font-bold text-[#1A1A1A] whitespace-nowrap">₹
                  {{ number_format($product->price, 2) }}</span>
                <!-- Dummy Original Price Logic -->
                <span class="text-[#999999] line-through whitespace-nowrap">₹
                  {{ number_format($product->price * 1.2, 2) }}</span>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <!-- Fallback Static Items (Repeated for Demo) -->
        @for ($i = 0; $i < 5; $i++)
          <!-- <div
                                                                                                                                                                                                                      class="flex flex-col gap-3 w-[calc(50%-8px)] md:w-[calc(33.33%-16px)] lg:w-[calc(25%-18px)] xl:w-[calc(20%-20px)] flex-shrink-0 snap-start"> -->
          <div
            class="bg-white box-border relative w-full aspect-square rounded-[14px] shadow-[0_2px_8px_rgba(0,0,0,0.08)] group transition-all duration-300 hover:shadow-lg overflow-hidden">
            <span
              class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
              Seller</span>
            <button
              class="absolute flex bottom-3 left-2 bg-white h-[32px] w-[32px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all z-20">
              <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="">
            </button>
            <div class="w-full h-full flex items-center justify-center p-4">
              <img src="{{ asset('assets/ring.png') }}" alt="Ring"
                class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
              <img src="{{ asset('assets/hover_image_p.png') }}"
                class="w-full h-full object-cover mix-blend-multiply absolute inset-0 p-4 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
            </div>
          </div>
          <div class="text-center font-['Outfit'] px-1">
            <h3
              class="text-sm md:text-base font-medium text-[#1A1A1A] mb-1 truncate w-full hover:text-[#C34A37] transition-colors">
              Twist Cross Cage
              Ring</h3>
            <div class="flex items-center justify-center gap-2 text-xs md:text-sm">
              <span class="font-bold text-[#1A1A1A]">₹ 949.00</span>
              <span class="text-[#999999] line-through">₹ 949.00</span>
            </div>
          </div>
          <!-- </div> -->
        @endfor
      @endif
    </div>

    </div>

    <div class="flex justify-center">
      <form id="sliderExploreAllForm" action="{{ route('products.index.post') }}" method="POST">
        @csrf
        <input type="hidden" id="sliderCategoryInput" value="">
        <button type="submit"
          class="flex flex-row justify-center items-center px-4 py-2 md:px-[26px] gap-2 md:gap-[10px] w-auto md:w-[194px] h-[45px] md:h-[60px] bg-white border-[1.8px] border-[#A87E3E] rounded-[200px] text-[#A87E3E] font-['Outfit'] font-normal text-[16px] md:text-[22px] leading-tight hover:bg-gray-50 transition-colors group cursor-pointer">
          Explore All
          <img src="assets/ic_back_2.png" alt="arrow"
            class="w-3 h-3 md:w-4 md:h-4 object-contain group-hover:translate-x-1 transition-transform">
        </button>
      </form>
    </div>
    </div>
  </section>

  <!--Launch Section-->
  <section class="pt-12 pb-0 md:pt-24 md:pb-0 bg-silk/30 text-center overflow-hidden relative w-full max-w-[100vw]">
    <div class="flex flex-col md:flex-row items-center justify-center mb-10 md:mb-16 gap-6 md:gap-10">
      <!-- Left Design (Hidden on very small mobile if needed, but keeping for now) -->
      <div class="hidden md:flex flex-row justify-end items-center gap-[4px] w-full max-w-[398px] h-10">
        <img src="assets/Design_new.png" alt="design left" class="h-full w-full object-contain">
      </div>

      <!-- Center Text -->
      <div class="flex flex-col justify-center items-center px-4 w-full md:w-auto h-auto rounded-[10px]">
        <span
          class="bg-[#C34A37] text-white text-sm md:text-xl min-[2000px]:text-3xl px-6 py-1.5 rounded-full font-Alexandria font-normal mb-4 tracking-wide shadow-sm">
          This Is New
        </span>
        <h2 style="font-family: 'Outfit'"
          class="font-medium text-4xl md:text-[54px] min-[2000px]:text-[80px] leading-tight text-[#CBA65A] text-center">
          Launch Jewellery
        </h2>
      </div>
      <!-- Right Design -->
      <div class="hidden md:flex flex-row justify-start items-center gap-[4px] w-full max-w-[398px] h-10">
        <img src="assets/Design_new.png" alt="design right" class="h-full w-full object-contain transform scale-x-[-1]">
      </div>
    </div>

    <div class="relative w-full max-w-full mx-auto mb-0 md:mb-0 group-container">
      <!-- Background Ellipse -->
      <div
        class="absolute top-[60%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1800px] h-[10px] max-w-none bg-[#FDFBF7] rounded-[50%] -z-10 blur-xl pointer-events-none">
      </div>

      <!-- Product Cards Grid -->
      <div id="launchScroll"
        class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar gap-6 relative z-10 w-full px-6 md:px-8 min-[1800px]:px-[calc((100vw-1600px)/2)]"
        style="-webkit-overflow-scrolling: touch;">
        <!-- Hidden Form for Category Filtering via POST -->
        <form id="launchCategoryForm" action="{{ route('products.index.post') }}" method="POST" class="hidden">
          @csrf
          <input type="hidden" name="category[]" id="launchCategoryInput">
          <input type="hidden" name="is_new" value="1">
        </form>

        @php
          $launchStyles = [
            [
              'gradient_stops' => [
                ['color' => '#FFF6E3', 'offset' => 0],
                ['color' => '#E8C889', 'offset' => 1]
              ],
              'star_color' => '#C19757',
              'curve_filter' => '' // Default
            ],
            [
              'gradient_stops' => [
                ['color' => '#FCECEC', 'offset' => 0],
                ['color' => '#E7B6A7', 'offset' => 1]
              ],
              'star_color' => '#CBA65A',
              'curve_filter' => 'brightness(0) saturate(100%) invert(86%) sepia(20%) saturate(713%) hue-rotate(323deg) brightness(97%) contrast(93%)'
            ],
            [
              'gradient_stops' => [
                ['color' => '#F4F1EC', 'offset' => 0],
                ['color' => '#D6C3A5', 'offset' => 1]
              ],
              'star_color' => '#D6C3A5',
              'curve_filter' => 'brightness(0) saturate(100%) invert(84%) sepia(8%) saturate(928%) hue-rotate(352deg) brightness(97%) contrast(93%)'
            ],
            [
              'gradient_stops' => [
                ['color' => '#FFF1E8', 'offset' => 0],
                ['color' => '#F3C6A8', 'offset' => 1]
              ],
              'star_color' => '#F3C6A8',
              'curve_filter' => 'brightness(0) saturate(100%) invert(87%) sepia(17%) saturate(1043%) hue-rotate(320deg) brightness(101%) contrast(91%)'
            ]
          ];
        @endphp

        @if(isset($categories) && $categories->count() > 0)
          @foreach($categories as $index => $category)
            @php
              $style = $launchStyles[$index % 4];
              $gradientId = "paint_launch_" . $index;
              $gradientRefId = "paint_launch_ref_" . $index;
            @endphp
            <div
              onclick="document.getElementById('launchCategoryInput').value = '{{ $category->name }}'; document.getElementById('launchCategoryForm').submit();"
              class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">

              <!-- Card Image Container -->
              <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden gap-2">
                <img src="{{ asset('storage/' . $category->image) }}"
                  class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[75%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
                  alt="{{ $category->name }}">

                <!-- Hover Stars Effect -->
                <div
                  class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                  <span
                    class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[{{ $style['star_color'] }}] text-2xl animate-pulse">✦</span>
                  <span
                    class="absolute top-[35%] left-[10%] text-[{{ $style['star_color'] }}] text-3xl animate-pulse delay-75">✦</span>
                  <span
                    class="absolute bottom-[25%] right-[12%] text-[{{ $style['star_color'] }}] text-2xl animate-pulse delay-150">✦</span>
                </div>

                <!-- Bottom Content Wrapper -->
                <div class="absolute bottom-0 left-0 w-full z-10">
                  <!-- SVG Background -->
                  <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-full h-auto block relative z-10">
                    <defs>
                      <linearGradient id="{{ $gradientId }}" x1="190.5" y1="0" x2="180.5" y2="260"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="{{ $style['gradient_stops'][0]['color'] }}" />
                        <stop offset="1" stop-color="{{ $style['gradient_stops'][1]['color'] }}" />
                      </linearGradient>
                    </defs>
                    <path
                      d="M0 20C150 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                      fill="url(#{{ $gradientId }})" />
                    <path
                      d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                      stroke="#D8B1B6" stroke-opacity="0.2" />
                  </svg>

                  <!-- Corner Images -->
                  <img src="assets/launchcategorycurv1.png" style="width: 9%; filter: {{ $style['curve_filter'] }};"
                    class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
                  <img src="assets/launchcategorycurv1.png" style="width: 9%; filter: {{ $style['curve_filter'] }};"
                    class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

                  <!-- Text Content -->
                  <div class="absolute bottom-[20%] w-full text-center z-30">
                    <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">9KT Solid
                      Gold
                    </p>
                    <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                      {{ $category->name }}
                    </h3>
                  </div>
                </div>
              </div>

              <!-- Reflection (Masked) -->
              <div
                class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none mask-image-b-to-t">
                <div class="absolute bottom-0 left-0 w-full z-10">
                  <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                    <defs>
                      <linearGradient id="{{ $gradientRefId }}" x1="175.5" y1="0" x2="175.5" y2="260"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="{{ $style['gradient_stops'][0]['color'] }}" />
                        <stop offset="1" stop-color="{{ $style['gradient_stops'][1]['color'] }}" />
                      </linearGradient>
                    </defs>
                    <path
                      d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                      fill="url(#{{ $gradientRefId }})" />
                  </svg>
                  <div class="absolute bottom-[35%] w-full text-center z-30">
                    <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                      9KT Solid Gold</p>
                    <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                      {{ $category->name }}
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>


    </div>
  </section>


  <!-- Unique Style Section -->
  <section class="bg-white pt-4 pb-8 md:pt-8 md:pb-0 overflow-hidden relative w-full max-w-[100vw] z-20">
    <!-- Title -->
    <div class="text-center mb-0 relative z-30">
      <div class="flex items-center justify-center gap-1 md:gap-4 mb-2">
        <img src="assets/Design_new.png" class="h-3 md:h-5 w-auto object-contain" alt="decoration">
        <span style="font-family: 'Alexandria'"
          class="font-Alexandria text-[#5C4522] text-sm md:text-2xl min-[2000px]:text-4xl tracking-normal font-normal whitespace-nowrap">Express
          Your Identity with</span>
        <img src="assets/Design_new.png" class="h-3 md:h-5 w-auto object-contain transform scale-x-[-1]" alt="decoration">
      </div>
      <h2 style="font-family: 'Outfit'"
        class="font-Outfit text-[#CBA65A] text-3xl md:text-[54px] min-[2000px]:text-[80px] font-medium leading-tight">
        Our Unique Style
      </h2>
    </div>

    <!-- Lens Grid Wrapper -->
    <div class="relative w-full h-[250px] md:h-[750px] lg:h-[850px] z-10 -mt-8 md:-mt-48">
      <!-- Top Curve Mask (White) -->
      <div
        class="absolute -top-[100px] md:-top-[698px] min-[1800px]:-top-[660px] left-1/2 -translate-x-1/2 w-[120%] md:w-[2416px] min-[1800px]:w-[2600px] min-[2000px]:w-[300%] h-[150px] md:h-[918px] max-w-none bg-white rounded-b-[100%] md:rounded-b-[50%] z-20 pointer-events-none">
      </div>

      <!-- Grid -->
      <!-- Mobile: 2x2 Grid (grid-cols-2), Laptop: 4x1 (grid-cols-4) -->
      <!-- Added gap-1 for mobile to remove whitespace, larger gap for desktop -->
      <!-- Slider Wrapper -->
      <!-- Added Buttons and Flex container -->
      <div class="relative h-full w-full">
        <!-- Navigation Buttons Removed -->


        <!-- Slider -->
        <div id="uniqueStyleSlider"
          class="h-full w-full flex gap-1 md:gap-5 overflow-x-auto snap-x snap-proximity no-scrollbar bg-white">
          @if(isset($uniqueStyles) && $uniqueStyles->count() > 0)
            <!-- Original Items -->
            @foreach($uniqueStyles as $style)
              <div
                class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
                <img src="{{ asset('storage/' . $style->image) }}"
                  class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100"
                  alt="Unique Style">
              </div>
            @endforeach

            <!-- Duplicated Items for continuous feel -->
            @foreach($uniqueStyles as $style)
              <div
                class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
                <img src="{{ asset('storage/' . $style->image) }}"
                  class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100"
                  alt="Unique Style">
              </div>
            @endforeach
          @else
            <!-- Fallback -->
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq1.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq2.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq3.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq4.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq1.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">

            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq2.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq3.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[35%] md:min-w-[30%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer border-r border-white/10">
              <img src="assets/Uniq4.png"
                class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
          @endif

        </div>
      </div>

      <!-- Bottom Curve Mask (White) -->
      <div
        class="absolute -bottom-[100px] md:-bottom-[698px] min-[1800px]:-bottom-[680px] left-1/2 -translate-x-1/2 w-[120%] md:w-[2416px] min-[1800px]:w-[2600px] min-[2000px]:w-[150%] h-[150px] md:h-[918px] max-w-none bg-white rounded-t-[100%] md:rounded-t-[50%] z-20 pointer-events-none">
      </div>
    </div>

    <!-- Button -->
    <div class="absolute bottom-4 md:bottom-[60px] left-1/2 -translate-x-1/2 z-30">
      <button
        class="w-[150px] h-[45px] md:w-[195px] md:h-[60px] min-[2000px]:w-[300px] min-[2000px]:h-[80px] bg-[#0D0D0E] text-white hover:bg-gray-800 rounded-[200px] font-Outfit tracking-widest text-xs md:text-sm min-[2000px]:text-2xl transition-all flex items-center justify-center gap-[10px] group shadow-lg px-[26px]">
        View More
        <img src="assets/ic_back_2_white.png"
          class="h-3 md:h-4 min-[2000px]:h-6 w-auto transform group-hover:translate-x-1 transition-transform" alt="arrow">
      </button>
    </div>

    <!-- Background Ellipse (Bottom) -->
    <div
      class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 w-[140%] h-[800px] bg-[#FDFBF7] rounded-[50%] z-0 blur-xl pointer-events-none">
    </div>
  </section>

  <!--Best Seller Section -->
  @if($bestSellerProduct)
    <section
      class="relative w-full flex justify-center  items-center py-[40px] px-4 md:px-[40px] gap-[20px] z-10 overflow-hidden bg-[#FDFBF7]">

      <!-- Ellipse Background -->
      <div
        style="position: absolute; width: 100%; height: 100%; left: 0; top: 0; background: radial-gradient(50% 50% at 50% 50%, #F3EAD8 0%, #FDFBF7 100%); pointer-events: none; z-index: 0;">
      </div>

      <div class="relative z-20 max-w-[1440px] min-[2000px]:max-w-full w-full mx-auto">
        <div class="flex flex-col lg:flex-row items-center justify-center gap-[60px] w-full h-auto py-0">

          <!-- Left Image -->
          <div class="flex-1 flex justify-center items-center relative w-full h-full order-first lg:order-none">
            <a href="{{ route('product.details', $bestSellerProduct->slug) }}"
              class="block w-full max-w-[300px] md:max-w-[450px] lg:max-w-[600px] min-[2000px]:max-w-[1000px]">
              <img
                src="{{ $bestSellerProduct->image ? asset('storage/' . $bestSellerProduct->image) : ($bestSellerProduct->images->first() ? asset('storage/' . $bestSellerProduct->images->first()->image_path) : asset('assets/Product Photo.png')) }}"
                class="w-full h-auto object-contain hover:scale-105 transition-transform duration-500 mix-blend-multiply border-none outline-none ring-0"
                style="filter: brightness(1.15) contrast(1.05); -webkit-mask-image: radial-gradient(closest-side, black 85%, transparent 100%); mask-image: radial-gradient(closest-side, black 85%, transparent 100%);"
                alt="{{ $bestSellerProduct->name }}">
            </a>
          </div>

          <!-- Right Content -->
          <div class="flex-1 flex flex-col  justify-center space-y-8 lg:pl-10">
            <div class="text-center lg:text-left xl:text-center">
              <h2
                class="font-['Alexandria'] text-[#0D0D0E] text-4xl md:text-[44px] min-[2000px]:text-[70px] font-normal leading-tight mb-2">
                Tattsvi Bestseller</h2>
              <p
                class="font-['Outfit'] text-[#0D0D0E] text-xl md:text-[24px] min-[2000px]:text-4xl font-normal tracking-normal leading-tight">
                Jewellery that defines choice, elegance and trust</p>
            </div>

            <div class="space-y-6 max-w-lg mx-auto lg:mx-0 xl:mx-auto">
              <!-- Feature 1 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png"
                    class="w-8 h-8 md:w-10 md:h-10 min-[2000px]:w-14 min-[2000px]:h-14 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit'"
                    class="font-Outfit text-[18px] md:text-[20px] min-[2000px]:text-3xl font-semibold text-[#0D0D0E] leading-tight mb-1">
                    {{ $bestSellerProduct->name }}
                  </h4>
                  <p style="font-family: 'Outfit'"
                    class="font-Outfit font-light text-[14px] md:text-[15px] min-[2000px]:text-xl text-[#5C5C5C] leading-snug">
                    {{ \Illuminate\Support\Str::limit($bestSellerProduct->short_description ?? 'A Signature Design Crafted For Everyday Elegance', 80) }}
                  </p>
                </div>
              </div>

              <!-- Feature 2 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png"
                    class="w-8 h-8 md:w-10 md:h-10 min-[2000px]:w-14 min-[2000px]:h-14 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit'"
                    class="font-Outfit text-[18px] md:text-[20px] min-[2000px]:text-3xl font-semibold text-[#0D0D0E] leading-tight mb-1">
                    Transparent & Fair Pricing</h4>
                  <p style="font-family: 'Outfit'"
                    class="font-Outfit font-light text-[14px] md:text-[15px] min-[2000px]:text-xl text-[#5C5C5C] leading-snug">
                    Value That Reflect Purity, Craftsmanship And Trust</p>
                </div>
              </div>

              <!-- Feature 3 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png"
                    class="w-8 h-8 md:w-10 md:h-10 min-[2000px]:w-14 min-[2000px]:h-14 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit'"
                    class="font-Outfit text-[18px] md:text-[20px] min-[2000px]:text-3xl font-semibold text-[#0D0D0E] leading-tight mb-1">
                    Certified Pure Gold</h4>
                  <p style="font-family: 'Outfit'"
                    class="font-Outfit font-light text-[14px] md:text-[15px] min-[2000px]:text-xl text-[#5C5C5C] leading-snug">
                    Hallmarked Jewellery You Can Wear With Confidence</p>
                </div>
              </div>
            </div>

            <div class="pt-10 text-center w-full flex flex-col items-center">
              <p style="font-family: 'Outfit'"
                class="font-Outfit font-medium text-[16px] md:text-[18px] min-[2000px]:text-2xl text-[#3D3D3D] mb-6 text-center">
                Loved Beyond Trends Jewellery that continues to be chosen.</p>
              <a href="{{ route('page.best-seller') }}" style="background: #CD9C56;"
                class="inline-flex items-center justify-center w-auto h-[50px] min-[2000px]:h-[70px] px-8 min-[2000px]:px-12 rounded-full text-white font-Outfit font-medium text-[16px] min-[2000px]:text-2xl shadow-sm hover:bg-[#b38f45] transition-colors leading-tight">
                View All Bestsellers
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Flexible solutions-->
  <section class="bg-gradient-to-r from-[#FCE4EC] to-[#FFF5F6] py-8 px-4 md:px-14">
    <div class="max-w-[1440px] min-[2000px]:max-w-full mx-auto text-center">
      <p style="font-family: 'Alexandria'"
        class="font-Alexandria text-[20px] md:text-[24px] min-[2000px]:text-4xl font-normal text-[#5C4522] leading-[29px] text-center my-[-9px] mb-4">
        Upgrade Your Sparkle, Stress-Free</p>

      <div class="flex items-center justify-center gap-3 md:gap-4 mb-8">
        <img src="assets/Design_pink_left.png" class="h-4 md:h-7 w-[15%] md:w-auto object-contain" alt="decoration">
        <h2
          class="font-Outfit text-[#B76E79] text-lg md:text-[36px] min-[2000px]:text-[60px] font-medium leading-tight whitespace-normal md:whitespace-nowrap">
          Flexible solutions for your jewellery</h2>
        <img src="assets/Design_pink_right.png" class="h-4 md:h-7 w-[15%] md:w-auto object-contain" alt="decoration">
      </div>

      <!-- Responsive Grid: 2 cols mobile, 3 cols tablet, 6 cols desktop -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-y-10 gap-x-4 md:gap-x-6 justify-items-center">

        <!-- Item 1 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/Frame1.png"
                class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Easy 15 Day Exchange">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Easy 15 Day Exchange
          </span>
        </div>

        <!-- Item 2 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/Group.png"
                class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Guaranteed Purity">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Guaranteed Purity
          </span>
        </div>

        <!-- Item 3 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/tr.png" class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Fast & Secure Shipping">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Fast & Secure Shipping
          </span>
        </div>

        <!-- Item 4 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/cj.png" class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Certified Jewellery">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Certified Jewellery
          </span>
        </div>

        <!-- Item 5 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/pc.png" class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Premium Craftsmanship">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Premium Craftsmanship
          </span>
        </div>

        <!-- Item 6 -->
        <div class="flex flex-col items-center group w-full">
          <div
            class="w-28 h-28 md:w-[140px] md:h-[140px] min-[2000px]:w-[200px] min-[2000px]:h-[200px] bg-white  rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
            <div
              class="w-20 h-20 md:w-[140px] md:h-[140px] min-[2000px]:w-[180px] min-[2000px]:h-[180px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
              style="background-image: url('assets/Cat 1.png');">
              <img src="assets/ee.png" class="h-8 w-8 md:h-12 md:w-12 min-[2000px]:h-20 min-[2000px]:w-20 object-contain"
                alt="Ethical & Eco-Conscious">
            </div>
          </div>
          <span
            class="text-xs md:text-[15px] min-[2000px]:text-2xl font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
            Ethical & Eco-Conscious
          </span>
        </div>

      </div>
    </div>
  </section>
  <section class="py-8 md:py-20 bg-white px-4 md:px-8 w-full max-w-[100vw] overflow-hidden">
    <div class="w-full mx-auto">
      <!-- Header -->
      <div class="text-center mb-12">
        <p style="font-family: 'Alexandria'"
          class="font-Alexandria text-[16px] md:text-[20px] min-[2000px]:text-4xl font-normal text-[#5C4522] leading-[29px] text-center my-[-5px] mb-2">
          Here From
        </p>
        <div class="flex items-center justify-center gap-3 md:gap-4">
          <img src="assets/Design.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
          <h2 style="font-family: 'Outfit'"
            class="font-Outfit text-[#CBA65A] text-2xl md:text-[36px] min-[2000px]:text-[80px] font-medium leading-tight md:leading-[48px] whitespace-nowrap">
            Our Customers
          </h2>
          <img src="assets/DesignRight.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
        </div>
      </div>

      <div class="relative group w-full mx-auto">
        <!-- Slider -->
        <div id="testimonialSlider"
          class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar pb-2 px-2 w-full">

          @forelse($reviews as $review)
            <div
              class="border border-[#DBB358] w-[85vw] md:w-[70%] lg:w-[1070px] min-[2000px]:w-[1200px] flex-shrink-0 snap-center bg-transparent p-6 md:p-8 lg:p-10 min-[2000px]:p-16 rounded-[20px] relative flex flex-col h-auto min-h-[300px] min-[2000px]:min-h-[405px] justify-center group transition-all duration-300 hover:shadow-md">

              <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-8 h-full">
                <!-- Product Image as Icon (Left Side) -->
                <div class="flex-shrink-0">
                  @if($review->product && $review->product->images->first())
                    <img src="{{ asset('storage/' . $review->product->images->first()->image_path) }}"
                      class="w-16 h-16 md:w-20 md:h-20 min-[2000px]:w-32 min-[2000px]:h-32 object-cover rounded-full border border-[#DBB358]"
                      alt="{{ $review->product->name }}">
                  @else
                    <img src="{{ asset('assets/ReviewQuote.png') }}"
                      class="w-12 h-12 md:w-16 md:h-16 min-[2000px]:w-24 min-[2000px]:h-24 object-contain opacity-100"
                      alt="quote">
                  @endif
                </div>

                <div class="flex flex-col justify-center h-full w-full">
                  <p
                    class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg min-[2000px]:text-3xl leading-relaxed mb-6 font-medium text-center md:text-left">
                    "{{ $review->comment }}"
                  </p>

                  <div class="flex items-center justify-center md:justify-start gap-4">
                    <!-- User Image -->
                    <img
                      src="{{ $review->user && $review->user->profile_picture ? asset('storage/' . $review->user->profile_picture) : asset('assets/client1.png') }}"
                      class="w-10 h-10 min-[2000px]:w-16 min-[2000px]:h-16 rounded-[10px] object-cover"
                      alt="{{ $review->user->name ?? 'User' }}">

                    <div>
                      <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-base min-[2000px]:text-2xl">
                        {{ $review->user->name ?? 'Anonymous' }}
                      </h4>
                      <div class="flex gap-1 text-[#CBA65A] text-[10px] min-[2000px]:text-lg">
                        @for ($i = 0; $i < 5; $i++)
                          @if ($i < $review->rating)
                            <i class="fas fa-star"></i>
                          @else
                            <i class="far fa-star"></i>
                          @endif
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <!-- Fallback -->
            <div
              class="border border-[#DBB358] w-[85vw] md:w-[70%] lg:w-[1070px] min-[2000px]:w-[1200px] flex-shrink-0 snap-center bg-transparent p-6 md:p-8 lg:p-10 min-[2000px]:p-16 rounded-[20px] relative flex flex-col h-auto min-h-[300px] min-[2000px]:min-h-[405px] justify-center group transition-all duration-300 hover:shadow-md">
              <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-8 h-full">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/ReviewQuote.png') }}"
                    class="w-12 h-12 md:w-16 md:h-16 min-[2000px]:w-24 min-[2000px]:h-24 object-contain opacity-100"
                    alt="quote">
                </div>
                <div class="flex flex-col justify-center h-full w-full">
                  <p
                    class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg min-[2000px]:text-3xl leading-relaxed mb-6 font-medium text-center md:text-left">
                    "Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are
                    subtle yet elegant, making them perfect for everyday styling."
                  </p>
                  <div class="flex items-center justify-center md:justify-start gap-4">
                    <img src="{{ asset('assets/client1.png') }}"
                      class="w-10 h-10 min-[2000px]:w-16 min-[2000px]:h-16 rounded-[10px] object-cover" alt="User">
                    <div>
                      <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-base min-[2000px]:text-2xl">
                        Ananya R.</h4>
                      <div class="flex gap-1 text-[#CBA65A] text-[10px] min-[2000px]:text-lg">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                          class="fas fa-star"></i><i class="fas fa-star"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforelse
        </div>

        <!-- Navigation -->
        <div class="flex justify-center md:justify-end gap-4 mt-8 px-4">
          <button onclick="scrollSlider('left')"
            class="w-12 h-12 rounded-full border border-[#D7D7DA] flex items-center justify-center text-[#5C4522] hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all bg-white hover:bg-[#F9F4E8]">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button onclick="scrollSlider('right')"
            class="w-12 h-12 rounded-full border border-[#D7D7DA] flex items-center justify-center text-[#5C4522] hover:border-[#CBA65A] hover:text-[#CBA65A] transition-all bg-white hover:bg-[#F9F4E8]">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!--Download The App Noww -->

  <section class="py-4 md:py-8 px-4 md:px-8">
    <div
      class="max-w-[1440px] min-[2000px]:max-w-full mx-auto border-[#F2D7D3] border-[4px] bg-[#FDF2F4] rounded-[40px] overflow-hidden flex flex-col md:flex-row items-center justify-between px-6 py-6 md:px-16 md:py-10 min-[2000px]:px-24 min-[2000px]:py-20 relative">
      <!-- Left Side: Text and Buttons -->
      <div class="w-full md:w-1/2 flex flex-col items-start gap-6 z-10">
        <h2 style="font-family: 'Outfit'"
          class="font-Outfit text-3xl md:text-[54px] min-[2000px]:text-[90px] font-bold text-[#0D0D0E] leading-tight">
          Download the app now!
        </h2>
        <p style="font-family: 'Outfit'"
          class="font-Outfit text-base md:text-[22px] min-[2000px]:text-4xl font-normal text-[#5C5C5C] max-w-md min-[2000px]:max-w-3xl">
          Experience seamless online ordering only on the Tattsvi App
        </p>
        <div class="flex flex-wrap gap-4 mt-2">
          <img src="assets/ioslogo.png"
            class="h-[45px] md:h-[55px] min-[2000px]:h-[100px] w-auto object-contain cursor-pointer transition-transform hover:scale-105"
            alt="Download on App Store">
          <img src="assets/Androidelogo.png"
            class="h-[45px] md:h-[55px] min-[2000px]:h-[100px] w-auto object-contain cursor-pointer transition-transform hover:scale-105"
            alt="Get it on Google Play">
        </div>
      </div>

      <!-- Right Side: Mobile QR Image -->
      <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-10 md:mt-0 relative">
        <img src="assets/MobileQr.png" class="w-[80%] md:w-[400px] md:h-[300px] lg:w-[450px] object-contain"
          alt="Mobile App with QR Code">
      </div>
    </div>
  </section>


  <!-- Know More Section -->
  <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
    <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
  </div>




  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (typeof initHomeInteractive === 'function') {
        initHomeInteractive(
                                                                                              {{isset($middleBanners) ? $middleBanners->count() : 0 }},
          @json($categories),
          "{{ url('storage') }}",
          "{{ asset('') }}"
        );
      } else {
        console.warn('initHomeInteractive function not found. Ensure script.js is loaded.');
      }

      // Auto-scroll for Diamond Shapes
      const shapeContainer = document.getElementById('diamond-shapes-container');
      if (shapeContainer) {
        const originalContent = Array.from(shapeContainer.children);

        // Clone content to ensure seamless scrolling (x3 for safety)
        for (let i = 0; i < 2; i++) {
          originalContent.forEach(item => shapeContainer.appendChild(item.cloneNode(true)));
        }

        // Auto-scroll logic
        let scrollAmount = 0;
        const speed = 0.5;
        let isHovered = false;

        const pause = () => isHovered = true;
        const resume = () => isHovered = false;

        shapeContainer.addEventListener('mouseenter', pause);
        shapeContainer.addEventListener('mouseleave', resume);
        shapeContainer.addEventListener('touchstart', pause);
        shapeContainer.addEventListener('touchend', resume);

        // Animation Loop
        function animateScroll() {
          if (!isHovered && shapeContainer.scrollWidth > shapeContainer.clientWidth) {
            scrollAmount += speed;

            if (scrollAmount >= (shapeContainer.scrollWidth / 3)) {
              scrollAmount = 0;
            }
            shapeContainer.scrollLeft = scrollAmount;
          } else {
            scrollAmount = shapeContainer.scrollLeft;
          }
          requestAnimationFrame(animateScroll);
        }
        animateScroll();
      }

      // Continuous Auto-Scroll for Unique Style Slider
      const uniqueSlider = document.getElementById('uniqueStyleSlider');
      if (uniqueSlider) {
        // Clone content for seamless loop (x3 to be safe)
        const uniqueContent = Array.from(uniqueSlider.children);
        for (let i = 0; i < 2; i++) {
          uniqueContent.forEach(item => uniqueSlider.appendChild(item.cloneNode(true)));
        }

        let uniqueScrollAmount = 0;
        const uniqueSpeed = 0.8; // Slightly faster or adjustable
        let uniqueHovered = false;

        const pauseUnique = () => uniqueHovered = true;
        const resumeUnique = () => uniqueHovered = false;

        uniqueSlider.addEventListener('mouseenter', pauseUnique);
        uniqueSlider.addEventListener('mouseleave', resumeUnique);
        uniqueSlider.addEventListener('touchstart', pauseUnique);
        uniqueSlider.addEventListener('touchend', resumeUnique);

        function animateUniqueScroll() {
          if (!uniqueHovered && uniqueSlider.scrollWidth > uniqueSlider.clientWidth) {
            uniqueScrollAmount += uniqueSpeed;
            // Reset when we've scrolled past the first set (approx 1/3 of total cloned width)
            if (uniqueScrollAmount >= (uniqueSlider.scrollWidth / 3)) {
              uniqueScrollAmount = 0;
            }
            uniqueSlider.scrollLeft = uniqueScrollAmount;
          } else {
            // Sync scroll amount if user manually scrolled
            uniqueScrollAmount = uniqueSlider.scrollLeft;
          }
          requestAnimationFrame(animateUniqueScroll);
        }
        animateUniqueScroll();
      }

      // Testimonial Slider Navigation
      window.scrollSlider = function (direction) {
        const slider = document.getElementById('testimonialSlider');
        if (slider) {
          const scrollAmount = slider.offsetWidth; // Scroll one full width
          if (direction === 'left') {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
          } else {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
          }
        }
      };

    });
  </script>
@endsection