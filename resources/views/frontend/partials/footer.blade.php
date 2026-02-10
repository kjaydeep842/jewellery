<footer class="bg-[#FDFBF7] relative overflow-hidden">
    <div class="max-w-[1920px] mx-auto px-6 md:px-20 py-12 md:py-16 relative z-10">
        <!-- Logo -->
        <div
            class="w-[212px] h-[46.8px] min-[2000px]:w-[350px] min-[2000px]:h-auto flex items-center justify-center mb-10">
            <img src="{{ asset('assets/logo_black.png') }}" alt="logo" class="w-full h-auto">
        </div>

        <div class="flex flex-col lg:flex-row justify-between gap-12 lg:gap-20">
            <!-- Left Side: Links -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-y-10 gap-x-12 md:gap-x-20">
                <!-- Categories -->
                <div>
                    <h4 class="font-['Outfit'] font-bold text-[16px] mb-4 text-[#0D0D0E]">Categories</h4>
                    <ul class="space-y-3 font-['Outfit'] text-[#6E6E6E] text-[14px]">
                        <li><a href="#" class="hover:text-[#CBA65A] transition-colors">Rings</a></li>
                        <li><a href="#" class="hover:text-[#CBA65A] transition-colors">Earrings</a></li>
                        <li><a href="#" class="hover:text-[#CBA65A] transition-colors">Bracelets</a></li>
                        <li><a href="#" class="hover:text-[#CBA65A] transition-colors">Necklaces</a></li>
                        <li><a href="#" class="hover:text-[#CBA65A] transition-colors">Bangles</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h4 class="font-['Outfit'] font-bold text-[16px] mb-4 text-[#0D0D0E]">Customer Service</h4>
                    <ul class="space-y-3 font-['Outfit'] text-[#6E6E6E] text-[14px]">
                        <li><a href="{{ route('page.faq') }}" class="hover:text-[#CBA65A] transition-colors">FAQs</a></li>
                        <li><a href="{{ route('page.return-exchange') }}" class="hover:text-[#CBA65A] transition-colors">Return &
                                Exchange</a></li>
                        <li><a href="{{ route('page.contact') }}" class="hover:text-[#CBA65A] transition-colors">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <!-- About Us -->
                <div>
                    <h4 class="font-['Outfit'] font-bold text-[16px] mb-4 text-[#0D0D0E]">About Us</h4>
                    <ul class="space-y-3 font-['Outfit'] text-[#6E6E6E] text-[14px]">
                        <li><a href="{{ route('page.about') }}" class="hover:text-[#CBA65A] transition-colors">Our Story</a>
                        </li>
                        <li><a href="{{ route('page.blog') }}" class="hover:text-[#CBA65A] transition-colors">Blogs</a></li>
                    </ul>
                </div>
            </div>

            <!-- Right: Sign Up -->
            <div class="flex flex-col items-start gap-4 lg:w-[400px]">
                <h4 style="font-family: 'Outfit'"
                    class="font-['Outfit'] font-bold text-[#0D0D0E] text-[28px] min-[2000px]:text-5xl leading-[1.2]">
                    Sign up <br>for Exclusive Offers
                </h4>
                <p
                    class="font-['Outfit'] text-base min-[2000px]:text-xl text-[#6E6E6E] leading-relaxed max-w-[350px]">
                    Be the first to know about new collections, exclusive deals & more!
                </p>
                <form class="flex flex-row gap-3 mt-4 w-full" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Email Address"
                        class="border border-[#E5E5E5] rounded-full px-6 py-3 text-base min-[2000px]:text-xl w-full outline-none focus:border-[#CBA65A] font-Outfit bg-white placeholder-gray-400 h-[54px] min-[2000px]:h-[70px] flex-grow">
                    <button type="submit"
                        class="bg-[#F9F4E8] text-[#5C4522] px-10 py-3 rounded-full text-base min-[2000px]:text-xl font-medium border border-[#EADDCC] hover:bg-[#F0E6D6] transition-colors font-Outfit whitespace-nowrap h-[54px] min-[2000px]:h-[70px] shadow-sm">
                        Submit
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col gap-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center md:items-end gap-8">
                <!-- Left: QR and Apps -->
                <div class="flex items-center gap-6">
                    <img src="{{ asset('assets/MobileQrNew.png') }}" alt="QR Code" class="w-40 h-40 object-contain">
                    <div class="flex flex-col gap-2">
                        <a href="#"><img src="{{ asset('assets/ioslogo.png') }}" alt="App Store"
                                class="h-[45px] md:h-[65px] w-auto"></a>
                        <a href="#"><img src="{{ asset('assets/Androidelogo.png') }}" alt="Google Play"
                                class="h-[45px] md:h-[65px] w-auto"></a>
                    </div>
                </div>

                <!-- Right Group: Socials, Rights, Payments -->
                <div class="flex flex-col items-center md:items-start gap-6">
                    <!-- Socials -->
                    <div class="flex gap-5">
                        <a href="#"
                            class="w-[50px] h-[50px] rounded-full border border-[#5C4522] flex items-center justify-center text-[#5C4522] text-2xl hover:bg-[#5C4522] hover:text-white transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-[50px] h-[50px] rounded-full border border-[#5C4522] flex items-center justify-center text-[#5C4522] text-2xl hover:bg-[#5C4522] hover:text-white transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-[50px] h-[50px] rounded-full border border-[#5C4522] flex items-center justify-center text-[#5C4522] text-2xl hover:bg-[#5C4522] hover:text-white transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-[50px] h-[50px] rounded-full border border-[#5C4522] flex items-center justify-center text-[#5C4522] text-2xl hover:bg-[#5C4522] hover:text-white transition-all">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                    </div>

                    <!-- Rights & Payments Group (Left Aligned) -->
                    <div class="flex flex-col items-start gap-3">
                        <!-- Rights Text -->
                        <p class="font-['Outfit'] text-[14px] text-[#5C5C5C]">All Rights Reserved &copy; Tattsvi</p>

                        <!-- Payments -->
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/google_pay.png') }}" alt="GPay" class="h-6">
                            <img src="{{ asset('assets/visa.png') }}" alt="Visa" class="h-4">
                            <img src="{{ asset('assets/paypal.png') }}" alt="PayPal" class="h-6">
                            <img src="{{ asset('assets/master-card.png') }}" alt="Mastercard" class="h-8">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="text-center mt-4">
                <p class="font-Outfit text-[14px] min-[2000px]:text-lg text-[#0D0D0E]">Copyright &copy; Tattsvi
                    {{ date('Y') }}. All
                    Right Reserved</p>
            </div>
        </div>
    </div>

    <!-- Watermark -->
    <div class="w-full flex justify-center pointer-events-none mt-10">
        <h1 class="text-[15vw] font-Outfit font-[900] uppercase tracking-[0.2em] leading-none select-none"
            style="background: linear-gradient(180deg, rgba(151, 102, 0, 0.07) 0%, rgba(219, 179, 88, 0.021) 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;">
            TATTSVI
        </h1>
    </div>
</footer>