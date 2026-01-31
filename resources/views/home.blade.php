@extends('layouts.master')

@section('content')

  @php
    $firstCategory = $categories->first();
  @endphp

  {{-- HERO SECTION AND COLLECTIONS --}}
  <section>
    <!-- Product Image -->
    <div class="relative w-full h-full mx-auto overflow-hidden">
      <div id="slides" class="whitespace-nowrap transition-transform duration-500">
        @if(isset($banners) && $banners->count() > 0)
          @foreach($banners as $banner)
            <div class="inline-block w-full">
              <img src="{{ asset('storage/' . $banner->image) }}" class="w-full h-[250px] md:h-[600px] object-cover"
                alt="{{ $banner->title }}">
            </div>
          @endforeach
        @else
          <!-- Fallback Static Slides -->
          <div class="inline-block w-full">
            <img src="assets/banner.png" class="w-full h-[250px] md:h-[600px] object-cover" alt="Slide 1">
          </div>
          <div class="inline-block w-full">
            <img src="assets/banner.png" class="w-full h-[250px] md:h-[600px] object-cover" alt="Slide 2">
          </div>
          <div class="inline-block w-full">
            <img src="assets/Top Banner Section.png" class="w-full h-[250px] md:h-[600px] object-cover" alt="Slide 3">
          </div>
        @endif
      </div>

      <!-- Dots navigation -->
      <div id="dots" class="absolute bottom-4 right-0 transform -translate-x-1/2 flex gap-2">
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
        @endif
      </div>
    </div>
  </section>

  <section class="pt-8 pb-2 md:pt-20 md:pb-4 max-w-7xl mx-auto">
    <div class="flex items-center justify-center gap-2 md:gap-6 mb-6 md:mb-10 w-full">
      <!-- Left Arrow -->
      <img src="assets/Design.png" alt="Decoration" class="h-5 md:h-8 object-contain">

      <!-- Text Group -->
      <div class="flex flex-col items-center justify-center -space-y-1 md:-space-y-2">
        <!-- Premium -->
        <span
          class="font-['Alexandria'] font-normal text-[16px] md:text-[24px] text-[#5C4522] leading-tight text-center z-10 relative">
          Premium
        </span>
        <!-- Collection -->
        <span
          class="font-['Outfit'] font-medium text-[32px] md:text-[54px] text-[#CBA65A] leading-tight md:leading-[68px] text-center">
          Collection
        </span>
      </div>

      <!-- Right Arrow -->
      <img src="assets/DesignRight.png" alt="Decoration" class="h-5 md:h-8 object-contain">
    </div>

    <div class=" items-center group/nav">
      <div id="jewellerySlider" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth snap-x snap-mandatory">
        @if(isset($categories) && $categories->count() > 0)
          @foreach($categories as $category)
            <div class="min-w-[200px] md:min-w-[210px] snap-start group">
              <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
                <!-- Star Icon -->
                <div
                  class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
                  ✦
                </div>

                <div class="w-full h-full rounded-[999px] overflow-hidden relative">
                  <img src="{{ $category->image_url ?? 'assets/premium_c1.png' }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                  <!-- Vertical Line -->
                  <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
                  </div>

                  <!-- Pill -->
                  <div
                    class="absolute bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-6 py-1.5 rounded-full text-[14px] font-bold tracking-widest  group-hover:hidden transition-colors whitespace-nowrap">
                    {{ $category->name }}
                  </div>
                  <!-- Hover Overlay & Button -->
                  <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <button
                      class="flex bg-white items-center gap-2 px-6 py-2 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                      <img src="assets/share_icon.png" class="w-4 h-4" alt="">
                      <span class="text-[12px] font-bold tracking-widest ">View More</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <!-- Fallback Static Items if no data -->
          <div class="min-w-[200px] md:min-w-[210px] snap-start group">
            <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
              <div
                class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
                ✦</div>
              <div class="w-full h-full rounded-[999px] overflow-hidden relative">
                <img src="assets/premium_c1.png"
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div
                  class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
                </div>
                <div
                  class="absolute bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-6 py-1.5 rounded-full text-[14px] font-bold tracking-widest  group-hover:hidden transition-colors">
                  Rings</div>
                <div
                  class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                  <button
                    class="flex bg-white items-center gap-2 px-6 py-2 border border-[#5C4522] rounded-full text-[#5C4522] transition-all duration-300 group">
                    <img src="assets/share_icon.png" class="w-4 h-4" alt=""><span
                      class="text-[12px] font-bold tracking-widest ">View More</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>

      <div class="flex items-center justify-between mt-4">
        <div class="flex items-center gap-3">
          <span id="slideIndex" class="text-sm font-bold text-gray-900 transition-all">01</span>
          <span class="h-[1px] w-12 bg-gray-300"></span>
          <span class="text-sm font-medium text-gray-400">04</span>
        </div>

        <div class="flex gap-4">
          <button onclick="slide('left')"
            class="w-11 h-11 rounded-full border border-gray-200 flex items-center justify-center text-bronze hover:bg-bronze hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button onclick="slide('right')"
            class="w-11 h-11 rounded-full border border-gray-200 flex items-center justify-center text-bronze hover:bg-bronze hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white pt-4 pb-8 md:pt-4 md:pb-16 px-14">
    <div class="max-w-7xl mx-auto">

      <div class="flex items-center justify-center mb-6 md:mb-10 gap-2 md:gap-6">
        <img src="assets/Design.png" alt="design left" class="h-5 md:h-8 w-auto object-contain">
        <div class="text-center">
          <p class="text-[16px] md:text-2xl font-Alexandria tracking-[0.1em] text-[#5C4522] mb-1">Find your
          </p>
          <h2 class="font-Outfit text-[32px] md:text-[54px] font-medium text-[#CBA65A] whitespace-nowrap leading-tight">
            Perfect Shape</h2>
        </div>
        <img src="assets/DesignRight.png" alt="design right" class="h-5 md:h-8 w-auto object-contain">
      </div>
      <!-- All  shape -->
      <div class="grid grid-cols-2 items-center sm:grid-cols-5 lg:grid-cols-10 gap-y-10 gap-x-4">
        @if(isset($shapes) && $shapes->count() > 0)
          @foreach($shapes as $shape)
            <div class="flex flex-col items-center group cursor-pointer gap-4">
              <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
                <img src="{{ asset('storage/' . $shape->image) }}" alt="{{ $shape->name }}"
                  class="w-full h-full object-contain grayscale reflection-img">
              </div>
              <span
                class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">{{ $shape->name }}</span>
            </div>
          @endforeach
        @else
          <!-- Round shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/round_shape.png" alt="Round" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Round</span>
          </div>
          <!-- Oval shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-15 h-15 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/oval_shape.png" alt="Oval" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Oval</span>
          </div>
          <!-- Princess shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/princess_shape.png" alt="Princess"
                class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Princess</span>
          </div>
          <!-- Emerald shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/embral.png" alt="Emerald" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Emerald</span>
          </div>
          <!-- Radiant shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/radiant.png" alt="Radiant" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px]  font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Radiant</span>
          </div>
          <!-- Heart shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/heart.png" alt="Heart" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest group-hover:text-black transition-colors group-hover:order-first">Heart</span>
          </div>
          <!-- Cushion shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/cushion.png" alt="Cushion" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px]  font-Outfit group-hover:text-black transition-colors group-hover:order-first">Cushion</span>
          </div>
          <!-- Pear shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/pear.png" alt="Pear" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Pear</span>
          </div>
          <!-- Marquise shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/marquies.png" alt="Marquise" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Marquise</span>
          </div>
          <!-- Asscher shape -->
          <div class="flex flex-col items-center group cursor-pointer gap-4">
            <div class="w-30 h-30 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/asscher.png" alt="Asscher" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] font-Outfit tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Asscher</span>
          </div>
        @endif
      </div>
    </div>
  </section>

  <section class="bg-[#FAF9F6] pt-12 pb-8 md:pt-28 md:pb-16 px-14">
    <div class="max-w-7xl mx-auto">

      <div class="flex items-center justify-center mb-6 md:mb-8 gap-2 md:gap-6">
        <img src="assets/Design.png" alt="design left" class="h-5 md:h-8 w-auto object-contain">
        <div class="text-center">
          <p class="text-[16px] md:text-2xl font-Alexandria tracking-[0.1em] text-[#5C4522] mb-1">Explore by
          </p>
          <h2 class="font-Outfit text-[32px] md:text-[54px] font-medium text-[#CBA65A] whitespace-nowrap leading-tight">
            Category</h2>
        </div>
        <img src="assets/DesignRight.png" alt="design right" class="h-5 md:h-8 w-auto object-contain">
      </div>

      <!-- Category Buttons: Horizontal Scroll on Mobile -->
      <!-- Category Buttons: Horizontal Scroll on Mobile -->
      <div class="flex flex-nowrap justify-start overflow-x-auto no-scrollbar gap-3 mb-8 w-full md:mb-12 snap-x">
        <button onclick="filterProducts('all', this)"
          class="category-btn active flex-shrink-0 px-6 py-2 md:px-10 md:py-2 font-['Outfit'] md:gap-0 bg-black text-white border border-gray-200 text-xs md:text-sm tracking-widest rounded-full hover:bg-black hover:text-white snap-center transition-colors whitespace-nowrap"
          data-id="all">All</button>

        @foreach($categories as $category)
          <button onclick="filterProducts('{{ $category->id }}', this)"
            class="category-btn flex-shrink-0 px-6 py-2 md:px-8 md:py-2 font-['Outfit'] md:gap-0 bg-gray-100 border border-gray-200 hover:text-white text-xs md:text-sm tracking-widest rounded-full hover:bg-black snap-center transition-colors whitespace-nowrap"
            data-id="{{ $category->id }}">{{ $category->name }}</button>
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

          if (btn) {
            btn.classList.remove('bg-gray-100', 'text-black');
            btn.classList.add('bg-black', 'text-white');

            // Scroll removed to prevent page jumping
            /*
            try {
              btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } catch (e) { }
            */
          }

          console.log('Fetching products for category:', categoryId);

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
              })
              .catch(error => {
                console.error('Error fetching products:', error);
                productGrid.style.opacity = '1';
              });
          }
        }
        window.filterProducts = filterProducts;
      </script>

      <!---category image 1-->
      <div id="product-grid" class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-6 mb-12 transition-opacity duration-300">
        @include('partials.home_products')
      </div>

      <div class="flex justify-center">
        <a href="{{ route('products.index') }}"
          class="border border-[#A87E3E] font-['outfit']  text-[#A87E3E] py-2 p-3 rounded-full text-[11px] tracking-widest flex items-center gap-3 hover:bg-gray-50 transition-colors group">
          Explore All
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </a>
      </div>
    </div>
  </section>
  <!--Banner Section-->
  <section>
    <!-- Product Image -->
    <div class="relative w-full h-full mx-auto overflow-hidden">
      <div id="slides1" class="whitespace-nowrap transition-transform duration-500">
        @if(isset($middleBanners) && $middleBanners->count() > 0)
          @foreach($middleBanners as $banner)
            <div class="inline-block w-full text-center relative">
              <img src="{{ url('storage/' . $banner->image) }}" class="w-full h-[250px] md:h-[600px] object-cover"
                alt="{{ $banner->title }}">
            </div>
          @endforeach
        @else
          <!-- Fallback Static Section if no active middle banners -->
          <div class="inline-block w-full">
            <img src="assets/banner.png" class="w-full h-[250px] md:h-[600px] object-cover" alt="Slide 1">
          </div>
        @endif
      </div>

      <!-- Dots navigation -->
      @if(isset($middleBanners) && $middleBanners->count() > 1)
        <div id="dots1" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
          @foreach($middleBanners as $index => $banner)
            <button
              class="w-8 h-1 rounded-[1px] {{ $index == 0 ? 'bg-white' : 'bg-white/50' }} hover:bg-white transition-all duration-300"
              onclick="goToSlide1({{ $index }})" aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
        </div>
      @endif
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
    <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <!-- 
                            <div
                                class="relative w-[910px] h-[700px] flex flex-col items-start py-[120px] px-0 gap-[10px] self-stretch grow flex-none order-0">
                                -->
        <div class="relative w-full md:w-1/2 lg:w-[50%] h-auto lg:min-h-[700px] flex flex-col items-center lg:items-start py-10 lg:py-[120px] px-4 lg:px-0 gap-6 lg:gap-[10px]
                                    self-stretch grow flex-none order-0 lg:-translate-x-12">

          <!-- Content Frame -->
          <div
            class="flex flex-col md:flex-row items-center justify-center lg:justify-start gap-4 md:gap-[10px] w-full h-auto mb-2">
            <!-- Design Frame (Left Line) -->
            <div class="hidden md:flex flex-row justify-end items-center gap-[4px] w-auto flex-1 h-[24px]">
              <img src="assets/Design_new.png" alt="design" class="h-full object-contain">
            </div>

            <!-- Mobile Design Line (Top) -->
            <div class="md:hidden w-[100px] h-[2px] bg-[#CBA65A] mb-2"></div>

            <!-- Text Frame -->
            <div class="flex flex-col justify-center items-center px-2 w-auto h-auto">
              <p style="font-family: 'Alexandria'"
                class="font-normal text-xl md:text-[24px] min-[2000px]:text-4xl leading-tight text-center text-[#5C4522] mb-1">
                Explore by</p>
              <h2 style="font-family: 'Outfit'"
                class="font-medium text-4xl md:text-[54px] min-[2000px]:text-[80px] leading-tight text-[#CBA65A] text-center">
                Category</h2>
            </div>

            <!-- Mobile Design Line (Bottom) -->
            <div class="md:hidden w-[100px] h-[2px] bg-[#CBA65A] mt-2"></div>
          </div>

          <!-- Description -->
          <div class="pl-0 lg:pl-[310px] w-full text-center lg:text-left mt-4 lg:mt-0">
            <p style="font-family: 'Outfit'"
              class="font-normal text-base md:text-[18px] min-[2000px]:text-2xl leading-relaxed md:leading-[35px] text-[#3D3D42] max-w-lg mx-auto lg:mx-0">
              Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are
              subtle yet elegant.
            </p>
          </div>
        </div>

        <div
          class="relative w-full md:w-1/2 lg:w-[50%] h-auto lg:h-[700px] flex flex-col justify-start items-center lg:items-end pt-10 lg:pt-0 px-0 lg:pl-[20px] gap-[1px] grow flex-none order-1">
          <div class="relative group translate-x-0 lg:translate-x-0">

            <button onclick="changeSlide('prev')"
              class="absolute left-0 md:-left-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#EAD8A6] border border-amber-100 flex items-center justify-center text-amber-800 shadow-xl hover:bg-amber-50 transition-all active:scale-90">
              <i class="fa-solid fa-angle-left"></i>
            </button>

            <div
              class="relative w-full max-w-[400px] h-[500px] lg:h-[600px] bg-white rounded-b-full border-[10px] border-white shadow-2xl overflow-hidden mx-auto">
              <img id="mainCatImg" src="assets/Rectangle_sidebar.png"
                class="w-full h-full object-cover transition-opacity duration-500" alt="Category">

              <div class="absolute bottom-16 left-0 w-full text-center">
                <span id="mainCatTitle"
                  class="bg-white/90 backdrop-blur-md px-8 py-2.5 min-[2000px]:px-12 min-[2000px]:py-4 rounded-full text-amber-900 font-serif italic min-[2000px]:text-4xl shadow-sm border border-amber-50 tracking-wide">Rings</span>
              </div>
            </div>

            <button onclick="changeSlide('next')"
              class="absolute right-0 md:-right-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#EAD8A6] border border-amber-100 flex items-center justify-center text-amber-800 shadow-xl hover:bg-amber-50 transition-all active:scale-90">
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
    <div id="productsliderGrid" class="grid grid-cols-2 bg-[#F3E5E5] lg:grid-cols-5 gap-2 md:gap-3 mb-12">
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
                <!-- Dynamic Image with Fallback -->
                <img src="{{ $product->images->first()->url ?? 'assets/ring_2.png' }}" alt="{{ $product->name }}"
                  class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                <img src="{{ $product->images->skip(1)->first()->url ?? 'assets/hover_image_p.png' }}"
                  class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
              </div>
            </div>
            <div class="text-center font-['Outfit']">
              <!-- Dynamic Name -->
              <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">{{ $product->name }}</h3>
              <div class="flex items-center justify-center gap-2 text-xs">
                <!-- Dynamic Price -->
                <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ {{ number_format($product->price, 2) }}</span>
                <!-- Dummy Original Price Logic (e.g. +20%) -->
                <span class="text-[#999999] line-through">₹ {{ number_format($product->price * 1.2, 2) }}</span>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
    </div>

    <div class="flex justify-center">
      <a href="{{ route('products.index') }}"
        class="flex flex-row justify-center items-center px-4 py-2 md:px-[26px] gap-2 md:gap-[10px] w-auto md:w-[194px] h-[45px] md:h-[60px] bg-white border-[1.8px] border-[#A87E3E] rounded-[200px] text-[#A87E3E] font-['Outfit'] font-normal text-[16px] md:text-[22px] leading-tight hover:bg-gray-50 transition-colors group">
        Explore All
        <img src="assets/ic_back_2.png" alt="arrow"
          class="w-3 h-3 md:w-4 md:h-4 object-contain group-hover:translate-x-1 transition-transform">
      </a>
    </div>
    </div>
    </section>

    <section class="py-8 md:py-16 bg-silk/30 text-center overflow-hidden relative w-full max-w-[100vw]">
      <div class="flex items-center justify-center mb-6 md:mb-10 gap-3 md:gap-6">
        <!-- Left Design -->
        <div class="hidden md:flex flex-row justify-end items-center pl-[40px] gap-[4px] w-full max-w-[398px] h-[24px]">
          <img src="assets/Design_new.png" alt="design left" class="h-full object-contain">
        </div>

        <!-- Center Text -->
        <div
          class="flex flex-col justify-center items-center px-[10px] w-auto md:w-[431px] h-auto md:h-[120px] rounded-[10px]">
          <span
            class="bg-[#C34A37] text-white text-base md:text-[24px] px-6 py-2 rounded-full font-Alexandria font-normal mb-2">
            This Is New
          </span>
          <h2 style="font-family: 'Outfit', sans-serif;"
            class="font-medium text-3xl md:text-[54px] leading-tight text-[#CBA65A] text-center whitespace-nowrap">
            Launch Jewellery
          </h2>
        </div>

        <!-- Right Design -->
        <div class="hidden md:flex flex-row justify-start items-center pr-[40px] gap-[4px] w-full max-w-[398px] h-[24px]">
          <img src="assets/Design_new.png" alt="design right" class="h-full object-contain transform scale-x-[-1]">
        </div>
      </div>

      <div class="relative w-full max-w-7xl mx-auto px-4 md:px-8 mb-0 md:mb-20 group-container">
        <!-- Background Ellipse -->
        <div
          class="absolute top-[60%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[2416px] h-[1138px] max-w-none bg-[#FDFBF7] rounded-[50%] -z-10 blur-xl pointer-events-none">
        </div>

        <!-- Product Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10 group-hover:scale-110">
          <!--launch section product 1-->
          <div class="flex flex-col gap-0 group cursor-pointer px-4">
            <!-- Main Card -->
            <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden">
              <img src="assets/launch_ring.png"
                class="relative z-0 w-full h-full object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
                alt="Rings">

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; left: 0px; top: 275px; z-index: 20;" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; right: 0px; top: 275px; transform: scaleX(-1); z-index: 20;"
                alt="curve right">

              <!-- SVG Shape -->
              <div class="absolute bottom-0 left-0 overflow-hidden  w-full h-auto z-10 pointer-events-none">
                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="w-full overflow-hidden h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_ring_launch)" />
                  <path
                    d="M350.5 189C350.5 205.292 337.292 218.5 321 218.5H30C13.7076 218.5 0.5 205.292 0.5 189V20.826172C110 75.8557 241 75.8557 350.5 20.818359V189Z"
                    stroke="#D8B1B6" stroke-opacity="0.2" />
                  <defs>
                    <linearGradient id="paint_ring_launch" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>

              </div>

              <!-- Text -->
              <div class="absolute bottom-5 w-full text-center z-20">
                <p class="font-Outfit text-sm text-[#5C4522] mb-1">9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl font-medium text-[#5C4522]">Rings</h3>
              </div>
            </div>
            <!-- Reflection -->
            <div
              class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-16 pointer-events-none mask-image-b-to-t">
              <img src="assets/launch_ring.png" class="relative w-[] h-full object-contain object-bottom"
                alt="Rings Reflection">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10">

                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_ring_launch_ref)" />
                  <defs>
                    <linearGradient id="paint_ring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
          </div>
          <!--launch section product 2-->
          <div class="flex flex-col gap-0 group cursor-pointer px-4">
            <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden">
              <img src="assets/launch_pendant.png"
                class="relative z-0 w-full h-full object-cover object-bottom transition-transform duration-500 group-hover:scale-110 drop-shadow-lg"
                alt="Pendants">

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 32px; height: 21px; left: 0px; top: 275px; z-index: 20;" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 32px; height: 21px; right: 0px; top: 275px; transform: scaleX(-1); z-index: 20;"
                alt="curve right">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10 pointer-events-none">
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 left-0">
                  <path
                    d="M4.5 19.8389L0 0.838867L4.36339 0.317865C12.4683 -0.649886 20.6838 0.605068 28.1302 3.94834L29 4.33887L4.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 right-0">
                  <path
                    d="M24.5 19.8389L29 0.838867L24.6366 0.317865C16.5317 -0.649886 8.31619 0.605068 0.869804 3.94834L0 4.33887L24.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_pendant_launch)" />
                  <path
                    d="M350.5 189C350.5 205.292 337.292 218.5 321 218.5H30C13.7076 218.5 0.5 205.292 0.5 189V20.826172C110 75.8557 241 75.8557 350.5 20.818359V189Z"
                    stroke="#D8B1B6" stroke-opacity="0.2" />
                  <defs>
                    <linearGradient id="paint_pendant_launch" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
              <div class="absolute bottom-5 w-full text-center z-20">
                <p class="font-Outfit text-sm text-[#5C4522] mb-1">9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl font-medium text-[#5C4522]">Pendants</h3>
              </div>
            </div>
            <div
              class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-16 pointer-events-none">
              <img src="assets/launch_pendant.png" class="relative z-0 w-full h-full object-cover object-bottom"
                alt="Pendants Reflection">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10">
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 left-0">
                  <path
                    d="M4.5 19.8389L0 0.838867L4.36339 0.317865C12.4683 -0.649886 20.6838 0.605068 28.1302 3.94834L29 4.33887L4.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 right-0">
                  <path
                    d="M24.5 19.8389L29 0.838867L24.6366 0.317865C16.5317 -0.649886 8.31619 0.605068 0.869804 3.94834L0 4.33887L24.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_pendant_launch_ref)" />
                  <defs>
                    <linearGradient id="paint_pendant_launch_ref" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-0 group cursor-pointer px-4">
            <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden">
              <img src="assets/launch_bracelet.png"
                class="relative z-0 w-full h-full object-cover object-bottom transition-transform duration-500 group-hover:scale-110 drop-shadow-lg"
                alt="Bracelets">

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; left: 0px; top: 275px; z-index: 20;" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; right: 0px; top: 275px; transform: scaleX(-1); z-index: 20;"
                alt="curve right">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10 pointer-events-none">

                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_bracelet_launch)" />
                  <path
                    d="M350.5 189C350.5 205.292 337.292 218.5 321 218.5H30C13.7076 218.5 0.5 205.292 0.5 189V20.826172C110 75.8557 241 75.8557 350.5 20.818359V189Z"
                    stroke="#D8B1B6" stroke-opacity="0.2" />
                  <defs>
                    <linearGradient id="paint_bracelet_launch" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
              <div class="absolute bottom-5 w-full text-center z-20">
                <p class="font-Outfit text-sm text-[#5C4522] mb-1">9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl font-medium text-[#5C4522]">Bracelets</h3>
              </div>
            </div>
            <div
              class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-16 pointer-events-none">
              <img src="assets/launch_bracelet.png" class="relative z-0 w-full h-full object-cover object-bottom"
                alt="Bracelets Reflection">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10">
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 left-0">
                  <path
                    d="M4.5 19.8389L0 0.838867L4.36339 0.317865C12.4683 -0.649886 20.6838 0.605068 28.1302 3.94834L29 4.33887L4.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 right-0">
                  <path
                    d="M24.5 19.8389L29 0.838867L24.6366 0.317865C16.5317 -0.649886 8.31619 0.605068 0.869804 3.94834L0 4.33887L24.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_bracelet_launch_ref)" />
                  <defs>
                    <linearGradient id="paint_bracelet_launch_ref" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
          </div>
          <!--launch section product 3-->
          <div class="flex flex-col gap-0 group cursor-pointer px-4">
            <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden">
              <img src="assets/launch_earring.png"
                class="relative z-0 w-full h-full object-cover object-bottom transition-transform duration-500 group-hover:scale-110 drop-shadow-lg"
                alt="Earrings">

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; left: 0px; top: 275px; z-index: 20;" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="position: absolute; width: 29px; height: 21px; right: 0px; top: 275px; transform: scaleX(-1); z-index: 20;"
                alt="curve right">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10 pointer-events-none">

                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_earring_launch)" />
                  <path
                    d="M350.5 189C350.5 205.292 337.292 218.5 321 218.5H30C13.7076 218.5 0.5 205.292 0.5 189V20.826172C110 75.8557 241 75.8557 350.5 20.818359V189Z"
                    stroke="#D8B1B6" stroke-opacity="0.2" />
                  <defs>
                    <linearGradient id="paint_earring_launch" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
              <div class="absolute bottom-5 w-full text-center z-20">
                <p class="font-Outfit text-sm text-[#5C4522] mb-1">9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl font-medium text-[#5C4522]">Earrings</h3>
              </div>
            </div>
            <div
              class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-16 pointer-events-none">
              <img src="assets/launch_earring.png" class="relative z-0 w-full h-full object-cover object-bottom"
                alt="Earrings Reflection">
              <div class="absolute bottom-0 left-0 w-full h-auto z-10">
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 left-0">
                  <path
                    d="M4.5 19.8389L0 0.838867L4.36339 0.317865C12.4683 -0.649886 20.6838 0.605068 28.1302 3.94834L29 4.33887L4.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" class="absolute top-0 right-0">
                  <path
                    d="M24.5 19.8389L29 0.838867L24.6366 0.317865C16.5317 -0.649886 8.31619 0.605068 0.869804 3.94834L0 4.33887L24.5 19.8389Z"
                    fill="#F0D194" />
                </svg>
                <svg viewBox="0 0 351 219" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                  <path
                    d="M0 20C110 75 241 75 351 20V189C351 205.569 337.569 219 321 219H30C13.4315 219 0 205.569 0 189V20Z"
                    fill="url(#paint_earring_launch_ref)" />
                  <defs>
                    <linearGradient id="paint_earring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="219"
                      gradientUnits="userSpaceOnUse">
                      <stop stop-color="#FFF6E3" />
                      <stop offset="1" stop-color="#E8C889" />
                    </linearGradient>
                  </defs>
                </svg>
              </div>
            </div>
          </div>
          <!--launch section product 3-->
        </div>


      </div>
    </section>

    <!-- Unique Style Section -->
    <section class="bg-white pt-0 pb-8 md:pt-16 md:pb-0 overflow-hidden relative w-full max-w-[100vw]">
      <!-- Title -->
      <div class="text-center mb-0 relative z-30">
        <div class="flex items-center justify-center gap-1 md:gap-4 mb-2">
          <img src="assets/Design_new.png" class="h-3 md:h-5 w-auto object-contain" alt="decoration">
          <span style="font-family: 'Alexandria', sans-serif;"
            class="font-Alexandria text-[#5C4522] text-sm md:text-2xl tracking-normal font-normal whitespace-nowrap">Express
            Your Identity with</span>
          <img src="assets/Design_new.png" class="h-3 md:h-5 w-auto object-contain transform scale-x-[-1]" alt="decoration">
        </div>
        <h2 style="font-family: 'Outfit', sans-serif;"
          class="font-Outfit text-[#CBA65A] text-3xl md:text-[54px] font-medium leading-tight">Our Unique Style
        </h2>
      </div>

      <!-- Lens Grid Wrapper -->
      <div class="relative w-full h-[350px] md:h-[500px] lg:h-[850px] z-10 -mt-8 md:-mt-48">
        <!-- Top Curve Mask (White) -->
        <div
          class="absolute -top-[100px] md:-top-[698px] left-1/2 -translate-x-1/2 w-[120%] md:w-[2416px] h-[150px] md:h-[918px] max-w-none bg-white rounded-b-[100%] md:rounded-b-[50%] z-20 pointer-events-none">
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
            class="h-full w-full flex gap-1 md:gap-5 overflow-x-auto snap-x snap-mandatory no-scrollbar bg-white">
            <!-- Original Items -->
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq1.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq2.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq3.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq4.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>

            <!-- Duplicated Items for continuous feel -->
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq1.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">

            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq2.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq3.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
            <div
              class="relative min-w-[50%] lg:min-w-[25%] h-full bg-black overflow-hidden group cursor-pointer snap-start">
              <img src="assets/Uniq4.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
            </div>
          </div>
        </div>

        <!-- Bottom Curve Mask (White) -->
        <div
          class="absolute -bottom-[100px] md:-bottom-[698px] left-1/2 -translate-x-1/2 w-[120%] md:w-[2416px] h-[150px] md:h-[918px] max-w-none bg-white rounded-t-[100%] md:rounded-t-[50%] z-20 pointer-events-none">
        </div>
      </div>

      <!-- Button -->
      <div class="absolute bottom-4 md:bottom-[60px] left-1/2 -translate-x-1/2 z-30">
        <button
          class="w-[150px] h-[45px] md:w-[195px] md:h-[60px] bg-[#0D0D0E] text-white hover:bg-gray-800 rounded-[200px] font-Outfit tracking-widest text-xs md:text-sm transition-all flex items-center justify-center gap-[10px] group shadow-lg px-[26px]">
          View More
          <img src="assets/ic_back_2_white.png"
            class="h-3 md:h-4 w-auto transform group-hover:translate-x-1 transition-transform" alt="arrow">
        </button>
      </div>

      <!-- Background Ellipse (Bottom) -->
      <div
        class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 w-[140%] h-[800px] bg-[#FDFBF7] rounded-[50%] z-0 blur-xl pointer-events-none">
      </div>
    </section>

    <!--Best Seller Section -->
    <section
      class="relative w-full flex justify-center  items-center py-[40px] px-4 md:px-[40px] gap-[20px] z-10 overflow-hidden bg-[#FDFBF7]">

      <!-- Ellipse Background -->
      <div
        style="position: absolute; width: 100%; height: 100%; left: 0; top: 0; background: radial-gradient(50% 50% at 50% 50%, #F3EAD8 0%, #FDFBF7 100%); pointer-events: none; z-index: 0;">
      </div>

      <div class="relative z-20 max-w-[1440px]  w-full mx-auto">
        <div class="flex flex-col lg:flex-row items-center justify-center gap-[60px] w-full h-auto py-0">

          <!-- Left Image -->
          <div
            class="flex-1 flex justify-center border:shadow-lg items-center relative w-full h-full order-first lg:order-none lg:-translate-x-12">
            <img src="assets/Product Photo.png"
              class="w-full max-w-[400px] lg:max-w-[500px] h-auto object-contain hover:scale-105 transition-transform duration-500"
              alt="Bestseller Spotlight">
          </div>

          <!-- Right Content -->
          <div class="flex-1 flex flex-col  justify-center space-y-8 lg:pl-10">
            <div class="text-center lg:text-left xl:text-center">
              <h2 class="font-['Alexandria'] text-[#0D0D0E] text-4xl md:text-[44px] font-normal leading-tight mb-2">
                Tattsvi Bestseller</h2>
              <p class="font-['Outfit'] text-[#0D0D0E] text-xl md:text-[24px] font-normal tracking-normal leading-tight">
                Jewellery that defines choice, elegance and trust</p>
            </div>

            <div class="space-y-6 max-w-lg mx-auto lg:mx-0 xl:mx-auto">
              <!-- Feature 1 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png" class="w-8 h-8 md:w-10 md:h-10 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit text-[18px] md:text-[20px] font-semibold text-[#0D0D0E] leading-tight mb-1">
                    Interwoven Gold Ring</h4>
                  <p style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit font-light text-[14px] md:text-[15px] text-[#5C5C5C] leading-snug">
                    A Signature Design Crafted For Everyday Elegance</p>
                </div>
              </div>

              <!-- Feature 2 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png" class="w-8 h-8 md:w-10 md:h-10 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit text-[18px] md:text-[20px] font-semibold text-[#0D0D0E] leading-tight mb-1">
                    Transparent & Fair Pricing</h4>
                  <p style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit font-light text-[14px] md:text-[15px] text-[#5C5C5C] leading-snug">
                    Value That Reflect Purity, Craftsmanship And Trust</p>
                </div>
              </div>

              <!-- Feature 3 -->
              <div class="flex items-center gap-5">
                <div
                  class="w-[60px] h-[60px] md:w-[60px] md:h-[60px] flex-shrink-0 bg-white rounded-[16px] flex items-center justify-center shadow-sm border border-[#F5F5F5]">
                  <img src="assets/cer1.png" class="w-8 h-8 md:w-10 md:h-10 object-contain" alt="icon">
                </div>
                <div class="text-left">
                  <h4 style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit text-[18px] md:text-[20px] font-semibold text-[#0D0D0E] leading-tight mb-1">
                    Certified Pure Gold</h4>
                  <p style="font-family: 'Outfit', sans-serif;"
                    class="font-Outfit font-light text-[14px] md:text-[15px] text-[#5C5C5C] leading-snug">
                    Hallmarked Jewellery You Can Wear With Confidence</p>
                </div>
              </div>
            </div>

            <div class="pt-10 text-center w-full flex flex-col items-center">
              <p style="font-family: 'Outfit', sans-serif;"
                class="font-Outfit font-medium text-[16px] md:text-[18px] text-[#3D3D3D] mb-6 text-center">
                Loved Beyond Trends Jewellery that continues to be chosen.</p>
              <button style="background: #CD9C56;"
                class="inline-flex items-center justify-center w-auto h-[50px] px-8 rounded-full text-white font-Outfit font-medium text-[16px] shadow-sm hover:bg-[#b38f45] transition-colors leading-tight">
                View All Bestsellers
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Flexible solutions-->
    <section class="bg-gradient-to-r from-[#FCE4EC] to-[#FFF5F6] py-8 px-4">
      <div class="max-w-[1440px] mx-auto text-center">
        <p style="font-family: 'Alexandria', sans-serif;"
          class="font-Alexandria text-[20px] md:text-[24px] font-normal text-[#5C4522] leading-[29px] text-center my-[-9px] mb-4">
          Upgrade Your Sparkle, Stress-Free</p>

        <div class="flex items-center justify-center gap-3 md:gap-4 mb-8">
          <img src="assets/Design_pink_left.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
          <h2
            class="font-Outfit text-[#B76E79] text-2xl md:text-[36px] font-medium leading-tight whitespace-normal md:whitespace-nowrap">
            Flexible
            solutions
            for your jewellery</h2>
          <img src="assets/Design_pink_right.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
        </div>

        <!-- Responsive Grid: 2 cols mobile, 3 cols tablet, 6 cols desktop -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-y-10 gap-x-4 md:gap-x-6 justify-items-center">

          <!-- Item 1 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/Frame1.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Easy 15 Day Exchange">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Easy 15 Day Exchange
            </span>
          </div>

          <!-- Item 2 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/Group.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Guaranteed Purity">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Guaranteed Purity
            </span>
          </div>

          <!-- Item 3 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/tr.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Fast & Secure Shipping">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Fast & Secure Shipping
            </span>
          </div>

          <!-- Item 4 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/cj.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Certified Jewellery">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Certified Jewellery
            </span>
          </div>

          <!-- Item 5 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/pc.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Premium Craftsmanship">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Premium Craftsmanship
            </span>
          </div>

          <!-- Item 6 -->
          <div class="flex flex-col items-center group w-full">
            <div
              class="w-28 h-28 md:w-[140px] md:h-[140px] bg-white  rounded-full flex items-center justify-center mb-2 shadow-md transition-transform group-hover:scale-110 duration-300">
              <div
                class="w-20 h-20 md:w-[140px] md:h-[140px] flex items-center justify-center bg-no-repeat bg-center bg-contain"
                style="background-image: url('assets/Cat 1.png');">
                <img src="assets/ee.png" class="h-8 w-8 md:h-12 md:w-12 object-contain" alt="Ethical & Eco-Conscious">
              </div>
            </div>
            <span
              class="text-xs md:text-[15px] font-['outfit'] tracking-tight text-center px-2 leading-tight text-rose-950">
              Ethical & Eco-Conscious
            </span>
          </div>

        </div>
      </div>
    </section>

    <section class="py-8 md:py-20 bg-white px-4 md:px-8 w-full max-w-[100vw] overflow-hidden">
      <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
          <p style="font-family: 'Alexandria', sans-serif;"
            class="font-Alexandria text-[16px] md:text-[20px] font-normal text-[#5C4522] leading-[29px] text-center my-[-5px] mb-2">
            Here From
          </p>
          <div class="flex items-center justify-center gap-3 md:gap-4">
            <img src="assets/Design.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
            <h2 style="font-family: 'Outfit', sans-serif;"
              class="font-Outfit text-[#CBA65A] text-2xl md:text-[36px] font-medium leading-tight md:leading-[48px] whitespace-nowrap">
              Our Customers
            </h2>
            <img src="assets/DesignRight.png" class="h-4 md:h-5 w-auto object-contain" alt="decoration">
          </div>
        </div>

        <div class="relative group w-full max-w-[1440px] mx-auto">
          <!-- Slider -->
          <div id="testimonialSlider"
            class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar pb-8 px-4 w-full">

            <!-- Review 1 -->
            <div
              class="w-full md:w-full lg:w-[800px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 rounded-[24px] relative flex flex-col h-auto min-h-[320px] justify-between group transition-all hover:shadow-md">
              <div class="flex items-start gap-4">
                <img src="assets/ReviewQuote.png" class="w-10 h-8 md:w-12 md:h-10 object-contain opacity-40 md:opacity-100"
                  alt="quote">
                <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg leading-relaxed mt-2">
                  Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are
                  subtle yet elegant, making them perfect for everyday styling. You can genuinely feel the
                  attention to detail in every piece."
                </p>
              </div>

              <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
                <img src="assets/client1.png" class="w-12 h-12 rounded-[10px] object-cover" alt="User">
                <div>
                  <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg">Ananya R.</h4>
                  <div class="flex gap-1 text-[#CBA65A] text-xs">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                      class="fas fa-star"></i><i class="fas fa-star"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Review 2 -->
            <div
              class="w-full md:w-full lg:w-[800px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 rounded-[24px] relative flex flex-col h-auto min-h-[320px] justify-between group transition-all hover:shadow-md">
              <div class="flex items-start gap-4">
                <img src="assets/ReviewQuote.png" class="w-10 h-8 md:w-12 md:h-10 object-contain opacity-40 md:opacity-100"
                  alt="quote">
                <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg leading-relaxed mt-2">
                  "The craftsmanship is outstanding. I bought a ring for my engagement and it looks
                  absolutely stunning. The packaging was premium and delivery was super fast. Highly
                  recommended!"
                </p>
              </div>

              <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
                <img src="assets/client1.png" class="w-12 h-12 rounded-[10px] object-cover" alt="User">
                <div>
                  <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg"> Ananya R.</h4>
                  <div class="flex gap-1 text-[#CBA65A] text-xs">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                      class="fas fa-star"></i><i class="fas fa-star"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Review 3 -->
            <div
              class="w-full md:w-full lg:w-[800px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 rounded-[24px] relative flex flex-col h-auto min-h-[320px] justify-between group transition-all hover:shadow-md">
              <div class="flex items-start gap-4">
                <img src="assets/ReviewQuote.png" class="w-10 h-8 md:w-12 md:h-10 object-contain opacity-40 md:opacity-100"
                  alt="quote">
                <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg leading-relaxed mt-2">
                  "I love how unique the collections are. It's rare to find such modern yet traditional
                  designs. Will definitely shop again!"
                </p>
              </div>

              <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
                <img src="assets/client1.png" class="w-12 h-12 rounded-[10px] object-cover" alt="User">
                <div>
                  <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg"> Ananya R.</h4>
                  <div class="flex gap-1 text-[#CBA65A] text-xs">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                      class="fas fa-star"></i><i class="fas fa-star"></i>
                  </div>
                </div>
              </div>
            </div>
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
        class="max-w-[1440px] mx-auto border-[#F2D7D3] border-[4px] bg-[#FDF2F4] rounded-[40px] overflow-hidden flex flex-col md:flex-row items-center justify-between px-6 py-6 md:px-16 md:py-10 relative">
        <!-- Left Side: Text and Buttons -->
        <div class="w-full md:w-1/2 flex flex-col items-start gap-6 z-10">
          <h2 style="font-family: 'Outfit', sans-serif;"
            class="font-Outfit text-3xl md:text-[54px] font-bold text-[#0D0D0E] leading-tight">
            Download the app now!
          </h2>
          <p style="font-family: 'Outfit', sans-serif;"
            class="font-Outfit text-base md:text-[22px] font-normal text-[#5C5C5C] max-w-md">
            Experience seamless online ordering only on the Tattsvi App
          </p>
          <div class="flex flex-wrap gap-4 mt-2">
            <img src="assets/ioslogo.png"
              class="h-[45px] md:h-[55px] w-auto object-contain cursor-pointer transition-transform hover:scale-105"
              alt="Download on App Store">
            <img src="assets/Androidelogo.png"
              class="h-[45px] md:h-[55px] w-auto object-contain cursor-pointer transition-transform hover:scale-105"
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
      // Middle Banner Slider Logic
      const slides1 = document.getElementById('slides1');
      const dots1 = document.querySelectorAll('#dots1 button');
      let currentSlide1 = 0;
      const totalSlides1 = {{ isset($middleBanners) ? $middleBanners->count() : 0 }};

      function goToSlide1(n) {
        if (totalSlides1 <= 0) return;
        currentSlide1 = (n + totalSlides1) % totalSlides1;
        slides1.style.transform = `translateX(-${currentSlide1 * 100}%)`;

        dots1.forEach((dot, index) => {
          dot.className = `w-8 h-1 rounded-[1px] transition-all duration-300 ${index === currentSlide1 ? 'bg-white' : 'bg-white/50 hover:bg-white'}`;
        });
      }

      // Auto-advance middle slider only if multiple slides exist
      if (totalSlides1 > 1) {
        setInterval(() => {
          goToSlide1(currentSlide1 + 1);
        }, 5000);
      }

      // Category Slider Logic
      const categories = @json($categories);
      let currentCatIndex = 0;
      const catImg = document.getElementById('mainCatImg');
      const catTitle = document.getElementById('mainCatTitle');
      const catDesc = document.getElementById('catDescription');
      const exploreCatTitle = document.getElementById('exploreCategoryTitle');

      function changeSlide(direction) {
        if (!categories || categories.length === 0) return;

        if (direction === 'next') {
          currentCatIndex = (currentCatIndex + 1) % categories.length;
        } else {
          currentCatIndex = (currentCatIndex - 1 + categories.length) % categories.length;
        }

        const category = categories[currentCatIndex];

        // Fade out
        catImg.style.opacity = '0';

        setTimeout(() => {
          // Update content
          if (category.image) {
            catImg.src = "{{ url('storage') }}/" + category.image;
          } else {
            catImg.src = "{{ asset('assets/Rectangle_sidebar.png') }}"; // Fallback
          }
          catTitle.textContent = category.name;
          if (catDesc) {
            catDesc.textContent = category.description || 'Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are subtle yet elegant.';
          }
          if (exploreCatTitle) {
            exploreCatTitle.textContent = category.name;
          }

          // Fade in
          catImg.style.opacity = '1';

          // Sync with product filter
          console.log('Changing category to:', category.name, 'ID:', category.id);

          if (typeof window.filterProducts === 'function') {
            window.filterProducts(category.id, null);
          } else if (typeof filterProducts === 'function') {
            filterProducts(category.id, null);
          } else {
            console.error('filterProducts function not found!');
          }
        }, 300); // Wait for transition
      }

      // Initialize with first category if exists
      if (categories.length > 0) {
        // Optional: Set initial state if not already set by server-side rendering
        // changeSlide('next'); // Just to trigger update or set manually
      }
    </script>
@endsection