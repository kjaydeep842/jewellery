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
<div class="w-full bg-gray-900 text-white text-sm py-2 px-4 flex flex-col md:flex-row  sm:text-sm md:text-base lg:text-xl items-center justify-between text-sm md:text-base">
    <p class="text-center md:text-left">
        Free Insured Shipping Worldwide on all orders.
        <span class="font-semibold">Use Code: FESTIVE10</span> for 10% Off.
    </p>

    <div class="flex items-center space-x-1 mt-1  md:text-right">
        <img src="assets/h.png"  class="w-5 h-5  rounded-full mx-auto mb-auto object-cover">
        <span>IND</span>
        <i class="fa-solid fa-indian-rupee-sign"></i>
        <i class="fa-solid fa-chevron-down"></i>

    </div>
</div>
  <!-- Header / Navbar -->
<header class="bg-white shadow">
  <div class="container mx-auto sm:text-sm md:text-base lg:text-xl md:w-auto md:text-right px-6 py-4 flex items-center justify-between items-center">
    <nav>
    <!-- Hamburger Button (Mobile) -->
      <button id="menu-btn" class="sm:hidden block text-3xl">
        ☰
      </button>

    <!-- Navigation Menu -->
    <ul id="menu" class="md:flex sm:flex sm:justify-center hidden sm:text-sm md:text-base lg:text-xl space-x-8 text-gray-700 font-medium gap-10 items-center">
      <li><a href="#" class="hover:text-rose-600 transition">Earrings</a></li>
      <li><a href="#" class="hover:text-rose-600 transition">Pendants & Necklaces</a></li>
      <li><a href="#" class="hover:text-rose-600 transition">Bracelets & Bangles</a></li>
     <!-- Logo -->
   
       <img id ="navImage" src="assets/logo.png" alt="logo photo" class="md:flex w-20 h-25 mx-auto mb-4 object-cover">
    
      <li><a href="#" class="hover:text-rose-600 transition">Mangalsutra</a></li>
      <li><a href="#" class="hover:text-rose-600 transition">Gifts</a></li>
      <li><a href="#" class="hover:text-rose-600 transition">New Arrivals</a></li>
    </ul>
  </nav>   
    <!-- Right Section (Cart & Mobile Menu) -->
    <div class="flex items-center gap-3 sm:text-sm md:text-base lg:text-xl items-center justify-between text-sm md:text-base">
 
      <!-- icons -->
     <i class="fa-solid fa-magnifying-glass"></i>
     <i class="fa-regular fa-user text-gray-700 text-xl"></i>
     <i class="fa-regular fa-heart text-gray-700 text-xl"></i>
        <i class="fa-solid fa-bag-shopping"></i>
    </div>
  </div>
  <script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
      navImage.classList.toggle("hidden");
      menu-btn.classList.toggle("hidden");
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
<!-- SIMPLE HERO SECTION USING mg.jpeg -->
<section class="relative w-full h-[600px] overflow-hidden">

    <!-- Main Hero Image -->
    <img src="assets/mg.jpeg"
         alt="Jewelry Hero Banner"
         class="w-full h-full object-cover">

    {{-- <!-- Optional dark overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Hero Text -->
    <div class="absolute top-1/2 left-10 transform -translate-y-1/2 text-white max-w-lg">

        <h1 class="text-4xl font-bold leading-tight">
            Where Timeless<br>Elegance Meets Modern<br>Craftsmanship.
        </h1>

        <p class="mt-3 text-sm opacity-90">
            Where every gemstone whispers a story, and every design carries heritage.
        </p>

        <a href="#"
           class="mt-5 inline-block bg-white text-black px-6 py-3 font-medium text-sm
                  hover:bg-gray-200 transition">
            SHOP NOW
        </a>

    </div> --}}
  <a href="#"
           class="mt-5 inline-block bg-white text-black px-6 py-3 font-medium text-sm
                  hover:bg-gray-200 transition">
            SHOP NOW
        </a>
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
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-8">
    
    <!-- Product Card 1 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww1.png" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
   <!-- Second Image (Hover State) -->
       <img src="assets/nw1.png" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Eternity Band</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product Card 2 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww2.png" alt="Birthstone Earrings" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw2.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
     <h3 class="text-lg font-semibold text-gray-800 mb-2">Birthstone Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product Card 3 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
     <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww3.png" alt="Byzantine Bracelet" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/nw3.png" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
 <h3 class="text-lg font-semibold text-gray-800 mb-2">Byzantine Bracelet</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product Card 4 -->
    <div class="relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/nww4.png" alt="Infinity Bracelet" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/nw4.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
