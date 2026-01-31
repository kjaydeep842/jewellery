<x-layouts.frontend>
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="flex items-center justify-center mb-12 space-x-4 text-sm font-bold uppercase tracking-wider">
                <span class="text-gray-400">Bag</span>
                <span class="text-gray-300">----------</span>
                <span class="text-gray-400">Address</span>
                <span class="text-gray-300">----------</span>
                <span class="text-[#D4AF37] border-b-2 border-[#D4AF37]">Payment</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Payment Options -->
                <div class="md:col-span-2 space-y-6">
                    <h2 class="font-serif text-2xl font-bold text-gray-900">Choose Payment Mode</h2>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                        <!-- Option 1: COD -->
                        <div class="border-b border-gray-100 last:border-0">
                            <label class="flex items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment_method" value="cod" checked
                                    class="w-5 h-5 text-[#D4AF37] focus:ring-[#D4AF37]">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Cash On Delivery (Cash/UPI)</span>
                                    <span class="block text-sm text-gray-500 mt-1">Pay comfortably at your
                                        doorstep.</span>
                                </div>
                            </label>
                        </div>

                        <!-- Option 2: Online (Mock) -->
                        <div class="border-b border-gray-100 last:border-0">
                            <label
                                class="flex items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors opacity-50">
                                <input type="radio" name="payment_method" value="online" disabled
                                    class="w-5 h-5 text-[#D4AF37] focus:ring-[#D4AF37]">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Credit/Debit Card / Net Banking</span>
                                    <span class="block text-sm text-gray-500 mt-1">Coming Soon</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_method" value="cod"> <!-- Hardcoded for now -->
                            <button type="submit"
                                class="bg-[#D4AF37] text-white font-bold uppercase tracking-widest py-4 px-12 hover:bg-gray-900 transition-colors shadow-lg">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-serif font-bold text-lg text-gray-900 mb-4 pb-2 border-b border-gray-100">
                            Delivery To</h3>
                        <h4 class="font-bold text-gray-900">{{ $address->name }}</h4>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $address->address_line_1 }}<br>
                            @if($address->address_line_2) {{ $address->address_line_2 }}<br> @endif
                            {{ $address->city }}, {{ $address->state }} - {{ $address->zip }}<br>
                            {{ $address->country }}
                        </p>
                        <p class="text-sm text-gray-900 font-bold mt-2">Mobile: {{ $address->phone }}</p>
                        <a href="{{ route('checkout.address') }}"
                            class="block text-xs text-[#D4AF37] font-bold mt-4 uppercase hover:underline">Change
                            Address</a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-serif font-bold text-lg text-gray-900 mb-4 pb-2 border-b border-gray-100">Price
                            Details</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Total MRP</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Discount</span>
                                <span class="text-green-600">-$0.00</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Delivery Fee</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div
                                class="pt-4 border-t border-gray-100 flex justify-between font-bold text-lg text-gray-900">
                                <span>Total Amount</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>