@extends('frontend.checkout.layouts.app', ['activeStep' => 'address'])

@section('content')
    <!-- Main Content -->
    <main class="max-w-[1150px] mx-auto px-4 lg:px-6 py-12 flex flex-col gap-12">

        <!-- Upper Section: Form & Price -->
        <div class="flex flex-col lg:flex-row gap-20 w-full">

            <!-- Left Column: Form Fields -->
            <div class="w-full flex-1 flex flex-col gap-8">

                <form
                    action="{{ isset($address) ? route('checkout.address.update', $address->id) : route('checkout.address.store') }}"
                    method="POST" class="flex flex-col gap-8 w-full">
                    @csrf
                    @if(isset($address))
                        @method('PUT')
                    @endif
                    <!-- Contact Details -->
                    <div class="flex flex-col gap-4">
                        <h3 class="font-bold text-[#1A1A1A] text-base">Contact Details</h3>
                        <input type="text" name="name" placeholder="Name*" required
                            value="{{ old('name', $address->name ?? '') }}"
                            class="w-full p-3 bg-white border border-gray-300 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                        <input type="text" name="phone" placeholder="Mobile No*" required
                            value="{{ old('phone', $address->phone ?? '') }}"
                            class="w-full p-3 bg-white border border-gray-300 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                    </div>

                    <!-- Address -->
                    <div class="flex flex-col gap-4">
                        <h3 class="font-bold text-[#1A1A1A] text-base">Address</h3>

                        <input type="text" name="zip" placeholder="Pin Code*" required
                            value="{{ old('zip', $address->zip ?? '') }}"
                            class="w-full p-3 bg-white border border-gray-300 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">

                        <div class="flex flex-col gap-1">
                            <input type="text" name="address_line_1" placeholder="House Number/ Tower/ Block*" required
                                value="{{ old('address_line_1', $address->address_line_1 ?? '') }}"
                                class="w-full p-3 bg-white border border-gray-300 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                            <span class="text-xs text-[#1A1A1A] font-medium pl-1">*House Number Will Allow A Doorstep
                                Delivery</span>
                        </div>

                        <div class="flex flex-col gap-1">
                            <input type="text" name="area" placeholder="Address (Locality, Building, Street)*" required
                                value="{{ old('area', $address->area ?? '') }}"
                                class="w-full p-3 bg-white border border-gray-300 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                            <span class="text-xs text-[#1A1A1A] font-medium pl-1">*Please Update Society/Apartment
                                Details</span>
                        </div>

                        <div class="flex flex-col md:flex-row gap-4 w-full">
                            <input type="text" name="city" placeholder="City / District*" required
                                value="{{ old('city', $address->city ?? '') }}"
                                class="w-full md:w-1/2 p-3 bg-white border border-gray-200 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                            <input type="text" name="state" placeholder="State*" required
                                value="{{ old('state', $address->state ?? '') }}"
                                class="w-full md:w-1/2 p-3 bg-white border border-gray-200 rounded-[5px] outline-none focus:border-[#CBA65A] transition-colors placeholder-gray-400">
                        </div>
                        <input type="hidden" name="country" value="India">
                    </div>

                    <!-- Address Type -->
                    <div class="flex flex-col gap-3">
                        <h3 class="font-bold text-[#1A1A1A] text-base">Address Type</h3>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="type" value="home" class="custom-checkbox" {{ old('type', $address->type ?? 'home') == 'home' ? 'checked' : '' }}>
                                <span class="text-[#1A1A1A]">Home</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="type" value="office" class="custom-checkbox" {{ old('type', $address->type ?? '') == 'office' ? 'checked' : '' }}>
                                <span class="text-[#1A1A1A]">Office</span>
                            </label>
                        </div>
                    </div>

                    <!-- Ready to ship -->
                    <div class="flex items-center gap-2 text-[#008F5D] font-medium text-sm">
                        <img src="{{ asset('assets/true_sign.png') }}" alt="In Stock" class="h-5 w-auto object-contain">
                        <span>In stock - ready to ship</span>
                    </div>

                    <!-- Action Buttons (Full Width) -->
                    <div class="flex flex-col md:flex-row gap-4 w-full mt-4">
                        <a href="{{ route('checkout.address') }}"
                            class="w-full md:w-[30%] py-4 rounded-[5px] border border-[#CBA65A] text-[#CBA65A] font-medium hover:bg-gray-50 transition-colors text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="w-full md:flex-1 py-4 rounded-[5px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] text-white font-medium shadow-md hover:opacity-90 transition-opacity">
                            Save
                        </button>
                    </div>
                </form>

            </div>

            <!-- Right Column: Price Details -->
            <div class="w-full lg:w-[380px] flex-shrink-0">
                <div class="p-6 sticky top-28 bg-white border border-gray-100 rounded-[8px]">
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Price Details ({{ $cartItems->count() }} Item)</h3>

                    <div class="space-y-3 pb-4 mb-4 text-sm font-medium">
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

                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center font-bold text-gray-900 text-lg">
                            <span>Total Amount</span>
                            <span>₹{{ number_format($totalAmount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End of Upper Section -->

    </main>
@endsection