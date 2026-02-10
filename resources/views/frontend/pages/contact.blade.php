@extends('frontend.layouts.master')


@section('content')
    <!-- Main Content -->
    <main class="w-full flex-grow relative">
        <!-- Banner Section (Beige Background) -->
        <section class="bg-[#EFE4CD] pt-[80px] pb-[190px] md:pb-[230px] text-center px-6">
            <h1 class="font-['outfit'] text-[#826230] text-4xl md:text-[56px] font-medium leading-tight mb-4">Contact us
            </h1>
        </section>

        <!-- Overlapping Card Section -->
        <section class="max-w-[1240px] mx-auto px-4 md:px-6 -mt-[140px] md:-mt-[160px] relative z-10 mb-20">
            <div
                class="flex flex-col lg:flex-row justify-between pr-0 lg:pr-16 shadow-[0px_8px_30px_rgba(0,0,0,0.05)] rounded-[30px] md:rounded-[60px] overflow-hidden bg-white py-8 md:py-16">

                <!-- Left Form Side (White) -->
                <div class="p-6 md:px-16 md:py-14 lg:w-[65%] xl:w-[68%]">
                    <h2 class="font-['Outfit'] text-[28px] md:text-[32px] font-bold text-[#1A1A1A] mb-2 leading-tight">
                        Send us a message</h2>
                    <p class="font-['Outfit'] text-[15px] text-[#5C5C5C] mb-10 leading-relaxed max-w-[600px]">Do you
                        have a question? A complaint? Or need any help to choose the right product from Tattsvi. Feel
                        free to contact us.</p>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <!-- First Name -->
                            <div class="flex flex-col gap-2">
                                <label class="font-['Outfit'] text-[16px] font-bold text-[#1A1A1A]">First Name</label>
                                <input type="text" placeholder="Name*"
                                    class="border border-[#EBEBEB] rounded-[8px] px-5 py-[16px] text-[15px] focus:outline-none focus:border-[#CBA65A] bg-white placeholder-[#9C9C9C] font-['Outfit']">
                            </div>
                            <!-- Last Name -->
                            <div class="flex flex-col gap-2">
                                <label class="font-['Outfit'] text-[16px] font-bold text-[#1A1A1A]">Last Name</label>
                                <input type="text" placeholder="Name*"
                                    class="border border-[#EBEBEB] rounded-[8px] px-5 py-[16px] text-[15px] focus:outline-none focus:border-[#CBA65A] bg-white placeholder-[#9C9C9C] font-['Outfit']">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <!-- Email -->
                            <div class="flex flex-col gap-2">
                                <label class="font-['Outfit'] text-[16px] font-bold text-[#1A1A1A]">Email</label>
                                <input type="email" placeholder="Enter Your Email"
                                    class="border border-[#EBEBEB] rounded-[8px] px-5 py-[16px] text-[15px] focus:outline-none focus:border-[#CBA65A] bg-white placeholder-[#9C9C9C] font-['Outfit']">
                            </div>
                            <!-- Contact Details -->
                            <div class="flex flex-col gap-2">
                                <label class="font-['Outfit'] text-[16px] font-bold text-[#1A1A1A]">Contact
                                    Details</label>
                                <div
                                    class="flex items-center border border-[#EBEBEB] rounded-[8px] overflow-hidden bg-white h-[54px]">
                                    <div class="relative border-r border-[#EBEBEB] h-[30px] my-auto flex items-center pr-2">
                                        <select
                                            class="bg-transparent pl-4 pr-6 h-full text-[15px] outline-none appearance-none text-[#1A1A1A] font-['Outfit'] cursor-pointer">
                                            <option>+91</option>
                                            <option>+1</option>
                                        </select>
                                        <i
                                            class="fa-solid fa-chevron-down absolute right-2 text-[10px] text-[#1A1A1A] pointer-events-none"></i>
                                    </div>
                                    <input type="tel" placeholder="Phone Number"
                                        class="w-full px-4 h-full text-[15px] focus:outline-none placeholder-[#9C9C9C] font-['Outfit'] bg-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="flex flex-col gap-2">
                            <label class="font-['Outfit'] text-[16px] font-bold text-[#1A1A1A]">Message</label>
                            <textarea rows="6" placeholder="Enter Your Message"
                                class="border border-[#EBEBEB] rounded-[8px] px-5 py-5 text-[15px] focus:outline-none focus:border-[#CBA65A] resize-none bg-white placeholder-[#9C9C9C] font-['Outfit']"></textarea>
                        </div>

                        <!-- Button -->
                        <div class="flex justify-end w-full pt-6">
                            <button type="button"
                                class="flex flex-row justify-center items-center px-[42px] py-[16px] gap-[10px] w-[266px] h-[62px] bg-gradient-to-r from-[#D9BE87] to-[#BE933C] rounded-[100px] text-white font-['Outfit'] text-[16px] font-semibold hover:shadow-lg transition-shadow">
                                Send a messages
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Info Side (Gold) -->
                <div
                    class="flex flex-col justify-center items-start p-6 md:p-[32px] gap-5 md:gap-[30px] w-full lg:w-[425px] h-auto md:h-[640px] bg-gradient-to-r from-[#D9BE87] to-[#BE933C] rounded-[20px] md:rounded-[30px] text-white flex-shrink-0">

                    <div>
                        <h3 class="font-['Outfit'] text-[24px] md:text-[26px] font-semibold mb-2 leading-snug">Hi! We
                            are always here <br>to help you.</h3>
                    </div>

                    <div class="space-y-4 w-full">
                        <!-- Helpline -->
                        <div
                            class="bg-[#D8C696] bg-opacity-40 p-4 md:p-[20px] rounded-[12px] md:rounded-[16px] flex items-center gap-3 md:gap-4 border border-[#ebd6a6] border-opacity-20 backdrop-blur-sm w-full">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <i class="fa-regular fa-heart text-[#352516] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-[#352516] opacity-90 font-['Outfit'] font-normal mb-1">
                                    Helpline:</p>
                                <p class="font-semibold text-[#352516] font-['Outfit'] text-[16px]">18004190066</p>
                            </div>
                        </div>
                        <!-- SMS/Whatsapp -->
                        <div
                            class="bg-[#D8C696] bg-opacity-40 p-4 md:p-[20px] rounded-[12px] md:rounded-[16px] flex items-center gap-3 md:gap-4 border border-[#ebd6a6] border-opacity-20 backdrop-blur-sm w-full">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <i class="fa-regular fa-heart text-[#352516] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-[#352516] opacity-90 font-['Outfit'] font-normal mb-1">SMS/
                                    WhatsApp</p>
                                <p class="font-semibold text-[#352516] font-['Outfit'] text-[16px]">18004190066</p>
                            </div>
                        </div>
                        <!-- Email -->
                        <div
                            class="bg-[#D8C696] bg-opacity-40 p-4 md:p-[20px] rounded-[12px] md:rounded-[16px] flex items-center gap-3 md:gap-4 border border-[#ebd6a6] border-opacity-20 backdrop-blur-sm w-full">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <i class="fa-regular fa-heart text-[#352516] text-xl"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[13px] text-[#352516] opacity-90 font-['Outfit'] font-normal mb-1">Email:
                                </p>
                                <p class="font-semibold text-[#352516] font-['Outfit'] text-[16px] break-all">
                                    support@tattsvi.com
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 w-full">
                        <div class="flex items-center gap-4 mb-6 w-full">
                            <div class="h-[1px] bg-white opacity-40 flex-grow"></div>
                            <span class="text-white text-2xl relative top-[-2px]">✦</span>
                            <div class="h-[1px] bg-white opacity-40 flex-grow"></div>
                        </div>
                        <p class="text-[16px] font-['Outfit'] mb-5 font-medium">Connect with us</p>
                        <div class="flex gap-5">
                            <a href="#"
                                class="w-[40px] h-[40px] rounded-full  text-white flex items-center justify-center hover:bg-opacity-90 transition-all text-lg">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-[40px] h-[40px] rounded-full text-white flex items-center justify-center hover:bg-opacity-90 transition-all text-lg">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-[40px] h-[40px] rounded-full text-white flex items-center justify-center hover:bg-opacity-90 transition-all text-lg">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#"
                                class="w-[40px] h-[40px] rounded-full text-white flex items-center justify-center hover:bg-opacity-90 transition-all text-lg">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

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
            <div class="flex gap-4 md:gap-6 md:justify-center">
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
@endsection