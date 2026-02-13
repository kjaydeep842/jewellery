@extends('frontend.layouts.master')

@section('content')
<main class="w-full flex-grow pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
    <div
        class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1920px] w-full self-stretch">

        <!-- Sidebar -->
        @include('frontend.profile.partials.sidebar')

        <!-- Main Content Form -->
        <div class="flex-grow p-4 md:p-10 bg-white md:bg-transparent rounded-[10px] shadow-sm md:shadow-none w-full">
            <h2 class="font-['Outfit'] font-semibold text-[#1A1A1A] text-xl min-[2000px]:text-3xl mb-8">Profile</h2>

            @if(session('status') == 'profile-updated')
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-[8px] font-['Outfit']">
                Profile updated successfully!
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-[8px] font-['Outfit']">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <!-- Profile Pic Upload -->
                <div class="relative w-24 h-24 mb-10">
                    <div id="profile-preview-container"
                        class="relative w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center group cursor-pointer overflow-hidden border-2 border-gray-200">
                        @if(Auth::user()->profile_picture)
                        <img id="profile-preview" src="{{ Auth::user()->profile_picture_url }}"
                            class="w-full h-full object-cover" alt="Profile">
                        @else
                        <i id="placeholder-icon" class="fa-regular fa-user text-4xl text-gray-400"></i>
                        <img id="profile-preview" src="" class="w-full h-full object-cover hidden" alt="Profile">
                        @endif

                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fa-solid fa-camera text-white"></i>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('profile_picture').click()"
                        class="absolute bottom-1 right-1 bg-[#CBA65A] text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#a68541] transition-colors border-2 border-white shadow-sm z-10">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </button>

                    <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*" onchange="previewImage(this)">
                </div>

                <!-- Name Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                    $nameParts = explode(' ', Auth::user()->name, 2);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = $nameParts[1] ?? '';
                    @endphp
                    <div class="space-y-2">
                        <input type="text" name="first_name" value="{{ old('first_name', $firstName) }}"
                            placeholder="First Name*"
                            class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400 @error('name') border-red-500 @enderror">
                    </div>
                    <div class="space-y-2">
                        <input type="text" name="last_name" value="{{ old('last_name', $lastName) }}"
                            placeholder="Last Name*"
                            class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">
                    </div>
                </div>

                <!-- Contact Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            placeholder="Email Address*"
                            class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400 @error('email') border-red-500 @enderror">
                    </div>
                    <div class="space-y-2">
                        <input type="text" value="{{ Auth::user()->phone }}" readonly
                            class="w-full h-[50px] min-[2000px]:h-[70px] bg-[#F2F2F3] border border-transparent rounded-[8px] px-4 text-sm font-['Outfit'] text-gray-600 outline-none">
                    </div>
                </div>

                <!-- Gender -->
                <div class="space-y-3">
                    <label class="text-sm font-['Outfit'] text-gray-700 font-medium">Gender*</label>
                    <div class="flex items-center gap-8">
                        @foreach(['Male', 'Female', 'Other'] as $gender)
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="radio" name="gender" value="{{ $gender }}"
                                    class="peer appearance-none w-5 h-5 border border-gray-300 rounded-full checked:border-[#CBA65A] checked:bg-[#CBA65A] transition-all"
                                    {{ old('gender', Auth::user()->gender) == $gender ? 'checked' : '' }}>
                                <i
                                    class="fa-solid fa-check text-white text-[10px] absolute opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span
                                class="text-sm font-['Outfit'] text-gray-600 group-hover:text-[#CBA65A]">{{ $gender }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Address Heading -->
                <h2 class="font-['Outfit'] font-normal text-[#1A1A1A] text-lg pt-4">Address</h2>

                <!-- Address Fields -->
                <div class="space-y-4">
                    @php
                    $address = Auth::user()->addresses()->where('is_default', true)->first();
                    @endphp
                    <input type="text" name="zip" value="{{ old('zip', $address->zip ?? '') }}" placeholder="Pin Code*"
                        class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">

                    <input type="text" name="address_line_1"
                        value="{{ old('address_line_1', $address->address_line_1 ?? '') }}"
                        placeholder="House Number/ Tower/Block*"
                        class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">
                    <p class="text-[11px] text-[#1A1A1A] font-['Outfit'] font-normal italic">*House Number Will Allow A
                        Doorstep Delivery</p>

                    <input type="text" name="address_line_2"
                        value="{{ old('address_line_2', $address->address_line_2 ?? '') }}"
                        placeholder="Address (Locality, Building, Street)*"
                        class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">
                    <p class="text-[11px] text-[#1A1A1A] font-['Outfit'] font-normal italic">*Please Update
                        Society/Apartment Details</p>

                    <!-- City/State Readonly -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}"
                            placeholder="City / District*"
                            class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">
                        <input type="text" name="state" value="{{ old('state', $address->state ?? '') }}"
                            placeholder="State*"
                            class="w-full h-[50px] min-[2000px]:h-[70px] border border-gray-200 rounded-[8px] px-4 text-sm font-['Outfit'] outline-none focus:border-[#CBA65A] placeholder-gray-400">
                    </div>
                </div>

                <!-- Address Type -->
                <div class="space-y-3 pt-2">
                    <label class="text-sm font-['Outfit'] text-gray-700 font-medium tracking-wide">Address Type</label>
                    <div class="flex items-center gap-8">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="radio" name="address_type" value="Home"
                                    class="peer appearance-none w-5 h-5 border border-gray-300 rounded-[4px] checked:bg-[#CBA65A] checked:border-[#CBA65A] transition-colors"
                                    {{ old('address_type', $address->type ?? 'Home') == 'Home' ? 'checked' : '' }}>
                                <i
                                    class="fa-solid fa-check text-white text-[10px] absolute opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="text-sm font-['Outfit'] text-gray-600 group-hover:text-[#CBA65A]">Home</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="radio" name="address_type" value="Office"
                                    class="peer appearance-none w-5 h-5 border border-gray-300 rounded-[4px] checked:bg-[#CBA65A] checked:border-[#CBA65A] transition-colors"
                                    {{ old('address_type', $address->type ?? '') == 'Office' ? 'checked' : '' }}>
                                <i
                                    class="fa-solid fa-check text-white text-[10px] absolute opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="text-sm font-['Outfit'] text-gray-600 group-hover:text-[#CBA65A]">Office</span>
                        </label>
                    </div>
                </div>

                <!-- Notification Preference -->
                <div class="flex items-center gap-3 pt-2">
                    <div class="relative flex items-center">
                        <input type="checkbox" id="otp_notify" name="otp_notify" value="1"
                            class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-gray-300 checked:border-[#CBA65A] checked:bg-[#CBA65A] transition-all"
                            {{ Auth::user()->otp_notify ? 'checked' : '' }}>
                        <i
                            class="fa-solid fa-check text-white absolute text-[10px] pointer-events-none opacity-0 peer-checked:opacity-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                    </div>
                    <label for="otp_notify" class="font-['Outfit'] text-[#1A1A1A] text-sm cursor-pointer select-none">
                        Notify me with offers & updates
                    </label>
                </div>

                <!-- Save Button -->
                <button type="submit"
                    class="w-full h-[54px] min-[2000px]:h-[74px] rounded-full font-['Outfit'] font-medium text-[17px] min-[2000px]:text-2xl text-white shadow-md tracking-wide hover:shadow-lg transition-all transform active:scale-[0.99] mt-6"
                    style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);">
                    Save Details
                </button>
            </form>
        </div>
    </div>
</main>
<div class="w-full bg-[#E9D3D6] py-4 flex items-center justify-center ">
    <span class="text-[#0D0D0E] font-['Outfit'] text-base font-medium">Know More About Tattsvi</span>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-preview');
                const placeholder = document.getElementById('placeholder-icon');

                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Trigger file input when clicking the preview container
    document.getElementById('profile-preview-container').addEventListener('click', function() {
        document.getElementById('profile_picture').click();
    });
</script>
@endpush

@push('styles')
<style>
    .cursive {
        font-family: 'Great Vibes', cursive;
    }

    .radio-custom:checked {
        background-color: #CBA65A;
        border-color: #CBA65A;
    }
</style>
@endpush