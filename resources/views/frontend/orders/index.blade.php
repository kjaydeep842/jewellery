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
                                        $statusColor = 'text-[#09B285]';
                                        $statusBg = 'bg-[#09B285]';
                                        $statusIcon = 'fa-check';
                                        $statusText = 'Confirmed';
                                        $statusDateText = 'Arriving by Sat, 7 Mar'; // Default fallback or logic based on status
                                        
                                        if($order->status === 'delivered' || $order->status === 'completed') {
                                            $statusColor = 'text-[#09B285]';
                                            $statusText = 'Delivered';
                                            $statusDateText = 'On ' . $order->created_at->format('D, d M');
                                        } elseif($order->status === 'cancelled') {
                                            $statusColor = 'text-[#D12B2B]';
                                            $statusText = 'Cancelled';
                                            $statusDateText = 'On ' . $order->created_at->format('D, d M');
                                        } elseif($order->status === 'refunded' || $order->status === 'returned' || str_contains(strtolower($order->status), 'refund')) {
                                            $statusColor = 'text-[#09B285]'; // Figma shows "Refund Credited" in green/grey mix, let's stick to theme green for success
                                            $statusText = $order->status === 'returned' ? 'Returned' : 'Refund Credited';
                                            $statusDateText = 'On ' . $order->created_at->format('D, d M');
                                        } else {
                                            $statusColor = 'text-[#09B285]';
                                            $statusText = 'Confirmed';
                                            $statusDateText = 'Arriving by ' . $order->created_at->addDays(7)->format('D, d M');
                                        }
                                    @endphp
                                    <div class="bg-white border border-[#CFD4E3] rounded-[4px] overflow-hidden flex flex-col gap-0 hover:shadow-sm transition-shadow">
                                        <!-- Card Header: Status Bar -->
                                        <div class="flex justify-between items-center p-4 md:p-6 border-b border-[#F0F2F7]">
                                            <div class="flex items-center gap-4">
                                                @if($order->status === 'delivered' || $order->status === 'completed')
                                                    <!-- Delivered Icon Design (Black circle + badge) -->
                                                    <div class="relative w-10 h-10 bg-[#1A1A1A] rounded-full flex items-center justify-center flex-shrink-0">
                                                        <img src="{{ asset('assets/ic_order.png') }}" alt="delivered" class="w-6 h-6 object-contain invert">
                                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#09B285] rounded-full border-2 border-white flex items-center justify-center">
                                                            <i class="fa-solid fa-check text-white text-[10px]"></i>
                                                        </div>
                                                    </div>
                                                @elseif($order->status === 'cancelled')
                                                    <!-- Cancelled Icon Design (Grey circle + badge) -->
                                                    <div class="relative w-10 h-10 bg-[#656E8A] rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="fa-solid fa-xmark text-white text-[18px]"></i>
                                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#D12B2B] rounded-full border-2 border-white flex items-center justify-center">
                                                            <i class="fa-solid fa-exclamation text-white text-[10px]"></i>
                                                        </div>
                                                    </div>
                                                @elseif($order->status === 'refunded' || $order->status === 'returned' || str_contains(strtolower($order->status), 'refund'))
                                                    <!-- Refunded/Returned Icon Design (Grey circle + badge) -->
                                                    <div class="relative w-10 h-10 bg-[#656E8A] rounded-full flex items-center justify-center flex-shrink-0">
                                                        <img src="{{ asset('assets/order_return.png') }}" alt="returned" class="w-6 h-6 object-contain invert">
                                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#09B285] rounded-full border-2 border-white flex items-center justify-center">
                                                            <i class="fa-solid fa-check text-white text-[10px]"></i>
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Confirmed/Pending (Green background with ic_order.png) -->
                                                    <div class="w-10 h-10 bg-[#09B285] rounded-full flex items-center justify-center flex-shrink-0">
                                                        <img src="{{ asset('assets/ic_order.png') }}" alt="confirmed" class="w-6 h-6 object-contain invert">
                                                    </div>
                                                @endif
                                                
                                                <div>
                                                    <p class="font-['Outfit'] font-bold {{ $statusColor }} text-[18px] leading-tight">
                                                        {{ $statusText }}
                                                    </p>
                                                    <p class="font-['Outfit'] font-normal text-[#989898] text-[14px]">
                                                        {{ $statusDateText }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Body: Product Info -->
                                        <div class="flex flex-row gap-4 md:gap-6 p-4 md:p-6 items-start">
                                            <!-- Product Image -->
                                            <div class="w-[80px] h-[80px] md:w-[130px] md:h-[130px] bg-[#F9F9FB] rounded-[4px] flex items-center justify-center flex-shrink-0 overflow-hidden border border-[#f0f0f0]">
                                                @if($product->images->count() > 0)
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                                        alt="{{ $product->name }}" 
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                @else
                                                    {{-- No Fallback Image --}}
                                                @endif
                                            </div>
                                            
                                            <!-- Product Details -->
                                            <div class="flex-grow flex flex-col min-w-0 relative">
                                                <div class="flex justify-between items-start mb-1">
                                                    <h3 class="font-['Outfit'] font-medium text-[#1A1A1A] text-[18px] md:text-[22px] leading-tight flex-grow pr-4">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <a href="{{ route('product.details', $product->slug) }}" class="font-['Outfit'] font-normal text-[#CBA65A] text-[15px] hover:underline whitespace-nowrap pt-1">View Details</a>
                                                </div>
                                                
                                                <p class="font-['Outfit'] font-bold text-[#1A1A1A] text-[20px] md:text-[28px] mt-1 mb-4">
                                                    ₹{{ number_format($item->price, 2) }}
                                                </p>
                                                
                                                <div class="flex flex-wrap gap-3">
                                                    <div class="px-4 py-2 bg-[#F3F4F6] rounded-[4px] font-['Outfit'] text-[15px] text-[#0D0D0E] flex items-center gap-3 min-w-[120px] justify-between cursor-pointer hover:bg-gray-200 transition-colors">
                                                        <span class="flex gap-2"><span class="text-[#989898]">Size:</span> <span class="font-medium">{{ $item->size ?: 'Standard' }}</span></span>
                                                        <i class="fa-solid fa-chevron-down text-[10px] text-[#848484]"></i>
                                                    </div>
                                                    <div class="px-4 py-2 bg-[#F3F4F6] rounded-[4px] font-['Outfit'] text-[15px] text-[#0D0D0E] flex items-center gap-3 min-w-[100px] justify-between cursor-pointer hover:bg-gray-200 transition-colors">
                                                        <span class="flex gap-2"><span class="text-[#989898]">Qty:</span> <span class="font-medium">{{ $item->quantity }}</span></span>
                                                        <i class="fa-solid fa-chevron-down text-[10px] text-[#848484]"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Footer: Action Buttons -->
                                        <div class="grid @if(in_array($order->status, ['delivered', 'completed', 'returned', 'cancelled', 'refunded'])) grid-cols-1 @else grid-cols-2 @endif gap-4 p-4 md:p-6 border-t border-[#F0F2F7]">
                                            @if(!in_array($order->status, ['delivered', 'completed', 'returned', 'cancelled', 'refunded']))
                                                <a href="{{ route('orders.cancel', $order->id) }}" class="py-3 px-6 rounded-[5px] bg-[#F1F1F1] font-['Outfit'] font-medium text-[#0D0D0E] text-[16px] md:text-[18px] hover:bg-gray-200 transition-colors text-center">
                                                    Cancel
                                                </a>
                                            @endif
                                            <button class="py-3 px-6 rounded-[5px] bg-[#F1F1F1] font-['Outfit'] font-medium text-[#0D0D0E] text-[16px] md:text-[18px] hover:bg-gray-200 transition-colors">
                                                Track
                                            </button>
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