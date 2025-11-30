<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jewelry Website</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700;1,800&display=swap">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,200&display=swap" rel="stylesheet">
    <style>
      @font-face {
          font-family: 'PP Editorial New';
          src: local('Playfair Display'), local('Georgia'), serif;
      }
      .font-fahkwang { font-family: 'Fahkwang', sans-serif; }
      .font-editorial { font-family: 'PP Editorial New', serif; }
      .font-roboto { font-family: 'Roboto', sans-serif; }


      html, body {
    overflow-x: hidden !important;
}

section {
    width: 100%;
}

img {
    max-width: 100%;
    height: auto;
}

/* Prevent ellipse & necklace from overflowing on small screens */
@media (max-width: 768px) {
    .hero-image-wrapper img {
        max-width: 80% !important;
    }
}

    </style>
</head>
<body class="bg-gray-50 text-gray-800" style="font-family: 'Fahkwang', sans-serif;">
  
@include('partials.header')
<!-- HERO SECTION -->
<!-- HERO SECTION -->
<!-- HERO SECTION -->
<section class="relative w-full bg-[#3d3d3f] text-white overflow-hidden">

  <div class="w-full flex justify-center bg-[#3d3d3f]">
      <img src="/assets/mg.jpeg"
           class="w-full max-w-[1800px] h-auto object-contain mx-auto">
  </div>

</section>
  <!-- New Arrivals Section -->
<section class="container mx-auto px-6 py-16">
  <div class="flex items-center space-x-1 mt-1  md:text-right">
  <h2 class="text-3xl font-bold  mb-10 text-gray-800">New Arrivals</h2>
   <span class="absolute right-0 text-xs px-44 py-2">
   <i class="fa-solid fa-chevron-left text-gray-700"></i>
   <i class="fa-solid fa-chevron-right text-gray-700"></i>
  </span>
    </div>

 <!-- Product Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    
    <!-- Product Card 1 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww1.png" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
   <!-- Second Image (Hover State) -->
       <img src="assets/nw1.png" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
      <h3 class="text-lg text-gray-800 mb-2">Eternity Band</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        <a href="{{ route('product.details') }}">

        Add to Cart
      </button>
      </a>
    </div>

    <!-- Product Card 2 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww2.png" alt="Birthstone Earrings" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw2.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
     <h3 class="text-lg text-gray-800 mb-2">Birthstone Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        
        Add to Cart
      </button>
    </div>

    <!-- Product Card 3 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
     <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww3.png" alt="Byzantine Bracelet" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/nw3.png" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
 <h3 class="text-lg text-gray-800 mb-2">Byzantine Bracelet</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product Card 4 -->
    <div class="relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww4.png" alt="Infinity Bracelet" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw4.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
      <h3 class="text-lg text-gray-800 mb-2">Infinity Bracelet</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

  </div>
</section>
<!-- Promo Banner Section -->
<section class="container mx-auto px-6 py-16">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    
    <!-- Left Banner -->
    <div class="relative bg-[url('assets/ear.png')] bg-cover bg-center rounded-lg overflow-hidden h-64 md:h-80 flex items-center justify-center text-white p-6">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative  space-y-3 text-center">
        <p class="text-sm mb-4">10% OF ON ALL RINGS</p>
        <h2 class="text-xl md:text-3xl mb-2">Elevate Your Style-Shop Our Latest Collection !</h2>
        <p class="text-xs md:text-sm mb-5">Experience the Beauty of Fine Jewelry at Prices You Won't Believe!</p>
        <a href="#" class="inline-block border border-white text-white px-4 py-1 rounded-full hover:bg-rose-50 hover:text-black transition text-sm">
          Shop Now
        </a>
      </div>
    </div>

    <!-- Right Banner -->
    <div class="relative bg-[url('assets/s1.jpg')] bg-cover  bg-center rounded-lg overflow-hidden h-64 md:h-80 flex flex-col items-center justify-center text-white text-center p-6">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative space-y-3 text-center">
        
        <h3 class="text-xl md:text-3xl mb-2">Start Your Journey to Exquisite Jewelry</h3>
        <p class="text-xs md:text-sm mb-4">Find Beautiful Jewelry That Fits Your Style and Budget!</p>
        <a href="#" class="inline-block border border-white text-white px-4 py-1 rounded-full hover:bg-rose-50 hover:text-black transition text-sm">
          Shop Now
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Best Seller Section -->
<section class="container mx-auto px-6 py-16">
  <div class="flex items-center space-x-1 mt-1  md:text-right">
  <h2 class="text-3xl font-bold  mb-10 text-gray-800">Best Seller</h2>
   <span class="absolute right-0 text-xs px-44 py-2">
   <i class="fa-solid fa-chevron-left text-gray-700"></i>
   <i class="fa-solid fa-chevron-right text-gray-700"></i>
  </span>
    </div>
  

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

    <!-- Product 1 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/bss1.png" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs1.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
           
   <h3 class="text-lg text-gray-800 mb-2">Anniversary Ring</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 2 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
     <img src="assets/bss2.png" alt="Vintage-Inspired Earrings" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs2.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
    
      <h3 class="text-lg text-gray-800 mb-2">Vintage-Inspired Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 3 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group ">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/bss3.png" alt="Wedding Band" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs3.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
     <h3 class="text-lg text-gray-800 mb-2">Wedding Band</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 4 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group ">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
     <img src="assets/bss4.png" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs4.jpg" class="mx-auto mb-4 rounded-lg object-cover w-full h-48 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
      
     <h3 class="text-lg text-gray-800 mb-2">Huggie Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

  </div>
