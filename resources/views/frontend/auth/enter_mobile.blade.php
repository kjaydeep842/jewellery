@extends('frontend.layouts.master')

@section('title', 'Enter Mobile Number - Tattsvi')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
<style>
    .iti {
        width: 100%;
    }

    .iti__flag-container {
        padding: 0 10px;
    }

    .iti__selected-flag {
        background-color: transparent !important;
        padding: 0 15px 0 15px !important;
    }

    .iti__country-list {
        z-index: 50;
        width: 320px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        font-family: 'Outfit', sans-serif;
    }

    #phone {
        padding-left: 95px !important;
    }
</style>
@endpush

@section('content')
<!-- Main Content -->
<main class="w-full flex-grow flex flex-col items-center justify-center pt-8 pb-16 px-4">
    <div class="flex flex-col items-center w-full max-w-[1600px] gap-6">
        <!-- Sign In Text -->
        <p class="font-['Alexandria'] text-[#8B7E66] text-sm md:text-base font-medium">Sign In</p>

        <!-- Welcome Heading -->
        <div class="flex items-center justify-center w-full gap-4 max-w-2xl px-4">
            <img src="{{ asset('assets/Design.png') }}" alt="design left"
                class="h-auto w-12 md:w-32 object-contain opacity-80">
            <h1
                class="font-['Outfit'] text-[#CBA65A] text-2xl md:text-5xl font-medium tracking-wide whitespace-nowrap text-center">
                Welcome to Tattsvi
            </h1>
            <img src="{{ asset('assets/DesignRight.png') }}" alt="design right"
                class="h-auto w-12 md:w-32 object-contain opacity-80">
        </div>

        <!-- Mobile Number Form -->
        <div class="w-full max-w-[420px] flex flex-col items-center mt-4">
            <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl md:text-2xl mb-1">Enter Mobile Number</h2>
            <p class="font-['Outfit'] text-[#8B7E66] text-xs md:text-sm mb-8 text-center text-gray-500">
                We will send you an OTP to verify your number
            </p>

            <!-- Error Message -->
            <div id="error-message" class="w-full mb-4 hidden">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm font-['Outfit']">
                    <span id="error-text"></span>
                </div>
            </div>

            <!-- Input Group -->
            <form id="mobile-form" class="w-full">
                @csrf
                <div class="w-full relative mb-6">
                    <input type="tel" id="phone" name="phone" placeholder="Phone Number"
                        class="w-full h-[54px] bg-white border border-gray-200 rounded-[4px] pr-4 outline-none focus:border-[#CBA65A] transition-colors font-['Outfit'] text-[#1A1A1A] placeholder-gray-400 text-[15px] shadow-sm"
                        required>
                    <input type="hidden" id="full_phone" name="full_phone">
                </div>

                <!-- Checkbox -->
                <div class="w-full flex items-center gap-3 mb-8 pl-1">
                    <div class="relative flex items-center">
                        <input type="checkbox" id="notify" name="otp_notify" value="1"
                            class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-gray-300 checked:border-[#CBA65A] checked:bg-[#CBA65A] transition-all">
                        <i
                            class="fa-solid fa-check text-white absolute text-[10px] pointer-events-none opacity-0 peer-checked:opacity-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                    </div>
                    <label for="notify" class="font-['Outfit'] text-[#1A1A1A] text-sm cursor-pointer select-none">
                        Notify me with offers & updates
                    </label>
                </div>

                <!-- Continue Button -->
                <button type="submit" id="continue-btn"
                    class="w-full h-[54px] rounded-full font-['Outfit'] font-medium text-[17px] text-white shadow-md tracking-wide hover:shadow-lg transition-all transform active:scale-[0.99]"
                    style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);">
                    <span id="btn-text">Continue</span>
                    <span id="btn-loader" class="hidden">
                        <i class="fa-solid fa-circle-notch fa-spin"></i> Sending...
                    </span>
                </button>

                <!-- Terms -->
                <p
                    class="text-center font-['Outfit'] text-[#8B7E66] text-[11px] max-w-[300px] leading-relaxed mt-12 mx-auto">
                    I accept that I have read & understood your <br>
                    <a href="#" class="underline hover:text-[#CBA65A] transition-colors">Privacy Policy</a> and
                    <a href="#" class="underline hover:text-[#CBA65A] transition-colors">T&Cs</a>.
                </p>
            </form>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<script src="{{ asset('js/enter_mobile_no.js') }}"></script>
@endpush