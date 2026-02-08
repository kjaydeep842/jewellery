@extends('frontend.checkout.layouts.app', ['activeStep' => 'payment'])

@section('content')
    <!-- Main Content -->
    <main class="max-w-[1920px] mx-auto px-4 lg:px-6 py-12">
        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST" class="w-full flex flex-col gap-12">
            @csrf
            <input type="hidden" name="payment_method" id="selected_payment_method" value="upi">

            <div class="flex flex-col xl:flex-row justify-center items-start gap-12 xl:gap-5">
                <!-- Left Column: Payment Modes -->
                <div class="w-full flex-1 flex flex-col gap-6">

                    <!-- Header -->
                    <h2 class="font-medium text-[#1A1A1A] text-lg">Choose Payment Mode</h2>

                    <!-- Payment Container -->
                    <div
                        class="bg-white border text-sm border-gray-200 rounded-[8px] flex flex-col md:flex-row overflow-hidden min-h-[350px] shadow-sm">
                        <!-- Sidebar Options -->
                        <div class="w-full md:w-[280px] bg-[#F8F8F8] flex flex-col border-r border-gray-200">
                            <div onclick="selectPaymentMode('upi')" id="mode-upi"
                                class="payment-option p-4 cursor-pointer bg-white border-l-4 border-[#CBA65A] text-[#CBA65A] font-medium flex items-center gap-3 transition-colors">
                                <span class="text-xs font-bold border border-[#CBA65A] px-1 rounded-[2px]">UPI</span>
                                <span class="text-sm font-semibold">UPI (Pay via any App)</span>
                            </div>
                            <div onclick="selectPaymentMode('card')" id="mode-card"
                                class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-[#EBEBEB] flex items-center gap-4 transition-colors border-l-4 border-transparent">
                                <img src="{{ asset('assets/card.png') }}" alt="Credit/Debit Card"
                                    class="w-5 h-5 object-contain">
                                <span class="font-medium">Credit/Debit Card</span>
                            </div>
                            <div onclick="selectPaymentMode('netbanking')" id="mode-netbanking"
                                class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-[#EBEBEB] flex items-center gap-4 transition-colors border-l-4 border-transparent">
                                <img src="{{ asset('assets/ic_bank.png') }}" alt="Net Banking"
                                    class="w-5 h-5 object-contain">
                                <span class="font-medium">Net Banking</span>
                            </div>
                            <div onclick="selectPaymentMode('wallet')" id="mode-wallet"
                                class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-[#EBEBEB] flex items-center gap-4 transition-colors border-l-4 border-transparent">
                                <img src="{{ asset('assets/Ic_Wallet.png') }}" alt="Wallets" class="w-5 h-5 object-contain">
                                <span class="font-medium">Wallets</span>
                            </div>
                            <div onclick="selectPaymentMode('emi')" id="mode-emi"
                                class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-[#EBEBEB] flex items-center gap-4 transition-colors border-l-4 border-transparent">
                                <img src="{{ asset('assets/ic_emi.png') }}" alt="EMI" class="w-5 h-5 object-contain">
                                <span class="font-medium">EMI</span>
                            </div>
                            <div onclick="selectPaymentMode('cod')" id="mode-cod"
                                class="payment-option p-4 cursor-pointer text-gray-700 hover:bg-[#EBEBEB] flex items-center gap-4 transition-colors border-l-4 border-transparent">
                                <img src="{{ asset('assets/ic_cash.png') }}" alt="COD" class="w-5 h-5 object-contain">
                                <span class="font-medium">Cash On Delivery(Cash/UPI)</span>
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div class="flex-1 p-8 bg-white" id="payment-content">
                            <!-- UPI Content (Default) -->
                            <div id="content-upi" class="payment-content-section">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Pay using UPI</h3>
                                <div class="flex flex-col gap-6">
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="upi_method" value="scan" class="custom-radio" checked>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/scaneandpay.png') }}" alt="Scan & Pay"
                                                class="w-[30px] h-[30px] object-contain">
                                            <span class="text-gray-900 font-medium text-sm">Scan & Pay</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="upi_method" value="id" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-300">
                                                <div class="w-5 h-5 rounded-full border-2 border-dashed border-gray-400">
                                                </div>
                                            </div>


                                            <span class="text-gray-900 font-medium text-sm">Enter UPI ID</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Credit/Debit Card Content -->
                            <div id="content-card" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Credit/Debit Card</h3>
                                <div class="space-y-6 max-w-[400px]">
                                    <!-- Card Number -->
                                    <div>
                                        <input type="text" name="card_number" placeholder="Card Number"
                                            class="custom-input">
                                    </div>

                                    <!-- Name On Card -->
                                    <div>
                                        <input type="text" name="card_name" placeholder="Name On Card" class="custom-input">
                                    </div>

                                    <!-- Expiry and CVV -->
                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <input type="text" name="card_expiry" placeholder="Valid Thru (MM/YY)"
                                                class="custom-input">
                                        </div>
                                        <div class="flex-1">
                                            <input type="text" name="card_cvv" placeholder="CVV" class="custom-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Net Banking Content -->
                            <div id="content-netbanking" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Net Banking</h3>
                                <div class="flex flex-col gap-6">

                                    <!-- Axis Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="bank_name" value="Axis Bank" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                                <!-- Placeholder or actual logo if available -->
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">Axis Bank</span>
                                        </div>
                                    </label>

                                    <!-- HDFC Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="bank_name" value="HDFC Bank" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">HDFC Bank</span>
                                        </div>
                                    </label>

                                    <!-- ICICI Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="bank_name" value="ICICI Bank" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">ICICI Bank</span>
                                        </div>
                                    </label>

                                    <!-- Other Banks Dropdown -->
                                    <div class="mt-2 w-full max-w-[300px]">
                                        <select name="other_bank_name"
                                            class="w-full p-2.5 text-gray-500 bg-white border border-gray-300 rounded-md shadow-sm outline-none focus:border-[#CBA65A] text-sm">
                                            <option value="" selected>Other Banks</option>
                                            <option value="State Bank of India">State Bank of India</option>
                                            <option value="Punjab National Bank">Punjab National Bank</option>
                                            <option value="Bank of Baroda">Bank of Baroda</option>
                                            <option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
                                        </select>
                                    </div>

                                </div>
                            </div>



                            <!-- Wallet Content -->
                            <div id="content-wallet" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Select Wallet</h3>
                                <div class="flex flex-col gap-6">

                                    <!-- Paytm -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="wallet_name" value="Paytm" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                                <!-- Placeholder -->
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">Paytm</span>
                                        </div>
                                    </label>

                                    <!-- PhonePe -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="wallet_name" value="PhonePe" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">PhonePe</span>
                                        </div>
                                    </label>

                                    <!-- Amazon Pay -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="wallet_name" value="Amazon Pay" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">Amazon Pay</span>
                                        </div>
                                    </label>

                                    <!-- MobiKwik -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="wallet_name" value="MobiKwik" class="custom-radio">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">MobiKwik</span>
                                        </div>
                                    </label>

                                </div>
                            </div>


                            <!-- EMI Content -->
                            <div id="content-emi" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Select EMI Option</h3>

                                <div class="flex flex-col gap-6">

                                    <!-- Axis Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="checkbox" name="emi_bank" value="Axis Bank" class="custom-checkbox">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                                <!-- Logo placeholder -->
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">Axis Bank</span>
                                        </div>
                                    </label>

                                    <!-- HDFC Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="checkbox" name="emi_bank" value="HDFC Bank" class="custom-checkbox">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">HDFC Bank</span>
                                        </div>
                                    </label>

                                    <!-- ICICI Bank -->
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="checkbox" name="emi_bank" value="ICICI Bank" class="custom-checkbox">
                                        <div class="flex items-center gap-3">
                                            <div class="bank-logo-circle">
                                            </div>
                                            <span class="text-gray-900 font-medium text-sm">ICICI Bank</span>
                                        </div>
                                    </label>

                                </div>
                            </div>

                            <!-- COD Content -->
                            <div id="content-cod" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Cash On Delivery(Cash/UPI)</h3>

                                <div class="flex items-start gap-4">
                                    <input type="checkbox" id="cod_option_final" name="cod_payment" value="1"
                                        class="custom-checkbox mt-1">
                                    <div>
                                        <label for="cod_option_final"
                                            class="text-gray-900 font-medium text-sm cursor-pointer">Cash on Delivery
                                            (Cash/UPI)</label>
                                        <p class="text-gray-400 text-xs mt-1 leading-relaxed">For This Option, There Is A
                                            Fee Of 10. You Can Pay <br> Online To Avoid This.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Other Content (Generic) -->
                            <div id="content-generic" class="payment-content-section hidden">
                                <h3 class="font-bold text-[#1A1A1A] text-sm mb-6">Payment Method</h3>
                                <p class="text-sm text-gray-500">This payment method is currently unavailable. Please try
                                    UPI or
                                    COD.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Price Details -->
                <div class="w-full xl:w-[400px] flex-shrink-0">
                    <div class="p-6 sticky top-28 bg-white border border-gray-100 rounded-[8px]">
                        <h3 class="font-bold text-gray-900 text-lg mb-6">Price Details ({{ $cartItems->count() }} Item)</h3>

                        <div class="space-y-4 pb-6 border-b border-gray-200 text-sm font-medium">
                            <div class="flex justify-between text-gray-900">
                                <span>Total MRP</span>
                                <span>₹{{ number_format($totalMrp, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-900">
                                <span>Discount on MRP</span>
                                <span>₹{{ number_format($discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-900">
                                <span>Platform Fee</span>
                                <span>₹{{ number_format($platformFee, 2) }}</span>
                            </div>
                        </div>

                        <div class="pt-4 mb-2">
                            <div class="flex justify-between items-center font-bold text-gray-900 text-lg">
                                <span>Total Amount</span>
                                <span>₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-6 text-sm text-gray-600">
                            <p class="font-bold mb-1">Delivering To:</p>
                            <p>{{ $address->name }}</p>
                            <p>{{ $address->address_line_1 }}</p>
                            <p>{{ $address->city }}, {{ $address->state }} - {{ $address->zip }}</p>
                            <p>Mobile: {{ $address->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row gap-4 w-full mt-10">
                <a href="{{ route('cart.index') }}"
                    class="w-full md:w-[30%] py-4 rounded-[5px] border border-[#CBA65A] text-[#CBA65A] font-medium hover:bg-gray-50 transition-colors uppercase tracking-wide text-center">
                    Cancel
                </a>
                <button type="submit"
                    class="w-full md:flex-1 py-4 rounded-[5px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] text-white font-medium shadow-md hover:opacity-90 transition-opacity uppercase tracking-wide">
                    Pay Now
                </button>
            </div>

        </form>
    </main>

    <script>
        function selectPaymentMode(mode) {
            // Update hidden input
            document.getElementById('selected_payment_method').value = mode;

            // Iterate all options to set active/inactive styling
            document.querySelectorAll('.payment-option').forEach(el => {
                // Check if this element corresponds to the selected mode
                if (el.id === 'mode-' + mode) {
                    // Active Styling
                    el.classList.remove('text-gray-700', 'hover:bg-[#EBEBEB]', 'border-transparent');
                    el.classList.add('bg-white', 'border-[#CBA65A]', 'text-[#CBA65A]');
                } else {
                    // Inactive Styling
                    el.classList.remove('bg-white', 'border-[#CBA65A]', 'text-[#CBA65A]');
                    el.classList.add('text-gray-700', 'hover:bg-[#EBEBEB]', 'border-transparent');
                }
            });

            // Show Content
            document.querySelectorAll('.payment-content-section').forEach(el => el.classList.add('hidden'));
            
            const contentEl = document.getElementById('content-' + mode);
            if (contentEl) {
                contentEl.classList.remove('hidden');
            } else {
                document.getElementById('content-generic').classList.remove('hidden');
            }
        }
    </script>
@endsection