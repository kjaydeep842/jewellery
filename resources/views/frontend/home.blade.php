@extends('frontend.layouts.master')


@section('content')

  @php
    $firstCategory = $categories->first();
  @endphp

  {{-- HERO SECTION AND COLLECTIONS --}}
  <section>
    <!-- Product Image -->
    <div class="relative w-full h-full mx-auto overflow-hidden">
      <div id="slides" class="grid w-full h-full overflow-hidden">

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
        <!-- Collection 1-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl min-[2000px]:text-3xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c1.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line (Visible initially) -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all">
                Rings
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522] transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                  <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest ">View
                    More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!--collection 2-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl min-[2000px]:text-3xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c2.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all">
                Earrings
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-6 py-2 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-4 h-4" alt="">
                  <span class="text-[12px] font-bold tracking-widest">View More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- collction 3-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl min-[2000px]:text-3xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c3.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all">
                Necklaces
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                  <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest">View
                    More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Collection 4-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl min-[2000px]:text-3xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c4.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all">
                Pendants
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                  <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest">View
                    More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!--Collection 5-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c1.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line (Visible initially) -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest  group-hover:hidden transition-all">
                Rings
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
        <!--collection 2-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c2.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 rounded-full text-xs md:text-sm font-bold tracking-widest group-hover:hidden transition-all">
                Earrings
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                  <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest">View
                    More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- collction 3-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c3.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>
              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 min-[2000px]:px-10 min-[2000px]:py-3 rounded-full text-xs md:text-sm min-[2000px]:text-2xl font-bold tracking-widest group-hover:hidden transition-all">
                Necklaces
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 min-[2000px]:px-10 min-[2000px]:py-4 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4 min-[2000px]:w-6 min-[2000px]:h-6" alt="">
                  <span class="text-[10px] md:text-xs min-[2000px]:text-xl font-bold tracking-widest">View
                    More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Collection 4-->
        <div
          class="min-w-[calc(50%-12px)] md:min-w-[calc(25%-18px)] lg:min-w-[calc(20%-20px)] min-[2000px]:min-w-[calc(20%-20px)] snap-start group">
          <div class="relative w-full aspect-[2/3] rounded-[999px] border border-[#C19757] p-2 md:p-3 overflow-visible">
            <!-- Star Icon -->
            <div
              class="absolute top-[9.5%] right-[14.5%] translate-x-1/2 -translate-y-1/2 text-[#C19757] text-[18px] md:text-xl z-20">
              ✦
            </div>

            <div class="w-full h-full rounded-[999px] overflow-hidden relative">
              <img src="assets/premium_c4.png"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              <!-- Vertical Line -->
              <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[2px] h-20 bg-white/70 z-10 group-hover:opacity-0 transition-opacity">
              </div>

              <!-- "Pill" (Visible initially) -->
              <div
                class="absolute bottom-12 md:bottom-20 left-1/2 -translate-x-1/2 font-['Outfit'] bg-white/90 px-4 py-1 md:px-6 md:py-1.5 rounded-full text-xs md:text-sm font-bold tracking-widest group-hover:hidden transition-all">
                Pendants
              </div>
              <!-- Hover Overlay & Button -->
              <div
                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                <button
                  class="flex bg-white items-center gap-2 px-4 py-1.5 md:px-6 md:py-2 border border-[#5C4522] rounded-full text-[#5C4522]  transition-all duration-300 group">
                  <img src="assets/share_icon.png" class="w-3 h-3 md:w-4 md:h-4" alt="">
                  <span class="text-[10px] md:text-xs font-bold tracking-widest">View More</span>
                </button>
              </div>
            </div>
          </div>
        </div>

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
      <!-- All  shape -->
      <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 items-center md:gap-8 no-scrollbar pb-4">
        @if(isset($shapes) && $shapes->count() > 0)
          @foreach($shapes as $shape)
            <div
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
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/round_shape.png" alt="Round" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Round</span>
          </div>
          <!-- Oval shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/oval_shape.png" alt="Oval" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Oval</span>
          </div>
          <!-- Princess shape -->
          <div
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
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/embral.png" alt="Emerald" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Emerald</span>
          </div>
          <!-- Radiant shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/radiant.png" alt="Radiant" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Radiant</span>
          </div>
          <!-- Heart shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/heart.png" alt="Heart" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest group-hover:text-black transition-colors group-hover:order-first">Heart</span>
          </div>
          <!-- Cushion shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/cushion.png" alt="Cushion" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] group-hover:text-black transition-colors group-hover:order-first">Cushion</span>
          </div>
          <!-- Pear shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/pear.png" alt="Pear" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Pear</span>
          </div>
          <!-- Marquise shape -->
          <div
            class="flex flex-col items-center group cursor-pointer gap-2 md:gap-4 flex-shrink-0 snap-start min-w-[28%] md:min-w-[12%]">
            <div class="w-14 h-14 md:w-28 md:h-28 transition-transform duration-300 group-hover:scale-110">
              <img src="assets/marquies.png" alt="Marquise" class="w-full h-full object-contain grayscale reflection-img">
            </div>
            <span
              class="text-[10px] min-[2000px]:text-xl font-['Outfit'] tracking-widest  group-hover:text-black transition-colors group-hover:order-first">Marquise</span>
          </div>
          <!-- Asscher shape -->
          <div
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

        function updateProductSlider(categoryId) {
          console.log('Fetching slider products for category:', categoryId);

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
              })
              .catch(error => {
                console.error('Error fetching slider products:', error);
                productSlider.style.opacity = '1';
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
      <div id="slides1" class="grid w-full h-full overflow-hidden">
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
          class="relative w-full md:w-1/2 lg:w-[50%] h-auto lg:h-[600px] flex flex-col justify-start items-center lg:items-end pt-10 lg:pt-0 px-0 lg:pl-[20px] gap-[1px] grow flex-none order-1">
          <div class="relative group translate-x-0 lg:translate-x-0">

            <button onclick="changeSlide('prev')"
              class="absolute left-0 md:-left-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#EAD8A6] border border-amber-100 flex items-center justify-center text-amber-800 shadow-xl hover:bg-amber-50 transition-all active:scale-90">
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
  <div id="productsliderGrid" class="flex overflow-x-auto no-scrollbar gap-5 mb-10 px-4 md:px-[100px]">
    @if(isset($products) && $products->count() > 0)
      @foreach($products as $product)
        <!-- Dynamic Product Item -->
        <div
          class="flex flex-col gap-3 w-[calc(50%-10px)] md:w-[calc(25%-15px)] lg:w-[calc(20%-16px)] flex-shrink-0 snap-start">
          <div
            class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
            <span
              class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
              Seller</span>
            <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute bottom-3 left-2 z-20">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button type="submit"
                class="flex bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors shadow-sm">
                <img src="{{ asset('assets/ic_wishlist1.png') }}" class="w-4 h-4" alt="Wishlist">
              </button>
            </form>
            <a href="{{ route('product.details', $product->slug) }}"
              class="w-full h-full flex items-center justify-center block">
              <!-- Dynamic Image with Fallback -->
              <img src="{{ $product->images->first()->url ?? 'assets/ring.png' }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
              <img src="{{ $product->images->skip(1)->first()->url ?? 'assets/hover_image_p.png' }}"
                class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
            </a>
          </div>
          <div class="text-center font-['Outfit'] px-2">
            <!-- Dynamic Name -->
            <h3 class="text-sm md:text-base lg:text-lg font-['outfit'] text-[#1A1A1A] mb-1 truncate w-full"
              title="{{ $product->name }}">
              <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
            </h3>
            <div class="flex flex-wrap items-center justify-center gap-2 text-xs md:text-sm lg:text-base">
              <!-- Dynamic Price -->
              <span class="font-bold font-['outfit'] text-[#1A1A1A] whitespace-nowrap">₹
                {{ number_format($product->price, 2) }}</span>
              <!-- Dummy Original Price Logic -->
              <span class="text-[#999999] line-through whitespace-nowrap">₹
                {{ number_format($product->price * 1.2, 2) }}</span>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <!-- Fallback Static Items -->
      <!--product 1 -->
      <div class="flex flex-col gap-3 w-[calc(50%-2px)] md:w-[calc(25%-3px)] lg:w-[calc(20%-4px)] flex-shrink-0">
        <div
          class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
          <span
            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
            Seller</span>
          <button
            class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
            <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
          </button>
          <div class="w-full h-full flex items-center justify-center">
            <img src="assets/ring.png" alt="Ring"
              class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
            <img src="assets/hover_image_p.png"
              class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
          </div>
        </div>
        <div class="text-center font-['Outfit']">
          <h3 class="text-sm min-[2000px]:text-2xl font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage
            Ring</h3>
          <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-xl">
            <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
            <span class="text-[#999999] line-through">₹ 949.00</span>
          </div>
        </div>
      </div>
      <!--product 2 -->
      <div class="flex flex-col gap-3 w-[calc(50%-2px)] md:w-[calc(25%-3px)] lg:w-[calc(20%-4px)] flex-shrink-0">
        <div
          class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
          <span
            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
            Seller</span>
          <button
            class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
            <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
          </button>
          <div class="w-full h-full flex items-center justify-center">
            <img src="assets/ring.png" alt="Ring"
              class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
            <img src="assets/hover_image_p.png"
              class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
          </div>
        </div>
        <div class="text-center font-['Outfit']">
          <h3 class="text-sm min-[2000px]:text-2xl font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage
            Ring</h3>
          <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-xl">
            <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
            <span class="text-[#999999] line-through">₹ 949.00</span>
          </div>
        </div>
      </div>
      <!--product 3 -->
      <div class="flex flex-col gap-3 w-[calc(50%-2px)] md:w-[calc(25%-3px)] lg:w-[calc(20%-4px)] flex-shrink-0">
        <div
          class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
          <span
            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10">Best
            Seller</span>
          <button
            class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
            <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
          </button>
          <div class="w-full h-full flex items-center justify-center">
            <img src="assets/ring.png" alt="Ring"
              class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
            <img src="assets/hover_image_p.png"
              class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
          </div>
        </div>
        <div class="text-center font-['Outfit']">
          <h3 class="text-sm min-[2000px]:text-2xl font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage
            Ring</h3>
          <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-xl">
            <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
            <span class="text-[#999999] line-through">₹ 949.00</span>
          </div>
        </div>
      </div>
      <!--product 4 -->
      <div class="flex flex-col gap-3 w-[calc(50%-2px)] md:w-[calc(25%-3px)] lg:w-[calc(20%-4px)] flex-shrink-0">
        <div
          class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
          <span
            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10 tracking-wide">Best
            Seller</span>
          <button
            class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
            <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
          </button>
          <div class="w-full h-full flex items-center justify-center">
            <img src="assets/ring.png" alt="Ring"
              class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
            <img src="assets/hover_image_p.png"
              class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
          </div>
        </div>
        <div class="text-center font-['Outfit']">
          <h3 class="text-sm min-[2000px]:text-2xl font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage
            Ring</h3>
          <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-xl">
            <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
            <span class="text-[#999999] line-through">₹ 949.00</span>
          </div>
        </div>
      </div>
      <!--product 5 -->
      <div class="flex flex-col gap-3 w-[calc(50%-2px)] md:w-[calc(25%-3px)] lg:w-[calc(20%-4px)] flex-shrink-0">
        <div
          class="bg-[#FDFBF7] box-border relative w-full aspect-square border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
          <span
            class="absolute font-['Alexandria'] font-light top-2 right-0 w-[75px] h-[25px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[12px] z-10 tracking-wide">Best
            Seller</span>
          <button
            class="absolute flex bottom-3 left-2 bg-white h-[27px] w-[27px] items-center justify-center rounded-full text-gray-400 hover:text-red-500 transition-colors z-20 shadow-sm">
            <img src="assets/ic_wishlist1.png" class="w-4 h-4" alt="">
          </button>
          <div class="w-full h-full flex items-center justify-center">
            <img src="assets/ring.png" alt="Ring"
              class="w-full h-full object-cover mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
            <img src="assets/hover_image_p.png"
              class="w-full h-full object-cover mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
          </div>
        </div>
        <div class="text-center font-['Outfit']">
          <h3 class="text-sm min-[2000px]:text-2xl font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage
            Ring</h3>
          <div class="flex items-center justify-center gap-2 text-xs min-[2000px]:text-xl">
            <span class="font-bold font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
            <span class="text-[#999999] line-through">₹ 949.00</span>
          </div>
        </div>
      </div>
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

    <div class="relative w-full max-w-[1600px] min-[2000px]:max-w-full mx-auto px-6 mb-0 md:mb-0 group-container">
      <!-- Background Ellipse -->
      <div
        class="absolute top-[60%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1800px] h-[10px] max-w-none bg-[#FDFBF7] rounded-[50%] -z-10 blur-xl pointer-events-none">
      </div>

      <!-- Product Cards Grid -->
      <div id="launchScroll"
        class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar gap-6 relative z-10 w-screen ml-[calc(50%-50vw)] pl-[calc(50vw-50%+1rem)] md:pl-[calc(50vw-50%+2rem)] pr-0">
        <!--launch section product 1: Rings-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden gap-2">
            <img src="assets/launch_ring.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[75%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Rings">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#C19757] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#C19757] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#C19757] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <!-- Bottom Content Wrapper -->
            <div class="absolute bottom-0 left-0 w-full z-10">
              <!-- SVG Background -->
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_ring_launch" x1="190.5" y1="0" x2="180.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF6E3" />
                    <stop offset="1" stop-color="#E8C889" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C150 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_ring_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png" style="width: 9%;" class="absolute top-[6%] left-0 h-auto z-20"
                alt="curve left">
              <img src="assets/launchcategorycurv1.png" style="width: 9%;"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <!-- Text Content -->
              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">9KT Solid
                  Gold
                </p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Rings
                </h3>
              </div>
            </div>
          </div>
          <!-- Reflection -->
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none mask-image-b-to-t">

            <div class="absolute bottom-0 left-0 w-full z-10">

              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_ring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF6E3" />
                    <stop offset="1" stop-color="#E8C889" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_ring_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Rings</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 2: Pendants-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_pendant.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[75%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Pendants">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#CBA65A] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#CBA65A] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#CBA65A] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_pendant_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCECEC" />
                    <stop offset="1" stop-color="#E7B6A7" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_pendant_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(86%) sepia(20%) saturate(713%) hue-rotate(323deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(86%) sepia(20%) saturate(713%) hue-rotate(323deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-Outfit text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Pendants</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_pendant_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCECEC" />
                    <stop offset="1" stop-color="#E7B6A7" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_pendant_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Pendants</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 3: Bracelets-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_bracelet.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[95%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Bracelets">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#D6C3A5] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#D6C3A5] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#D6C3A5] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_bracelet_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F4F1EC" />
                    <stop offset="1" stop-color="#D6C3A5" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_bracelet_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(84%) sepia(8%) saturate(928%) hue-rotate(352deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(84%) sepia(8%) saturate(928%) hue-rotate(352deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-Outfit text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Bracelets</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_bracelet_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F4F1EC" />
                    <stop offset="1" stop-color="#D6C3A5" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_bracelet_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Bracelets</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 4: Earrings-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_earring.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[85%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Earrings">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#F3C6A8] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#F3C6A8] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#F3C6A8] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_earring_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF1E8" />
                    <stop offset="1" stop-color="#F3C6A8" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_earring_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(87%) sepia(17%) saturate(1043%) hue-rotate(320deg) brightness(101%) contrast(91%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(87%) sepia(17%) saturate(1043%) hue-rotate(320deg) brightness(101%) contrast(91%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Earrings</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_earring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF1E8" />
                    <stop offset="1" stop-color="#F3C6A8" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_earring_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Earrings</h3>
              </div>
            </div>
          </div>
        </div>
        <!--launch section product 1: Rings-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-[40px] overflow-hidden gap-2">
            <img src="assets/launch_ring.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[75%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Rings">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#C19757] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#C19757] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#C19757] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <!-- Bottom Content Wrapper -->
            <div class="absolute bottom-0 left-0 w-full z-10">
              <!-- SVG Background -->
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_ring_launch" x1="190.5" y1="0" x2="180.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF6E3" />
                    <stop offset="1" stop-color="#E8C889" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C150 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_ring_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png" style="width: 9%;" class="absolute top-[6%] left-0 h-auto z-20"
                alt="curve left">
              <img src="assets/launchcategorycurv1.png" style="width: 9%;"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <!-- Text Content -->
              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">9KT Solid
                  Gold
                </p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Rings
                </h3>
              </div>
            </div>
          </div>
          <!-- Reflection -->
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none mask-image-b-to-t">

            <div class="absolute bottom-0 left-0 w-full z-10">

              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_ring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF6E3" />
                    <stop offset="1" stop-color="#E8C889" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_ring_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Rings</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 2: Pendants-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_pendant.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[75%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Pendants">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#CBA65A] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#CBA65A] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#CBA65A] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_pendant_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCECEC" />
                    <stop offset="1" stop-color="#E7B6A7" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_pendant_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(86%) sepia(20%) saturate(713%) hue-rotate(323deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(86%) sepia(20%) saturate(713%) hue-rotate(323deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-Outfit text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Pendants</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_pendant_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FCECEC" />
                    <stop offset="1" stop-color="#E7B6A7" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_pendant_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Pendants</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 3: Bracelets-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_bracelet.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[95%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Bracelets">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#D6C3A5] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#D6C3A5] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#D6C3A5] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_bracelet_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F4F1EC" />
                    <stop offset="1" stop-color="#D6C3A5" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_bracelet_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(84%) sepia(8%) saturate(928%) hue-rotate(352deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(84%) sepia(8%) saturate(928%) hue-rotate(352deg) brightness(97%) contrast(93%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-Outfit text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-Outfit text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Bracelets</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_bracelet_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#F4F1EC" />
                    <stop offset="1" stop-color="#D6C3A5" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_bracelet_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Bracelets</h3>
              </div>
            </div>
          </div>
        </div>

        <!--launch section product 4: Earrings-->
        <div
          class="flex flex-col gap-0 group cursor-pointer px-0 md:px-4 min-w-[75%] sm:min-w-[45%] lg:min-w-[25%] snap-center">
          <div class="relative w-full aspect-[0.6] rounded-t-[60px] overflow-hidden">
            <img src="assets/launch_earring.png"
              class="absolute left-1/2 -translate-x-1/2 w-[82%] h-[85%] object-cover object-bottom transition-transform duration-500 drop-shadow-lg"
              alt="Earrings">

            <!-- Hover Stars Effect -->
            <div
              class="absolute inset-0 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
              <span class="absolute top-[12%] left-1/2 -translate-x-1/2 text-[#F3C6A8] text-2xl animate-pulse">✦</span>
              <span class="absolute top-[35%] left-[10%] text-[#F3C6A8] text-3xl animate-pulse delay-75">✦</span>
              <span class="absolute bottom-[25%] right-[12%] text-[#F3C6A8] text-2xl animate-pulse delay-150">✦</span>
            </div>

            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-full h-auto block relative z-10">
                <defs>
                  <linearGradient id="paint_earring_launch" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF1E8" />
                    <stop offset="1" stop-color="#F3C6A8" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_earring_launch)" />
                <path
                  d="M350.5 230C350.5 246.292 337.292 259.5 321 259.5H30C13.7076 259.5 0.5 246.292 0.5 230V20.826172C110 75.8557 241 75.8557 350.5 20.818359V230Z"
                  stroke="#D8B1B6" stroke-opacity="0.2" />
              </svg>

              <!-- Corner Images -->
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(87%) sepia(17%) saturate(1043%) hue-rotate(320deg) brightness(101%) contrast(91%);"
                class="absolute top-[6%] left-0 h-auto z-20" alt="curve left">
              <img src="assets/launchcategorycurv1.png"
                style="width: 9%; filter: brightness(0) saturate(100%) invert(87%) sepia(17%) saturate(1043%) hue-rotate(320deg) brightness(101%) contrast(91%);"
                class="absolute top-[6%] right-0 h-auto transform scale-x-[-1] z-20" alt="curve right">

              <div class="absolute bottom-[20%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Earrings</h3>
              </div>
            </div>
          </div>
          <div
            class="relative w-full h-40 md:h-56 rounded-[40px] overflow-hidden transform scale-y-[-1] opacity-20 -mt-20 md:-mt-24 pointer-events-none">
            <div class="absolute bottom-0 left-0 w-full z-10">
              <svg viewBox="0 0 351 260" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                <defs>
                  <linearGradient id="paint_earring_launch_ref" x1="175.5" y1="0" x2="175.5" y2="260"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFF1E8" />
                    <stop offset="1" stop-color="#F3C6A8" />
                  </linearGradient>
                </defs>
                <path
                  d="M0 20C110 75 241 75 351 20V230C351 246.569 337.569 260 321 260H30C13.4315 260 0 246.569 0 230V20Z"
                  fill="url(#paint_earring_launch_ref)" />
              </svg>
              <div class="absolute bottom-[35%] w-full text-center z-30">
                <p class="font-['Outfit'] text-sm min-[2000px]:text-xl text-[#5C4522] mb-1">
                  9KT Solid Gold</p>
                <h3 class="font-['Outfit'] text-xl min-[2000px]:text-3xl font-medium text-[#5C4522]">
                  Earrings</h3>
              </div>
            </div>
          </div>
        </div>
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
    <div class="relative w-full h-[350px] md:h-[750px] lg:h-[850px] z-10 -mt-8 md:-mt-48">
      <!-- Top Curve Mask (White) -->
      <div
        class="absolute -top-[100px] md:-top-[698px] min-[1800px]:-top-[680px] left-1/2 -translate-x-1/2 w-[120%] md:w-[2416px] min-[1800px]:w-[2600px] min-[2000px]:w-[150%] h-[150px] md:h-[918px] max-w-none bg-white rounded-b-[100%] md:rounded-b-[50%] z-20 pointer-events-none">
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
          <img src="assets/Product Photo.png"
            class="w-full max-w-[300px] md:max-w-[450px] lg:max-w-[600px] min-[2000px]:max-w-[1000px] h-auto object-contain hover:scale-105 transition-transform duration-500"
            alt="Bestseller Spotlight">
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
                  Interwoven Gold Ring</h4>
                <p style="font-family: 'Outfit'"
                  class="font-Outfit font-light text-[14px] md:text-[15px] min-[2000px]:text-xl text-[#5C5C5C] leading-snug">
                  A Signature Design Crafted For Everyday Elegance</p>
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
            <button style="background: #CD9C56;"
              class="inline-flex items-center justify-center w-auto h-[50px] min-[2000px]:h-[70px] px-8 min-[2000px]:px-12 rounded-full text-white font-Outfit font-medium text-[16px] min-[2000px]:text-2xl shadow-sm hover:bg-[#b38f45] transition-colors leading-tight">
              View All Bestsellers
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

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

          <!-- Review 1 -->
          <div
            class="border-2 border-[#F9F4E8] w-full md:w-full lg:w-[1070px] min-[2000px]:w-[1200px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 min-[2000px]:p-16 rounded-[24px] relative flex flex-col h-auto min-h-[300px] min-[2000px]:min-h-[500px] justify-between group transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
            <div class="flex items-start gap-4">
              <img src="assets/ReviewQuote.png"
                class="w-10 h-8 md:w-12 md:h-10 min-[2000px]:w-20 min-[2000px]:h-16 object-contain opacity-40 md:opacity-100"
                alt="quote">
              <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg min-[2000px]:text-3xl leading-relaxed mt-2">
                Tattsvi jewellery feels incredibly refined and comfortable to wear. The designs are
                subtle yet elegant, making them perfect for everyday styling. You can genuinely feel the
                attention to detail in every piece."
              </p>
            </div>

            <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
              <img src="assets/client1.png"
                class="w-12 h-12 min-[2000px]:w-20 min-[2000px]:h-20 rounded-[10px] object-cover" alt="User">
              <div>
                <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg min-[2000px]:text-3xl">
                  Ananya R.</h4>
                <div class="flex gap-1 text-[#CBA65A] text-xs min-[2000px]:text-xl">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Review 2 -->
          <div
            class="border-2 border-[#F9F4E8] w-full md:w-full lg:w-[1070px] min-[2000px]:w-[1200px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 min-[2000px]:p-16 rounded-[24px] relative flex flex-col h-auto min-h-[300px] min-[2000px]:min-h-[500px] justify-between group transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
            <div class="flex items-start gap-4">
              <img src="assets/ReviewQuote.png"
                class="w-10 h-8 md:w-12 md:h-10 min-[2000px]:w-20 min-[2000px]:h-16 object-contain opacity-40 md:opacity-100"
                alt="quote">
              <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg min-[2000px]:text-3xl leading-relaxed mt-2">
                "The craftsmanship is outstanding. I bought a ring for my engagement and it looks
                absolutely stunning. The packaging was premium and delivery was super fast. Highly
                recommended!"
              </p>
            </div>

            <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
              <img src="assets/client1.png"
                class="w-12 h-12 min-[2000px]:w-20 min-[2000px]:h-20 rounded-[10px] object-cover" alt="User">
              <div>
                <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg min-[2000px]:text-3xl">
                  Ananya R.</h4>
                <div class="flex gap-1 text-[#CBA65A] text-xs min-[2000px]:text-xl">
                  <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Review 3 -->
          <div
            class="border-2 border-[#F9F4E8] w-full md:w-full lg:w-[1000px] min-[2000px]:w-[1200px] flex-shrink-0 snap-center bg-[#F9F4E8] p-6 md:p-8 lg:p-10 min-[2000px]:p-16 rounded-[24px] relative flex flex-col h-auto min-h-[300px] min-[2000px]:min-h-[500px] justify-between group transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
            <div class="flex items-start gap-4">
              <img src="assets/ReviewQuote.png"
                class="w-10 h-8 md:w-12 md:h-10 min-[2000px]:w-20 min-[2000px]:h-16 object-contain opacity-40 md:opacity-100"
                alt="quote">
              <p class="font-['Outfit'] text-[#0D0D0E] text-base md:text-lg min-[2000px]:text-3xl leading-relaxed mt-2">
                "I love how unique the collections are. It's rare to find such modern yet traditional
                designs. Will definitely shop again!"
              </p>
            </div>

            <div class="flex items-center gap-4 mt-6 pl-0 md:pl-6 lg:pl-16">
              <img src="assets/client1.png"
                class="w-12 h-12 min-[2000px]:w-20 min-[2000px]:h-20 rounded-[10px] object-cover" alt="User">
              <div>
                <h4 class="font-['Outfit'] font-semibold text-[#0D0D0E] text-lg min-[2000px]:text-3xl">
                  Ananya R.</h4>
                <div class="flex gap-1 text-[#CBA65A] text-xs min-[2000px]:text-xl">
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
                            {{ isset($middleBanners) ? $middleBanners->count() : 0 }},
          @json($categories),
          "{{ url('storage') }}",
          "{{ asset('') }}"
        );
      } else {
        console.warn('initHomeInteractive function not found. Ensure script.js is loaded.');
      }
    });
  </script>
@endsection