<x-admin-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 p-4" style="background-image: radial-gradient(#d4af37 1px, transparent 1px); background-size: 50px 50px;">
        <div class="w-full max-w-7xl flex flex-col lg:flex-row shadow-2xl rounded-2xl overflow-hidden bg-[#0a0a0a] border border-zinc-800 relative z-10">
            <!-- Left Side - Image/Branding -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center text-center p-12 lg:border-r border-zinc-800 bg-[#0a0a0a]">
                <img src="{{ asset('img/T-Logo.png') }}" alt="Logo" class="h-80 w-auto mb-8 drop-shadow-xl transform hover:scale-105 transition-transform duration-500">
                <h1 class="text-5xl lg:text-6xl font-serif font-bold mb-4 tracking-wide text-white drop-shadow-md"></h1>
                <p class="text-xl text-gray-300 font-light tracking-wider max-w-md mx-auto"></p>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-12 bg-[#0a0a0a]">
                <div class="w-full max-w-md">
                    <div class="mb-8 text-center">
                        <h2 class="text-4xl font-serif font-bold text-white mb-2">Welcome Back</h2>
                        <p class="text-lg text-gray-400">Please sign in to your account.</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-6">
                            <label for="email" class="block text-lg font-medium text-gray-300 mb-2">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-3 text-lg rounded-lg input-dark placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                                placeholder="email@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                        </div>

                        <!-- Password -->
                        <div class="mb-8">
                            <label for="password" class="block text-lg font-medium text-gray-300 mb-2">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 text-lg rounded-lg input-dark placeholder-gray-500 focus:outline-none focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] transition-colors"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mb-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-slate-800 text-[#d4af37] shadow-sm focus:ring-[#d4af37]" name="remember">
                                <span class="ms-2 text-base text-gray-300">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3 px-4 text-xl rounded-lg btn-gold font-bold text-white shadow-lg transform transition hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d4af37] focus:ring-offset-gray-900">
                            Log In
                        </button>

                        <!-- <div class="mt-6 text-center space-y-3">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="block text-base text-[#d4af37] hover:text-[#edc95e] transition-colors">Forgot your password?</a>
                            @endif

                            @if (Route::has('register'))
                            <p class="text-gray-400 text-base">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-[#d4af37] hover:text-[#edc95e] font-medium hover:underline transition-colors">Register</a>
                            </p>
                            @endif
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-guest-layout>