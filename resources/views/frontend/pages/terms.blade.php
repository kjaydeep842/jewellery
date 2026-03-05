@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions - Tattsvi')

@section('content')

    <!-- Breadcrumbs Section -->
    <div class="max-w-[1920px] mx-auto px-4 md:px-10 lg:px-[100px] py-4">
        <div class="flex items-center gap-2 text-sm text-[#5C5C5C] font-['Outfit']">
            <a href="{{ route('home') }}" class="hover:text-[#B39359] transition-colors">Home</a>
            <span>/</span>
            <span class="font-['Outfit'] font-medium truncate text-gray-900">{{ $title }}</span>
        </div>
    </div>

    <!-- Title Section (Beige) -->
    <section
        class="bg-[#EFE4CD] flex flex-col justify-center items-center px-6 py-12 md:py-20 gap-4 w-full min-h-[223px] text-center overflow-hidden">
        <h1
            class="font-['Outfit'] text-[#826230] text-[32px] md:text-[48px] lg:text-[64px] min-[2000px]:text-[84px] font-medium leading-tight max-w-[1400px] mx-auto tracking-tight">
            {{ $title }}
        </h1>
        <p class="font-['Outfit'] text-[#5C5C5C] text-sm md:text-lg lg:text-xl font-normal max-w-[900px] mx-auto">
            @if(isset($title) && ($title === 'Terms & Conditions' || str_contains($title, 'Terms')))
                Use of our service implies agreement with our policies and guidelines
            @else
                Our official policies and guidelines for your security
            @endif
        </p>
    </section>

    <!-- Content Section -->
    <section class="max-w-[1400px] mx-auto px-4 sm:px-6 md:px-10 lg:px-20 py-12 md:py-20 lg:py-24 overflow-x-hidden">
        <!-- Text Content -->
        <div class="legal-content-wrapper w-full overflow-x-hidden">
            <div
                class="legal-content w-full font-['Outfit'] text-[#4A4A4A] text-[16px] md:text-[18px] lg:text-[20px] leading-relaxed text-left">
                @if(isset($content) && $content)
                    <div class="space-y-8">
                        {!! $content !!}
                    </div>
                @else
                    <div class="text-center py-20 w-full bg-gray-50 rounded-lg border border-dashed border-gray-200">
                        <p class="text-gray-400 italic">Content is currently being updated. Please check back later.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        /* CRITICAL FIX FOR CONTENT CUTTING */
        .legal-content,
        .legal-content * {
            max-width: 100% !important;
            overflow-wrap: break-word !important;
            word-wrap: break-word !important;
            white-space: normal !important;
            box-sizing: border-box !important;
        }

        .legal-content h1,
        .legal-content h2,
        .legal-content h3 {
            color: #1A1A1A;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            line-height: 1.3;
            display: block !important;
        }

        .legal-content h1 {
            font-size: clamp(26px, 6vw, 48px) !important;
        }

        .legal-content h2 {
            font-size: clamp(22px, 5vw, 40px) !important;
        }

        .legal-content h3 {
            font-size: clamp(18px, 4vw, 32px) !important;
        }

        .legal-content p {
            margin-bottom: 1.5rem !important;
            display: block !important;
            line-height: 1.6 !important;
        }

        .legal-content ul,
        .legal-content ol {
            width: 100% !important;
            display: block !important;
            list-style: none !important;
            padding: 0 !important;
            margin-bottom: 1.5rem !important;
        }

        .legal-content li {
            position: relative !important;
            padding-left: 1.5rem !important;
            display: block !important;
            margin-bottom: 0.75rem !important;
        }

        .legal-content li::before {
            content: '●';
            color: #5C5C5C;
            font-size: 8px;
            position: absolute;
            left: 0;
            top: 8px;
        }

        .legal-content a {
            color: #B39359;
            text-decoration: underline;
        }

        .legal-content img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .legal-content table {
            display: block !important;
            width: 100% !important;
            overflow-x: auto !important;
            border-collapse: collapse;
            margin-bottom: 2rem !important;
        }
    </style>

@endsection