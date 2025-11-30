<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Tattsvi</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,200&display=swap">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @font-face {
            font-family: 'PP Editorial New';
            src: local('Playfair Display');
        }
    </style>

    <script src="/assets/script.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800" style="font-family: 'Fahkwang', sans-serif;">

{{-- ✅ Include Header --}}
@include('partials.header')

{{-- ---------------------------------------------------------------------- --}}
{{-- PRODUCT DETAILS CONTENT BELOW --}}
{{-- ---------------------------------------------------------------------- --}}

<!-- Product Image Slider -->
<div class="relative max-w-sm sm:max-w-md lg:max-w-2xl mx-auto overflow-hidden mt-6">
    <div id="slides" class="whitespace-nowrap transition-transform duration-500 flex">
        <div class="w-full flex-shrink-0">
            <img src="/assets/bs3.jpg" class="w-full h-auto object-cover">
        </div>
        <div class="w-full flex-shrink-0">
            <img src="/assets/bs2.jpg" class="w-full h-auto object-cover">
        </div>
        <div class="w-full flex-shrink-0">
            <img src="/assets/bs1.jpg" class="w-full h-auto object-cover">
        </div>
    </div>

    <!-- Slider dots -->
    <div id="dots" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
        <button class="w-3 h-3 rounded-full bg-black bg-opacity-75"></button>
        <button class="w-3 h-3 rounded-full bg-black bg-opacity-75"></button>
        <button class="w-3 h-3 rounded-full bg-black bg-opacity-75"></button>
    </div>
</div>

<!-- Product Title / Stock / Rating -->
<div class="px-4 mt-5">
    <p class="text-gray-500 text-sm font-medium">TATTSVI</p>
    <h1 class="text-2xl font-bold mt-1">GOLD ITEMS</h1>

    <div class="flex flex-col sm:flex-row justify-between mt-3">
        <span class="bg-green-500/20 text-green-700 px-3 py-1 rounded-md text-sm font-medium">Available in stock</span>

        <div class="flex items-center text-yellow-500 text-sm mt-2 sm:mt-0">
            <span class="text-lg">⭐⭐⭐⭐⭐</span>
            <span class="ml-1 text-gray-800 font-semibold">4.4</span>
            <span class="text-gray-500 ml-1">(126 Reviews)</span>
        </div>
    </div>
</div>

<!-- Product Info -->
<div class="px-4 mt-6">
    <h2 class="text-lg font-semibold">Product info</h2>
    <p class="text-gray-600 mt-2 leading-6">
        Gold, Silver, and Diamond pieces offer a perfect blend of elegance and durability.
        Each material adds beauty and lasting value to any jewelry collection.
    </p>
</div>

<!-- Divider Sections -->
<div class="mt-6 border-t">

    <!-- Product Details -->
    <div class="flex items-center justify-between px-5 py-4 border-b">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-box"></i>
            <span class="text-lg">Product Details</span>
        </div>
        <i class="fa-solid fa-chevron-right text-gray-500"></i>
    </div>

    <!-- Shipping -->
    <div class="flex items-center justify-between px-5 py-4 border-b">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-truck"></i>
            <span class="text-lg">Shipping Information</span>
        </div>
        <i class="fa-solid fa-chevron-right text-gray-500"></i>
    </div>

    <!-- Returns -->
    <div class="flex items-center justify-between px-5 py-4 border-b">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-rotate-left"></i>
            <span class="text-lg">Returns</span>
        </div>
        <i class="fa-solid fa-chevron-right text-gray-500"></i>
    </div>

</div>

<!-- Rating box -->
<div class="px-5 mt-6">
    <div class="bg-gray-100 rounded-xl p-6 shadow-sm">
        <h3 class="text-3xl font-bold">4.3 <span class="text-lg text-gray-500">/5</span></h3>
        <p class="text-gray-500 mt-1">Based on 128 Reviews</p>

        <div class="flex text-yellow-500 text-2xl mt-2">⭐⭐⭐⭐⭐</div>
    </div>
</div>

<!-- You may also like -->
<div class="mt-6">
    <h2 class="text-lg font-semibold px-4">You may also like</h2>

    <div class="flex space-x-4 mt-4 overflow-x-scroll pb-3 px-4">
        
        @foreach (['bs1','bs2','bs3','bs4'] as $img)
        <div class="flex-shrink-0 w-40 bg-white rounded-xl border p-3 shadow-sm">
            <div class="h-28 bg-gray-100 rounded-md flex items-center justify-center">
                <img src="/assets/{{ $img }}.jpg" class="max-h-full max-w-full object-contain">
            </div>
            <p class="text-gray-500 text-xs mt-2">TATTASVI</p>
            <h3 class="text-md font-semibold">MANGALSUTRA</h3>
            <p class="text-blue-600 font-semibold">$900.0</p>
        </div>
        @endforeach

    </div>
</div>

<!-- Buy Now Bar -->
<div class="fixed bottom-0 left-0 w-full bg-white shadow-xl z-50">
    <div class="flex justify-between items-center px-6 py-4 bg-yellow-600 text-white font-semibold">
        <div>
            <div class="text-xl">$140.00</div>
            <div class="text-sm opacity-90">Unit price</div>
        </div>
        <button class="bg-yellow-700 hover:bg-yellow-800 px-6 py-3 rounded-lg text-white font-bold">
            Buy Now
        </button>
    </div>
</div>

{{-- ✅ Include Footer --}}
@include('partials.footer')

</body>
</html>
