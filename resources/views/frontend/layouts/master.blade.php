<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tattsvi - Timeless Elegance</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&family=Outfit:wght@300;400;500;600&family=Alexandria:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'Outfit': ['Outfit'],
                        'serif': ['Playfair Display'],
                        'sans': ['Inter'],
                        'Alexandria': ['Alexandria'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter';
            overflow-x: hidden;
            width: 100%;
        }

        html {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .serif {
            font-family: 'Playfair Display', serif;
        }

        .bg-cream {
            background-color: #FDFBF7;
        }

        .text-gold {
            color: #B39359;
        }

        .border-gold {
            border-color: #B39359;
        }

        .accent-bg {
            background-color: #B39359;
        }

        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@400;600&display=swap');

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .text-bronze {
            color: #5C4522;
        }

        .bg-bronze {
            background-color: #5C4522;
        }

        .border-bronze {
            border-color: #5C4522;
        }

        /* Premium Arch Shape */
        .premium-arch {
            border-radius: 160px;
            aspect-ratio: 2 / 3.2;
            overflow: hidden;
            position: relative;
            border: 1px solid #E9D3D6;
            transition: all 0.3s ease;
        }

        /* Hover border change */
        .group:hover .premium-arch {
            border-color: #5C4522;
            box-shadow: 0 20px 25px -5px rgb(92 69 34 / 0.1);
        }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Hide scrollbar but keep functionality */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Ticker Container */
        .ticker-wrapper {
            width: 100%;
            overflow: hidden;
            background: #f3dede;
            /* light pink background */
            /*border-top: 2px solid #d4b1b1;
            border-bottom: 2px solid #d4b1b1;*/
            white-space: nowrap;
        }

        /* Moving Text */
        .ticker {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-left 30s linear infinite;
        }

        .ticker span {
            display: inline-block;
            font-family: outfit;
            padding-right: 50px;
            font-size: 14px;
            font-weight: 300;
            color: #6b4b4b;
            letter-spacing: 1px;
        }

        /* Animation */
        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .reflection-img {
            -webkit-box-reflect: below -45px linear-gradient(to bottom, rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.15));
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('styles')
</head>

<body class="bg-[#FDFBF7]  antialiased overflow-x-hidden w-full">

    @include('frontend.partials.header')


    @yield('content')

    @include('frontend.partials.footer')


    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-[60] hidden transition-opacity opacity-0"></div>
    <div id="mobile-menu-sidebar"
        class="fixed top-0 left-0 w-[85%] max-w-[320px] h-full bg-white z-[70] transform -translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
        <!-- Header -->
        <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-cream">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 flex items-center justify-center">
                    <img src="{{ asset('assets/logo.png') }}" alt="logo">
                </div>
                <span class="serif text-xl tracking-tighter">TATTSVI</span>
            </div>
            <button id="close-menu-btn"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-red-500 shadow-sm transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <!-- Links -->
        @include('frontend.partials.mobile-menu')
    </div>

    <!-- Global Loader Overlay -->
    <div id="page-loader"
        class="fixed inset-0 z-[9999] flex items-center justify-center hidden transition-opacity duration-500"
        style="background: linear-gradient(180deg, #F2D7D3 0%, #EAD8A6 100%);">

        <style>
            @keyframes shimmer {
                0% {
                    transform: translateX(-150%) skewX(-15deg);
                }

                50% {
                    transform: translateX(150%) skewX(-15deg);
                }

                100% {
                    transform: translateX(150%) skewX(-15deg);
                }
            }

            @keyframes breathe {

                0%,
                100% {
                    transform: scale(1);
                    opacity: 0.9;
                }

                50% {
                    transform: scale(1.05);
                    opacity: 1;
                }
            }

            .loader-logo-container {
                position: relative;
                overflow: hidden;
                display: inline-block;
                animation: breathe 3s ease-in-out infinite;
            }

            .loader-shimmer {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to right,
                        rgba(255, 255, 255, 0) 0%,
                        rgba(255, 255, 255, 0.4) 50%,
                        rgba(255, 255, 255, 0) 100%);
                transform: translateX(-150%);
                animation: shimmer 2.5s infinite;
            }
        </style>

        <div class="flex flex-col items-center">
            <!-- Logo with Shimmer Effect -->
            <div class="loader-logo-container">
                <!-- Base Logo -->
                <img src="{{ asset('assets/loadinglogo.png') }}" alt="Loading..."
                    class="w-48 md:w-56 h-auto object-contain block">

                <!-- Shimmer Overlay (Masked to Logo) -->
                <div class="loader-shimmer"
                    style="-webkit-mask-image: url('{{ asset('assets/loadinglogo.png') }}'); mask-image: url('{{ asset('assets/loadinglogo.png') }}'); -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat; -webkit-mask-position: center; mask-position: center;">
                </div>
            </div>

            <!-- Optional: Elegant Text below -->
            <div class="mt-4 text-[#5C4522] font-['Outfit'] text-sm tracking-[0.2em] uppercase animate-pulse">
                Loading Elegance...
            </div>
        </div>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const globalLoader = document.getElementById('page-loader');

            // --- Global Loader Logic for Links, Forms & Programmatic Actions ---
            if (globalLoader) {

                // 1. Monkey-patch form.submit() to catch programmatic submissions
                // (Fixes "View More" buttons and Shape filters that call submit() via JS)
                const originalSubmit = HTMLFormElement.prototype.submit;
                HTMLFormElement.prototype.submit = function() {
                    // Check for opt-out
                    if (!this.dataset.noLoader) {
                        globalLoader.classList.remove('hidden');
                    }
                    originalSubmit.apply(this, arguments);
                };

                // 2. Handle Link Clicks & Heuristic OnClick Navigation
                document.addEventListener('click', function(e) {
                    const link = e.target.closest('a');
                    const elementWithOnclick = e.target.closest('[onclick]');

                    // A) Handle Standard Links
                    if (link) {
                        const href = link.getAttribute('href');
                        const target = link.getAttribute('target');

                        if (href &&
                            !href.startsWith('#') &&
                            !href.startsWith('javascript:') &&
                            target !== '_blank' &&
                            !e.ctrlKey && !e.metaKey &&
                            !link.hasAttribute('download') &&
                            !link.dataset.noLoader
                        ) {
                            globalLoader.classList.remove('hidden');
                        }
                    }

                    // B) Handle Elements with onclick="window.location..." or "submit()"
                    // (Fixes "Add to Cart" buttons and other JS-based navigation)
                    if (elementWithOnclick) {
                        const code = elementWithOnclick.getAttribute('onclick');
                        if (code && (
                                code.includes('window.location') ||
                                code.includes('location.href') ||
                                code.includes('.submit()')
                            )) {
                            // Double check it's not a new tab action (harder to detect in raw string, but usually location.href is current tab)
                            globalLoader.classList.remove('hidden');
                        }
                    }
                });

                // 3. Handle Standard Form Submissions (for type="submit" buttons)
                document.addEventListener('submit', function(e) {
                    const form = e.target;
                    if (!form.dataset.noLoader && !e.defaultPrevented) {
                        globalLoader.classList.remove('hidden');
                    }
                });

                // 4. Handle Browser Back Button (Hide Loader from Cache)
                window.addEventListener('pageshow', function(event) {
                    if (event.persisted) {
                        globalLoader.classList.add('hidden');
                    }
                });
            }

            // Auto-expand accordions with checked inputs
            setTimeout(() => {
                document.querySelectorAll('.filter-container .filter-content input[type="checkbox"]:checked').forEach(checkbox => {
                    const content = checkbox.closest('.filter-content');
                    if (content && content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        const container = content.closest('.filter-container');
                        if (container) {
                            const icon = container.querySelector('.accordion-icon');
                            if (icon) icon.classList.add('rotate-180');
                        }
                    }
                });
            }, 100); // Small delay to ensure DOM is fully ready if other scripts are manipulating it

            // Global Filter Accordion Logic
            // Using capture phase (true) to ensure we handle the click before other scripts might stop propagation
            document.addEventListener('click', function(e) {
                // Filter Accordion - Toggle Visibility
                const header = e.target.closest('.filter-accordion-header');
                if (header) {
                    const container = header.closest('.filter-container');
                    if (container) {
                        // Prevent potential interference from other scripts
                        e.preventDefault();
                        e.stopPropagation();

                        const content = container.querySelector('.filter-content');
                        const icon = header.querySelector('.accordion-icon');

                        if (content) {
                            content.classList.toggle('hidden');
                            if (icon) icon.classList.toggle('rotate-180');
                        }
                    }
                    return;
                }

                // View More Shapes (Global)
                if (e.target.classList.contains('view-more-shapes')) {
                    e.preventDefault();
                    e.stopPropagation();

                    const container = e.target.closest('.filter-content');
                    if (container) {
                        const hiddenShapes = container.querySelectorAll('.extra-shape');
                        hiddenShapes.forEach(shape => {
                            shape.classList.toggle('hidden');
                        });

                        if (e.target.textContent.includes('View More')) {
                            e.target.textContent = '- View Less';
                        } else {
                            e.target.textContent = '+ View More';
                        }
                    }
                }
            }, true); // Enable capture phase
        });
    </script>
</body>

</html>