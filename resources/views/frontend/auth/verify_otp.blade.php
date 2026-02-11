@extends('frontend.layouts.master')

@section('title', 'Verify OTP - Tattsvi')

@section('content')
    <!-- Main Content -->
    <main
        class="w-full h-full flex items-center justify-center flex-grow pt-4 pb-16 px-4 md:px-0 min-[2000px]:pt-20 min-[2000px]:pb-32">
        <div
            class="flex flex-col justify-start items-center w-full max-w-[1840px] min-[2000px]:max-w-[2600px] min-h-[622px] min-[2000px]:min-h-[800px] pt-4 md:pt-10 flex-grow order-0">
            <!-- Sign In Text -->
            <p
                class="font-['Alexandria'] text-[#8B7E66] text-sm md:text-base min-[2000px]:text-2xl font-medium mb-1 min-[2000px]:mb-3">
                Sign In
            </p>

            <!-- Welcome Heading -->
            <div
                class="flex items-center justify-center w-full gap-2 md:gap-4 min-[2000px]:gap-8 mb-10 min-[2000px]:mb-20 w-full max-w-[90%] md:max-w-[1600px] min-[2000px]:max-w-[2200px]">
                <img src="{{ asset('assets/Design.png') }}" alt="design left"
                    class="h-3 md:h-auto min-[2000px]:h-16 w-full flex-1 object-contain object-right max-w-[60px] md:max-w-[400px] min-[2000px]:max-w-[600px] opacity-80">
                <h1
                    class="font-['outfit'] text-[#CBA65A] text-2xl md:text-[50px] min-[2000px]:text-[80px] font-medium tracking-wide whitespace-nowrap px-2 md:px-4 min-[2000px]:px-8">
                    Welcome to Tattsvi
                </h1>
                <img src="{{ asset('assets/DesignRight.png') }}" alt="design right"
                    class="h-3 md:h-auto min-[2000px]:h-16 w-full flex-1 object-contain object-left max-w-[60px] md:max-w-[400px] min-[2000px]:max-w-[600px] opacity-80">
            </div>

            <!-- Verify OTP Form -->
            <div class="w-full max-w-[320px] md:max-w-[420px] min-[2000px]:max-w-[600px] flex flex-col items-center">
                <h2 class="font-['Outfit'] font-medium text-[#1A1A1A] text-xl min-[2000px]:text-3xl mb-1 min-[2000px]:mb-3">
                    Verify OTP
                </h2>
                <p
                    class="font-['Outfit'] text-[#8B7E66] text-[13px] min-[2000px]:text-xl mb-8 min-[2000px]:mb-12 text-center">
                    Sent to {{ $phone }}
                </p>

                <!-- Error Message -->
                <div id="error-message" class="w-full mb-4 hidden">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm font-['Outfit']">
                        <span id="error-text"></span>
                    </div>
                </div>

                <!-- Success Message -->
                <div id="success-message" class="w-full mb-4 hidden">
                    <div
                        class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-['Outfit']">
                        <span id="success-text"></span>
                    </div>
                </div>

                <!-- OTP Input Group -->
                <form id="otp-form" class="w-full">
                    @csrf
                    <style>
                        .otp-input:not(:placeholder-shown) {
                            border-color: #CBA65A;
                            background-color: #fffaf2;
                        }
                    </style>
                    <div class="flex gap-2 min-[2000px]:gap-4 mb-6 min-[2000px]:mb-10 w-full justify-center">
                        <input type="text" maxlength="1" placeholder="-" data-index="0"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                        <input type="text" maxlength="1" placeholder="-" data-index="1"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                        <input type="text" maxlength="1" placeholder="-" data-index="2"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                        <input type="text" maxlength="1" placeholder="-" data-index="3"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                        <input type="text" maxlength="1" placeholder="-" data-index="4"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                        <input type="text" maxlength="1" placeholder="-" data-index="5"
                            class="otp-input w-[45px] h-[45px] md:w-[54px] md:h-[54px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] border border-gray-200 rounded-[8px] text-center text-lg md:text-xl min-[2000px]:text-4xl outline-none focus:border-[#CBA65A] focus:bg-[#fffaf2] transition-all font-['Outfit'] font-medium text-[#CBA65A] placeholder-gray-300 shadow-sm" />
                    </div>

                    <!-- Resend OTP -->
                    <div class="flex items-center justify-between w-full mb-10 min-[2000px]:mb-16 px-1">
                        <span class="font-['Outfit'] text-[#1A1A1A] text-[13px] min-[2000px]:text-xl">Didn't receive the
                            OTP?</span>
                        <button type="button" id="resend-btn"
                            class="font-['Outfit'] text-[#CBA65A] text-[13px] min-[2000px]:text-xl font-medium underline decoration-1 underline-offset-2 hover:text-[#BE933C] transition-colors">
                            <span id="resend-text">Resend OTP</span>
                            <span id="resend-timer" class="hidden">Resend in <span id="timer-count">60</span>s</span>
                        </button>
                    </div>

                    <!-- Verify Button -->
                    <button type="submit" id="verify-btn"
                        class="flex flex-row justify-center items-center py-[18px] px-4 gap-[10px] w-full max-w-[600px] h-[54px] min-[2000px]:h-[74px] rounded-full font-['Outfit'] font-medium text-[17px] min-[2000px]:text-2xl text-white shadow-md tracking-wide hover:shadow-lg transition-all transform active:scale-[0.99] self-stretch order-1 flex-grow-0"
                        style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);">
                        <span id="btn-text">Verify</span>
                        <span id="btn-loader" class="hidden">
                            <i class="fa-solid fa-circle-notch fa-spin"></i> Verifying...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/verify_otp_1.js') }}"></script>
@endpush