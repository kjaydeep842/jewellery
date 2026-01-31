<x-layouts.frontend>
    <div class="bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="flex items-center justify-center mb-12 space-x-4 text-sm font-bold uppercase tracking-wider">
                <span class="text-gray-400">Bag</span>
                <span class="text-gray-300">----------</span>
                <span class="text-[#D4AF37] border-b-2 border-[#D4AF37]">Address</span>
                <span class="text-gray-300">----------</span>
                <span class="text-gray-400">Payment</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Saved Addresses -->
                <div class="space-y-6">
                    <h2 class="font-serif text-2xl font-bold text-gray-900">Select Delivery Address</h2>

                    @if($addresses->isEmpty())
                        <p class="text-gray-500 italic">No saved addresses found. Please add a new one.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($addresses as $address)
                                <div
                                    class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:border-[#D4AF37] cursor-pointer transition-colors relative group">
                                    <div class="flex justify-between items-start mb-2">
                                        <span
                                            class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded uppercase">{{ $address->type }}</span>
                                        <a href="{{ route('checkout.select-address', $address->id) }}"
                                            class="text-[#D4AF37] text-sm font-bold hover:underline">Deliver Here</a>
                                    </div>
                                    <h3 class="font-bold text-gray-900">{{ $address->name }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ $address->address_line_1 }}</p>
                                    @if($address->address_line_2)
                                        <p class="text-gray-600 text-sm">{{ $address->address_line_2 }}</p>
                                    @endif
                                    <p class="text-gray-600 text-sm">{{ $address->city }}, {{ $address->state }} -
                                        {{ $address->zip }}</p>
                                    <p class="text-gray-600 text-sm mt-2">Mobile: <span
                                            class="font-bold text-gray-900">{{ $address->phone }}</span></p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Add New Address Form -->
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <h2 class="font-serif text-xl font-bold text-gray-900 mb-6">Add New Address</h2>
                    <form action="{{ route('checkout.address.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number</label>
                            <input type="text" name="phone" required
                                class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pincode</label>
                            <input type="text" name="zip" required
                                class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address (House No, Building,
                                Street)</label>
                            <input type="text" name="address_line_1" required
                                class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Locality / Town</label>
                            <input type="text" name="address_line_2"
                                class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" name="city" required
                                    class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                <input type="text" name="state" required
                                    class="w-full border-gray-300 rounded-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                            </div>
                        </div>

                        <input type="hidden" name="country" value="India"> <!-- Defaulting -->

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address Type</label>
                            <div class="flex space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="home" checked
                                        class="text-[#D4AF37] focus:ring-[#D4AF37]">
                                    <span class="ml-2">Home</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="type" value="office"
                                        class="text-[#D4AF37] focus:ring-[#D4AF37]">
                                    <span class="ml-2">Office</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-[#D4AF37] text-white font-bold uppercase tracking-widest py-3 hover:bg-gray-900 transition-colors">
                                Save Address
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>