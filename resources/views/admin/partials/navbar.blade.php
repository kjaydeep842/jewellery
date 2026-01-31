<header x-data="{ notificationOpen: false, profileOpen: false }" style="background-color: var(--color-header);"
    class="flex items-center justify-between px-4 md:px-8 py-4 md:py-5 sticky top-0 z-40 mb-6 transition-all duration-300 shadow-sm border-b border-amber-100">

    <div class="flex items-center relative z-10">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = !sidebarOpen"
            class="mr-2 md:mr-4 text-zinc-500 hover:text-amber-600 focus:outline-none transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <h1
            class="text-lg md:text-3xl font-premium font-bold tracking-wider text-zinc-900 drop-shadow-sm flex flex-col">
            @yield('title', 'Dashboard')
            <span class="block h-1 w-8 md:w-12 bg-gradient-to-r from-amber-400 to-amber-600 rounded-full mt-1"></span>
        </h1>
    </div>

    <div class="flex items-center space-x-2 md:space-x-6 relative z-10">
        <!-- Notifications -->
        <div class="relative">
            <button @click="notificationOpen = !notificationOpen"
                class="relative group p-2 rounded-full hover:bg-amber-50 transition-all duration-300 border border-transparent hover:border-amber-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-zinc-500 group-hover:text-amber-600 transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span
                    class="absolute top-1.5 right-1.5 h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white animate-pulse"></span>
            </button>

            <!-- Mobile Backdrop -->
            <div x-show="notificationOpen" @click="notificationOpen = false" x-transition.opacity
                class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

            <!-- Notification Dropdown -->
            <div x-show="notificationOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.away="notificationOpen = false"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90vw] max-w-sm z-50 bg-white rounded-xl shadow-2xl border border-amber-100 overflow-hidden md:absolute md:top-full md:left-auto md:right-0 md:translate-x-0 md:translate-y-0 md:w-96 md:mt-3">

                <div class="px-4 py-3 border-b border-zinc-100 bg-amber-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-zinc-800 font-heading">Notifications</h3>
                    <span class="text-xs bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full font-bold">3 New</span>
                </div>

                <div class="max-h-80 overflow-y-auto">
                    <!-- New Order -->
                    <a href="#"
                        class="block px-4 py-4 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0 group">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 bg-emerald-100 rounded-full p-2 text-emerald-600 group-hover:bg-emerald-200 transition-colors mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-bold text-zinc-800">New Order #1024</p>
                                <p class="text-sm text-zinc-600 mt-0.5">Customer placed a new order for $1,200.</p>
                                <p class="text-xs text-zinc-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>
                    </a>

                    <!-- Low Stock -->
                    <a href="#"
                        class="block px-4 py-4 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0 group">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 bg-amber-100 rounded-full p-2 text-amber-600 group-hover:bg-amber-200 transition-colors mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-bold text-zinc-800">Low Stock Alert</p>
                                <p class="text-sm text-zinc-600 mt-0.5">Gold Ring (Size 6) is running low.</p>
                                <p class="text-xs text-zinc-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                    </a>

                    <!-- New Customer -->
                    <a href="#" class="block px-4 py-4 hover:bg-zinc-50 transition-colors group">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 bg-blue-100 rounded-full p-2 text-blue-600 group-hover:bg-blue-200 transition-colors mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm font-bold text-zinc-800">New Customer</p>
                                <p class="text-sm text-zinc-600 mt-0.5">Sarah Johnson joined your store.</p>
                                <p class="text-xs text-zinc-400 mt-1">3 hours ago</p>
                            </div>
                        </div>
                    </a>
                </div>

                <a href="#"
                    class="block text-center text-xs font-bold text-amber-600 py-3 bg-amber-50 hover:bg-amber-100 transition-colors uppercase tracking-wide border-t border-amber-100">
                    View All Notifications
                </a>
            </div>
        </div>

        <div class="h-8 w-px bg-zinc-200 hidden md:block"></div>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false"
                class="flex items-center space-x-3 group focus:outline-none">
                <div class="text-right hidden md:block">
                    <span
                        class="block text-sm font-bold text-zinc-800 group-hover:text-amber-600 transition-colors font-heading">{{ Auth::user()->name }}</span>
                    <span
                        class="block text-[10px] font-bold text-amber-500 tracking-[0.1em] uppercase">Administrator</span>
                </div>
                <div
                    class="h-10 w-10 flex items-center justify-center bg-gradient-to-br from-zinc-800 to-black text-amber-400 rounded-full shadow-lg border-2 border-amber-100/50 ring-2 ring-white/50 transform group-hover:scale-105 transition-all duration-300">
                    <span class="font-premium text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </button>

            <!-- Mobile Backdrop -->
            <div x-show="open" @click="open = false" x-transition.opacity
                class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

            <!-- Profile Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90vw] max-w-xs bg-white rounded-xl shadow-2xl border border-amber-100 overflow-hidden z-50 md:absolute md:top-full md:left-auto md:right-0 md:translate-x-0 md:translate-y-0 md:mt-3 md:w-48">

                <div class="px-4 py-3 border-b border-zinc-100 bg-amber-50/50 md:hidden">
                    <p class="text-sm font-bold text-zinc-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-amber-600 font-bold uppercase tracking-wider">Administrator</p>
                </div>

                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 text-sm text-zinc-700 hover:bg-amber-50 hover:text-amber-600 border-b border-zinc-50 last:border-0">Dashboard</a>
                <a href="{{ route('admin.settings.index') }}"
                    class="block px-4 py-3 text-sm text-zinc-700 hover:bg-amber-50 hover:text-amber-600 border-b border-zinc-50 last:border-0">Settings</a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>