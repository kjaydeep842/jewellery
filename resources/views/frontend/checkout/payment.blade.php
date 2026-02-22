@extends('frontend.layouts.master')

@section('content')
    <style>
        /* Hide Default Header/Ticker */
        #header-placeholder,
        .ticker-wrapper {
            display: none !important;
        }

        /* Payment Option Styling */
        .payment-option {
            transition: all 0.2s ease;
        }

        .payment-option:hover:not(.payment-disabled) {
            background-color: #FDFBF7;
        }

        .payment-disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
            pointer-events: none;
        }
    </style>

    <!-- Custom Ticker -->
    <div class="ticker-wrapper" style="display: block !important;">
        <div class="ticker">
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
            <span>✦ Find a new reason to shine with our Solitaires ✦</span>
        </div>
    </div>

    <!-- Custom Header with Stepper -->
    <header class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-[1920px] mx-auto px-6 py-4 flex flex-wrap lg:flex-nowrap justify-between items-center gap-4">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-800 hover:text-[#CBA65A] transition-colors">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="w-[120px]">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/logo_black.png') }}" alt="Tattsvi" class="w-full h-auto">
                    </a>
                </div>
            </div>

            <!-- Stepper (Active: PAYMENT) -->
            <div class="hidden md:flex items-center gap-4 text-sm font-medium tracking-wide">
                <div class="text-[#CBA65A]">BAG</div>
                <div class="text-[#CBA65A]">----------</div>
                <div class="text-[#CBA65A] ">ADDRESS</div>
                <div class="text-[#CBA65A]">----------</div>
                <div class="text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1">PAYMENT</div>
            </div>

            <!-- Secure Badge -->
            <div class="flex items-center gap-2 text-green-600 font-medium text-sm">
                <img src="{{ asset('assets/L- Brand Logo.png') }}" alt="Secure" class="h-6 w-auto object-contain"> 100%
                SECURE
            </div>
        </div>

        <!-- Gradient Navigation Bar -->
        <nav
            class="hidden lg:flex items-center justify-center space-x-6 min-[2000px]:space-x-12 text-[15px] min-[2000px]:text-2xl font-['Outfit'] font-medium tracking-wide bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] w-full py-[14px] text-white">
            <div class="relative group">
                <a href="{{ route('page.new-arrivals') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">New Arrivals</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.best-seller') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">Best Seller</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.18kt') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">18KT Jewellery</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.tattsvisfavourite') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">Tattsvi's Favourite</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.exhibition') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">Exhibition</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.readytostock') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">Ready To Stock</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.contact') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">Contact Us</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.about') }}"
                    class="flex items-center gap-1 hover:text-white/80 transition-colors">About Us</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-[1920px] mx-auto px-4 lg:px-6 py-8 flex flex-col gap-8 min-h-[600px]">

        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST"
            class="w-full flex flex-col lg:flex-row justify-center items-start gap-8">
            @csrf
            <input type="hidden" name="payment_method" id="selected_payment_method" value="cod"> <!-- Default COD -->

            <!-- Left Column: Payment Modes -->
            <div class="w-full flex-1 flex flex-col gap-6">

                <!-- Header -->
                <h2 class="font-bold text-[#1A1A1A] text-xl font-Outfit">Choose Payment Mode</h2>

                <!-- Payment Container -->
                <div
                    class="bg-white border border-gray-100 rounded-[10px] flex flex-col md:flex-row overflow-hidden min-h-[400px] shadow-sm">

                    <!-- Sidebar Options -->
                    <div class="w-full md:w-[280px] bg-[#FDFBF7] flex flex-col border-r border-gray-100 p-0">

                        <div onclick="selectPaymentMode('upi')" id="mode-upi"
                            class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-white flex items-center gap-3 transition-colors border-l-[4px] border-transparent border-b border-gray-100 md:border-b-0 payment-disabled">
                            <span
                                class="text-[10px] font-bold border border-gray-400 text-gray-400 px-1 rounded-[2px] uppercase">UPI</span>
                            <span class="text-sm font-medium font-Outfit tab-text">UPI (Pay via any App)</span>
                        </div>

                        <div onclick="selectPaymentMode('card')" id="mode-card"
                            class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-white flex items-center gap-4 transition-colors border-l-[4px] border-transparent border-b border-gray-100 md:border-b-0 payment-disabled">
                            <img src="{{ asset('assets/card.png') }}" alt="Credit/Debit Card"
                                class="w-5 h-5 object-contain opacity-70">
                            <span class="font-medium font-Outfit text-sm tab-text">Credit/Debit Card</span>
                        </div>

                        <div onclick="selectPaymentMode('netbanking')" id="mode-netbanking"
                            class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-white flex items-center gap-4 transition-colors border-l-[4px] border-transparent border-b border-gray-100 md:border-b-0 payment-disabled">
                            <img src="{{ asset('assets/ic_bank.png') }}" alt="Net Banking"
                                class="w-5 h-5 object-contain opacity-70">
                            <span class="font-medium font-Outfit text-sm tab-text">Net Banking</span>
                        </div>

                        <div onclick="selectPaymentMode('wallet')" id="mode-wallet"
                            class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-white flex items-center gap-4 transition-colors border-l-[4px] border-transparent border-b border-gray-100 md:border-b-0 payment-disabled">
                            <img src="{{ asset('assets/Ic_Wallet.png') }}" alt="Wallets"
                                class="w-5 h-5 object-contain opacity-70">
                            <span class="font-medium font-Outfit text-sm tab-text">Wallets</span>
                        </div>

                        <div onclick="selectPaymentMode('emi')" id="mode-emi"
                            class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-white flex items-center gap-4 transition-colors border-l-[4px] border-transparent border-b border-gray-100 md:border-b-0 payment-disabled">
                            <img src="{{ asset('assets/ic_emi.png') }}" alt="EMI" class="w-5 h-5 object-contain opacity-70">
                            <span class="font-medium font-Outfit text-sm tab-text">EMI</span>
                        </div>

                        <div onclick="selectPaymentMode('cod')" id="mode-cod"
                            class="payment-option p-4 cursor-pointer bg-white border-l-[4px] border-[#CBA65A] text-[#CBA65A] flex items-center gap-4 transition-colors border-b border-gray-100 md:border-b-0">
                            <img src="{{ asset('assets/ic_cash.png') }}" alt="COD" class="w-5 h-5 object-contain">
                            <span class="font-bold font-Outfit text-sm tab-text">Cash On Delivery</span>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="flex-1 p-8 bg-white" id="payment-content">

                        <!-- UPI Content -->
                        <div id="content-upi" class="payment-content-section hidden">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                Pay using UPI</h3>
                            <div class="flex flex-col gap-6">
                                <label
                                    class="flex items-center gap-4 cursor-pointer group p-3 rounded-lg border border-gray-100 hover:border-[#CBA65A] transition-colors bg-[#FDFBF7]">
                                    <input type="radio" name="upi_method" value="scan" class="accent-[#CBA65A] w-4 h-4"
                                        checked>
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('assets/scaneandpay.png') }}" alt="Scan & Pay"
                                            class="w-[30px] h-[30px] object-contain">
                                        <span class="text-gray-900 font-medium text-sm font-Outfit">Scan & Pay</span>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center gap-4 cursor-pointer group p-3 rounded-lg border border-gray-100 hover:border-[#CBA65A] transition-colors bg-white">
                                    <input type="radio" name="upi_method" value="id" class="accent-[#CBA65A] w-4 h-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                                            @
                                        </div>
                                        <span class="text-gray-900 font-medium text-sm font-Outfit">Enter UPI ID</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Credit/Debit Card Content -->
                        <div id="content-card" class="payment-content-section hidden">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                Credit/Debit Card</h3>
                            <div class="space-y-6 max-w-[400px]">
                                <input type="text" name="card_number" placeholder="Card Number"
                                    class="w-full p-3 border border-gray-200 rounded text-sm focus:border-[#CBA65A] outline-none font-Outfit">
                                <input type="text" name="card_name" placeholder="Name On Card"
                                    class="w-full p-3 border border-gray-200 rounded text-sm focus:border-[#CBA65A] outline-none font-Outfit">
                                <div class="flex gap-4">
                                    <input type="text" name="card_expiry" placeholder="Valid Thru (MM/YY)"
                                        class="flex-1 p-3 border border-gray-200 rounded text-sm focus:border-[#CBA65A] outline-none font-Outfit">
                                    <input type="text" name="card_cvv" placeholder="CVV"
                                        class="flex-1 p-3 border border-gray-200 rounded text-sm focus:border-[#CBA65A] outline-none font-Outfit">
                                </div>
                            </div>
                        </div>

                        <!-- Net Banking Content -->
                        <div id="content-netbanking" class="payment-content-section hidden">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                Net Banking</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="bank_name" value="Axis Bank" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">Axis Bank</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="bank_name" value="HDFC Bank" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">HDFC Bank</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="bank_name" value="ICICI Bank" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">ICICI Bank</span>
                                </label>
                                <div class="col-span-2 mt-2">
                                    <select name="other_bank_name"
                                        class="w-full p-3 border border-gray-200 rounded text-sm outline-none focus:border-[#CBA65A]">
                                        <option value="" selected>Select Other Bank</option>
                                        <option value="SBI">State Bank of India</option>
                                        <option value="PNB">Punjab National Bank</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Wallet Content -->
                        <div id="content-wallet" class="payment-content-section hidden">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                Wallets</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="wallet_name" value="Paytm" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">Paytm</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="wallet_name" value="PhonePe" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">PhonePe</span>
                                </label>
                                <label
                                    class="flex items-center gap-3 cursor-pointer p-3 border border-gray-200 rounded hover:border-[#CBA65A]">
                                    <input type="radio" name="wallet_name" value="Amazon Pay" class="accent-[#CBA65A]">
                                    <span class="text-sm font-medium">Amazon Pay</span>
                                </label>
                            </div>
                        </div>

                        <!-- EMI & COD Content -->
                        <div id="content-emi" class="payment-content-section hidden">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                EMI Options</h3>
                            <p class="text-sm text-gray-500">No EMI options available for this order.</p>
                        </div>

                        <div id="content-cod" class="payment-content-section">
                            <h3 class="font-bold text-[#1A1A1A] text-base mb-6 font-Outfit border-b border-gray-100 pb-2">
                                Cash On Delivery</h3>
                            <div class="flex items-start gap-3 p-4 bg-[#FDFBF7] rounded border border-[#CBA65A]">
                                <input type="checkbox" id="cod_option_final" name="cod_payment" value="1"
                                    class="mt-1 accent-[#CBA65A] w-4 h-4">
                                <div>
                                    <label for="cod_option_final"
                                        class="font-medium text-gray-900 cursor-pointer block">Cash on Delivery
                                        (Cash/UPI)</label>
                                    <p class="text-xs text-gray-500 mt-1">Pay comfortably at your doorstep.</p>
                                </div>
                            </div>
                        </div>

                        <div id="content-generic" class="payment-content-section hidden">
                            <p class="text-sm text-gray-500">Please select a valid payment option.</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Price Details -->
            <div class="w-full lg:w-1/3 flex-shrink-0">
                <div class="bg-white border text-sm border-gray-100 rounded-lg p-6 sticky top-28 shadow-sm">
                    <h3 class="font-bold text-gray-900 text-lg mb-6 font-Outfit border-b border-gray-100 pb-3">Price Details
                        ({{ $cartItems->count() }} Item)</h3>

                    <div class="space-y-4 pb-6 mb-4 border-b border-gray-100 font-Outfit">
                        <div class="flex justify-between text-gray-600">
                            <span>Total MRP</span>
                            <span class="font-medium">₹{{ number_format($totalMrp, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Discount on MRP</span>
                            <span>-₹{{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Platform Fee</span>
                            <span class="font-medium">₹{{ number_format($platformFee, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center font-bold text-gray-900 text-xl mb-6 font-Outfit">
                        <span>Total Amount</span>
                        <span>₹{{ number_format($totalAmount, 2) }}</span>
                    </div>

                    <div class="bg-[#F8F8F8] p-4 rounded mb-6 text-xs text-gray-600 font-Outfit">
                        <p class="font-bold text-gray-800 mb-1">Delivering To:</p>
                        <p class="font-medium">{{ $address->name }}</p>
                        <p>{{ $address->address_line_1 }}</p>
                        <p>{{ $address->city }}, {{ $address->zip }}</p>
                        <p>Mobile: {{ $address->phone }}</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('checkout.address') }}"
                            class="flex-1 py-3 text-center border border-gray-300 text-gray-600 font-medium rounded-full hover:bg-gray-50 transition-colors uppercase text-sm">
                            Back
                        </a>
                        <button type="submit"
                            class="flex-[2] py-3 bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] text-white font-medium rounded-full shadow-lg hover:opacity-90 transition-opacity uppercase text-sm">
                            Pay Now
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-400">Need Help? <a href="{{ route('page.contact') }}"
                                class="text-[#CBA65A] hover:underline">Contact Us</a></p>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script>
        function selectPaymentMode(mode) {
            // Update hidden input
            document.getElementById('selected_payment_method').value = mode;

            // Update Sidebar Styles
            document.querySelectorAll('.payment-option').forEach(el => {
                const textSpan = el.querySelector('.tab-text');
                if (el.id === 'mode-' + mode) {
                    el.classList.remove('text-gray-700', 'hover:bg-white', 'border-transparent');
                    el.classList.add('bg-white', 'border-[#CBA65A]', 'text-[#CBA65A]');
                    if (textSpan) {
                        textSpan.classList.remove('font-medium', 'font-semibold');
                        textSpan.classList.add('font-bold');
                    }
                } else {
                    el.classList.remove('bg-white', 'border-[#CBA65A]', 'text-[#CBA65A]');
                    el.classList.add('text-gray-700', 'hover:bg-white', 'border-transparent');
                    if (textSpan) {
                        textSpan.classList.remove('font-bold');
                        textSpan.classList.add('font-medium');
                    }
                }
            });

            // Show Content
            document.querySelectorAll('.payment-content-section').forEach(el => el.classList.add('hidden'));
            const content = document.getElementById('content-' + mode);
            if (content) content.classList.remove('hidden');
            else document.getElementById('content-generic').classList.remove('hidden');
        }
    </script>
@endsection