</section>
<!-- Limited Time Offer Section -->
<section class="relative bg-[url('assets/time.jpg')] bg-cover from-rose-600 via-rose-500 to-rose-400 text-white py-12 md:py-20 text-center overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    
<!-- Headings -->
    <h2 class="text-2xl md:text-4xl mb-4 ">Don't Miss Out. Limited Time Offer on Our Exquisite Jewelry!</h2>
    
    <!-- Countdown Timer -->
    <div id="countdown" class="flex justify-center gap-4 md:gap-6 mb-8 md:mb-10">
      
    <div class="flex flex-col items-center">
        <span id="days" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs md:text-sm uppercase tracking-wide">Days</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="hours" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs md:text-sm uppercase tracking-wide">Hours</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="minutes" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs md:text-sm uppercase tracking-wide">Minutes</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="seconds" class="text-3xl md:text-5xl">00</span>
        <span class="text-xs md:text-sm uppercase tracking-wide">Seconds</span>
      </div>
    </div>

    <!-- CTA Button -->
     <div class="flex justify-center">
     <p class="text-sm md:text-base mb-6 max-w-2xl text-center">
      This is Your Moment to Shine! Take Advantage of Our Limited-Time Sale and Adorn Yourself with
      Stunning Jewelry at Exceptional Savings!
    </p>
    </div>
    <a href="#shop" class="inline-block bg-white text-black px-6 py-2 md:px-8 md:py-3 hover:bg-rose-500 transition text-sm md:text-base rounded-md">
      Get Started
    </a>
  </div>

  <!-- Optional subtle overlay pattern -->
  <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/symphony.png')] opacity-10"></div>
</section>

<!-- Explore Categories Section -->
<section class="container mx-auto px-6 py-16">
  <h2 class="text-3xl font-bold mb-10 text-gray-800 text-center">Explore Cenes</h2>

   <!-- Slider Container -->
<div id="slider" class="overflow-x-auto whitespace-nowrap scroll-smooth flex space-x-4 p-4 hide-scrollbar">

    <!-- Category 1: Earrings -->
  <div class="inline-block w-48 md:w-64 bg-white rounded-lg shadow-md p-4 text-center flex-shrink-0">
      <a href="#earrings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
       <img src="assets/ex1.png" alt="Earrings" class="w-32 h-32 md:w-40 md:h-40 mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium text-sm md:text-base">Earring</span>
    </a>
   </div>

    <!-- Category 2: Bracelets & Bangles -->
  <div class="inline-block w-48 md:w-64 bg-white rounded-lg shadow-md p-4 text-center flex-shrink-0">
     <a href="#bracelets" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex2.png" alt="Bracelets & Bangles" class="w-32 h-32 md:w-40 md:h-40 mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium text-sm md:text-base">Bracelets & Bangles</span>
    </a>
 </div>

    <!-- Category 3: Rings -->
   <div class="inline-block w-48 md:w-64 bg-white rounded-lg shadow-md p-4 text-center flex-shrink-0">
     <a href="#rings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex3.png" alt="Rings" class="w-32 h-32 md:w-40 md:h-40 mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium text-sm md:text-base">Rings</span>
    </a>
  </div>

    <!-- Category 4: Gifts -->
   <div class="inline-block w-48 md:w-64 bg-white rounded-lg shadow-md p-4 text-center flex-shrink-0">     
     <a href="#gifts" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex4.png" alt="Gifts" class="w-32 h-32 md:w-40 md:h-40 mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium text-sm md:text-base">Gifts</span>
    </a>
  </div>

    <!-- Category 5: Pendants & Necklaces -->
 <div class="inline-block w-48 md:w-64 bg-white rounded-lg shadow-md p-4 text-center flex-shrink-0">
       <a href="#pendants" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex5.png" alt="Pendants & Necklaces" class="w-32 h-32 md:w-40 md:h-40 mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium text-sm md:text-base">Pendants & Necklaces</span>
    </a>
 </div>
