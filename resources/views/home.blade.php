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
      <!-- Editorial New Italic Ultrabold (800 italic) -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,800&display=swap" rel="stylesheet">

    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,200&display=swap" rel="stylesheet">

    <!-- PP Editorial New alternative (closest match) -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,800&display=swap" rel="stylesheet">

    <style>
      @font-face {
          font-family: 'PP Editorial New';
          src: local('Playfair Display');
      }
    </style>


</head>
<body class="bg-gray-50 text-gray-800" style="font-family: 'Fahkwang', sans-serif;">
  
  

  <!-- Top Promo Bar -->
<div class="w-full bg-gray-900 text-white text-sm py-2 px-4 flex flex-col md:flex-row items-center justify-between">
    <p class="text-center md:text-left text-xs sm:text-sm md:text-base">
        Free Insured Shipping Worldwide on all orders.
        <span class="font-semibold">Use Code: FESTIVE10</span> for 10% Off.
    </p>

    <div class="flex items-center space-x-1 mt-1 md:mt-0 text-xs sm:text-sm md:text-base">
        <img src="assets/h.png"  class="w-4 h-4 md:w-5 md:h-5 rounded-full object-cover">
        <span>IND</span>
        <i class="fa-solid fa-indian-rupee-sign"></i>
        <i class="fa-solid fa-chevron-down"></i>

    </div>
</div>
  <!-- Header / Navbar -->
<header class="bg-white shadow">
  <div class="container mx-auto px-4 py-3 flex items-center justify-between">
    <nav class="flex items-center justify-between w-full md:w-auto">
    <!-- Hamburger Button (Mobile) -->
      <button id="menu-btn" class="block md:hidden text-2xl text-gray-700 focus:outline-none">
        ☰
      </button>
    
      <!-- Logo for Mobile (moved to be always visible) -->
      <img src="assets/logo.png" alt="logo photo" class="w-16 h-auto object-cover md:hidden block" id="mobile-logo">
      
    <!-- Navigation Menu -->
    <ul id="menu" class="hidden flex-col absolute top-[60px] left-0 w-full bg-white shadow-md py-4 space-y-4 text-center 
               md:flex md:flex-row md:space-x-8 md:space-y-0 md:static md:shadow-none md:py-0 md:text-left 
               text-gray-700 font-medium md:items-center z-50">
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">Earrings</a></li>
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">Pendants & Necklaces</a></li>
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">Bracelets & Bangles</a></li>
     <!-- Logo for Desktop -->
       <img id ="navImage" src="assets/logo.png" alt="logo photo" class="hidden md:block w-20 h-auto object-cover">
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">Mangalsutra</a></li>
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">Gifts</a></li>
      <li><a href="#" class="hover:text-rose-600 transition text-sm md:text-base">New Arrivals</a></li>
    </ul>
  </nav>   
    <!-- Right Section (Cart & Mobile Menu) -->
    <div class="flex items-center gap-3 text-gray-700 text-xl">
 
      <!-- icons -->
     <i class="fa-solid fa-magnifying-glass"></i>
     <i class="fa-regular fa-user"></i>
     <i class="fa-regular fa-heart"></i>
        <i class="fa-solid fa-bag-shopping"></i>
    </div>
  </div>
  <script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    const navImage = document.getElementById('navImage'); 
    const mobileLogo = document.getElementById('mobile-logo'); // Get the mobile logo

    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
      // Toggle visibility of the mobile logo when the menu is toggled
      if (menu.classList.contains("hidden")) {
        mobileLogo.classList.remove("hidden");
      } else {
        mobileLogo.classList.add("hidden");
      }
      // Also toggle the desktop logo if it's visible on larger screens (though it should be hidden by default on small screens)
      if (navImage) {
        navImage.classList.toggle("hidden");
      }
    });
  </script>

