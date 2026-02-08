@extends('layouts.master')

@section('content')
    <style>
        /* Custom Scrollbar - Preserved from original file */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #FAF8F1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #E8E1D5;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #D4AF37;
        }
    </style>

    <main class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-4 py-10 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-10">

            <div class="space-y-2">
                <div
                    class="w-full h-auto aspect-[4/5] lg:h-[990px] lg:aspect-[3/5] overflow-hidden flex justify-center items-center">
                    <img id="mainImage" src="{{ $product->images->first()->url ?? asset('assets/ring.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-contain-cover mix-blend-multiply transition-opacity duration-300">
                </div>
                <!-- Thumbnails -->
                <div class="grid grid-cols-5 gap-2">
                    @forelse($product->images as $image)
                        <div class="cursor-pointer border border-gray-200 hover:border-amber-400 rounded-md bg-white overflow-hidden aspect-square flex items-center justify-center"
                            onclick="changeImage('{{ $image->url }}')">
                            <img src="{{ $image->url }}" class="object-contain-cover h-full w-full">
                        </div>
                    @empty
                        <div
                            class="cursor-pointer border border-gray-200 hover:border-amber-400 rounded-md bg-white overflow-hidden aspect-square flex items-center justify-center">
                            <img src="{{ asset('assets/ring.png') }}" class="object-contain-cover h-full w-full">
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <div
                        class="flex items-center justify-center box-border px-[10px] py-[4px] gap-[6px] w-[151.67px] min-[2000px]:w-[200px] h-[23px] min-[2000px]:h-[35px] bg-white border border-[#D7D7DA] rounded-[4px]">
                        <span class="font-['Outfit'] font-bold text-[#1A1A1A] min-[2000px]:text-xl">4.5</span>
                        <img src="{{ asset('assets/1star.png') }}" class="h-3 w-3 min-[2000px]:h-5 min-[2000px]:w-5" alt="">
                        <span class="font-['Outfit'] text-[#8B8B8B] text-sm min-[2000px]:text-lg font-normal">| 4.2k
                            Ratings</span>
                    </div>
                    <h1
                        class="mt-0 w-full font-['Outfit'] font-medium text-[26px] min-[2000px]:text-[40px] leading-[30px] min-[2000px]:leading-[50px] text-[#0D0D0E]">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-1">
                        <span
                            class="font-['Outfit'] font-semibold text-[32px] min-[2000px]:text-[48px] leading-[40px] text-[#0D0D0E]">₹{{ number_format($product->price) }}</span>
                        <p class="font-['Outfit'] text-[12px] min-[2000px]:text-lg leading-[18px] text-[#808080] mt-1">
                            (MRP
                            inclusive of all taxes)</p>
                    </div>

                    <div class="flex items-center space-x-2 font-['Outfit'] mt-1">
                        <img src="{{ asset('assets/true_sign.png') }}" class="h-5 w-5" alt="">
                        <span class="text-[14px] min-[2000px]:text-xl leading-[10px] text-[#3D3D42] font-medium">In
                            stock - ready to
                            ship</span>
                    </div>
                </div>

                <div
                    class="grid grid-cols-3 w-full h-auto bg-[rgba(219,179,88,0.1)] rounded-[10px] overflow-hidden font-['Outfit'] border border-[rgba(219,179,88,0.2)]">
                    <!-- Row 1 -->
                    <div class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">SKU</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">{{ $product->sku ?? 'N/A' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-r-2 border-b-2 border-[#DBB358]/20 p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Metal</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->metal_type ?? 'N/A' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-2 border-[#DBB358]/20 p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Carat</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->carat ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Row 2 -->
                    <div class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Category</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->category->name ?? 'N/A' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-r-2 border-[#DBB358]/20 p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Gender</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->gender ?? 'Unisex' }}
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-2">
                        <p class="text-[#3D3D42] text-sm min-[2000px]:text-xl mb-1">Purity</p>
                        <p class="font-bold text-[#1A1A1A] text-base min-[2000px]:text-2xl">
                            {{ $product->purity ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <p class="font-['Outfit'] mt-1 text-[#1A1A1A] text-lg min-[2000px]:text-3xl font-medium mb-0">Offers For
                    You</p>
                <div
                    class="w-full bg-[#F2F4F7] h-[50px] min-[2000px]:h-[70px] rounded-lg flex items-center justify-between cursor-pointer px-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/5off.png') }}" class="h-10 w-10 min-[2000px]:h-14 min-[2000px]:w-14"
                            alt="offer">
                        <div class="font-['Outfit'] text-gray text-sm min-[2000px]:text-xl">
                            EXTRA 10% OFF on Silver Jewellery above ₹999
                        </div>
                    </div>
                    <i class="fa-solid fa-angle-down text-[#3D3D42] min-[2000px]:text-xl"></i>
                </div>


                <!-- size Section-->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-sm min-[2000px]:text-xl text-gray-900  font-['Outfit']">Select Size</h3>

                    </div>
                    <div id="size-container" class="flex font-['Outfit'] flex-wrap gap-2">
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            5
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            6
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            7
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            8
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            9
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            10
                        </button>
                        <button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            11
                        </button><button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            12
                        </button><button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            13
                        </button><button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            14
                        </button><button onclick="selectSize(this)"
                            class="px-6 py-2 text-xs  tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            15
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            16
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            17
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            18
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            19
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            20
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            21
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            22
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            23
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            24
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            25
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            26
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            27
                        </button>
                        <button onclick="selectSize(this)"
                            class="extra-size hidden px-6 py-2 text-xs tracking-wider rounded-full border-2 border-gray-200 bg-white hover:border-amber-400">
                            28
                        </button>
                        <button id="view-more-btn" onclick="toggleSizes()"
                            class="text-xs font-Outfit text-gray-400 underline hover:text-amber-800 transition-colors">
                            View More
                        </button>
                    </div>
                </div>
                <!--Metal Color -->
                <div class="mt-8">
                    <h3 class="text-[11px] min-[2000px]:text-lg font-['Outfit'] tracking-widest mb-5">Metal Color</h3>

                    <div class="flex space-x-5 font-['Outfit']">
                        <label class="flex flex-col items-center group cursor-pointer">
                            <input type="radio" name="metal" class="hidden peer">
                            <img src="{{ asset('assets/yellow.png') }}" class="h-12 w-35">
                        </label>

                        <label class="flex flex-col items-center group cursor-pointer">
                            <input type="radio" name="metal" class="hidden peer">
                            <img src="{{ asset('assets/silver.png') }}" class="h-12 w-35">
                        </label>

                        <label class="flex flex-col items-center group cursor-pointer">
                            <input type="radio" name="metal" class="hidden peer" checked>
                            <img src="{{ asset('assets/rose.png') }}" class="h-12 w-35">
                        </label>
                    </div>
                </div>
                <form action="{{ route('cart.store') }}" method="POST"
                    class="mt-8 flex flex-wrap w-full items-center gap-[10px] md:gap-[20px]">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="size" id="selectedSizeInput">

                    <button type="submit"
                        class="flex-1 md:w-[465px] min-[2000px]:w-[600px] h-[86px] min-[2000px]:h-[100px] bg-[linear-gradient(90deg,#D9BE87_0%,#BE933C_100%)] hover:bg-[#B38940] rounded-[100px] text-white py-[24px] px-[16px] flex items-center justify-center gap-[12px] shadow-sm group">
                        <img src="{{ asset('assets/ic_bag.png') }}"
                            class="h-[24px] w-[32px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]" alt="bag">
                        <span class="text-[18px] min-[2000px]:text-2xl font-medium font-['Outfit']">Add to Cart</span>
                    </button>

                    <button type="submit" formaction="{{ route('wishlist.toggle') }}"
                        class="w-[60px] h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors group">
                        <img src="{{ asset('assets/ic_wishlist.png') }}"
                            class="h-[24px] w-[24px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]" alt="wishlist">
                    </button>

                    <button type="button"
                        class="w-[60px] h-[60px] min-[2000px]:w-[80px] min-[2000px]:h-[80px] flex items-center justify-center border border-[#826230] rounded-full hover:bg-gray-50 transition-colors group">
                        <img src="{{ asset('assets/share_icon.png') }}"
                            class="h-[24px] w-[24px] min-[2000px]:h-[32px] min-[2000px]:w-[32px]" alt="share">
                    </button>
                </form>

                <div
                    class="w-full h-auto mt-8 bg-[#FAF5F5] rounded-xl p-8 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-0">

                    <div class="flex flex-col items-center text-center gap-1">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <!-- Using existing icon or placeholder since strictly matching image icons requires new assets -->
                            <img src="{{ asset('assets/IC -.png') }}" class="h-8 w-auto" alt="">
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            30 Day returnable
                        </p>
                    </div>

                    <div class="flex flex-col items-center text-center gap-1">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <img src="{{ asset('assets/IC -.png') }}" class="h-8 w-auto" alt="">
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            Lifetime Exchange &<br>Buy-Back
                        </p>
                    </div>

                    <div class="flex flex-col items-center text-center gap-1">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <img src="{{ asset('assets/IC -.png') }}" class="h-8 w-auto" alt="">
                        </div>
                        <p class="text-[14px] min-[2000px]:text-xl font-medium font-['Outfit'] text-[#5C4522]">
                            Certified Jewellery
                        </p>
                    </div>

                </div>

                <div class="mt-8 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-['Outfit'] font-medium flex items-center gap-2">
                            Estimated Delivery Date
                        </h4>
                        <button class="text-xs text-[#5C4522] flex items-center gap-1 hover:underline">
                            <i class="fas fa-map-marker-alt"></i>
                            Locate Me
                        </button>
                    </div>

                    <div class="relative flex items-center">
                        <input type="text" placeholder="Enter Pincode" maxlength="6"
                            class="w-full border border-gray-300 text-black rounded-md py-3 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-yellow-600 focus:border-yellow-600">
                        <button
                            class="absolute right-2 font-Outfit px-4 py-1.5 bg-white text-gray-400 font-bold text-xs border-l border-gray-200 uppercase hover:text-yellow-700 transition-colors">
                            Confirm
                        </button>
                    </div>

                    <p class="mt-2 text-[11px] text[#3D3D42] font-['Outfit']">
                        Enter Pincode to get expected delivery date
                    </p>

                    <p class="mt-4  text-center text-[#3D3D42] font-['Outfit']">
                        Any Questions? Please feel free to reach us at
                        <span class="font-['Outfit']">18001230006</span>
                    </p>
                </div>
            </div>
    </main>
    <!--Product details-->

    <div class="bg-[#FDFBF7] py-12 px-4 md:px-15 font-sans text-[#4A4A4A]">
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
            <img src="{{ asset('assets/Design.png') }}"
                class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
            <div class="text-center flex flex-col items-center">
                <p style="font-family: 'Alexandria', sans-serif;"
                    class="text-[12px] tracking-[0.2em] text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">Product
                </p>
                <h2
                    class="font-['Outfit'] font-medium text-[28px] md:text-[40px] leading-tight md:leading-[68px] text-[#CBA65A]">
                    Details</h2>
            </div>
            <img src="{{ asset('assets/Design (1).png') }}"
                class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
        </div>

        <div class="flex flex-wrap justify-center gap-2 mb-10 font-['Outfit']">
            <button
                class="px-4 md:px-8 py-2 border border-[#E8E1D5] text-sm rounded-full font-medium transition duration-300 hover:bg-black hover:text-white">
                About
            </button>
            <button
                class="px-4 md:px-8 py-2 border border-[#E8E1D5] text-sm rounded-full font-medium hover:bg-black hover:text-white transition duration-300">
                Diamond & Metal Details
            </button>
            <button
                class="px-4 md:px-8 py-2 border border-[#E8E1D5] text-gray-700 text-sm rounded-full font-medium hover:bg-black hover:text-white transition duration-300">
                Price Breakup
            </button>
        </div>

        <div
            class="w-full max-w-[1120px] h-auto mx-auto bg-[#FAF8F1] border-t-2 border-b-2 p-8 lg:p-0 flex flex-col lg:flex-row items-center justify-between overflow-hidden gap-8 lg:gap-0">

            <div class="flex-1 px-4 lg:pl-[60px] flex flex-col justify-center h-full text-center lg:text-left">
                <span class="text-[20px] leading-[20px] font-['Outfit'] text-gray mb-3">About Your</span>
                <h3 class="text-[28px] leading-[36px] font-medium font-['Outfit'] text-[#1A1A1A] mb-4">
                    {{ $product->name }}
                </h3>
                <p
                    class="text-[14px] leading-[22px] font-['Outfit'] text-[#808080] mb-8 w-full max-w-[500px] mx-auto lg:mx-0">
                    {{ $product->description }}
                </p>

                <div
                    class="w-full max-w-[580px] h-[52px] bg-white rounded-[8px] flex justify-between items-center px-6 shadow-sm mx-auto lg:mx-0">
                    <span class="text-[14px] font-medium font-['Outfit'] text-[#1A1A1A]">Weight</span>
                    <span class="text-[14px] font-medium font-['Outfit'] text-[#1A1A1A]">2.079 gram</span>
                </div>
            </div>

            <div
                class="w-full max-w-[335px] h-auto aspect-square  rounded-[12px] border border-[#F2F4F7] flex items-center justify-center lg:mr-[20px] relative  p-4">
                <img src="{{ $product->images->first()->url ?? asset('assets/ring.png') }}" alt="{{ $product->name }}"
                    class="w-full h-full object-contain">
            </div>

        </div>
    </div>
    <!--Ratings and reviews-->
    <section class=" h-full w-full max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto py-16 font-sans">
        <div class="flex flex-col lg:flex-row items-center gap-2">
            <!-- Left Side: Summary -->
            <div class="w-full lg:w-1/3 flex flex-col  py-8 gap-[20px]">
                <div class="flex items-center gap-2 justify-center lg:justify-start items-center md:gap-4 mb-2">
                    <div class="flex md:flex flex-row justify-center md:justify-end gap-[9px] w-auto md:w-[200px] h-[25px]">
                        <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain">
                    </div>
                    <div class="text-center lg:text-left flex flex-col justify-center items-center lg:items-start">
                        <span
                            class="text-[14px] md:text-[17px] min-[2000px]:text-3xl text-[#5C4522] block font-['Alexandria'] leading-none">Ratings
                            &</span>
                        <h2
                            class="text-[24px] md:text-[32px] min-[2000px]:text-5xl text-[#CBA65A] font-medium font-['Outfit'] leading-tight">
                            Reviews
                        </h2>
                    </div>
                    <div
                        class="flex md:hidden flex-row justify-center md:justify-start gap-[9px] w-auto md:w-[200px] h-[25px]">
                        <img src="{{ asset('assets/Design_new.png') }}" alt="design" class="h-full object-contain"
                            style="transform: scaleX(-1);">
                    </div>
                </div>

                <div class="flex items-center gap-2 justify-center">
                    <div class="flex items-center gap-1 text-[#F5B800]">
                        <i class="fas fa-star text-lg"></i>
                        <i class="fas fa-star text-lg"></i>
                        <i class="fas fa-star text-lg"></i>
                        <i class="fas fa-star text-lg"></i>
                        <i class="fas fa-star-half-alt text-lg"></i>
                    </div>
                    <span class="font-['Outfit'] text-[32px] text-[#1A1A1A]">4.5</span>
                </div>

                <button
                    class="self-center  w-auto px-9 py-2 border border-[#CBA65A] text-[#CBA65A] text-sm rounded-full hover:bg-[#CBA65A] hover:text-white transition-all font-['Outfit'] tracking-wide">
                    Write Review
                </button>
            </div>

            <!-- Right Side: Reviews Card -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl border border-[#F2F4F7] overflow-hidden shadow-sm">
                    <!-- Card Header -->
                    <div class="bg-white border-b border-[#F2F4F7] px-8 py-5">
                        <h3 class="text-[#5C4522] font-bold font-['Outfit'] text-xl">Customers Review</h3>
                    </div>

                    <!-- Card Body (Reviews List) -->
                    <div class="bg-[#FAF8F1] px-8 py-6 h-[350px] overflow-y-auto space-y-6 custom-scrollbar">
                        @forelse($product->reviews as $review)
                            <!-- Review Item -->
                            <div class="border-b border-[#E8E1D5] pb-6 last:border-0 last:pb-0">
                                <p class="text-[#3D3D42] text-[15px] leading-relaxed mb-4 font-['Outfit'] italic">
                                    "{{ $review->comment }}"
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-[#1A1A1A] font-['Outfit'] text-sm">{{ $review->user->name ?? 'Anonymous' }}</span>
                                        <div
                                            class="border border-[#D7D7DA] rounded px-2 py-0.5 bg-white text-xs flex items-center gap-1">
                                            <span class="font-bold">{{ $review->rating }}</span>
                                            <img src="{{ asset('assets/1star.png') }}" class="h-3 w-3" alt="">
                                            <span
                                                class="text-[#808080]  border-l-2 font-['Outfit']">{{ optional($review->created_at)->format('d M Y') ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center p-4">No reviews yet.</p>
                        @endforelse
                    </div>


                </div>
                <!-- Card Footer (Pagination) -->
                <div class="py-4 px-8 flex justify-end items-center gap-3">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-full border border-[#CBA65A] text-[#CBA65A] font-medium bg-white shadow-sm text-sm">
                        1
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#E8E1D5] text-[#5C4522] transition-colors">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>
    <!-- image slider-->
    <div class="relative w-full h-full mx-auto overflow-hidden">

        <div id="slides" class="grid w-full h-full overflow-hidden">
            @if(isset($banners) && $banners->count() > 0)
                @foreach($banners as $index => $banner)
                    <div
                        class="{{ $index == 0 ? 'col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out' : 'absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out' }}">
                        <img src="{{ asset('storage/' . $banner->image) }}"
                            class="{{ $index == 0 ? 'w-full h-auto block' : 'w-full h-full object-cover block' }}"
                            alt="{{ $banner->title }}">
                    </div>
                @endforeach
            @else
                <!-- Fallback Static Slides -->
                <!-- Slide 1 -->
                <div class="col-start-1 row-start-1 w-full relative transition-transform duration-[1500ms] ease-out">
                    <img src="{{ asset('assets/Top Banner Section.png') }}" class="w-full h-auto block" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
                    <img src="{{ asset('assets/banner.png') }}" class="w-full h-full object-cover block" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
                    <img src="{{ asset('assets/Top Banner Section.png') }}" class="w-full h-full object-cover block"
                        alt="Slide 3">
                </div>
                <!-- Slide 4 -->
                <div class="absolute top-0 left-0 w-full h-full transition-transform duration-[1500ms] ease-out">
                    <img src="{{ asset('assets/banner.png') }}" class="w-full h-full object-cover block" alt="Slide 4">
                </div>
            @endif
        </div>
    </div>
    <!-- Dots navigation -->
    <div id="dots" class="flex justify-center mt-4 gap-2 dots-expanding">
        @if(isset($banners) && $banners->count() > 0)
            @foreach($banners as $index => $banner)
                <button
                    class="h-3 rounded-full transition-all duration-300 {{ $index == 0 ? 'w-8 bg-[#CBA65A]' : 'w-3 bg-[#E8E1D5]' }}"
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        @else
            <button class="h-3 rounded-full transition-all duration-300 w-8 bg-[#CBA65A]" aria-label="Slide 1"></button>
            <button class="h-3 rounded-full transition-all duration-300 w-3 bg-[#E8E1D5]" aria-label="Slide 2"></button>
            <button class="h-3 rounded-full transition-all duration-300 w-3 bg-[#E8E1D5]" aria-label="Slide 3"></button>
            <button class="h-3 rounded-full transition-all duration-300 w-3 bg-[#E8E1D5]" aria-label="Slide 4"></button>
        @endif
    </div>


    <!-- Similar Jewellery Product Section -->
    <section class="max-w-[1600px] min-[2000px]:max-w-[2400px] mx-auto px-4 py-12 font-Outfit">
        <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
            <img src="{{ asset('assets/Design.png') }}"
                class="h-auto w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
            <div class="text-center flex flex-col items-center">
                <p style="font-family: 'Alexandria', sans-serif;"
                    class="text-[15px]  text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">Similar</p>
                <h2
                    class="font-['Outfit'] font-medium text-[28px] md:text-[40px] leading-tight md:leading-[50px] text-[#CBA65A]">
                    Jewellery Product</h2>
            </div>
            <img src="{{asset('assets/Design(1).png')}}"
                class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
            <!-- Left Banner Card -->
            <div
                class="lg:col-span-1 bg-[#111111] h-full w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden">
                <img src="{{asset('assets/neckless.png')}}" alt="Necklace"
                    class="w-full h-full object-contain object-center">


            </div>

            <!-- Right Grid -->
            <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">
                @foreach($relatedProducts as $related)
                    <!-- Product Card -->
                    <div class="flex flex-col gap-3">
                        <div
                            class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                            <span
                                class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Trending</span>

                            <div class="w-full h-full flex items-center justify-center">
                                <a href="{{ route('product.details', $related->slug) }}" class="block w-full h-full">
                                    <img src="{{ $related->images->first()->url ?? asset('assets/ring.png') }}"
                                        alt="{{ $related->name }}"
                                        class="w-full h-full object-contain-full mix-blend-multiply transition-transform duration-500 ease-in-out group-hover:opacity-0 group-hover:scale-110">
                                    <img src="{{ $related->images->skip(1)->first()->url ?? asset('assets/ring.png') }}"
                                        class="w-full h-full object-contain mix-blend-multiply absolute inset-0 opacity-0 transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:scale-110">
                                </a>
                            </div>
                        </div>
                        <div class="text-center font-['Outfit']">
                            <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">
                                <a href="{{ route('product.details', $related->slug) }}">{{ $related->name }}</a>
                            </h3>
                            <div class="flex items-center justify-center gap-2 text-xs">
                                <span class="font-['outfit'] text-[#1A1A1A]">₹ {{ number_format($related->price) }}</span>
                                <!-- <span class="text-[#999999] line-through">₹ 949.00</span> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="w-full py-3 bg-[#EADCDC] flex items-center justify-center">
        <span class="font-['Outfit'] font-medium text-[#1A1A1A]">Know More About Tattsvi</span>
    </div>
    </main>

    <script src="{{ asset('js/script_p_3.js') }}"></script>
    <script>
        function changeImage(src) {
            const mainImg = document.getElementById('mainImage');
            if (mainImg) {
                mainImg.style.opacity = '0';
                setTimeout(() => {
                    mainImg.src = src;
                    mainImg.style.opacity = '1';
                }, 150);
            }
        }

        function selectSize(btn) {
            // Remove active class from all
            document.querySelectorAll('#size-container button').forEach(b => {
                b.classList.remove('border-amber-400', 'bg-amber-50');
                b.classList.add('border-gray-200', 'bg-white');
            });
            // Add active class
            btn.classList.remove('border-gray-200', 'bg-white');
            btn.classList.add('border-amber-400', 'bg-amber-50');

            // Set Input
            const size = btn.innerText.trim();
            const input = document.getElementById('selectedSizeInput');
            if (input) input.value = size;
        }

        function toggleSizes() {
            document.querySelectorAll('.extra-size').forEach(el => {
                el.classList.toggle('hidden');
            });
            const btn = document.getElementById('view-more-btn');
            if (btn.innerText.includes("More")) {
                btn.innerText = "View Less";
            } else {
                btn.innerText = "View More";
            }
        }
    </script>
@endsection