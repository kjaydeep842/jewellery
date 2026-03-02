@extends('frontend.layouts.master')

@section('content')
    <style>
        /* Custom Scrollbar for right-side content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
    <main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
        <div
            class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

            <!-- Sidebar -->
            @include('frontend.profile.partials.sidebar')

            <!-- Main Content -->
            <!-- Fixed height container with independent vertical scrolling -->
            <div class="flex-grow flex flex-col lg:h-[calc(100vh-150px)] lg:overflow-y-auto w-full pr-0 md:pr-4 custom-scrollbar">
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
                    <div class="p-0 md:p-6 bg-transparent flex-grow">
                        <div class="flex justify-between items-center mb-6 px-4 md:px-0">
                            <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl min-[2000px]:text-3xl">My Orders</h2>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                @foreach($order->items as $item)
                                    @php
                                        $product = $item->product;
                                        $statusColor = 'text-gray-500';
                                        $statusBg = 'bg-gray-100';
                                        $statusIcon = 'fa-rotate-left';
                                        
                                        if($order->status === 'delivered') {
                                            $statusColor = 'text-[#008A4B]';
                                            $statusBg = 'bg-[#E7F3EF]';
                                            $statusIcon = 'fa-check';
                                        } elseif($order->status === 'cancelled') {
                                            $statusColor = 'text-[#D12B2B]';
                                            $statusBg = 'bg-[#FBE9E9]';
                                            $statusIcon = 'fa-xmark';
                                        } elseif($order->status === 'refunded' || str_contains(strtolower($order->status), 'refund')) {
                                            $statusColor = 'text-[#4A4A4A]';
                                            $statusBg = 'bg-[#F3F4F6]';
                                            $statusIcon = 'fa-rotate-left';
                                        }
                                    @endphp
                                    <div class="bg-white border border-[#CFD4E3] rounded-[4px] p-4 md:p-[24px] flex flex-col gap-4 hover:shadow-sm transition-shadow">
                                        <!-- Card Header -->
                                        <div class="flex justify-between items-start">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $statusBg }}">
                                                    <i class="fa-solid {{ $statusIcon }} {{ $statusColor }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-['Outfit'] font-medium text-[#0D0D0E] text-[16px] leading-tight mb-0.5">
                                                        {{ ucfirst($order->status) }}
                                                    </p>
                                                    <p class="font-['Outfit'] font-normal text-[#989898] text-[13px]">
                                                        On {{ $order->created_at->format('D, d M') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <a href="{{ route('product.details', $product->slug) }}" class="font-['Outfit'] font-normal text-[#CBA65A] text-[15px] hover:underline whitespace-nowrap">View Details</a>
                                        </div>

                                        <!-- Card Content -->
                                        <div class="flex flex-row gap-4 md:gap-6 items-start mt-2">
                                            <!-- Product Image -->
                                            <div class="w-[100px] h-[120px] md:w-[130px] md:h-[156px] bg-[#EEF0F5] rounded-[10px] flex items-center justify-center flex-shrink-0 overflow-hidden border border-[#f0f0f0]">
                                                @if($product->images->count() > 0)
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                                        alt="{{ $product->name }}" 
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                @else
                                                    {{-- No Fallback Image --}}
                                                @endif
                                            </div>
                                            
                                            <!-- Product Details -->
                                            <div class="flex-grow flex flex-col min-w-0">
                                                <h3 class="font-['Outfit'] font-normal text-[#0D0D0E] text-[16px] md:text-[20px] leading-tight mb-2 line-clamp-2 md:line-clamp-none">
                                                    {{ $product->name }}
                                                </h3>
                                                <p class="font-['Outfit'] font-semibold text-[#0D0D0E] text-[20px] md:text-[24px] mb-3 md:mb-5">
                                                    ₹{{ number_format($item->price, 2) }}
                                                </p>
                                                <div class="flex flex-wrap gap-2 mt-auto">
                                                    <span class="px-3 py-1.5 bg-[#F3F4F6] rounded-[4px] font-['Outfit'] text-[12px] md:text-[14px] text-[#4A4A4A] font-medium leading-none">
                                                        Size: {{ $item->size ?: 'Standard' }}
                                                    </span>
                                                    <span class="px-3 py-1.5 bg-[#F3F4F6] rounded-[4px] font-['Outfit'] text-[12px] md:text-[14px] text-[#4A4A4A] font-medium leading-none">
                                                        Qty: {{ $item->quantity }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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