<!-- Hero Section -->
<!-- HERO SECTION (Exact Figma Implementation) -->
<!-- FONTS (put in <head>) -->
  <link href="https://fonts.googleapis.com/css2?family=Fahkwang:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,800&display=swap" rel="stylesheet">
  
  <style>
    /* map PP Editorial New to Playfair Display as a close substitute */
    @font-face {
      font-family: 'PP Editorial New';
      src: local('Playfair Display'), local('Georgia'), serif;
    }
    .font-fahkwang { font-family: 'Fahkwang', sans-serif; }
    .font-editorial { font-family: 'PP Editorial New', serif; }
    .font-roboto { font-family: 'Roboto', sans-serif; }
  </style>
  
  <!-- HERO (replace existing hero) -->
  <section class="relative w-full bg-[#3d3d3f] text-white overflow-hidden py-10 md:py-20">
  
    <!-- frame height = 817 (Figma) -->
    <div class="flex flex-col md:flex-row max-w-[1920px] mx-auto relative h-auto md:h-[600px] px-4">
  
      <!-- background image -->
      <img src="assets/hero1.png" alt="hero"
           class="absolute inset-0 w-full h-full object-cover opacity-40 z-0" />
  
      <!-- dark gradient -->
      <img src="assets/Rectangle 2.png" alt="dark background" class="absolute inset-0 w-full h-full object-cover z-10" />
  
      <!-- left content -->
      <div class="relative z-10 w-full md:w-[48%] text-center md:text-left pt-10 pb-5 md:py-20 md:pl-20">
        <h1 class="font-fahkwang font-semibold text-3xl md:text-[40px] leading-tight md:leading-[48px] tracking-tight text-white">
          Where Timeless<br/>Elegance, Meets Modern<br/>Craftsmanship. </h1>
  
        <p class="text-sm md:text-base mt-4 opacity-90 max-w-sm mx-auto md:mx-0">
          Where every gemstone whispers a story, and every design carries heritage.
        </p>
  
        <a href="#" class="mt-6 inline-flex items-center justify-center bg-white text-black 
                           w-[120px] h-[38px] text-sm tracking-wide font-medium  shadow-sm
                           hover:bg-gray-200 transition">
          SHOP NOW
        </a>
      </div>
  
      <!-- right artwork area -->
      <div class="relative z-20 w-full md:w-[55%] h-64 md:h-full flex justify-center items-center md:absolute md:right-0 md:top-8 pointer-events-none">
  
        <!-- necklace artwork (use your transparent PNG exported from Figma or the mangalsutra.png) -->
        <img src="assets/mang2.png" alt="necklace"
             class="w-full max-w-[804px] h-auto max-h-[440px] object-contain "/>
  
        <!-- pedestal (ellipse) -->
        <img src="assets/ellips.png" alt="pedestal"
             class="absolute bottom-0 md:bottom-[30px] w-full max-w-[700px] opacity-50 "/>
      </div>
  
      <!-- 10% Off badge (exact baseline offset) -->
      <div class="relative z-40 w-full text-center md:text-right md:absolute md:right-[40px] md:bottom-[90px] select-none py-5 md:py-0">
  
        <div class="flex items-end justify-center md:justify-end gap-1 leading-none">
          <span class="font-editorial italic font-bold text-5xl md:text-[70px] leading-none md:leading-[70px]">10</span>
          <span class="font-roboto italic font-light text-xl md:text-[30px] leading-none md:leading-[70px]">%</span>
          <span class="font-roboto italic font-light text-xl md:text-[30px] leading-none md:leading-[70px] relative" style="top:4px;">Off</span>
        </div>
  
        <p class="text-sm md:text-[15px] mt-2 opacity-90 font-roboto leading-tight md:leading-[12px]">
          On Making Charges of <br/><br/>Selected Jewellery
        </p>
      </div>
  
    </div>
  </section>
  

  <!-- New Arrivals Section -->
<section class="container mx-auto px-6 py-10 md:py-16">
  <div class="flex items-center justify-between mb-6 md:mb-10">
  <h2 class="text-2xl md:text-3xl font-bold text-gray-800">New Arrivals</h2>
   <span class="flex gap-2 text-xl">
   <i class="fa-solid fa-chevron-left text-gray-700 cursor-pointer"></i>
   <i class="fa-solid fa-chevron-right text-gray-700 cursor-pointer"></i>
  </span>
    </div>

 <!-- Product Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-8">
    
    <!-- Product Card 1 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww1.png" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
   <!-- Second Image (Hover State) -->
       <img src="assets/nw1.png" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
      <h3 class="text-lg text-gray-800 mb-2">Eternity Band</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product Card 2 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww2.png" alt="Birthstone Earrings" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw2.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
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
        
      <img src="assets/nww3.png" alt="Byzantine Bracelet" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/nw3.png" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
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
        
      <img src="assets/nww4.png" alt="Infinity Bracelet" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw4.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
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
<section class="container mx-auto px-6 py-10 md:py-16">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
    
    <!-- Left Banner -->
    <div class="relative bg-[url('assets/ear.png')] bg-cover bg-center overflow-hidden h-64 md:h-80 flex items-center justify-center text-white p-4">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative space-y-2 text-center">
        <p class="text-xs md:text-sm mb-2">10% OFF ON ALL RINGS</p>
        <h2 class="text-xl md:text-3xl font-semibold mb-2">Elevate Your Style-Shop Our Latest Collection !</h2>
        <p class="text-xs md:text-sm mb-4">Experience the Beauty of Fine Jewelry at Prices You Won't Believe!</p>
        <a href="#" class="inline-block border border-white text-white px-4 py-1 rounded-full hover:bg-rose-50 hover:text-black transition text-sm">
          Shop Now
        </a>
      </div>
    </div>

    <!-- Right Banner -->
    <div class="relative bg-[url('assets/s1.jpg')] bg-cover bg-center overflow-hidden h-64 md:h-80 flex flex-col items-center justify-center text-white text-center p-4">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative space-y-2 text-center">
        
        <h3 class="text-xl md:text-3xl font-semibold mb-2">Start Your Journey to Exquisite Jewelry</h3>
        <p class="text-xs md:text-sm mb-4">Find Beautiful Jewelry That Fits Your Style and Budget!</p>
        <a href="#" class="inline-block border border-white text-white px-4 py-1 rounded-full hover:bg-rose-50 hover:text-black transition text-sm">
          Shop Now
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Best Seller Section -->
<section class="container mx-auto px-6 py-10 md:py-16">
  <div class="flex items-center justify-between mb-6 md:mb-10">
  <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Best Seller</h2>
   <span class="flex gap-2 text-xl">
   <i class="fa-solid fa-chevron-left text-gray-700 cursor-pointer"></i>
   <i class="fa-solid fa-chevron-right text-gray-700 cursor-pointer"></i>
  </span>
    </div>
  

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

    <!-- Product 1 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/bss1.png" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs1.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
           
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
        
     <img src="assets/bss2.png" alt="Vintage-Inspired Earrings" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs2.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
    
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
        
      <img src="assets/bss3.png" alt="Wedding Band" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs3.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
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
        
     <img src="assets/bss4.png" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs4.jpg" class="mx-auto mb-4 rounded-lg object-contain w-full h-48 sm:h-56 md:h-64 absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
      
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
<section class="relative bg-[url('assets/time.jpg')] bg-cover from-rose-600 via-rose-500 to-rose-400 text-white py-10 md:py-20 overflow-hidden">
  <div class="container w-full md:w-1/2 mx-auto px-6 relative z-10 text-center md:text-left">
    
<!-- Headings -->
    <h2 class="text-2xl md:text-4xl mb-4 ">Don't Miss Out. Limited Time Offer on Our Exquisite Jewelry!</h2>
    
    <!-- Countdown Timer -->
    <div id="countdown" class="flex justify-center md:justify-start gap-4 md:gap-6 mb-8 md:mb-10">
      
    <div class="flex flex-col items-center">
        <span id="days" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs uppercase tracking-wide">Days</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="hours" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs uppercase tracking-wide">Hours</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="minutes" class="text-3xl md:text-5xl">00:</span>
        <span class="text-xs uppercase tracking-wide">Minutes</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="seconds" class="text-3xl md:text-5xl">00</span>
        <span class="text-xs uppercase tracking-wide">Seconds</span>
      </div>
    </div>

    <!-- CTA Button -->
     <div class="text-center md:text-left">
     <p class="text-sm md:text-xl mb-6 max-w-2xl mx-auto md:mx-0">
      This is Your Moment to Shine! Take Advantage of Our Limited-Time Sale and Adorn Yourself with
      Stunning Jewelry at Exceptional Savings!
    </p>
    <a href="#shop" class="inline-block bg-white text-black px-6 py-2 hover:bg-rose-50 transition text-sm">
      Get Started
    </a>
 </div>
  </div>

  <!-- Optional subtle overlay pattern -->
  <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/symphony.png')] opacity-10"></div>
</section>

<!-- Countdown Script -->
<script>
  // Example countdown: 5 hours from now
  const countdownDate = new Date().getTime() + 5 * 60 * 60 * 1000;

  const timer = setInterval(function () {
    const now = new Date().getTime();
    const distance = countdownDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").textContent = String(days).padStart(2, "0");
    document.getElementById("hours").textContent = String(hours).padStart(2, "0");
    document.getElementById("minutes").textContent = String(minutes).padStart(2, "0");
    document.getElementById("seconds").textContent = String(seconds).padStart(2, "0");

    if (distance < 0) {
      clearInterval(timer);
      document.getElementById("countdown").innerHTML = "<p class='text-2xl font-semibold'>Offer Expired!</p>";
    }
  }, 1000);
</script>
<!-- Explore Categories Section -->
<section class="container mx-auto px-6 py-16">
  <h2 class="text-2xl md:text-3xl font-bold mb-6 md:mb-10 text-gray-800 text-center">Explore Cenes</h2>

   <!-- Slider Container -->
<div id="slider" class="overflow-x-auto whitespace-nowrap scroll-smooth flex space-x-4 p-2 md:p-4 justify-start md:justify-center">

    <!-- Category 1: Earrings -->
  <div class="inline-block w-[180px] md:w-[250px] bg-white rounded-lg shadow-md p-3 md:p-4 text-center flex-shrink-0">
      <a href="#earrings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-3 md:p-4 text-center">
       <img src="assets/ex1.png" alt="Earrings" class="inline-block w-full h-32 md:h-48 mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-full font-medium text-sm md:text-base">Earring</span>
    </a>
   </div>

    <!-- Category 2: Bracelets & Bangles -->
  <div class="inline-block w-[180px] md:w-[250px] bg-white rounded-lg shadow-md p-3 md:p-4 text-center flex-shrink-0">
     <a href="#bracelets" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-3 md:p-4 text-center">
      <img src="assets/ex2.png" alt="Bracelets & Bangles" class="inline-block w-full h-32 md:h-48 mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-full font-medium text-sm md:text-base">Bracelets & Bangles</span>
    </a>
 </div>

    <!-- Category 3: Rings -->
   <div class="inline-block w-[180px] md:w-[250px] bg-white rounded-lg shadow-md p-3 md:p-4 text-center flex-shrink-0">
     <a href="#rings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-3 md:p-4 text-center">
      <img src="assets/ex3.png" alt="Rings" class="inline-block w-full h-32 md:h-48 mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-full font-medium text-sm md:text-base">Rings</span>
    </a>
  </div>

    <!-- Category 4: Gifts -->
   <div class="inline-block w-[180px] md:w-[250px] bg-white rounded-lg shadow-md p-3 md:p-4 text-center flex-shrink-0">     
     <a href="#gifts" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-3 md:p-4 text-center">
      <img src="assets/ex4.png" alt="Gifts" class="inline-block w-full h-32 md:h-48 mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-full font-medium text-sm md:text-base">Gifts</span>
    </a>
  </div>

    <!-- Category 5: Pendants & Necklaces -->
 <div class="inline-block w-[180px] md:w-[250px] bg-white rounded-lg shadow-md p-3 md:p-4 text-center flex-shrink-0">
       <a href="#pendants" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-3 md:p-4 text-center">
      <img src="assets/ex5.png" alt="Pendants & Necklaces" class="inline-block w-full h-32 md:h-48 mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-full font-medium text-sm md:text-base">Pendants & Necklaces</span>
    </a>
 </div>
</div>
</section>
    <!-- JavaScript for Slider -->
  <script>
    function scrollLeft() {
      document.getElementById('slider').scrollBy({ left: -300, behavior: 'smooth' });
    }
    function scrollRight() {
      document.getElementById('slider').scrollBy({ left: 300, behavior: 'smooth' });
    }
  </script>

  </script>