<h3 class="text-lg font-semibold text-gray-800 mb-2">Infinity Bracelet</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

  </div>
</section>
<!-- Promo Banner Section -->
<section class="container mx-auto px-6 py-16">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
    
    <!-- Left Banner -->
    <div class="relative bg-[url('assets/ear.png')] bg-cover bg-center  overflow-hidden h-30 flex items-center justify-center text-white">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative text-center">
        <a href="#" class="inline-block border border-white-700 text-white font-semibold px-6 py-2 rounded-full hover:bg-rose-50 hover:text-black transition">
          Shop Now
        </a>
        <h3 class="text-2xl md:text-3xl font-semibold mb-3">Elevate Your Style�Shop
Our Latest Collection !</h3>
        <p class="text-lg">Experience the Beauty of Fine Jewelry at Prices You Won�t Believe!</p>
      </div>
    </div>

    <!-- Right Banner -->
    <div class="relative bg-[url('assets/s1.jpg')] bg-cover  bg-center  overflow-hidden h-80 flex flex-col items-center justify-center text-white text-center">
      <div class="absolute inset-0 bg-black/40"></div>
      <div class="relative space-y-3">
        
        <a href="#" class="inline-block border border-white-700 text-white font-semibold px-6 py-2 rounded-full hover:bg-rose-50 hover:text-black transition">
          Shop Now
        </a>
        <h3 class="text-2xl md:text-3xl font-semibold">Start Your Journey to
Exquisite Jewelry</h3>
        <p class="text-lg">Find Beautiful Jewelry That Fits Your Style and Budget!</p>
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
  

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

    <!-- Product 1 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/bss1.png" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs1.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
           
   <h3 class="text-lg font-semibold text-gray-800 mb-2">Anniversary Ring</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 2 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
     <img src="assets/bss2.png" alt="Vintage-Inspired Earrings" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs2.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
    
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Vintage-Inspired Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 3 -->
    <div class=" relative group bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group ">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
      <img src="assets/bss3.png" alt="Wedding Band" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
      <img src="assets/bs3.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
     
     <h3 class="text-lg font-semibold text-gray-800 mb-2">Wedding Band</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

    <!-- Product 4 -->
    <div class=" relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center  group ">
      <span class="absolute top-3 right-3 text-xs px-3 py-1"><i class="fa-regular fa-heart text-gray-700 text-xl"></i></span>
      <span class="absolute top-10 right-3 text-xs px-3 py-1"><i class="fa-regular fa-eye text-gray-600 text-xl"></i></span>
        
     <img src="assets/bss4.png" class="mx-auto mb-4 rounded-lg object-cover transition-opacity duration-500 ease-in-out  group-hover:opacity-0">
     <img src="assets/bs4.jpg" class="mx-auto mb-4 rounded-lg object-cover absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out group-hover:opacity-100">
      
     <h3 class="text-lg font-semibold text-gray-800 mb-2">Huggie Earrings</h3>
      <div class="mb-3">
        <span class="text-gray-400 line-through mr-2"><i class="fa-solid fa-indian-rupee-sign"></i>16,999.00</span>
        <span class="text-rose-600 font-bold"><i class="fa-solid fa-indian-rupee-sign"></i>14,999.00</span>
      </div>
      <button class="mt-2 px-5 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-500 transition">
        Add to Cart
      </button>
    </div>

  </div>
</section>
<!-- Limited Time Offer Section -->
<section class="relative bg-[url('assets/time.jpg')] bg-cover from-rose-600 via-rose-500 to-rose-400 text-white py-20 text-left overflow-hidden">
  <div class="container md:w-1/2 mx-auto px-6 relative z-10 md:text-left">
    <!-- Headings -->
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-left">Don�t Miss Out. Limited Time Offer on Our Exquisite Jewelry!</h2>
    

    <!-- Countdown Timer -->
    <div id="countdown" class="flex md:justify-start justify-center gap-4 md:gap-6 mb-10">
      <div class="flex flex-col items-center">
        <span id="days" class="text-4xl md:text-5xl font-bold">00</span>
        <span class="text-sm uppercase tracking-wide">Days</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="hours" class="text-4xl md:text-5xl font-bold">00</span>
        <span class="text-sm uppercase tracking-wide">Hours</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="minutes" class="text-4xl md:text-5xl font-bold">00</span>
        <span class="text-sm uppercase tracking-wide">Minutes</span>
      </div>
      <div class="flex flex-col items-center">
        <span id="seconds" class="text-4xl md:text-5xl font-bold">00</span>
        <span class="text-sm uppercase tracking-wide">Seconds</span>
      </div>
    </div>

    <!-- CTA Button -->

     <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
      This is Your Moment to Shine! Take Advantage of Our Limited-Time Sale and Adorn Yourself with
      Stunning Jewelry at Exceptional Savings!
    </p>
    <a href="#shop" class="inline-block bg-white text-rose-600 font-semibold px-8 py-3 rounded-lg hover:bg-rose-50 transition">
      Get Started
    </a>

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
  <h2 class="text-3xl font-bold mb-10 text-gray-800 text-center">Explore Cenes</h2>

   <!-- Slider Container -->
<div id="slider" class="overflow-x-auto whitespace-nowrap scroll-smooth flex space-x-4 p-4">

    <!-- Category 1: Earrings -->
  <div class="inline-block w-[250px] bg-white rounded-lg shadow-md p-4 text-center">
      <a href="#earrings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
       <img src="assets/ex1.png" alt="Earrings" class="inline-block w-[250px] h-[170px] mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-[250px] font-medium">Earring</span>
    </a>
   </div>

    <!-- Category 2: Bracelets & Bangles -->
  <div class="inline-block w-[250px] bg-white rounded-lg shadow-md p-4 text-center">
     <a href="#bracelets" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex2.png" alt="Bracelets & Bangles" class="inline-block w-[250px] h-[170px] mb-2 rounded-full object-cover">
      <span class="text-gray-800 font-medium">Bracelets & Bangles</span>
    </a>
 </div>

    <!-- Category 3: Rings -->
   <div class="inline-block w-[250px] bg-white rounded-lg shadow-md p-4 text-center">
     <a href="#rings" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex3.png" alt="Rings" class="inline-block w-[250px] h-[170px] mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-[250px] font-medium">Rings</span>
    </a>
  </div>

    <!-- Category 4: Gifts -->
   <div class="inline-block w-[250px] bg-white rounded-lg shadow-md p-4 text-center">     
     <a href="#gifts" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex4.png" alt="Gifts" class="inline-block w-[250px] h-[170px] mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-[250px] font-medium">Gifts</span>
    </a>
  </div>

    <!-- Category 5: Pendants & Necklaces -->
 <div class="inline-block w-[250px] bg-white rounded-lg shadow-md p-4 text-center">
       <a href="#pendants" class="flex flex-col items-center bg-white rounded-lg shadow hover:shadow-lg transition p-4 text-center">
      <img src="assets/ex5.png" alt="Pendants & Necklaces" class="inline-block w-[250px] h-[170px] mb-2 rounded-full object-cover">
      <span class="text-gray-800 w-[250px] font-medium">Pendants & Necklaces</span>
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
   <script>
  const slider = document.getElementById("slider");
  const slides = slider.children;
  let index = 0;

  function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;
  }

  document.getElementById("nextBtn").onclick = () => {
    index = (index + 1) % slides.length;
    updateSlider();
  };

  document.getElementById("prevBtn").onclick = () => {
    index = (index - 1 + slides.length) % slides.length;
    updateSlider();
  };

  // Swipe functionality
  let startX = 0;

  slider.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
  });

  slider.addEventListener("touchend", (e) => {
    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;

    if (diff > 50) {
      index = (index + 1) % slides.length;  // swipe left
    } else if (diff < -50) {
      index = (index - 1 + slides.length) % slides.length; // swipe right
    }
    updateSlider();
  });
</script>

  </script>

<!-- Product Spotlight Section -->
<section class="container mx-auto px-6 py-16">
  <h2 class="text-3xl font-bold mb-10 text-gray-800 text-center">Product Spotlight</h2>

  <div class="flex flex-col md:flex-row items-center justify-center gap-10">
    
    <!-- Product Image -->
    <div class="w-full md:w-1/2">
      <img src="assets/hero.png" alt="Pearl Earrings" class="rounded-lg shadow-lg object-cover mx-auto">
    </div>

    <!-- Product Details -->
     <!-- Product Spotlight Section -->
  <section class="max-w-4xl mx-auto px-6 py-16 text-center">
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold mb-10 tracking-tight uppercase">Product Spotlight</h2>

    <!-- Product Card -->
    <div class="bg-gray-50   rounded-lg shadow-sm hover:shadow-md transition p-8 flex flex-col items-center">
      <img src="assets/p1.jpg" alt="Pearl Earrings" class="w-48 h-48 object-cover mb-6">
      <h3 class="text-2xl font-semibold mb-2">Pearl Earrings</h3>
      <p class="text-lg text-gray-600 mb-4">$50.00</p>
      <a href="#" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-2 rounded-md transition">
        Shop Now
      </a>
    </div>
  </section>

  </div>
</section>
<!-- Trust & Services Section -->
<section class="bg-gray-50 py-16">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-center">

      <!-- Service 1 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-truck-fast text-pink-500 text-xl"></i>
        <h4 class="font-semibold text-gray-800 mb-1">Free Shipping & Returns</h4>
        <p class="text-gray-600 text-sm">Taxes and duties included.</p>
      </div>

      <!-- Service 2 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
                <i class="fa-solid fa-thumbs-up text-pink-500 text-xl"></i>
     <h4 class="font-semibold text-gray-800 mb-1">Satisfaction Guarantee</h4>
        <p class="text-gray-600 text-sm">We stand behind our products.</p>
      </div>

      <!-- Service 3 -->
      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
        <i class="fa-solid fa-credit-card text-pink-500 text-xl"></i>
        <h4 class="font-semibold text-gray-800 mb-1">Secure Payments</h4>
        <p class="text-gray-600 text-sm">Visa, Mastercard, Amex, PayPal & more.</p>
      </div> 
    </div>
  </div>
</section>
<!-- Client Reviews Section -->
       
     <section class="bg-gray-50 py-16">
  <div class="container mx-auto px-6 overflow-hidden relative text-center">
    <!-- Section Heading -->
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Clients Reviews</h2>
    <p class="text-gray-600 mb-10">Sparkling Feedback from Our Happy Clients!</p>

    <!-- Reviews Grid / Carousel -->
    <div id="slider" class="grid gap-8 md:grid-cols-3">

      <!-- Review 1 -->
        <div class="inline-block w-[300px] bg-white rounded-lg shadow-md p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
        <img src="assets/c1.jpg" alt="Customer photo" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
      
        <p class="text-gray-700 mb-4">
          "Cenes offers exceptional service and beautiful jewelry. I always leave the store feeling like I've made a great investment."
        </p>
        <span class="block font-semibold text-gray-800"> � Kathleen Parker</span>
      </div>

      <!-- Review 2 -->
      <div class=" inline-block w-[300px] bg-white rounded-lg shadow-md p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
        <img src="assets/c2.jpg" alt="Customer photo" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
        <p class="text-gray-700 mb-4">
          "Shopping at Cenes is always a delightful experience. The staff is knowledgeable, and the jewelry is simply breathtaking!"
        </p>
        <span class="block font-semibold text-gray-800">� Michael Elliott</span>
      </div>

      <!-- Review 3 -->
      <div class=" inline-block w-[300px] bg-white rounded-lg shadow-md p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
        <img src="assets/c3.jpg" alt="Customer photo" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
        <p class="text-gray-700 mb-4">
          "The craftsmanship at Cenes is top-notch. I've bought several pieces from them, and each one is truly a work of art."
        </p>
        <span class="block font-semibold text-gray-800">� Christopher Casas</span>
      </div> 
    
   <!-- nav buttons -->
    <button id="prevBtn" class="absolute top-1/2 left-2 -translate-y-1/2 
            bg-black/50 text-white px-3 py-1 rounded">‹</button>

    <button id="nextBtn" class=" absolute top-1/2 right-2 -translate-y-1/2
            bg-black/50 text-white px-3 py-1 rounded">›</button>
</div>   
</section>
<script>
  const slider = document.getElementById("slider");
  const slides = slider.children;
  let index = 0;

  function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;
  }

  document.getElementById("nextBtn").onclick = () => {
    index = (index + 1) % slides.length;
    updateSlider();
  };

  document.getElementById("prevBtn").onclick = () => {
    index = (index - 1 + slides.length) % slides.length;
    updateSlider();
  };

  // Swipe functionality
  let startX = 0;

  slider.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
  });

  slider.addEventListener("touchend", (e) => {
    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;

    if (diff > 50) {
      index = (index + 1) % slides.length;  // swipe left
    } else if (diff < -50) {
      index = (index - 1 + slides.length) % slides.length; // swipe right
    }
    updateSlider();
  });
</script>
    <!-- Blog Cards Grid -->
    <div class="grid gap-0 md:grid-cols-3">

      <!-- Article 1 -->
       
        <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o3.jpg" alt="Our Journal" class="w-50 h-50 mx-auto mb-4 object-cover"><br>
         <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-6 py-2  transition">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">How to Layer Necklaces Like a Pro</h3><br>
        <p class="text-gray-600 mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="text-rose-600 font-semibold hover:underline">Read More</a>
      </div>

      <!-- Article 2 -->
      
       <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o2.jpg" alt="Our Journal" class="w-50 h-50 mx-auto mb-4 object-cover"><br>
        <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-6 py-2  transition">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">Custom Jewelry Design: Bringing Your Vision to Life</h3>
        <p class="text-gray-600 mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="text-rose-600 font-semibold hover:underline">Read More</a>
      </div>

      <!-- Article 3 -->
      <div class="p-6 rounded-lg shadow-sm hover:shadow-md transition text-left">
        <img src="assets/o1.jpg" alt="Our Journal" class="w-50 h-50 mx-auto mb-4 object-cover"><br>
        <a href="#" class="bg-black hover:bg-pink-600 text-white font-semibold px-6 py-2  transition">
        Abstract
      </a><br>
        <br><h3 class="text-xl font-semibold text-gray-800 mb-2">The History and Evolution of Diamond Cuts</h3>
        <p class="text-gray-600 mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#readmore" class="text-rose-600 font-semibold hover:underline">Read More</a>
      </div>

    </div>
  </div>
</section>
<!-- Footer Section -->
<footer class="text-black-100 py-16">
  <div class="container mx-auto px-6 text-Hind">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Company & Newsletter -->
      <div>
        <h3 class="text-xl font-bold mb-4">Company</h3>
        

      <!-- Customer Care -->
      
        
        <ul class="space-y-2">
          <li><a href="#" class="hover:text-rose-600">HOME</a></li>
          <li><a href="#" class="hover:text-rose-600">PAGES</a></li>
          <li><a href="#" class="hover:text-rose-600">SHOP</a></li>
          <li><a href="#" class="hover:text-rose-600">PORTFOLIO</a></li>
          <li><a href="#" class="hover:text-rose-600">FEATURES</a></li>
        </ul>
      </div>
       <div>
            <p class="mb-4">Sign up to our newsletter for exclusive access:</p>
        <form class="flex flex-col sm:flex-row gap-2">
          <input type="email" placeholder="Enter your email" class="p-2 rounded-lg text-gray-900 flex-1"><br>
         <br><button type="submit" class="bg-pink-600 hover:bg-rose-500 text-black font-semibold px-4 py-2">Submit</button>
        </form>
      </div>
      <!-- Pages -->
      <div class="md:text-right">
          <h3 class="text-xl font-bold mb-4">Customer Care</h3>
        
        <ul class="space-y-2">
          <li><a href="#" class="hover:text-rose-600">CONTACT US</a></li>
          <li><a href="#" class="hover:text-rose-600">FAQ</a></li>
          <li><a href="#" class="hover:text-rose-600">DELIVERY</a></li>
          <li><a href="#" class="hover:text-rose-600">RETURNS</a></li>
           <li><a href="#" class="hover:text-rose-600">SIZE GUIDE</a></li>
        </ul>
      </div>

      
    </div>
  </div>
  <!-- Extra Info -->
      <div class="md:text-center">
        <h3 class="text-xl font-bold mb-4">2025. All rights reserved.</h3>
        <p class="text-gray-400 text-sm">Elegant jewelry, crafted with care and delivered worldwide.</p>
      </div>
</footer>


</body>
</html>
