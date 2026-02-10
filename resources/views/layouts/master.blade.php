<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tattsvi - Timeless Elegance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&family=Outfit:wght@300;400;500;600&family=Alexandria:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

    <script src="js/script.js" defer></script>

</head>

<body class="bg-[#FDFBF7]  antialiased overflow-x-hidden w-full">

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-[60] hidden transition-opacity opacity-0"></div>
    <div id="mobile-menu-sidebar"
        class="fixed top-0 left-0 w-[85%] max-w-[320px] h-full bg-white z-[70] transform -translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
        <!-- Header -->
        <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-cream">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 flex items-center justify-center">
                    <img src="assets/logo.png" alt="logo">
                </div>
                <span class="serif text-xl tracking-tighter">TATTSVI</span>
            </div>
            <button id="close-menu-btn"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-red-500 shadow-sm transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <!-- Links -->
        <div class="flex-1 overflow-y-auto p-5 space-y-6">
            <!-- New Arrivals -->
            <div class="mobile-dropdown group">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-new-arrivals', this)">
                    New Arrivals <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-new-arrivals" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Diamond Rings</a>
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Gold Necklaces</a>
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Wedding Collection</a>
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] font-medium py-1">View All
                        New</a>
                </div>
            </div>

            <!-- Best Seller -->
            <div class="mobile-dropdown">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-best-seller', this)">
                    Best Seller <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-best-seller" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Top Rated</a>
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Most Gifted</a>
                </div>
            </div>

            <!-- Ready To Stock -->
            <div class="mobile-dropdown">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium  tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-ready-stock', this)">
                    Ready To Stock <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-ready-stock" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Necklaces</a>
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Earrings</a>
                </div>
            </div>

            <!-- Buy It Again -->
            <div class="mobile-dropdown">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-buy-again', this)">
                    Buy It Again <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-buy-again" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Previously Ordered</a>
                </div>
            </div>
            <!--conact us-->
            <div class="mobile-dropdown">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-buy-again', this)">
                    Contact Us <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-buy-again" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Previously Ordered</a>
                </div>
            </div>
            <!--exibition -->
            <div class="mobile-dropdown">
                <button
                    class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                    onclick="toggleMobileDropdown('menu-buy-again', this)">
                    Exhibition <i
                        class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                </button>
                <div id="menu-buy-again" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                    <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Previously Ordered</a>
                </div>
                <!--about us-->
                <div class="mobile-dropdown">
                    <button
                        class="flex items-center justify-between w-full text-[15px] font-medium tracking-wider text-gray-800 pb-2 border-b border-gray-50"
                        onclick="toggleMobileDropdown('menu-buy-again', this)">
                        About Us <i
                            class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-300"></i>
                    </button>
                    <div id="menu-buy-again" class="hidden pl-4 mt-3 space-y-3 border-l-2 border-[#E9D3D6]">
                        <a href="#" class="block text-sm text-gray-600 hover:text-[#B39359] py-1">Previously Ordered</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Info -->
        <div class="bg-gray-50 p-5 border-t border-gray-100">
            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                <span><i class="fa-solid fa-flag-usa mr-2"></i> USA (USD)</span>
            </div>
            <a href="#"
                class="block w-full bg-black text-white text-center py-3 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#5C4522] transition-colors">Sign
                In / Register</a>
        </div>
    </div>
</body>

</html>