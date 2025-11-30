<!-- Top Promo Bar -->
<div class="w-full bg-gray-900 text-white text-sm py-2 px-4 flex flex-col md:flex-row items-center justify-between">
  <p class="text-center md:text-left">
      Free Insured Shipping Worldwide on all orders.
      <span class="font-semibold">Use Code: FESTIVE10</span> for 10% Off.
  </p>

  <div class="flex items-center space-x-2 mt-1 md:mt-0">
      <img src="/assets/h.png" class="w-5 h-5 rounded-full object-cover" />
      <span>IND</span>
      <i class="fa-solid fa-indian-rupee-sign"></i>
      <i class="fa-solid fa-chevron-down"></i>
  </div>
</div>

<!-- Navbar -->
<header class="bg-white shadow">
  <div class="container mx-auto px-6 py-4 flex items-center justify-between">

      <!-- Desktop Menu -->
      <nav class="hidden lg:flex items-center gap-10">
          <a href="#" class="hover:text-rose-600">Earrings</a>
          <a href="#" class="hover:text-rose-600">Pendants & Necklaces</a>
          <a href="#" class="hover:text-rose-600">Bracelets & Bangles</a>

          <img src="/assets/logo.png" alt="logo" class="w-20 h-auto">

          <a href="#" class="hover:text-rose-600">Mangalsutra</a>
          <a href="#" class="hover:text-rose-600">Gifts</a>
          <a href="#" class="hover:text-rose-600">New Arrivals</a>
      </nav>

      <!-- Mobile Menu Button -->
      <button class="p-2 lg:hidden text-xl" onclick="handleMenu()">
          <i class="fa-solid fa-bars"></i>
      </button>

      <!-- Right Icons -->
      <div class="hidden lg:flex items-center gap-5 text-xl">
          <i class="fa-solid fa-magnifying-glass"></i>
          <i class="fa-regular fa-user"></i>
          <i class="fa-regular fa-heart"></i>
          <i class="fa-solid fa-bag-shopping"></i>
      </div>
  </div>

  <!-- Mobile Slide Menu -->
  <div id="nav-dailog1"
       class="hidden fixed inset-0 z-50 bg-white p-4 overflow-y-auto h-screen">

      <!-- Top Bar -->
      <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-2">
              <img src="/assets/logo.png" class="w-10">
              <span class="text-lg font-semibold">Tattsvi</span>
          </div>

          <button onclick="handleMenu()" class="text-2xl">
              <i class="fa-solid fa-xmark"></i>
          </button>
      </div>

      <!-- Mobile Menu Links -->
      <div class="space-y-2">
          <a class="block p-3 rounded-lg hover:bg-gray-100">Earrings</a>
          <a class="block p-3 rounded-lg hover:bg-gray-100">Pendants & Necklaces</a>
          <a class="block p-3 rounded-lg hover:bg-gray-100">Bracelets & Bangles</a>
          <a class="block p-3 rounded-lg hover:bg-gray-100">Mangalsutra</a>
          <a class="block p-3 rounded-lg hover:bg-gray-100">Gifts</a>
          <a class="block p-3 rounded-lg hover:bg-gray-100">New Arrivals</a>
      </div>

      <div class="mt-6 border-t pt-4">
          <a href="#" class="hover:text-rose-600">Login</a>
      </div>
  </div>
</header>



<script src="{{ asset('js/script.js') }}" defer></script>
