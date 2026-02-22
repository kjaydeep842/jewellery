@extends('frontend.layouts.master')

@section('title', 'Privacy Policy - Tattsvi')

@section('content')

    <!-- Breadcrumbs Section -->
    <div class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-6 py-4">
        <div class="flex items-center gap-2 text-sm text-[#5C5C5C] font-['Outfit']">
            <a href="{{ route('home') }}" class="hover:text-[#B39359] transition-colors">Home</a>
            <span>/</span>
            <span class="font-['Outfit'] font-medium truncate">{{ $title }}</span>
        </div>
    </div>

    <!-- Title Section (Beige) -->
    <section
        class="bg-[#EFE4CD] flex flex-col justify-center items-center p-[40px_20px] md:p-[40px_10%] lg:p-[40px_290px] gap-[20px] w-full min-h-[223px] flex-none order-2 self-stretch grow-0 text-center overflow-hidden">
        <h1
            class="font-['Outfit'] text-[#826230] text-[clamp(28px,4vw,72px)] font-medium leading-[1.2] max-w-none mx-auto tracking-tight whitespace-nowrap">
            {{ $title }}
        </h1>
        <p class="font-['Outfit'] text-[#5C5C5C] text-sm md:text-lg font-normal tracking-normal max-w-[800px]">
            @if($title === 'Privacy Policy')
                We Protect your data and ensure a secure, transparent experience
            @else
                Our official policies and guidelines for your security
            @endif
        </p>
    </section>

    <!-- Content Section -->
    <section class="max-w-[1240px] min-[2000px]:max-w-[2000px] mx-auto px-6 py-12 md:py-24 min-[2000px]:py-36">

        <!-- Text Content -->
        <div
            class="legal-content max-w-[1220px] mx-auto flex flex-col items-start p-0 gap-[35px] w-full flex-none order-0 flex-grow font-['Outfit'] text-[#5C5C5C] text-[16px] leading-[1.6] text-left break-words overflow-hidden hyphens-auto">
            @if($content)
                {!! $content !!}
            @else
                <div class="text-center py-12 w-full">
                    <p class="text-zinc-400 italic">Content is currently being updated. Please check back later.</p>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* Styling for Dynamic Content to match the User's HTML Structure */
        .legal-content h1,
        .legal-content h2,
        .legal-content h3 {
            color: #1A1A1A;
            font-weight: 700;
            margin-bottom: 0.75rem;
            line-height: 1.2;
            width: 100%;
        }

        .legal-content h2 {
            font-size: 24px;
        }

        @media (min-width: 768px) {
            .legal-content h2 {
                font-size: 28px;
            }
        }

        .legal-content p {
            margin-bottom: 0;
            /* Using gap on parent */
            font-weight: 400;
            width: 100%;
        }

        .legal-content ul,
        .legal-content ol {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            /* space-y-3 */
            list-style: none;
            padding: 0;
        }

        .legal-content li {
            position: relative;
            padding-left: 1.5rem;
            display: flex;
            items-start: flex-start;
            gap: 0.5rem;
        }

        .legal-content li::before {
            content: '●';
            color: #5C5C5C;
            font-size: 6px;
            position: absolute;
            left: 0;
            top: 10px;
        }

        .legal-content a {
            color: #B39359;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .legal-content img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .legal-content table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>

@endsection