@extends('frontend.layouts.master')


@section('content')
    <!-- Main Content -->
    <main class="w-full flex-grow">

        <!-- Banner -->
        <section
            class="flex flex-col justify-center items-center py-[50px] md:py-[80px] px-6 w-full bg-[#EFE4CD] text-center">
            <h1 class="font-['outfit'] text-[#826230] text-4xl md:text-[56px] font-medium leading-tight mb-4">
                Return and Exchange
            </h1>
            <p class="font-['outfit'] text-[#5C5C5C] text-sm md:text-base max-w-[600px] leading-relaxed">
                Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
                his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
            </p>
        </section>

        <!-- Content Section -->
        <section class="min-h-screen w-full flex flex-col items-center px-6 py-16">
            <div class="space-y-4">
                <!-- Question 1 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-1', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is
                            Tattsvi's Return and Exchange Policy? How does it work?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-1"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We offer a 30-day return and exchange policy for all our products. The item must be unused
                            and in its original packaging.
                        </p>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-2', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">To return a
                            product to Tattsvi, please follow these steps:</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-2"
                        class="hidden flex flex-col justify-between items-start px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm px-1 w-full">
                            If a piece is no longer available on our website, please contact our Customer Relationship
                            Management team. We will do our best to make it available for you.
                        </p>
                        <div class="w-full flex justify-end">
                            <span class="font-['outfit'] text-[#1A1A1A] text-xs font-medium">14K Gold</span>
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-3', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">How do I place
                            an exchange request on Tattsvi?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-3"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            You can place an exchange request by logging into your account and visiting the 'My Orders'
                            section. Select the item and choose 'Exchange'.
                        </p>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-4', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-4"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-5', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-5"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 6 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-6', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-6"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 7 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-7', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-7"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 8 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-8', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-8"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 9 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-9', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-9"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
                        </p>
                    </div>
                </div>

                <!-- Question 10 -->
                <div class="w-full max-w-[1374px] bg-white rounded-[4px] border border-[#EBEBEB] overflow-hidden">
                    <button
                        class="flex flex-row justify-between items-center py-[12px] px-[20px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] rounded-none flex-none order-0 self-stretch grow-0 text-left focus:outline-none"
                        onclick="toggleReturnAccordion('faq-10', this)">
                        <span class="font-['outfit'] font-semibold text-[#1A1A1A] text-sm md:text-base">What is No
                            Questions Asked Returns?</span>
                        <div class="icon-container w-6 h-6 flex items-center justify-center rounded-full bg-[#EFE4CD]">
                            <i class="fa-solid fa-plus text-[#1A1A1A] text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-10"
                        class="hidden flex flex-row justify-between items-center px-[20px] py-[12px] gap-[10px] w-full min-h-[74px] bg-[#FBF9F3] leading-relaxed">
                        <p class="font-['outfit'] text-[#5C5C5C] text-sm">
                            We accept returns without asking for a reason, as long as the product is in its original
                            condition.
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
                <p class="font-['Outfit'] text-[#5C5C5C] text-sm mb-1 tracking-widest">Visit</p>
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
@endsection