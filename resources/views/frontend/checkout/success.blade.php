@extends('frontend.layouts.master')

@section('header')
    <style>
        .ticker-wrapper {
            width: 100%;
            overflow: hidden;
            background: #f3dede;
            white-space: nowrap;
        }

        .ticker {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-left 30s linear infinite;
        }

        .ticker span {
            display: inline-block;
            font-family: outfit;
            padding-right: 50px;
            font-size: 14px;
            font-weight: 300;
            color: #6b4b4b;
            letter-spacing: 1px;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
@endsection

@section('content')
    <!-- Main Content -->
    <main class="w-full flex-grow pt-10 pb-20 bg-[#FDFBF7] flex flex-col items-center px-4">
        <div class="w-full max-w-[960px] flex flex-col gap-6">

            <!-- Order Confirmed Box -->
            <div
                class="w-full bg-white rounded-[10px] border border-[#EADDCC] flex flex-col items-center justify-center py-[70px] px-8 text-center">
                <!-- Status Icon -->
                <div class="w-[84px] h-[84px] mb-4 flex items-center justify-center">
                    <img src="{{ asset('assets/true_sign.png') }}" alt="Success" class="w-full h-full object-contain">
                </div>

                <h1 class="font-['Outfit'] font-bold text-[#00B47A] text-[34px] leading-tight mb-3">Order Confirmed</h1>

                <p class="font-['Outfit'] text-[24px] text-[#0D0D0E] max-w-[824px] leading-[1.26] font-light">
                    Your order is confirmed. you will receive an order confirmation email/SMS shortly with the expected
                    delivery date for your items.
                </p>
            </div>

            <!-- Delivery Address Box -->
            <div
                class="w-full bg-[#FCF8EC] rounded-[10px] border border-[#EADDCC] flex flex-col md:flex-row justify-between items-center px-10 py-7 gap-6">
                <div class="flex flex-col gap-1 w-full text-center md:text-left">
                    <div class="font-['Outfit'] text-[22px] leading-tight">
                        <span class="text-[#848484] font-normal">Deliver To : </span>
                        <span class="text-[#0D0D0E] font-medium capitalize">{{ $order->customer_name }}</span>
                    </div>
                    <p class="font-['Outfit'] text-[#0D0D0E] text-[22px] font-normal capitalize leading-tight">
                        {{ $order->address_id ? $order->address->address_line_1 . ', ' . $order->address->area . ', ' . $order->address->city . ', ' . $order->address->state . ' - ' . $order->address->zip : 'Address not available' }}
                    </p>
                </div>

                <button onclick="window.location.href='{{ route('orders.index') }}';"
                    class="flex-shrink-0 bg-white border border-[#CBA65A] text-[#CBA65A] font-['Outfit'] font-medium text-[15px] w-full md:w-[160px] h-[48px] rounded-[6px] hover:bg-[#FDFBF7] transition-colors">
                    Order Details
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="w-full flex flex-col md:flex-row gap-4 mt-2 font-['Outfit']">
                <button onclick="window.location.href='{{ route('home') }}';"
                    class="w-full md:flex-1 h-[60px] flex flex-row justify-center items-center px-4 gap-[10px] bg-white border border-[#CBA65A] text-[#CBA65A] font-medium text-[18px] rounded-[10px] hover:bg-[#FDFBF7] transition-colors">
                    Continue Shopping
                </button>
                <button onclick="window.location.href='{{ route('orders.index') }}';"
                    class="w-full md:flex-1 h-[60px] flex flex-row justify-center items-center px-4 gap-[10px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] text-white font-medium text-[18px] rounded-[10px] hover:opacity-90 transition-opacity shadow-sm">
                    My Order
                </button>
            </div>

        </div>
    </main>
@endsection