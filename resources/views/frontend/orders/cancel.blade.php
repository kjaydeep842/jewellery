@extends('frontend.layouts.master')

@section('content')
    <main class="w-full flex-grow pt-8 pb-16 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
        <div class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 lg:p-[40px] gap-6 lg:gap-[20px] max-w-[1920px] w-full mx-auto">

            <!-- Sidebar -->
            @include('frontend.profile.partials.sidebar')

            <!-- Main Content: Cancel Order -->
            <div class="flex-grow flex flex-col w-full lg:max-w-[1375px] rounded-[4px] gap-8">

                <!-- Initial View Container -->
                <div id="cancel-content-view" class="flex flex-col gap-8 w-full">
                    <!-- Item Card -->
                    @php $item = $order->items->first(); @endphp
                    <div
                        class="flex flex-col sm:flex-row items-start sm:items-center p-4 md:p-5 bg-white rounded-[10px] border border-[#EADDCC]">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-[24px]">
                            <div
                                class="w-[80px] h-[80px] sm:w-[110px] sm:h-[110px] bg-[#F8F8F8] rounded-[8px] overflow-hidden flex-shrink-0">
                                @if($item->product && $item->product->images->first())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                        alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/ring.png') }}" alt="Ring" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex flex-col gap-2">
                                <h3 class="font-['Outfit'] font-medium text-[#1A1A1A] text-[16px] leading-tight">
                                    {{ $item->product_name }}
                                </h3>
                                <p class="font-['Outfit'] font-bold text-[#1A1A1A] text-[18px]">
                                    ₹{{ number_format($item->price, 2) }}</p>
                                <div class="flex gap-3 mt-1">
                                    <div
                                        class="bg-[#EDEDED] px-3 py-1.5 rounded-[4px] text-[13px] text-[#1A1A1A] font-medium flex items-center gap-2 font-['Outfit']">
                                        Size: {{ $item->size ?: 'Standard' }}
                                    </div>
                                    <div
                                        class="bg-[#EDEDED] px-3 py-1.5 rounded-[4px] text-[13px] text-[#1A1A1A] font-medium flex items-center gap-2 font-['Outfit'] cursor-pointer">
                                        Qty: {{ $item->quantity }} <i
                                            class="fa-solid fa-chevron-down text-[10px] ml-1 text-gray-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancel Form -->
                    <div class="flex flex-col gap-5 pt-2">
                        <div class="border-b border-[#EADDCC] pb-4">
                            <h2 class="font-['Outfit'] font-bold text-[20px] text-[#1A1A1A]">Reason for cancellation</h2>
                            <p class="font-['Outfit'] text-[14px] text-[#6E6E6E] mt-1.5 tracking-wide">Please tell us
                                correct reason for cancellation. This information is only used to improve our service</p>
                        </div>

                        <div class="flex flex-col gap-4" id="cancel-form">
                            <h3 class="font-['Outfit'] font-bold text-[15px] text-[#1A1A1A]">Select Reason*</h3>

                            <div class="flex flex-col gap-3.5 pl-1">
                                @php
                                    $reasons = [
                                        "Incorrect size ordered",
                                        "Product not required anymore",
                                        "Cash issue",
                                        "Ordered By Mistake",
                                        "Wants to change style/color",
                                        "Delayed Delivery Cancellation",
                                        "Duplicate Order"
                                    ];
                                @endphp
                                @foreach($reasons as $reason)
                                    <label class="flex items-center gap-3 cursor-pointer group w-fit">
                                        <div class="relative flex items-center">
                                            <input type="radio" name="cancel_reason" value="{{ $reason }}"
                                                class="peer w-5 h-5 appearance-none border border-[#CBD5E1] rounded-full checked:border-[#CBA65A] checked:border-[5px] bg-white transition-all cursor-pointer">
                                        </div>
                                        <span
                                            class="font-['Outfit'] text-[15px] text-[#6E6E6E] group-hover:text-[#1A1A1A] transition-colors">{{ $reason }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2">
                            <textarea id="cancel-comment" placeholder="Additional Comments"
                                class="w-full h-[120px] rounded-[10px] border border-[#EADDCC] p-4 text-[#1A1A1A] font-['Outfit'] text-[15px] focus:outline-none focus:border-[#CBA65A] focus:ring-1 focus:ring-[#CBA65A] resize-none"></textarea>
                        </div>

                        <div class="mt-2">
                            <p id="cancel-error" class="hidden text-red-500 font-['Outfit'] text-[14px] mb-2 px-1">
                                Please select a reason for cancellation.</p>

                            <button onclick="submitCancelOrder()"
                                class="w-full bg-[#CBA65A] hover:bg-[#B39359] text-white font-['Outfit'] font-semibold text-[18px] py-4 rounded-[10px] transition-colors shadow-sm">
                                Cancel Order
                            </button>
                        </div>
                    </div>
                </div>

                <div id="cancel-success-view" class="hidden flex flex-col gap-6 md:gap-8 w-full">
                    <div
                        class="w-full bg-white rounded-[10px] border border-[#EADDCC] px-4 md:px-[32px] py-6 md:py-[40px] flex flex-col gap-6 md:gap-8">
                        <!-- Header -->
                        <div class="flex flex-col items-center justify-center pt-2">
                            <div class="w-[60px] h-[60px] flex items-center justify-center mb-4">
                                <img src="{{ asset('assets/true_sign.png') }}" alt="Success"
                                    class="w-full h-full object-contain">
                            </div>
                            <h2 class="font-['Outfit'] font-bold text-[#1A1A1A] text-[24px]">Order Cancelled</h2>
                        </div>

                        <!-- Nested Cancelled Item Card -->
                        <div class="w-full bg-white rounded-[10px] border border-[#EADDCC] p-4 md:p-[24px]">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-[24px]">
                                <div
                                    class="w-[80px] h-[80px] sm:w-[110px] sm:h-[110px] bg-[#F8F8F8] rounded-[8px] overflow-hidden flex-shrink-0">
                                    @if($item->product && $item->product->images->first())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                            alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('assets/ring.png') }}" alt="Ring" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h3 class="font-['Outfit'] font-medium text-[#1A1A1A] text-[16px] leading-tight">
                                        {{ $item->product_name }}
                                    </h3>
                                    <p class="font-['Outfit'] font-bold text-[#1A1A1A] text-[18px]">
                                        ₹{{ number_format($item->price, 2) }}</p>
                                    <div class="flex gap-3 mt-1">
                                        <div
                                            class="bg-[#EDEDED] px-3 py-1.5 rounded-[4px] text-[13px] text-[#1A1A1A] font-medium flex items-center gap-2 font-['Outfit']">
                                            Size: {{ $item->size ?: 'Standard' }}
                                        </div>
                                        <div
                                            class="bg-[#EDEDED] px-3 py-1.5 rounded-[4px] text-[13px] text-[#1A1A1A] font-medium flex items-center gap-2 font-['Outfit']">
                                            Qty: {{ $item->quantity }} <i
                                                class="fa-solid fa-chevron-down text-[10px] ml-1 text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Messages -->
                        <div class="flex flex-col gap-5">
                            <div class="flex items-start gap-3">
                                <div class="w-[22px] h-[22px] flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <img src="{{ asset('assets/true_sign.png') }}" alt="Check"
                                        class="w-full h-full object-contain">
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="font-['Outfit'] font-normal text-[#A3A3A3] text-[15px]">Refund
                                        Details</span>
                                    <span class="font-['Outfit'] font-medium text-[#525E71] text-[13.5px]">A refund is not
                                        applicable on this order as it is a Pay on delivery order</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-[22px] h-[22px] flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <img src="{{ asset('assets/true_sign.png') }}" alt="Check"
                                        class="w-full h-full object-contain">
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="font-['Outfit'] font-normal text-[#A3A3A3] text-[15px]">Please Note</span>
                                    <span class="font-['Outfit'] font-medium text-[#525E71] text-[13.5px]">You will receive
                                        an email/sms confirming the cancellation of order shortly.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button (Outside the white box) -->
                    <a href="{{ route('orders.index') }}"
                        class="w-full block bg-[#CBA65A] hover:bg-[#B39359] text-white font-['Outfit'] font-semibold text-[18px] py-4 rounded-[10px] transition-colors shadow-sm text-center">
                        Done
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function submitCancelOrder() {
            const reasons = document.querySelectorAll('input[name="cancel_reason"]');
            let checkedReason = null;
            for (let r of reasons) {
                if (r.checked) { checkedReason = r.value; break; }
            }

            if (checkedReason) {
                document.getElementById('cancel-error').classList.add('hidden');

                // Show loader
                const globalLoader = document.getElementById('page-loader');
                if (globalLoader) globalLoader.classList.remove('hidden');

                // AJAX call to cancel order
                fetch("{{ route('orders.cancel.submit', $order->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        reason: checkedReason,
                        comment: document.getElementById('cancel-comment').value
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (globalLoader) globalLoader.classList.add('hidden');

                        if (data.success) {
                            document.getElementById('cancel-content-view').classList.add('hidden');
                            document.getElementById('cancel-success-view').classList.remove('hidden');
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    })
                    .catch(error => {
                        if (globalLoader) globalLoader.classList.add('hidden');
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });

            } else {
                document.getElementById('cancel-error').classList.remove('hidden');
            }
        }

        // Hide error when any option is selected
        document.addEventListener('DOMContentLoaded', function () {
            const reasons = document.querySelectorAll('input[name="cancel_reason"]');
            reasons.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        document.getElementById('cancel-error').classList.add('hidden');
                    }
                });
            });
        });
    </script>
@endpush