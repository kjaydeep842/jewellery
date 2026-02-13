@extends('frontend.layouts.master')

@section('content')
<main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
    <div
        class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

        <!-- Sidebar -->
        @include('frontend.profile.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-grow min-h-[600px] flex flex-col">
            @if($orders->isEmpty())
            <!-- Main Content: Empty State -->
            <div class="flex-grow flex flex-col justify-center items-center p-[12px] gap-[12px] w-full rounded-[4px]"
                style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
                <div class="relative">
                    <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="No Order Found"
                        class="w-16 h-16 opacity-80">
                </div>
                <p class="font-['Outfit'] font-bold text-[#1A1A1A] text-xl">No Order Found</p>
            </div>
            @else
            <div class="p-4 md:p-10 bg-white rounded-[10px] shadow-sm flex-grow">
                <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl min-[2000px]:text-3xl mb-8">My Orders
                </h2>
                <div class="space-y-6">
                    @foreach($orders as $order)
                    <div class="border border-gray-100 rounded-xl p-4 md:p-6 hover:shadow-md transition-shadow">
                        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
                            <div>
                                <p class="text-[13px] text-[#989898] font-['Outfit'] uppercase">Order ID</p>
                                <p class="font-['Outfit'] font-semibold text-[#1A1A1A]">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-[13px] text-[#989898] font-['Outfit'] uppercase">Date</p>
                                <p class="font-['Outfit'] font-semibold text-[#1A1A1A]">
                                    {{ $order->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[13px] text-[#989898] font-['Outfit'] uppercase">Status</p>
                                <span
                                    class="px-3 py-1 rounded-full text-[12px] font-medium 
                                                                                    {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' :
                                ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-[13px] text-[#989898] font-['Outfit'] uppercase">Total</p>
                                <p class="font-['Outfit'] font-bold text-[#CBA65A] text-lg">
                                    ₹{{ number_format($order->total_amount) }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-50 pt-4 flex justify-between items-center">
                            <p class="text-sm text-gray-600 font-['Outfit']">{{ $order->items->count() }} items</p>
                            <a href="#" class="text-[#B39359] text-sm font-medium hover:underline font-['Outfit']">View
                                Details</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</main>
<div class="w-full bg-[#E9D3D6] py-4 flex items-center justify-center ">
    <span class="text-[#0D0D0E] font-['Outfit'] text-base font-medium">Know More About Tattsvi</span>
</div>
@endsection