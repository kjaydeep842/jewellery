@extends('frontend.layouts.master')


@section('content')
    <style>
        .ck-content blockquote {
            border-left: 3px solid #1A1A1A;
            padding-left: 24px;
            margin-left: 0;
            font-style: italic;
            color: #5C5C5C;
        }

        .ck-content p {
            margin-bottom: 1.25rem;
        }

        .ck-content h2,
        .ck-content h3,
        .ck-content h4 {
            font-family: 'Playfair Display', serif;
            color: #CBA65A;
            margin-bottom: 1rem;
            font-weight: 500;
        }
    </style>
    <!-- Main Content -->
    <main class="w-full flex-grow">

        <!-- Our Story Banner -->
        <section
            class="flex flex-col justify-center items-center py-[30px] px-[20px] md:px-[290px] gap-[20px] w-full max-w-[1920px] min-h-[200px] bg-[#EFE4CD] flex-none order-2 self-stretch flex-grow-0 mx-auto text-center">
            <h1 class="font-['Outfit'] text-[#976600] text-4xl md:text-6xl m-0">Our Story</h1>
            <p class="font-['Outfit'] text-[#5C5C5C] md:text-lg w-full leading-relaxed">
                Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
                his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
            </p>
        </section>

        <!-- Meet our founders Section -->
        @if($ourStories->count() > 0)
            @foreach($ourStories as $story)
                <section class="w-full max-w-[1440px] mx-auto px-4 lg:px-12">
                    <div class="flex flex-col lg:flex-row items-stretch">

                        <!-- Left: Owner oval image column -->
                        <div class="flex-shrink-0 flex justify-center items-center lg:w-[420px] xl:w-[460px]"
                             style="padding: 60px 0;">
                            <div class="w-[260px] h-[320px] md:w-[300px] md:h-[380px] lg:w-[260px] lg:h-[380px] rounded-[200px] overflow-hidden bg-[#EFE4D6]">
                                @if($story->image)
                                    <img src="{{ asset('storage/' . $story->image) }}"
                                         alt="{{ $story->title }}"
                                         class="w-full h-full object-cover object-top">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fa-solid fa-user text-[#CBA65A] text-7xl opacity-40"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right: Title + Description text -->
                        <div class="flex-1 flex flex-col justify-center py-10 lg:py-16 lg:pl-10 xl:pl-14">
                            <h2 class="font-['Playfair_Display'] text-[#CBA65A] text-3xl md:text-4xl xl:text-[44px] font-medium mb-5 leading-snug">
                                {{ $story->title ?: 'Meet our founders' }}
                            </h2>
                            <div class="ck-content font-['Outfit'] text-[#5C5C5C] text-sm md:text-[15px] leading-relaxed space-y-4">
                                {!! $story->description !!}
                            </div>
                        </div>

                    </div>
                </section>
            @endforeach
        @endif

        <!-- Features Section -->
        @if($features->count() > 0)
            <section class="w-full max-w-[1440px] mx-auto px-4 lg:px-12 pb-14">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($features as $feature)
                        <div class="flex flex-col items-center justify-center p-8 text-center rounded-2xl"
                            style="background: linear-gradient(180deg, #F9E4E4 0%, #FFFFFF 100%);">
                            <div class="flex justify-center mb-5">
                                @if($feature->image)
                                    <img src="{{ asset('storage/' . $feature->image) }}" alt="{{ $feature->title }}"
                                        class="h-[48px] w-auto">
                                @else
                                    <img src="{{ asset('assets/color_truck.png') }}" alt="Feature" class="h-[48px] w-auto opacity-80">
                                @endif
                            </div>
                            <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-lg mb-3">
                                {{ $feature->title }}
                            </h3>
                            <p class="font-['Outfit'] text-[#6E6E6E] text-[13px] leading-relaxed max-w-[280px]">
                                {{ strip_tags($feature->description) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Instagram Divider Section -->
        <div class="w-full bg-[#FCFBF7] py-10">
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