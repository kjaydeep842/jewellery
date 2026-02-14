@extends('layouts.frontend')

@section('title', 'Privacy Policy - Tattsvi')

@section('content')

<!-- Hero Banner -->
<section class="relative bg-[#F5E6D3] py-20 px-4 md:px-8 text-center animate-fade-in">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-heading font-black text-[#6B5035] mb-4 tracking-tight drop-shadow-sm">
            Privacy Policy
        </h1>
        <p class="text-[#8C745E] italic font-medium max-w-2xl mx-auto leading-relaxed">
            We Protect your data and ensure a secure, transparent experience.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="bg-white py-16 px-4 md:px-8">
    <div class="max-w-4xl mx-auto bg-white">
        <div class="legal-content prose prose-stone lg:prose-lg max-w-none text-[#2D2D2D] leading-relaxed">
            @if($content && $content->content)
            {!! $content->content !!}
            @else
            <div class="text-center py-12">
                <p class="text-zinc-400 italic">Content is currently being updated. Please check back later.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<style>
    /* Styling for CKEditor Content on Frontend */
    .legal-content p {
        margin-bottom: 1.5rem;
    }

    .legal-content h1,
    .legal-content h2,
    .legal-content h3 {
        color: #6B5035;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }

    .legal-content h2 {
        font-size: 1.875rem;
        border-bottom: 1px solid #F5E6D3;
        padding-bottom: 0.5rem;
    }

    .legal-content h3 {
        font-size: 1.5rem;
    }

    .legal-content ul,
    .legal-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .legal-content li {
        margin-bottom: 0.5rem;
    }

    .legal-content a {
        color: #d97706;
        text-decoration: underline;
        transition: color 0.2s;
    }

    .legal-content a:hover {
        color: #b45309;
    }

    .legal-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 2rem 0;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection