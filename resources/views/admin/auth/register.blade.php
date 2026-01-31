<x-admin-guest-layout>
    <div class="min-h-screen flex bg-gray-900">
        <!-- Left Side - Image/Branding -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1599643478518-17488fbbcd75?q=80&w=2070&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12 text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-24 mb-6 drop-shadow-lg">
                <h1 class="text-4xl font-serif font-bold mb-4 tracking-wide text-white drop-shadow-md">Join the Elite</h1>
                <p class="text-lg font-light tracking-wider opacity-90 max-w-md">Begin your journey in luxury management.</p>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f172a]">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-serif font-bold text-white mb-2">Create Account</h2>
                    <p class="text-gray-400">Register a new administrator account.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="admin@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 rounded-lg btn-gold font-bold text-white shadow-lg transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d4af37] focus:ring-offset-gray-900">
                        Register
                    </button>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.login') }}" class="text-sm text-gray-400 hover:text-[#d4af37] transition-colors">
                            Already registered? <span class="text-[#d4af37] hover:underline">Log in</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-guest-layout>

