@extends('layouts.master')

@section('title', 'Contact Us')

@section('content')
<div class="bg-[#F9F5EB] min-h-screen py-20 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-zinc-100">
        <h1 class="text-4xl font-serif font-bold text-zinc-900 mb-4">Send us a message</h1>
        <p class="text-zinc-500 mb-8 text-sm md:text-base leading-relaxed">
            Do you have a question? A complaint? Or need any help to choose the right product from Tattsvi? Feel free to contact us.
        </p>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- First Name -->
                <div>
                    <label class="block text-zinc-800 font-bold mb-2">First Name</label>
                    <input type="text" name="first_name" placeholder="Name*" required
                        class="w-full bg-white border border-zinc-200 rounded-lg px-4 py-3 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-[#C5A265] focus:border-[#C5A265] transition-all">
                    @error('first_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block text-zinc-800 font-bold mb-2">Last Name</label>
                    <input type="text" name="last_name" placeholder="Name*" required
                        class="w-full bg-white border border-zinc-200 rounded-lg px-4 py-3 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-[#C5A265] focus:border-[#C5A265] transition-all">
                    @error('last_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Email and Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Email -->
                <div>
                    <label class="block text-zinc-800 font-bold mb-2">Email</label>
                    <input type="email" name="email" placeholder="Enter Your Email" required
                        class="w-full bg-white border border-zinc-200 rounded-lg px-4 py-3 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-[#C5A265] focus:border-[#C5A265] transition-all">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-zinc-800 font-bold mb-2 flex justify-between">
                        <span>Contact Details</span>
                    </label>
                    <div class="flex">
                        <select name="phone_code" class="bg-white border border-zinc-200 border-r-0 rounded-l-lg px-3 py-3 text-zinc-700 bg-[center_right_0.5rem] focus:outline-none focus:ring-0 focus:border-zinc-200 w-24">
                            <option value="+91">+91</option>
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                        </select>
                        <input type="text" name="phone_number" placeholder="Phone Number" required
                            class="w-full bg-white border border-zinc-200 rounded-r-lg px-4 py-3 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-[#C5A265] focus:border-[#C5A265] transition-all">
                    </div>
                    @error('phone_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Message -->
            <div class="mb-8">
                <label class="block text-zinc-800 font-bold mb-2">Message</label>
                <textarea name="message" placeholder="Enter Your Message" required rows="6"
                    class="w-full bg-white border border-zinc-200 rounded-lg px-4 py-3 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-[#C5A265] focus:border-[#C5A265] transition-all resize-none"></textarea>
                @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-[#C5A265] hover:bg-[#b08e55] text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Send a messages
                </button>
            </div>
        </form>
    </div>
</div>
@endsection