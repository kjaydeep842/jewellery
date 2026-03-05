@extends('frontend.layouts.master')

@section('title', 'Return & Exchange - Tattsvi')

@section('content')
    <!-- Breadcrumbs Section -->
    <div class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-6 py-4">
        <div class="flex items-center gap-2 text-sm text-[#5C5C5C] font-['Outfit']">
            <a href="{{ route('home') }}" class="hover:text-[#B39359] transition-colors">Home</a>
            <span>/</span>
            <span class="font-['Outfit'] font-medium truncate">Return and Exchange</span>
        </div>
    </div>

    <!-- Title Section (Beige) -->
    <section
        class="bg-[#EFE4CD] flex flex-col justify-center items-center p-[40px_20px] md:p-[60px_10%] lg:p-[70px_15%] gap-[20px] w-full min-h-[223px] text-center overflow-hidden">
        <h1 class="font-['Outfit'] text-[#826230] text-[clamp(32px,5vw,72px)] font-medium leading-[1.2] tracking-tight">
            Return and Exchange
        </h1>
        <p
            class="font-['Outfit'] text-[#5C5C5C] text-sm md:text-lg font-normal tracking-normal max-w-[800px] leading-relaxed">
            Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
            his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
        </p>
    </section>

    <!-- Main Content -->
    <main class="w-full flex-grow bg-white py-16 px-6">
        <div class="max-w-[1374px] mx-auto flex flex-col gap-[10px]">

            @forelse($policies as $index => $policy)
                <div class="w-full bg-white rounded-[14px] border border-[#EFE4CD] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[20px] px-[20px] md:px-[30px] gap-[10px] w-full min-h-[74px] text-left focus:outline-none group"
                        onclick="toggleReturnAccordion('faq-{{ $index }}', this)">
                        <span
                            class="font-['Outfit'] font-semibold text-[#5C4522] text-sm md:text-[22px] leading-none uppercase tracking-tight">
                            {{ $policy->title }}
                        </span>
                        <div
                            class="icon-wrapper w-[24px] h-[24px] md:w-[32px] md:h-[32px] rounded-full bg-[#EFE4CD] flex items-center justify-center transition-colors">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-[10px] md:text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-{{ $index }}"
                        class="hidden bg-[#FBF9F3] px-[20px] md:px-[30px] py-[12px] transition-all duration-300">
                        <div class="font-['Outfit'] text-[#5C5C5C] text-sm md:text-base leading-relaxed">
                            {!! $policy->content !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="font-['Outfit'] text-[#5C5C5C]">No return or exchange policies found.</p>
                </div>
            @endforelse

        </div>
    </main>

    <!-- Instagram Divider Section -->
    <div class="w-full bg-[#FCFBF7] py-20 mt-8 border-t border-[#EFE4CD]/20">
        <div class="flex items-center justify-center w-full gap-2 md:gap-4 mb-4 max-w-[90%] md:max-w-[1600px] mx-auto">
            <img src="{{ asset('assets/Design.png') }}" alt="design left"
                class="h-3 md:h-auto w-full flex-1 object-contain object-right max-w-[100px] md:max-w-[400px] opacity-80">
            <div class="text-center px-4">
                <p class="font-['Outfit'] text-[#5C5C5C] text-sm mb-1 tracking-widest uppercase">Visit</p>
                <h2
                    class="font-['Outfit'] text-[#CBA65A] text-3xl md:text-[48px] font-medium tracking-wide whitespace-nowrap">
                    Our Instagram
                </h2>
            </div>
            <img src="{{ asset('assets/DesignRight.png') }}" alt="design right"
                class="h-3 md:h-auto w-full flex-1 object-contain object-left max-w-[100px] md:max-w-[400px] opacity-80">
        </div>

        <!-- Image Gallery -->
        <div class="w-full overflow-x-auto no-scrollbar pb-4 px-4 mt-12">
            <div class="flex gap-4 md:gap-6 min-w-max md:justify-center mx-auto">
                @for($i = 1; $i <= 8; $i++)
                    <div
                        class="w-[180px] h-[220px] md:w-[260px] md:h-[320px] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 group flex-shrink-0 border border-[#EFE4CD]/30">
                        <img src="{{ asset('assets/our_story_' . $i . '.png') }}" alt="Instagram Post {{ $i }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Know More Section -->
    <div class="w-full bg-[#EAD4D4] py-4">
        <p class="text-center font-['Outfit'] text-[#333333] text-sm md:text-base font-semibold tracking-wider uppercase">
            Know More About Tattsvi
        </p>
    </div>

    <script>
        function toggleReturnAccordion(id, btn) {
            var panel = document.getElementById(id);
            if (!panel) return;

            var isOpen = !panel.classList.contains('hidden');
            var icon = btn.querySelector('.icon-wrapper i');

            // Close ALL other open panels
            document.querySelectorAll('[id^="faq-"]').forEach(function (p) {
                if (p.id !== id) {
                    p.classList.add('hidden');
                    // Reset other icons
                    var otherBtn = document.querySelector('[onclick*="' + p.id + '"]');
                    if (otherBtn) {
                        var otherIcon = otherBtn.querySelector('.icon-wrapper i');
                        if (otherIcon) {
                            otherIcon.classList.remove('fa-minus');
                            otherIcon.classList.add('fa-plus');
                        }
                    }
                }
            });

            // Toggle current panel
            if (isOpen) {
                panel.classList.add('hidden');
                if (icon) {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            } else {
                panel.classList.remove('hidden');
                if (icon) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                }
            }
        }
    </script>
@endsection