<!-- Product Spotlight Section -->
<section class="container mx-auto px-6 py-10 md:py-16">
  <h2 class="text-2xl md:text-3xl font-bold mb-6 md:mb-10 text-gray-800 text-center">Product Spotlight</h2>

  <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-10">
    
    <!-- Product Image -->
    <div class="w-full md:w-1/2">
      <img src="assets/hero.png" alt="Pearl Earrings" class="rounded-lg shadow-lg object-contain w-full h-auto max-h-[300px] md:max-h-[400px] mx-auto">
    </div>

    <!-- Product Details -->
    <div class="w-full md:w-1/2 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition p-6 md:p-8 flex flex-col items-center text-center">
      <img src="assets/p1.jpg" alt="Pearl Earrings" class="w-32 h-32 md:w-48 md:h-48 object-cover mb-4 md:mb-6 rounded-full">
      <h3 class="text-xl md:text-2xl mb-2">Pearl Earrings</h3>
      <p class="text-base md:text-lg text-gray-600 mb-4">$50.00</p>
      <a href="#" class="hover:bg-pink-600 border border-black text-black px-5 py-2 transition text-sm md:text-base">
        Shop Now
      </a>
    </div>

  </div>
</section>
<!-- Trust & Services Section -->
<section class="bg-gray-50 py-10 md:py-16">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 text-center">

      <!-- Service 1 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-truck-fast text-pink-500 text-2xl md:text-3xl mb-2"></i>
        <h4 class="font-semibold text-gray-800 text-base md:text-lg mb-1">Free Shipping & Returns</h4>
        <p class="text-gray-600 text-sm md:text-base">Taxes and duties included.</p>
      </div>

      <!-- Service 2 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
                <i class="fa-solid fa-thumbs-up text-pink-500 text-2xl md:text-3xl mb-2"></i>
     <h4 class="font-semibold text-gray-800 text-base md:text-lg mb-1">Satisfaction Guarantee</h4>
        <p class="text-gray-600 text-sm md:text-base">We stand behind our products.</p>
      </div>

      <!-- Service 3 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-credit-card text-pink-500 text-2xl md:text-3xl mb-2"></i>
        <h4 class="font-semibold text-gray-800 text-base md:text-lg mb-1">Secure Payments</h4>
        <p class="text-gray-600 text-sm md:text-base">Visa, Mastercard, Amex, PayPal & more.</p>
      </div> 
    </div>
  </div>
</section>
<!-- Client Reviews Section -->
       
     
  <div class="max-w-sm sm:max-w-xl md:max-w-3xl mx-auto relative px-4 py-10 md:py-16">

    <!-- Section Heading -->
    <h2 class="text-2xl md:text-3xl text-center font-bold text-gray-800 mb-2 md:mb-4">Our Clients Reviews</h2>
    <p class="text-sm md:text-base text-gray-600 text-center mb-8 md:mb-10">Sparkling Feedback from Our Happy Clients!</p>

    <!-- Slider Container -->
    <div class="overflow-hidden" id="testimonial-wrapper">
      <div id="testimonial-track" class="flex transition-transform duration-500">

        <!-- Testimonial 1 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center"> 
          <img src="assets/c1.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-3 sm:mb-4 object-cover">
    
          <p class="text-sm sm:text-lg text-gray-700 leading-relaxed">
            "Cenes offers exceptional service and beautiful jewelry.  
            I always leave the store feeling like I've made a great investment."
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Kathleen Parker</p>
        </div>

        <!-- Testimonial 2 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center">
<img src="assets/c2.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-3 sm:mb-4 object-cover">
             
   <p class="text-sm sm:text-lg text-gray-700 leading-relaxed">
            "Shopping at Cenes is always a delightful experience.  
            The staff is knowledgeable, and the jewelry is simply breathtaking!"
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Michael Elliott</p>
        </div>

        <!-- Testimonial 3 -->
        <div class="w-full flex-shrink-0 p-4 sm:p-6 bg-white shadow rounded-xl text-center">
