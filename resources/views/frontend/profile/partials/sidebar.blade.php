<div class="w-full lg:w-[445px] flex-shrink-0 flex flex-col gap-4">
    <!-- User Profile Card -->
    <a href="{{ route('profile.edit') }}"
        class="flex flex-row items-center p-4 gap-5 w-full h-[103px] bg-[rgba(219,179,88,0.1)] border border-[#EFE4CD] rounded-[10px] group transition-all hover:bg-[rgba(219,179,88,0.15)] hover:border-[#CBA65A]/30">
        <div
            class="w-12 h-12 rounded-full bg-white flex items-center justify-center border border-[#EADDCC] flex-shrink-0 overflow-hidden">
            @if(Auth::user()->profile_picture)
            <img src="{{ Auth::user()->profile_picture_url }}" alt="user"
                class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-[#EFE4CD] flex items-center justify-center text-[18px] font-bold text-[#CBA65A] uppercase">
                {{ Auth::user()->initials }}
            </div>
            @endif
        </div>
        <div class="flex flex-col gap-1.5 flex-grow">
            <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-[16px] leading-tight group-hover:text-[#CBA65A] transition-colors">
                {{ Auth::user()->name ?: 'User' }}
            </h3>

            @php
            $user = Auth::user();
            $address = $user->addresses()->where('is_default', true)->first();
            $fields = [
            'name' => !empty($user->name),
            'email' => !empty($user->email),
            'gender' => !empty($user->gender),
            'profile_picture' => !empty($user->profile_picture),
            'address' => $address && !empty($address->address_line_1) && !empty($address->zip)
            ];
            $completedCount = count(array_filter($fields));
            $percentage = ($completedCount / count($fields)) * 100;
            @endphp

            <div class="mt-1 space-y-1.5">
                <div class="h-1 w-full bg-[#EADDCC]/40 rounded-full overflow-hidden">
                    <div class="h-full bg-[#CBA65A] rounded-full transition-all duration-1000 ease-in-out" style="width: {{ $percentage }}%"></div>
                </div>
                <p class="text-[12px] text-[#7D7D7D] font-['Outfit'] font-normal leading-tight">{{ round($percentage) }}% Complete</p>
            </div>
        </div>
        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-800 group-hover:text-[#CBA65A] shadow-sm ml-auto flex-shrink-0 transition-all group-hover:scale-110">
            <i class="fa-solid fa-chevron-right text-[12px]"></i>
        </div>
    </a>

    <!-- Navigation Links -->
    <div class="flex flex-col gap-8">
        <!-- Overview -->
        <div>
            <h4 class="text-[#989898] text-[13px] font-['Outfit'] uppercase mb-4 tracking-wide font-normal">
                Overview</h4>
            <ul class="space-y-4">
                <!-- <li>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border {{ request()->routeIs('profile.edit') ? 'bg-[rgba(219,179,88,0.1)] border-[#EFE4CD]' : 'border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]' }}">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_User.png') }}" alt="profile"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>My Profile</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('orders.index') }}"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border {{ request()->routeIs('orders.index') ? 'bg-[rgba(219,179,88,0.1)] border-[#EFE4CD]' : 'border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]' }}">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_order.png') }}" alt="order"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>My Orders</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('wishlist.index') }}"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border {{ request()->routeIs('wishlist.index') ? 'bg-[rgba(219,179,88,0.1)] border-[#EFE4CD]' : 'border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]' }}">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_wishlist.png') }}" alt="wishlist"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>My Wishlist</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border {{ request()->routeIs('cart.index') ? 'bg-[rgba(219,179,88,0.1)] border-[#EFE4CD]' : 'border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]' }}">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_bag_black.png') }}" alt="bag"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>My Bag</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Legal -->
        <div>
            <h4 class="text-[#989898] text-[13px] font-['Outfit'] uppercase mb-4 tracking-wide font-normal">
                Legal</h4>
            <ul class="space-y-4">
                <li>
                    <a href="#"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_order.png') }}" alt="terms"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>Terms of Use</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-between w-full h-[68px] px-4 rounded-[10px] text-[#1A1A1A] font-['Outfit'] text-[15px] font-medium group transition-colors box-border border border-transparent hover:bg-[rgba(219,179,88,0.1)] hover:border-[#EFE4CD]">
                        <div class="flex items-center gap-4">
                            <div class="w-5 flex justify-center">
                                <img src="{{ asset('assets/ic_wishlist.png') }}" alt="privacy"
                                    class="w-[18px] h-auto group-hover:opacity-80">
                            </div>
                            <span>Privacy Center</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[12px] text-gray-400 group-hover:text-[#CBA65A]"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>