<div class="w-full lg:w-[445px] flex-shrink-0 flex flex-col gap-4">
    <!-- User Profile Card -->
    <div
        class="flex flex-row items-center p-4 gap-5 w-full h-[103px] bg-[rgba(219,179,88,0.1)] border border-[#EFE4CD] rounded-[10px]">
        <div
            class="w-12 h-12 rounded-full bg-white flex items-center justify-center border border-[#EADDCC] flex-shrink-0">
            <img src="{{ asset('assets/ic_User.png') }}" alt="user" class="w-5 h-5">
        </div>
        <div class="flex flex-col gap-1.5 flex-grow">
            <h3 class="font-['Outfit'] font-bold text-[#1A1A1A] text-[16px] leading-tight">
                Hello {{ Auth::user()->name ?: 'User' }}</h3>
            <div class="h-1.5 w-[140px] bg-[#EADDCC] rounded-full overflow-hidden">
                <div class="h-full bg-[#CBA65A] rounded-full" style="width: 25%"></div>
            </div>
            <p class="text-[12px] text-[#7D7D7D] font-['Outfit'] font-normal leading-tight">25% Complete</p>
        </div>
        <a href="{{ route('profile.edit') }}"
            class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-800 hover:text-[#CBA65A] shadow-sm ml-auto flex-shrink-0">
            <i class="fa-solid fa-chevron-right text-[12px]"></i>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex flex-col gap-8">
        <!-- Overview -->
        <div>
            <h4 class="text-[#989898] text-[13px] font-['Outfit'] uppercase mb-4 tracking-wide font-normal">
                Overview</h4>
            <ul class="space-y-4">
                <li>
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
                </li>
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