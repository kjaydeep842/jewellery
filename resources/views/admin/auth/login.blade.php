<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-xl font-bold mb-4 text-center">Admin Login</h2>

        @if($errors->any())
            <div class="bg-red-200 text-red-700 p-2 rounded mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <button class="w-full bg-indigo-600 text-white p-2 rounded">
                Login
            </button>
        </form>
    </div>

</div>


</x-guest-layout>