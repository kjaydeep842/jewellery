@extends('frontend.layouts.master')


@section('content')
    <!-- Main Content -->
    <main class="w-full flex-grow">

        <!-- Our Story Banner -->
        <section
            class="flex flex-col justify-center items-center py-[30px] px-[20px] md:px-[290px] gap-[20px] w-full max-w-[1920px] min-h-[200px] bg-[#EFE4CD] flex-none order-2 self-stretch flex-grow-0 mx-auto text-center">
            <h1 class="font-['Playfair_Display'] text-[#976600] text-4xl md:text-6xl m-0">Our Story</h1>
            <p class="font-['Outfit'] text-[#5C5C5C] md:text-lg w-full leading-relaxed">
                Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
                his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
            </p>
        </section>

        <!-- Meet our founders Section -->
        <section class="max-w-[1440px] mx-auto px-6 py-16 md:py-24">
            <div class="flex flex-col md:flex-row items-center gap-12 md:gap-20">
                <!-- Image -->
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="w-full max-w-[400px] aspect-[3/4] rounded-[200px] overflow-hidden relative">
                        <img src="{{ asset('assets/meet_founder.png') }}" alt="Founder" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Text Content -->
                <div class="w-full md:w-1/2 text-left">
                    <h2 class="font-['Playfair_Display'] text-[#CBA65A] text-3xl md:text-5xl mb-6">Meet our founders
                    </h2>
                    <div class="font-['Outfit'] text-[#5C5C5C] space-y-5 md:text-[15px] leading-relaxed">
                        <p>
                            "But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you a complete account of the system, and expound the actual
                            teachings of the great explorer of the truth, the master-builder of human happiness. No one
                            rejects, dislikes, or avoids pleasure itself.
                        </p>
                        <p>
                            "But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you a complete account of the system, and expound the actual
                            teachings of the great explorer of the truth, the master-builder of human happiness. No one
                            rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who
                            do not know how to pursue pleasure rationally encounter consequences that are extremely
                            painful.
                        </p>
                        <div class="pl-6 border-l-[3px] border-black">
                            <p class="text-[#5C5C5C]">
                                Nor again is there anyone who loves or pursues or desires to obtain pain of itself,
                                because it is pain, but because occasionally circumstances occur in which toil and pain
                                can procure him some great pleasure. To take a trivial example, which of us ever
                                undertakes laborious physical exercise.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="max-w-[1440px] mx-auto px-6 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center justify-center p-8 text-center rounded-2xl"
                    style="background: linear-gradient(180deg, #F9E4E4 0%, #FFFFFF 100%);">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('assets/color_truck.png') }}" alt="Free Shipping" class="h-[40px] w-auto">
                    </div>
                    <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-lg mb-3">Free Shipping</h3>
                    <p class="font-['Outfit'] text-[#6E6E6E] text-[13px] leading-relaxed max-w-[280px]">
                        Perceived end knowledge certain day sweetness why cordially. Ask a quick six seven offer see
                        among.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="flex flex-col items-center justify-center p-8 text-center rounded-2xl"
                    style="background: linear-gradient(180deg, #F9E4E4 0%, #FFFFFF 100%);">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('assets/color_truck.png') }}" alt="Fast Delivery" class="h-[40px] w-auto">
                    </div>
                    <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-lg mb-3">Fast Delivery</h3>
                    <p class="font-['Outfit'] text-[#6E6E6E] text-[13px] leading-relaxed max-w-[280px]">
                        Parlors waiting so against me no. Wishing calling is warrant settled was lucky.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="flex flex-col items-center justify-center p-8 text-center rounded-2xl"
                    style="background: linear-gradient(180deg, #F9E4E4 0%, #FFFFFF 100%);">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('assets/color_truck.png') }}" alt="Quality Guarantee" class="h-[40px] w-auto">
                    </div>
                    <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-lg mb-3">100% Quality Guarantee</h3>
                    <p class="font-['Outfit'] text-[#6E6E6E] text-[13px] leading-relaxed max-w-[280px]">
                        Unaffected at so of compliment alteration to. Place voice no arises along to.
                    </p>
                </div>
            </div>
        </section>

        <!-- Instagram Divider Section -->
        <div class="w-full bg-[#FCFBF7] py-16">
            <div class="flex items-center justify-center w-full gap-2 md:gap-4 mb-4 max-w-[90%] md:max-w-[1600px] mx-auto">
                <img src="{{ asset('assets/Design.png') }}" alt="design left"
                    class="h-3 md:h-auto w-full flex-1 object-contain object-right max-w-[100px] md:max-w-[400px] opacity-80">
                <div class="text-center px-4">
                    <p class="font-['Outfit'] text-[#5C5C5C] text-sm mb-1 uppercase tracking-widest">Visit</p>
                    <h2
                        class="font-['Playfair_Display'] text-[#CBA65A] text-3xl md:text-[40px] font-medium tracking-wide whitespace-nowrap">
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

    </main>
@endsection