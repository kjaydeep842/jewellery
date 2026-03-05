@extends('frontend.layouts.master')

@section('content')
    <style>
        /* Hide Default Header/Ticker */
        #header-placeholder, .ticker-wrapper {
            display: none !important;
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

            <!-- Stepper (Active: ADDRESS) -->
            <div class="hidden md:flex items-center gap-4 text-sm font-medium tracking-wide">
                <div class="text-[#CBA65A]">BAG</div>
                <div class="text-[#CBA65A]">----------</div>
                <div class="text-[#CBA65A] border-b-2 border-[#CBA65A] pb-1">ADDRESS</div>
                <div class="text-gray-300">----------</div>
                <div class="text-gray-400">PAYMENT</div>
            </div>

            <!-- Secure Badge -->
            <div class="flex items-center gap-2 text-green-600 font-medium text-sm">
                <img src="{{ asset('assets/L- Brand Logo.png') }}" alt="Secure" class="h-6 w-auto object-contain"> 100% SECURE
            </div>
        </div>

        <!-- Gradient Navigation Bar -->
        <nav
            class="hidden lg:flex items-center justify-center space-x-6 min-[2000px]:space-x-12 text-[15px] min-[2000px]:text-2xl font-['Outfit'] font-medium tracking-wide bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] w-full py-[14px] text-white">
            <div class="relative group">
                <a href="{{ route('page.new-arrivals') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">New Arrivals</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.best-seller') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Best Seller</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.18kt') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">18KT Jewellery</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.tattsvisfavourite') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Tattsvi's Favourite</a>
            </div>
            {{-- <div class="relative group">
                <a href="{{ route('page.exhibition') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Exhibition</a>
            </div> --}}
            <div class="relative group">
                <a href="{{ route('page.readytostock') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Ready To Stock</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.contact') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">Contact Us</a>
            </div>
            <div class="relative group">
                <a href="{{ route('page.about') }}" class="flex items-center gap-1 hover:text-white/80 transition-colors">About Us</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-[1920px] mx-auto px-4 lg:px-6 py-8 flex flex-col lg:flex-row gap-8 min-h-[600px]">

        <!-- Left Column: Address Selection -->
        <div class="w-full lg:w-2/3 flex flex-col gap-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#1A1A1A] font-Outfit">Select Delivery Address</h2>
                <a href="{{ route('checkout.address.create') }}" class="text-[#CBA65A] border border-[#CBA65A] px-4 py-2 rounded text-sm font-medium hover:bg-[#FDFBF7] transition-colors"> Add New Address </a>
            </div>

            @if($addresses->isEmpty())
                <div class="text-center py-10 bg-white rounded-lg border border-gray-100">
                    <p class="text-gray-500 mb-4">No addresses found.</p>
                    <a href="{{ route('checkout.address.create') }}" class="bg-[#CBA65A] text-white px-6 py-2 rounded-full font-medium hover:opacity-90">Add Address</a>
                </div>
            @else
                <div class="grid gap-4">
                    <!-- Hidden input to track selected address -->
                    <input type="hidden" id="selected-address-id" value="{{ session('selected_address_id', $addresses->firstWhere('is_default', 1)->id ?? $addresses->first()->id) }}">

                    @foreach($addresses as $address)
                    @php
                        // Determine initial state
                        $isSelected = (session('selected_address_id') == $address->id) || (!session()->has('selected_address_id') && ($address->is_default || $loop->first));
                    @endphp
                    <div id="address-card-{{ $address->id }}" 
                         onclick="selectAddress({{ $address->id }})"
                         class="address-card border {{ $isSelected ? 'border-[#CBA65A] bg-[#FFFBF2]' : 'border-gray-200' }} rounded-lg p-6 relative group transition-all hover:shadow-md cursor-pointer">
                        
                        <!-- Actions -->
                        <div class="absolute top-4 right-4 flex gap-2">
                            <a href="{{ route('checkout.address.edit', $address->id) }}" class="text-gray-400 hover:text-[#CBA65A] px-2 py-1 border border-gray-200 rounded text-xs flex items-center gap-1 transition-colors z-10">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                        </div>

                        <!-- Selection Indicator -->
                        <div class="flex items-start gap-4">
                            <div class="mt-1">
                                <div id="radio-indicator-{{ $address->id }}"
                                   class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors {{ $isSelected ? 'border-[#CBA65A]' : 'border-gray-300' }}">
                                    <div class="w-2.5 h-2.5 bg-[#CBA65A] rounded-full transition-transform {{ $isSelected ? 'scale-100' : 'scale-0' }}"></div>
                                </div>
                            </div>

                            <div class="flex-grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-gray-900 text-lg font-Outfit">{{ $address->name }}</h3>
                                    <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded uppercase tracking-wider">{{ $address->type }}</span>
                                </div>
                                
                                <p class="text-gray-600 text-sm leading-relaxed mb-2 font-Outfit">
                                    {{ $address->address_line_1 }}<br>
                                    {{ $address->area ? $address->area . ',' : '' }} {{ $address->city }}, {{ $address->state }} - {{ $address->zip }}
                                </p>
                                
                                <p class="text-gray-800 text-sm font-medium font-Outfit mb-4">Mobile: <span class="text-gray-600">{{ $address->phone }}</span></p>

                                <!-- Remove Address Action Button -->
                                <button type="button" onclick="event.stopPropagation(); removeAddress({{ $address->id }}, this);" class="group flex flex-row items-center justify-center px-4 py-[8px] gap-2 w-auto border border-gray-200 rounded-[6px] bg-transparent hover:bg-red-50 hover:border-red-200 transition-all shadow-sm relative z-10">
                                    <div class="w-[18px] h-[18px] flex items-center justify-center opacity-70 group-hover:opacity-100 transition-opacity">
                                        <img src="{{ asset('assets/trash.png') }}" alt="Delete" class="w-full h-full object-contain">
                                    </div>
                                    <span class="font-['Outfit'] font-medium text-sm leading-[24px] text-gray-600 group-hover:text-red-600 transition-colors">
                                        Remove Address
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>

        <!-- Right Column: Price Details -->
        <div class="w-full lg:w-1/3 flex-shrink-0">
            <div class="bg-white border border-gray-100 rounded-lg p-6 sticky top-28 shadow-sm">
                <h3 class="font-bold text-gray-900 text-lg mb-6 font-Outfit border-b border-gray-100 pb-3">Price Details ({{ $cartItems->count() }} Item)</h3>

                <div class="space-y-4 pb-6 mb-4 border-b border-gray-100 text-sm font-Outfit">
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

                <div class="flex justify-between items-center font-bold text-gray-900 text-xl mb-8 font-Outfit">
                    <span>Total Amount</span>
                    <span>₹{{ number_format($totalAmount, 2) }}</span>
                </div>

                <button onclick="proceedToPayment()"
                    class="flex flex-row justify-center items-center px-4 py-[18px] gap-[10px] w-full h-[60px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] rounded-[100px] flex-none order-1 self-stretch grow-0 text-white font-medium text-lg shadow-lg hover:shadow-xl hover:opacity-95 transition-all transform active:scale-[0.98]">
                    Continue to Payment
                </button>
                
                <div class="mt-4 text-center">
                     <p class="text-xs text-gray-400">Need Help? <a href="{{ route('page.contact') }}" class="text-[#CBA65A] hover:underline">Contact Us</a></p>
                </div>
            </div>
        </div>

    </main>

    <script>
        function selectAddress(id) {
            // Update hidden input
            document.getElementById('selected-address-id').value = id;

            // Reset Styles
            document.querySelectorAll('.address-card').forEach(card => {
                card.classList.remove('border-[#CBA65A]', 'bg-[#FFFBF2]');
                card.classList.add('border-gray-200');
            });
            document.querySelectorAll('[id^="radio-indicator-"]').forEach(indicator => {
                indicator.classList.remove('border-[#CBA65A]');
                indicator.classList.add('border-gray-300');
                indicator.querySelector('div').classList.remove('scale-100');
                indicator.querySelector('div').classList.add('scale-0');
            });

            // Set Active Style
            const activeCard = document.getElementById('address-card-' + id);
            if(activeCard) {
                activeCard.classList.remove('border-gray-200');
                activeCard.classList.add('border-[#CBA65A]', 'bg-[#FFFBF2]');
                
                const indicator = activeCard.querySelector('[id^="radio-indicator-"]');
                indicator.classList.remove('border-gray-300');
                indicator.classList.add('border-[#CBA65A]');
                indicator.querySelector('div').classList.remove('scale-0');
                indicator.querySelector('div').classList.add('scale-100');
            }
        }

        function proceedToPayment() {
            const id = document.getElementById('selected-address-id').value;
            if (!id) {
                alert('Please select an address to continue.');
                return;
            }
            // Use standard JS concatenation for URL to avoid Blade issues in external JS files (though this is inline)
            // Redirect to select-address route which sets session and moves to payment
            window.location.href = "{{ url('/checkout/select-address') }}/" + id;
        }

        async function removeAddress(id, btnElement) {
            if (!confirm('Are you sure you want to remove this address?')) {
                return;
            }

            try {
                const response = await fetch(`/checkout/address/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Remove the address card from the DOM
                    const card = document.getElementById(`address-card-${id}`);
                    if (card) {
                        // Optional fade out effect
                        card.style.transition = 'opacity 0.3s ease';
                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.remove();
                            // If this was the selected address, clear the hidden input
                            const selectedIdInput = document.getElementById('selected-address-id');
                            if (selectedIdInput.value == id) {
                                selectedIdInput.value = '';
                            }
                        }, 300);
                    }
                    
                    // Show success toast
                    if (typeof window.showToast === 'function') {
                        window.showToast(data.message, 'success');
                    }
                } else {
                    // Handle failure
                    if (typeof window.showToast === 'function') {
                        window.showToast(data.message || 'Failed to remove address.', 'error');
                    } else {
                        alert(data.message || 'Failed to remove address.');
                    }
                }
            } catch (error) {
                console.error('Error removing address:', error);
                if (typeof window.showToast === 'function') {
                    window.showToast('Something went wrong.', 'error');
                } else {
                    alert('Something went wrong.');
                }
            }
        }
    </script>

@endsection