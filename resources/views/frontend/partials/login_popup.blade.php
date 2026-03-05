<!-- Login Popup Overlay -->
<div id="login-popup" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 transition-all duration-300">
    <!-- Backdrop with Blur -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeLoginPopup()"></div>

    <!-- Popup Card -->
    <div
        class="relative bg-white w-full max-w-[580px] min-h-[500px] md:w-[580px] md:h-[547px] rounded-[32px] md:rounded-[48px] overflow-hidden shadow-2xl px-8 py-10 md:px-14 md:py-16 flex flex-col justify-center">
        <!-- Close Button -->
        <button onclick="closeLoginPopup()"
            class="absolute top-6 right-6 md:top-10 md:right-10 text-gray-400 hover:text-gray-600 transition-colors">
            <i class="fa-solid fa-xmark text-xl md:text-2xl"></i>
        </button>

        <!-- Title & Subtitle (Left Aligned) -->
        <div class="mb-6 md:mb-10 text-left">
            <h2 class="text-[32px] md:text-[42px] font-bold text-[#1a1a1a] mb-2 leading-tight">Welcome to Tattsvi</h2>
            <p class="text-[#808080] text-base md:text-[20px] font-light leading-[1.4] max-w-[380px]">
                Sign in to explore our collections and enjoy exclusive updates.
            </p>
        </div>

        <!-- Form -->
        <div class="w-full space-y-6">
            <!-- Mobile Form -->
            <form id="loginPopupForm" class="space-y-6">
                @csrf
                <!-- Phone Input Group -->
                <div
                    class="flex items-center w-full border border-[#dcdcdc] rounded-[12px] h-[60px] md:h-[68px] transition-all focus-within:border-[#BE933C] p-1">
                    <!-- Country Selector (India Default) -->
                    <div class="flex items-center gap-2 pl-4 pr-3">
                        <img src="https://flagcdn.com/w40/in.png" alt="IN"
                            class="w-6 md:w-7 h-auto rounded-[2px] shadow-sm">
                        <i class="fa-solid fa-chevron-down text-[10px] md:text-[12px] text-[#1a1a1a]"></i>
                    </div>
                    <!-- Separator -->
                    <div class="w-[1px] h-8 bg-[#dcdcdc] mx-1"></div>
                    <!-- Input -->
                    <input type="tel" name="phone" placeholder="Enter Your Mobile Number" required
                        class="flex-1 h-full px-4 text-[18px] md:text-[20px] font-['Outfit'] font-normal outline-none text-[#1a1a1a] placeholder-[#b5b5b5]">
                </div>

                <!-- Checkbox -->
                <label class="flex items-center gap-4 cursor-pointer group">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="otp_notify"
                            class="peer h-5 w-5 md:h-6 md:w-6 cursor-pointer appearance-none rounded-[6px] border border-[#B5B5B5] transition-all checked:bg-[#BE933C] checked:border-[#BE933C]">
                        <i
                            class="fa-solid fa-check absolute text-[10px] md:text-[12px] text-white opacity-0 peer-checked:opacity-100 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>
                    <span class="text-base md:text-[18px] text-[#333333] font-normal select-none">Notify me about new
                        arrivals & offers</span>
                </label>

                <!-- Continue Button (Pill Shaped) -->
                <button type="submit" id="popupSubmitBtn"
                    class="bg-[#BE933C] w-full h-[60px] md:h-[72px] rounded-full text-white font-semibold text-[18px] md:text-[22px] tracking-wide shadow-sm hover:opacity-95 transition-all flex items-center justify-center">
                    Continue
                </button>
            </form>

            <!-- Legal Text -->
            <div class="text-center pt-2">
                <p class="text-[#808080] text-sm md:text-[17px] font-normal leading-relaxed">
                    I accept that I have read & understood your <br class="hidden md:block">
                    <a href="{{ route('page.privacy') }}"
                        class="text-[#808080] font-normal underline decoration-[#808080] hover:text-[#BE933C] underline-offset-4">Privacy
                        Policy and T&Cs.</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function openLoginPopup() {
        const popup = document.getElementById('login-popup');
        if (popup) {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeLoginPopup() {
        const popup = document.getElementById('login-popup');
        if (popup) {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            document.body.style.overflow = 'auto';
            // Mark as closed in session so it doesn't reappear until next visit
            sessionStorage.setItem('login_popup_closed', 'true');
        }
    }

    @guest
        document.addEventListener('DOMContentLoaded', function () {
            // Show after 5 seconds if not closed before
            if (!sessionStorage.getItem('login_popup_closed')) {
                setTimeout(openLoginPopup, 5000);
            }

            const popupForm = document.getElementById('loginPopupForm');
            if (popupForm) {
                popupForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const phoneInput = this.querySelector('input[name="phone"]');
                    const notifyCheckbox = this.querySelector('input[name="otp_notify"]');
                    const submitBtn = document.getElementById('popupSubmitBtn');

                    if (!phoneInput.value || phoneInput.value.replace(/\D/g, '').length < 10) {
                        if (window.showToast) window.showToast('Please enter a valid 10-digit mobile number', 'error');
                        return;
                    }

                    const rawPhone = phoneInput.value.replace(/\D/g, '');
                    const fullPhone = '+91' + rawPhone; // Default to India as per design

                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Sending...';

                    fetch("{{ route('frontend.auth.send-otp') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            full_phone: fullPhone,
                            otp_notify: notifyCheckbox.checked ? 1 : 0
                        })
                    })
                        .then(async (response) => {
                            const data = await response.json();
                            if (response.ok) {
                                if (window.showToast) window.showToast(data.message, 'success');
                                window.location.href = data.redirect;
                            } else {
                                throw new Error(data.message || 'Verification failed');
                            }
                        })
                        .catch((error) => {
                            if (window.showToast) window.showToast(error.message, 'error');
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        });
                });
            }
        });

        // Also expose openLoginPopup to global scope for header usage
        window.openLoginPopup = openLoginPopup;
    @endguest
</script>