<img src="assets/c3.jpg" alt="Customer photo" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-3 sm:mb-4 object-cover">
               
         <p class="text-sm sm:text-lg text-gray-700 leading-relaxed">
            "The craftsmanship at Cenes is top-notch.  
            I've bought several pieces from them, and each one is truly a work of art."
          </p>
          <p class="mt-3 sm:mt-4 font-semibold text-yellow-700 text-sm sm:text-base">— Christopher Casas</p>
        </div>

      </div>
    </div>

    <!-- Left Button -->
    <button id="prev"
      class="absolute top-1/2 left-0 sm:left-2 -translate-y-1/2 bg-white p-2 sm:p-3 rounded-full shadow hover:bg-gray-200 text-lg sm:text-xl">
      ‹
    </button>

    <!-- Right Button -->
    <button id="next"
      class="absolute top-1/2 right-0 sm:right-2 -translate-y-1/2 bg-white p-2 sm:p-3 rounded-full shadow hover:bg-gray-200 text-lg sm:text-xl">
      ›
    </button>

  </div>

  <!-- JavaScript -->
  <script>
    const track = document.getElementById("testimonial-track");
    const total = track.children.length;
    let index = 0;

    document.getElementById("next").onclick = () => {
      index = (index + 1) % total;
      track.style.transform = `translateX(-${index * 100}%)`;
    };

    document.getElementById("prev").onclick = () => {
      index = (index - 1 + total) % total;
      track.style.transform = `translateX(-${index * 100}%)`;
    };
  </script>

</section>
    <!-- Blog Cards Grid -->
    <section class="container mx-auto px-6 py-10 md:py-16">
    <div class="grid gap-6 md:gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

      <!-- Article 1 -->
        <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o3.jpg" alt="Our Journal" class="w-full h-48 object-cover mb-4 rounded-md"><br>
         <a href="#" class="inline-block bg-black hover:bg-pink-600 text-white text-xs font-semibold px-4 py-1 transition mb-4">
        Abstract
      </a>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">How to Layer Necklaces Like a Pro</h3>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

      <!-- Article 2 -->
      
       <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o2.jpg" alt="Our Journal" class="w-full h-48 object-cover mb-4 rounded-md"><br>
        <a href="#" class="inline-block bg-black hover:bg-pink-600 text-white text-xs font-semibold px-4 py-1 transition mb-4">
        Abstract
      </a>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Custom Jewelry Design: Bringing Your Vision to Life</h3>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

      <!-- Article 3 -->
      <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o1.jpg" alt="Our Journal" class="w-full h-48 object-cover mb-4 rounded-md"><br>
        <a href="#" class="inline-block bg-black hover:bg-pink-600 text-white text-xs font-semibold px-4 py-1 transition mb-4">
        Abstract
      </a>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">The History and Evolution of Diamond Cuts</h3>
        <p class="text-gray-600 text-sm mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="font-semibold hover:underline text-sm"><u>Read More</u></a>
      </div>

    </div>
</section>
<!-- Footer Section -->
<footer class="text-black-100 py-10 md:py-16 bg-white">
  <div class="container mx-auto px-6 text-Hind">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center md:text-left">

      <!-- Company -->
      <div>
        <h3 class="text-xl font-bold mb-4">Company</h3>
        <ul class="space-y-2 text-gray-700 text-sm">
          <li><a href="#" class="hover:text-rose-600 transition">HOME</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">PAGES</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">SHOP</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">PORTFOLIO</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">FEATURES</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="mt-8 md:mt-0">
       <p class="mb-4 text-gray-700 text-sm">Sign up to our newsletter for exclusive access:</p>
        <form class="flex flex-col sm:flex-row gap-2 max-w-sm mx-auto md:mx-0">
          <input type="email" placeholder="Enter your email" class="p-2 rounded-lg text-gray-900 flex-1 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 text-sm">
          <button type="submit" class="border border-black text-black w-full sm:w-auto px-4 py-2 hover:bg-rose-500 hover:text-white transition text-sm rounded-lg">Submit</button>
        </form>
      </div>

      <!-- Customer Care -->
      <div class="mt-8 md:mt-0">
          <h3 class="text-xl font-bold mb-4">Customer Care</h3>
        
        <ul class="space-y-2 text-gray-700 text-sm">
          <li><a href="#" class="hover:text-rose-600 transition">CONTACT US</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">FAQ</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">DELIVERY</a></li>
          <li><a href="#" class="hover:text-rose-600 transition">RETURNS</a></li>
           <li><a href="#" class="hover:text-rose-600 transition">SIZE GUIDE</a></li>
        </ul>
      </div>
    </div>

    <!-- Extra Info -->
    <div class="mt-10 pt-6 border-t border-gray-200 text-center">
      <h3 class="text-sm text-gray-600">2025. All rights reserved.</h3>
    </div>
  </div>
</footer>
</body>
</html>
