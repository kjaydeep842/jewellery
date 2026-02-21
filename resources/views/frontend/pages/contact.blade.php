@extends('frontend.layouts.master')


@section('content')
<!-- Main Content -->
<main class="w-full flex-grow relative bg-[#FDFBF7]">
    <!-- Breadcrumbs -->
    <div class="max-w-[1600px] mx-auto px-6 py-4">
        <p class="text-xs text-gray-500 font-['Outfit']">
            Home / <span class="text-[#1A1A1A] font-medium">Contact us</span>
        </p>
    </div>

    <!-- Banner Section (Beige Background) -->
    <section class="bg-[#EFE4CD] pt-10 pb-48 md:pb-64 text-center px-6">
        <h1 class="font-['outfit'] text-[#826230] text-[40px] md:text-[56px] font-semibold leading-tight mb-2">
            Contact us
        </h1>
    </section>

    <!-- Overlapping Cards Container -->
    <section class="max-w-[1240px] mx-auto px-4 md:px-6 -mt-40 md:-mt-52 relative z-10 mb-20">
        <div class="relative w-full">

            <!-- White Form Card -->
            <div
                class="bg-white rounded-[30px] md:rounded-[40px] shadow-[0_4px_40px_rgba(0,0,0,0.04)] p-6 md:p-12 lg:pr-40 xl:pr-56 w-full lg:w-[75%] relative z-10">

                <div class="mb-8">
                    <h2 class="font-['Outfit'] text-[24px] md:text-[30px] font-bold text-[#1A1A1A] mb-3">
                        Send us a message
                    </h2>
                    <p class="font-['Outfit'] text-[14px] md:text-[15px] text-[#5C5C5C] leading-relaxed max-w-[600px]">
                        Do you have a question? A complaint? Or need any help to choose the right product from
                        Tattsvi. Feel free to contact us.
                    </p>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Name Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-['Outfit'] text-[15px] font-bold text-[#1A1A1A]">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Name*"
                                class="w-full border @error('first_name') border-red-500 @else border-[#EBEBEB] @enderror rounded-[8px] px-4 py-3 text-[15px] outline-none focus:border-[#CBA65A] font-['Outfit'] placeholder-[#BBBBBB]">
                            @error('first_name')
                            <span class="text-red-500 text-xs font-['Outfit']">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-['Outfit'] text-[15px] font-bold text-[#1A1A1A]">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Name*"
                                class="w-full border @error('last_name') border-red-500 @else border-[#EBEBEB] @enderror rounded-[8px] px-4 py-3 text-[15px] outline-none focus:border-[#CBA65A] font-['Outfit'] placeholder-[#BBBBBB]">
                            @error('last_name')
                            <span class="text-red-500 text-xs font-['Outfit']">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email / Phone Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-['Outfit'] text-[15px] font-bold text-[#1A1A1A]">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Your Email"
                                class="w-full border @error('email') border-red-500 @else border-[#EBEBEB] @enderror rounded-[8px] px-4 py-3 text-[15px] outline-none focus:border-[#CBA65A] font-['Outfit'] placeholder-[#BBBBBB]">
                            @error('email')
                            <span class="text-red-500 text-xs font-['Outfit']">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-['Outfit'] text-[15px] font-bold text-[#1A1A1A]">Contact Details</label>
                            <div class="flex items-center border @error('phone_number') border-red-500 @else border-[#EBEBEB] @enderror rounded-[8px] overflow-hidden">
                                <div class="border-r border-[#EBEBEB] px-3 py-3 bg-white">
                                    <select name="phone_code"
                                        class="bg-transparent text-[15px] outline-none font-['Outfit'] text-[#1A1A1A] cursor-pointer">
                                        <option value="+91" {{ old('phone_code') == '+91' ? 'selected' : '' }}>+91</option>
                                        <option value="+1" {{ old('phone_code') == '+1' ? 'selected' : '' }}>+1</option>
                                    </select>
                                </div>
                                <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number"
                                    class="w-full px-4 py-3 text-[15px] outline-none font-['Outfit'] placeholder-[#BBBBBB]">
                            </div>
                            @error('phone_number')
                            <span class="text-red-500 text-xs font-['Outfit']">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="flex flex-col gap-2">
                        <label class="font-['Outfit'] text-[15px] font-bold text-[#1A1A1A]">Message</label>
                        <textarea name="message" rows="6" placeholder="Enter Your Message"
                            class="w-full border @error('message') border-red-500 @else border-[#EBEBEB] @enderror rounded-[8px] px-4 py-3 text-[15px] outline-none focus:border-[#CBA65A] resize-none font-['Outfit'] placeholder-[#BBBBBB]">{{ old('message') }}</textarea>
                        @error('message')
                        <span class="text-red-500 text-xs font-['Outfit']">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button - Aligned Right -->
                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="bg-[#CBA65A] hover:bg-[#b08e48] text-white font-['Outfit'] text-[16px] font-medium px-10 py-3 rounded-full shadow-md transition-colors w-full md:w-auto">
                            Send a messages
                        </button>
                    </div>
                </form>
            </div>

            <!-- Gold Info Card - Absolute on Desktop to Overlap -->
            <div class="mt-8 lg:mt-0 lg:absolute lg:top-12 lg:right-0 lg:w-[32%] z-20">
                <div
                    class="bg-[#CCA863] rounded-[30px] p-8 md:p-10 text-white shadow-xl h-full flex flex-col justify-between min-h-[500px]">

                    <div class="mb-8">
                        <h3 class="font-['Outfit'] text-[24px] font-medium leading-snug">
                            Hi! We are always here <br>to help you.
                        </h3>
                    </div>

                    <div class="space-y-4 flex-grow">
                        <!-- Helpline -->
                        <div class="bg-[#D8C696] bg-opacity-30 rounded-[16px] p-4 flex items-center gap-4">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <i class="fa-solid fa-headset text-[#4A3B22] text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[#4A3B22] text-[13px] opacity-80 font-['Outfit']">Helpline:</span>
                                <span class="text-[#4A3B22] text-[16px] font-semibold font-['Outfit']">18004190066</span>
                            </div>
                        </div>

                        <!-- SMS/WhatsApp -->
                        <div class="bg-[#D8C696] bg-opacity-30 rounded-[16px] p-4 flex items-center gap-4">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <i class="fa-regular fa-comment-dots text-[#4A3B22] text-xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[#4A3B22] text-[13px] opacity-80 font-['Outfit']">SMS/ WhatsApp</span>
                                <span class="text-[#4A3B22] text-[16px] font-semibold font-['Outfit']">18004190066</span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-[#D8C696] bg-opacity-30 rounded-[16px] p-4 flex items-center gap-4">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <i class="fa-regular fa-envelope text-[#4A3B22] text-xl"></i>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[#4A3B22] text-[13px] opacity-80 font-['Outfit']">Email:</span>
                                <span class="text-[#4A3B22] text-[16px] font-semibold font-['Outfit'] break-all">support@tattsvi.com</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social Section -->
                    <div class="mt-8">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-[1px] bg-white opacity-40 flex-grow"></div>
                            <div class="text-white opacity-60">✦</div>
                            <div class="h-[1px] bg-white opacity-40 flex-grow"></div>
                        </div>

                        <p class="text-[15px] font-['Outfit'] mb-4 font-medium">Connect with us</p>

                        <div class="flex gap-4">
                            <a href="#"
                                class="w-9 h-9 flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white transition-all">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                            <a href="#"
                                class="w-9 h-9 flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white transition-all">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="#"
                                class="w-9 h-9 flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white transition-all">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                            <a href="#"
                                class="w-9 h-9 flex items-center justify-center bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white transition-all">
                                <i class="fab fa-x-twitter text-sm"></i>
                            </a>
                        </div>
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
            <p class="font-['Outfit'] text-[#5C5C5C] text-sm mb-1 tracking-widest">Visit</p>
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
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_1.png') }}" alt="Instagram Post 1" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_2.png') }}" alt="Instagram Post 2" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_3.png') }}" alt="Instagram Post 3" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_4.png') }}" alt="Instagram Post 4" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_5.png') }}" alt="Instagram Post 5" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_6.png') }}" alt="Instagram Post 6" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_7.png') }}" alt="Instagram Post 7" class="w-full h-full object-cover">
            </div>
            <div class="w-[180px] h-[220px] md:w-[220px] md:h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <img src="{{ asset('assets/our_story_8.png') }}" alt="Instagram Post 8" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>

<!-- Know More Section -->
<div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
    <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
</div>
@endsection