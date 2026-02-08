<div class="ticker-wrapper">
    <div class="ticker">
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        <span>✦ Find a new reason to shine with our Solitaires ✦</span>
    </div>
</div>

<!-- Header Section (Specific to Bag Page) -->
<header class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
    <div class="max-w-[1920px] mx-auto px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-4">

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-800 hover:text-[#CBA65A] transition-colors">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="w-[180px]">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo_black.png') }}" alt="Tattsvi" class="w-full h-auto">
                </a>
            </div>
        </div>

        <!-- Stepper -->
        <!-- Stepper -->
        <div class="hidden md:flex items-center gap-4 text-sm font-medium tracking-wide">
            <div
                class="{{ $activeStep === 'cart' ? 'text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1 font-bold' : 'text-gray-400' }}">
                BAG</div>
            <div class="text-gray-300">----------</div>
            <div
                class="{{ $activeStep === 'address' ? 'text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1 font-bold' : 'text-gray-400' }}">
                ADDRESS</div>
            <div class="text-gray-300">----------</div>
            <div
                class="{{ $activeStep === 'payment' ? 'text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1 font-bold' : 'text-gray-400' }}">
                PAYMENT</div>
        </div>

        <!-- Secure Badge -->
        <div
            class="flex items-center gap-2 font-['Outfit'] font-normal text-[20px] leading-none text-[#0D0D0E] uppercase">
            <img src="{{ asset('assets/shielldpayment.png') }}" alt="Secure" class="w-[60px] h-[60px] object-contain">
            100% SECURE
        </div>
    </div>

    <!-- Navigation Bar (Standard) -->
    <div class="bg-[#CBA65A] text-white py-3 hidden lg:block">
        <nav
            class="max-w-[1920px] mx-auto px-6 flex justify-center space-x-8 xl:space-x-10 text-sm font-medium tracking-wide relative">

            <!-- New Arrivals -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    New Arrivals <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- Best Seller -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    Best Seller <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- Ready To Stock -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    Ready To Stock <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- Buy It Again -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    Buy It Again <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- Contact Us -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    Contact Us <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- Exhibition -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    Exhibition <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>

            <!-- About Us -->
            <div class="relative group">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors py-2">
                    About Us <i
                        class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                </a>
            </div>
        </nav>
    </div>
</header>