<x-admin-guest-layout>
    <div class="min-h-screen flex bg-gray-900">
        <!-- Left Side - Image/Branding -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative"
            style="background-image: url('https://images.unsplash.com/photo-1611591437281-460bfbe1220a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12 text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-24 mb-6 drop-shadow-lg">
                <h1 class="text-4xl font-serif font-bold mb-4 tracking-wide text-white drop-shadow-md">Exquisite
                    Craftsmanship</h1>
                <p class="text-lg font-light tracking-wider opacity-90 max-w-md">Access your personal collection.</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#0f172a]">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-serif font-bold text-white mb-2">Welcome Back</h2>
                    <p class="text-gray-400">Please sign in to your account.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg input-dark placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="email@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div class="mb-8">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg input-dark placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-slate-800 text-[#d4af37] shadow-sm focus:ring-[#d4af37]" name="remember">
                            <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-4 rounded-lg btn-gold font-bold text-white shadow-lg transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d4af37] focus:ring-offset-gray-900">
                        Log In
                    </button>

                    <div class="mt-6 text-center space-y-3">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="block text-sm text-[#d4af37] hover:text-[#edc95e] transition-colors">Forgot your password?</a>
                        @endif
                        
                        @if (Route::has('register'))
                        <p class="text-gray-400 text-sm">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-[#d4af37] hover:text-[#edc95e] font-medium hover:underline transition-colors">Register</a>
                        </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-guest-layout>