</div>
</section>
<!-- Product Spotlight Section -->
<section class="container mx-auto px-6 py-16">
  <h2 class="text-3xl font-bold mb-10 text-gray-800 text-center">Product Spotlight</h2>

  <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
    
    <!-- Product Image -->
    <div class="w-full md:w-1/2 flex justify-center">
      <img src="assets/hero.png" alt="Pearl Earrings" class="rounded-lg shadow-lg object-cover w-full max-w-sm md:max-w-none">
    </div>

    <!-- Product Details -->
     <!-- Product Spotlight Section -->
  <div class="w-full md:w-1/2 px-6 py-8 text-center">
    <!-- Title -->
    <h2 class="text-2xl md:text-4xl mb-6 tracking-tight uppercase">Product Spotlight</h2>

    <!-- Product Card -->
    <div class="bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition p-6 flex flex-col items-center">
      <img src="assets/p1.jpg" alt="Pearl Earrings" class="w-32 h-32 md:w-48 md:h-48 object-cover mb-6 rounded-full">
      <h3 class="text-xl md:text-2xl mb-2">Pearl Earrings</h3>
      <p class="text-base md:text-lg text-gray-600 mb-4">50.00$</p>
      <a href="#" class="hover:bg-pink-600 border border-black text-black px-6 py-2 transition rounded-md">
        Shop Now
      </a>
    </div>
  </div>

  </div>
</section>
<!-- Trust & Services Section -->
<section class="bg-gray-50 py-16">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">

      <!-- Service 1 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-truck-fast text-pink-500 text-2xl mb-2"></i>
        <h4 class="font-semibold text-gray-800 text-lg mb-1">Free Shipping & Returns</h4>
        <p class="text-gray-600 text-sm">Taxes and duties included.</p>
      </div>

      <!-- Service 2 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
                <i class="fa-solid fa-thumbs-up text-pink-500 text-2xl mb-2"></i>
     <h4 class="font-semibold text-gray-800 text-lg mb-1">Satisfaction Guarantee</h4>
        <p class="text-gray-600 text-sm">We stand behind our products.</p>
      </div>

      <!-- Service 3 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-credit-card text-pink-500 text-2xl mb-2"></i>
        <h4 class="font-semibold text-gray-800 text-lg mb-1">Secure Payments</h4>
        <p class="text-gray-600 text-sm">Visa, Mastercard, Amex, PayPal & more.</p>
      </div> 
    </div>
  </div>
</section>
<!-- Client Reviews Section -->
       
     
  <div class="max-w-xs sm:max-w-md md:max-w-3xl mx-auto relative px-4">

    <!-- Section Heading -->
    <h2 class="text-2xl md:text-3xl text-center font-bold text-gray-800 mb-4">Our Clients Reviews</h2>
    <p class="text-gray-600 text-center mb-8 md:mb-10 text-sm md:text-base">Sparkling Feedback from Our Happy Clients!</p>

    <!-- Slider Container -->
    <div class="overflow-hidden" id="testimonial-wrapper">
      <div id="testimonial-track" class="flex transition-transform duration-500">

        <!-- Testimonial 1 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center"> 
          <img src="assets/c1.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-4 object-cover">
    
          <p class="text-gray-700 text-sm sm:text-lg leading-relaxed">
            "Cenes offers exceptional service and beautiful jewelry.  
            I always leave the store feeling like I've made a great investment."
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Kathleen Parker</p>
        </div>

        <!-- Testimonial 2 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center">
    <img src="assets/c2.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-4 object-cover">
             
   <p class="text-gray-700 text-sm sm:text-lg leading-relaxed">
            "Shopping at Cenes is always a delightful experience.  
            The staff is knowledgeable, and the jewelry is simply breathtaking!"
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Michael Elliott</p>
        </div>

        <!-- Testimonial 3 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center">
      <img src="assets/c3.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-4 object-cover">
               
         <p class="text-gray-700 text-sm sm:text-lg leading-relaxed">
            "The craftsmanship at Cenes is top-notch.  
            I've bought several pieces from them, and each one is truly a work of art."
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Christopher Casas</p>
        </div>

      </div>
    </div>

    <!-- Left Button -->
    <button id="prev"
      class="absolute top-1/2 left-0 sm:left-2 -translate-y-1/2 bg-white p-2 sm:p-3 rounded-full shadow hover:bg-gray-200 text-lg">
      ‹
    </button>

    <!-- Right Button -->
    <button id="next"
      class="absolute top-1/2 right-0 sm:right-2 -translate-y-1/2 bg-white p-2 sm:p-3 rounded-full shadow hover:bg-gray-200 text-lg">
      ›
    </button>

  </div>

</section>
    <!-- Blog Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6 py-16 mx-auto max-w-7xl">

      <!-- Article 1 -->
       
        <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o3.jpg" alt="Our Journal" class="w-full h-auto object-cover mb-4 rounded-lg"><br>
         <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-4 py-2 text-sm transition rounded-md">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">How to Layer Necklaces Like a Pro</h3><br>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

      <!-- Article 2 -->
      
       <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o2.jpg" alt="Our Journal" class="w-full h-auto object-cover mb-4 rounded-lg"><br>
        <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-4 py-2 text-sm transition rounded-md">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">Custom Jewelry Design: Bringing Your Vision to Life</h3>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

      <!-- Article 3 -->
      <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o1.jpg" alt="Our Journal" class="w-full h-auto object-cover mb-4 rounded-lg"><br>
        <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-4 py-2 text-sm transition rounded-md">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">The History and Evolution of Diamond Cuts</h3><br>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

    </div>
  </div>
</section>
@include('partials.footer')
</body>
</html>