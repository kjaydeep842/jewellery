@extends('frontend.layouts.master')

@section('content')
<style>
    .blog-content blockquote {
        border-left: 3px solid #1A1A1A;
        padding-left: 24px;
        margin-left: 0;
        font-style: italic;
        color: #5C5C5C;
    }

    .blog-content p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #5C5C5C;
        font-family: 'Outfit', sans-serif;
    }

    .blog-content h2,
    .blog-content h3,
    .blog-content h4 {
        font-family: 'Playfair Display', serif;
        color: #1A1A1A;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .blog-content h2 {
        font-size: 1.875rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
    }

    .blog-content ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        margin-bottom: 1.5rem;
        color: #5C5C5C;
    }

    .blog-content li {
        margin-bottom: 0.5rem;
    }
</style>

<!-- Main Content -->
<main class="w-full flex-grow bg-white">

    <!-- Blog Detail Header -->
    <section class="w-full bg-[#EFE4CD] py-16 px-6 text-center">
        <div class="max-w-[1000px] mx-auto">
            <h1 class="font-['Playfair_Display'] text-[#826230] text-3xl md:text-5xl font-medium leading-tight mb-4">
                {{ $blog->title }}
            </h1>
            <p class="font-['Outfit'] text-[#5C5C5C] text-sm md:text-base opacity-80 uppercase tracking-widest">
                {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
            </p>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="max-w-[1100px] mx-auto px-6 py-12 md:py-20">

        <!-- Images Grid (as per reference image) -->
        @if($blog->image)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="aspect-[4/3] overflow-hidden rounded-sm shadow-sm border border-zinc-100">
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>
            <div class="aspect-[4/3] overflow-hidden rounded-sm shadow-sm border border-zinc-100">
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>
        </div>
        @endif

        <!-- Main description -->
        <div class="blog-content prose prose-lg max-w-none">
            {!! $blog->description !!}
        </div>

    </section>

    <!-- Recent Blogs Section -->
    @if($recentBlogs->count() > 0)
    <section class="bg-[#FCFBF7] py-16 px-6 border-t border-zinc-100">
        <div class="max-w-[1440px] mx-auto">
            <h2 class="font-['Playfair_Display'] text-[#CBA65A] text-3xl md:text-4xl text-center mb-12">Recent Stories</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recentBlogs as $recent)
                <div class="flex flex-col group cursor-pointer bg-white p-4 border border-[#EBEBEB] hover:shadow-md transition-shadow"
                    onclick="window.location.href='{{ route('page.blog.details', $recent->slug) }}';">
                    <div class="w-full aspect-[16/10] overflow-hidden bg-gray-50 mb-4">
                        @if($recent->image)
                        <img src="{{ Storage::url($recent->image) }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <img src="{{ asset('assets/blog_image.png') }}" alt="{{ $recent->title }}" class="w-full h-full object-cover opacity-50">
                        @endif
                    </div>
                    <h3 class="font-['outfit'] font-medium text-[#1A1A1A] text-lg mb-2">{{ Str::limit($recent->title, 60) }}</h3>
                    <p class="font-['outfit'] text-[#5C5C5C] text-xs mb-4">{{ $recent->created_at->format('M d, Y') }}</p>
                    <a href="{{ route('page.blog.details', $recent->slug) }}" class="text-[#CBA65A] font-['outfit'] text-sm font-semibold uppercase tracking-wider hover:text-[#826230] transition-colors">Read More →</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</main>
@endsection