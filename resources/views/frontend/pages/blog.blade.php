@extends('frontend.layouts.master')


@section('content')
<!-- Main Content -->
<main class="w-full flex-grow">

    <!-- Blog Banner -->
    <section
        class="flex flex-col justify-center items-center py-[30px] md:py-[40px] px-6 gap-4 w-full bg-[#EFE4CD] text-center">
        <h1 class="font-['outfit'] text-[#826230] text-4xl md:text-[56px] font-medium leading-tight">Blog
        </h1>
        <p class="font-['outfit'] text-[#5C5C5C] text-sm md:text-base max-w-[600px] leading-relaxed">
            Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion
            his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh.
        </p>
    </section>

    <!-- Blog Grid Section -->
    <section class="max-w-[1440px] mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12">
            @forelse($blogs as $blog)
            <!-- Blog Post -->
            <div
                class="flex flex-col group cursor-pointer border border-[#EBEBEB] p-3 hover:shadow-lg transition-shadow bg-white rounded-[2px]"
                onclick="window.location.href='{{ route('page.blog.details', $blog->slug) }}';">
                <div class="w-full aspect-[16/10] overflow-hidden bg-gray-50">
                    @if($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    @else
                    <img src="{{ asset('assets/blog_image.png') }}" alt="Blog Post" class="w-full h-full object-cover opacity-50">
                    @endif
                </div>
                <div class="flex flex-col items-start gap-1 mt-4">
                    <h3 class="font-['outfit'] font-medium text-[#1A1A1A] text-lg leading-tight">{{ $blog->title }}</h3>
                    <p class="font-['outfit'] text-[#5C5C5C] text-xs font-normal mt-1 mb-2">
                        {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                    </p>
                    <a href="{{ route('page.blog.details', $blog->slug) }}"
                        class="w-full border border-[#CBA65A] text-[#CBA65A] py-3 mt-2 rounded-[2px] font-['outfit'] text-sm font-medium hover:bg-[#CBA65A] hover:text-white transition-colors bg-[#FCFBF7] text-center">
                        Read More
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-[#5C5C5C] font-['outfit']">No blogs found at the moment. Please check back later!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $blogs->links() }}
        </div>
    </section>

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
</main>
@endsection