@extends('frontend.layouts.master')


@section('content')
    <!-- Main Content -->
    <main class="w-full flex-grow">

        <!-- FAQ Banner -->
        <section
            class="flex flex-col justify-center items-center py-[30px] md:py-[40px] px-6 gap-4 w-full bg-[#EFE4CD] text-center">
            <h1 class="font-['outfit'] text-[#826230] text-4xl md:text-[56px] font-medium leading-tight">Frequently
                Asked Questions
            </h1>
            <p class="font-['outfit'] text-[#5C5C5C] text-sm md:text-base max-w-[600px] leading-relaxed">
                Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
                his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
            </p>
        </section>

        <!-- FAQ Content Section -->
        <section class="max-w-[1000px] mx-auto px-6 py-16">
            <div class="space-y-4">
                <!-- Question 1 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-1', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Do you sell gift
                            cards or gift certificates?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-1"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Yes, we offer gift cards that can be used for any purchase on our website. They make the
                            perfect gift for any occasion.
                        </p>
                    </div>
                </div>

                <!-- Question 2 (Expanded by default) -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-2', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">I can't find the
                            piece I wanted on the site anymore. Can I still order it?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-minus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-2"
                        class="flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm px-1">
                            If a piece is no longer available on our website, please contact our Customer Relationship
                            Management team. We will do our best to make it available for you.
                        </p>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-3', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Do you offer any
                            additional discounts?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-3"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We occasionally offer promotional discounts. Subscribe to our newsletter to stay updated on
                            the latest deals and offers.
                        </p>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-4', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Does Tattsvi
                            Jewels have a catalog?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-4"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Yes, we have a digital catalog available on our website. You can also request a physical
                            copy by contacting our support team.
                        </p>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-5', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Where is your
                            jewellery made?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-5"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            All our jewellery is handcrafted by skilled artisans in our workshops located in
                            [City/Country], ensuring the highest quality.
                        </p>
                    </div>
                </div>

                <!-- Question 6 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-6', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Where is Tattsvi
                            Jewels located?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-6"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Our headquarters is located at [Address]. We also have several retail stores across the
                            region. Check our Store Locator for details.
                        </p>
                    </div>
                </div>

                <!-- Question 7 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-7', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Who are we? What
                            makes Tattsvi Jewels different?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-7"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Tattsvi Jewels is dedicated to providing exquisite, high-quality jewellery with unique
                            designs that blend tradition with modernity.
                        </p>
                    </div>
                </div>

                <!-- Question 8 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-8', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Do you sell gift
                            cards or gift certificates?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-8"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Yes, we offer gift cards usable for any purchase.
                        </p>
                    </div>
                </div>

                <!-- Question 9 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-9', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Do you offer any
                            additional discounts?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-9"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Please check our website during festive seasons for special discounts.
                        </p>
                    </div>
                </div>

                <!-- Question 10 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[10px] border border-[#F4EBD0] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-10', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Does Tattsvi
                            Jewels have a catalog?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-10"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Yes, catalogs are available upon request.
                        </p>
                    </div>
                </div>

                <!-- Question 11 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[10px] border border-[#F4EBD0] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-11', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Where is your
                            jewellery made?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-11"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            All our jewellery is handcrafted by skilled artisans in our workshops located in
                            [City/Country], ensuring the highest quality.
                        </p>
                    </div>
                </div>

                <!-- Question 12 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[10px] border border-[#F4EBD0] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-12', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Where is Tattsvi
                            Jewels located?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-12"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Our headquarters is located at [Address]. We also have several retail stores across the
                            region. Check our Store Locator for details.
                        </p>
                    </div>
                </div>

                <!-- Question 13 -->
                <div class="w-[1374px] max-w-full bg-white rounded-[10px] border border-[#F4EBD0] overflow-hidden">
                    <button class="w-full flex justify-between items-center p-5 text-left focus:outline-none"
                        onclick="toggleFAQAccordion('faq-13', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">Who are we? What
                            makes Tattsvi Jewels different?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-13"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            Tattsvi Jewels is dedicated to providing exquisite, high-quality jewellery with unique
                            designs that blend tradition with modernity.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Instagram Divider Section -->
    <div class="w-full bg-[#FCFBF7] py-16">
        <div class="flex items-center justify-center w-full gap-2 md:gap-4 mb-4 max-w-[90%] md:max-w-[1600px] mx-auto">
            <img src="{{ asset('assets/Design.png') }}" alt="design left"
                class="h-3 md:h-auto w-full flex-1 object-contain object-right max-w-[100px] md:max-w-[400px] opacity-80">
            <div class="text-center px-4">
                <p class="font-['Outfit'] text-[#5C5C5C] text-sm mb-1  tracking-widest">Visit</p>
                <h2
                    class="font-['Outfit'] text-[#CBA65A] text-3xl md:text-[40px] font-medium tracking-wide whitespace-nowrap">
                    Our Instagram
                </h2>
            </div>
            <img src="{{ asset('assets/DesignRight.png') }}" alt="design right"
                class="h-3 md:h-auto w-full flex-1 object-contain object-left max-w-[100px] md:max-w-[400px] opacity-80">
        </div>
        <!-- Image Gallery -->
        <div class="w-full overflow-x-auto no-scrollbar pb-4 px-4 mt-8">
            <div class="flex gap-4 md:gap-6 min-w-max md:justify-center mx-auto">
                <!-- Image 1 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_1.png') }}" alt="Instagram Post 1" class="w-full h-full">
                </div>
                <!-- Image 2 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_2.png') }}" alt="Instagram Post 2" class="w-full h-full">
                </div>
                <!-- Image 3 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_3.png') }}" alt="Instagram Post 3" class="w-full h-full">
                </div>
                <!-- Image 4 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_4.png') }}" alt="Instagram Post 4" class="w-full h-full">
                </div>
                <!-- Image 5 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_5.png') }}" alt="Instagram Post 5" class="w-full h-full">
                </div>
                <!-- Image 6 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_6.png') }}" alt="Instagram Post 6" class="w-full h-full">
                </div>
                <!-- Image 7 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_7.png') }}" alt="Instagram Post 7" class="w-full h-full">
                </div>
                <!-- Image 8 -->
                <div
                    class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <img src="{{ asset('assets/our_story_8.png') }}" alt="Instagram Post 8" class="w-full h-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Know More Section -->
    <div class="w-full bg-[#EAD4D4] py-3 mt-4">
        <p class="text-center font-['Outfit'] text-[#333333] text-xs md:text-sm font-medium tracking-wide">
            Know More About Tattsvi
        </p>
    </div>

    <script>
        function toggleFAQAccordion(id, btn) {
            var panel = document.getElementById(id);
            if (!panel) return;

            var isOpen = !panel.classList.contains('hidden');

            // Close ALL open panels first
            document.querySelectorAll('[id^="faq-"]').forEach(function (p) {
                p.classList.add('hidden');
            });
            document.querySelectorAll('.icon-container i').forEach(function (icon) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            });

            // If it was closed, open it now
            if (!isOpen) {
                panel.classList.remove('hidden');
                var icon = btn.querySelector('.icon-container i');
                if (icon) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                }
            }
        }

        // Open the first item that has fa-minus icon (pre-expanded) on load
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="faq-"]').forEach(function (panel) {
                if (!panel.classList.contains('hidden')) {
                    // sync icon to fa-minus
                    var btn = panel.previousElementSibling;
                    if (btn) {
                        var icon = btn.querySelector('.icon-container i');
                        if (icon) {
                            icon.classList.remove('fa-plus');
                            icon.classList.add('fa-minus');
                        }
                    }
                }
            });
        });
    </script>
@endsection