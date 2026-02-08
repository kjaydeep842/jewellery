@extends('frontend.checkout.layouts.app', ['activeStep' => 'address'])

@section('content')
    <!-- Main Content -->
    <main
        class="w-full max-w-[1920px] mx-auto flex flex-col xl:flex-row justify-center items-start gap-12 xl:gap-5 px-4 py-8 lg:px-20 xl:px-[100px] xl:pt-[40px] xl:pb-[120px]">
        <!-- Left Column: Address Selection -->
        <div class="w-full flex-1 flex flex-col gap-6">

            <!-- Header Row -->
            <div class="flex justify-between items-center">
                <h2 class="font-medium text-[#1A1A1A] text-lg">Select Delivery Address</h2>
                <a href="{{ route('checkout.address.create') }}"
                    class="px-6 py-2 border border-[#CBA65A] text-[#CBA65A] text-sm font-medium rounded-[5px] hover:bg-[#FDFBF7] transition-colors">
                    Add New Address
                </a>
            </div>

            @if($addresses->isEmpty())
                <div class="text-center py-10 bg-white border border-gray-200 rounded-[8px]">
                    <p class="text-gray-500 mb-4">No saved addresses found.</p>
                </div>
            @else
                <!-- Addresses Loop -->
                @foreach($addresses as $address)
                    <div class="address-card border border-gray-200 rounded-[8px] p-6 shadow-sm relative cursor-pointer hover:border-[#CBA65A] transition-colors {{ $loop->first ? 'border-[#CBA65A] bg-[#FDFBF7]' : '' }}"
                        onclick="selectAddressCard(this, {{ $address->id }})">

                        <!-- Radio Button (Hidden but functional) -->
                        <input type="radio" name="selected_address" value="{{ $address->id }}"
                            class="absolute top-6 left-6 accent-[#CBA65A]" {{ $loop->first ? 'checked' : '' }}>

                        <!-- Edit Button -->
                        <a href="{{ route('checkout.address.edit', $address->id) }}"
                            class="absolute top-6 right-6 flex items-center gap-2 px-3 py-1.5 border border-gray-200 rounded-[4px] text-xs font-medium text-gray-600 hover:border-[#CBA65A] hover:text-[#CBA65A] transition-colors z-10">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        <!-- Content -->
                        <div class="flex flex-col gap-2 pr-20 pl-8">
                            <h3 class="font-bold text-[#1A1A1A] text-base">{{ $address->name }} <span
                                    class="text-xs font-normal text-gray-500 ml-2">({{ ucfirst($address->type) }})</span></h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $address->address_line_1 }}<br>
                                {{ $address->city }}, {{ $address->state }} - {{ $address->zip }}
                            </p>
                            <p class="text-gray-900 text-sm font-medium mt-1">
                                Mobile: <span class="font-bold">{{ $address->phone }}</span>
                            </p>
                        </div>

                        <!-- Remove Button -->
                        <button
                            class="flex items-center gap-2 mt-6 ml-8 px-4 py-2 border border-blue-50 bg-gray-100 rounded-[4px] text-sm font-medium text-gray-600 hover:border-red-500 hover:text-red-500 transition-colors z-10">
                            <i class="fa-regular fa-trash-can"></i> Remove Address
                        </button>
                    </div>
                @endforeach
            @endif

            <!-- Payment Icons -->
            <div class="flex flex-row justify-between items-center gap-2 w-full h-[70.74px] mt-3">
                <div
                    class="h-full flex-1 min-w-[80px] rounded-[4px] flex items-center justify-center shadow-sm hover:border-[#CBA65A] transition-colors cursor-pointer">
                    <img src="{{ asset('assets/google_pay.png') }}" alt="GPay" class="w-full h-full object-contain-cover">
                </div>
                <!-- ... other icons ... -->
                <div
                    class="h-full flex-1 min-w-[80px] rounded-[4px] flex items-center justify-center shadow-sm hover:border-[#CBA65A] transition-colors cursor-pointer">
                    <img src="{{ asset('assets/visa.png') }}" alt="Visa" class="w-full h-full object-contain-cover">
                </div>
                <div
                    class="h-full flex-1 min-w-[80px] rounded-[4px] flex items-center justify-center shadow-sm hover:border-[#CBA65A] transition-colors cursor-pointer">
                    <img src="{{ asset('assets/paypal.png') }}" alt="PayPal" class="w-full h-full object-contain-cover">
                </div>
                <div
                    class="h-full flex-1 min-w-[80px] rounded-[4px] flex items-center justify-center shadow-sm hover:border-[#CBA65A] transition-colors cursor-pointer">
                    <img src="{{ asset('assets/master-card.png') }}" alt="MasterCard"
                        class="w-full h-full object-contain-cover">
                </div>
            </div>

        </div>

        <!-- Right Column: Price Details -->
        <div class="w-full xl:w-[400px] flex-shrink-0">
            <div class="sticky top-28 bg-[#FDFBF7] rounded border border-gray-100 p-6">
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

                <div class="pt-4 mb-8">
                    <div class="flex justify-between items-center font-bold text-gray-900 text-lg">
                        <span>Total Amount</span>
                        <span>₹{{ number_format($totalAmount, 2) }}</span>
                    </div>
                </div>

                <button id="place-order-btn" onclick="proceedToPayment()"
                    class="w-full py-3.5 rounded-full bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] text-white text-xl font-medium shadow-md hover:opacity-90 transition-opacity mb-4">
                    Place Order
                </button>

                <div class="text-center">
                    <a href="{{ route('page.contact') }}"
                        class="text-sm text-gray-500 hover:text-[#CBA65A] transition-colors">Need Help? Contact
                        Us</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        function selectAddressCard(card, id) {
            // Reset all cards
            document.querySelectorAll('.address-card').forEach(c => {
                c.classList.remove('border-[#CBA65A]', 'bg-[#FDFBF7]');
                c.querySelector('input[type="radio"]').checked = false;
            });

            // Select clicked card
            card.classList.add('border-[#CBA65A]', 'bg-[#FDFBF7]');
            card.querySelector('input[type="radio"]').checked = true;
        }

        function proceedToPayment() {
            const selected = document.querySelector('input[name="selected_address"]:checked');
            if (selected) {
                // Redirect to the select-address route which sets session and redirects to payment
                window.location.href = "{{ url('/checkout/select-address') }}/" + selected.value;
            } else {
                @if($addresses->isEmpty())
                    alert('Please add an address first.');
                @else
                    alert('Please select an address.');
                @endif
                        }
        }
    </script>
@endsection