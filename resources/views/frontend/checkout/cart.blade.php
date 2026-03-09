@extends('frontend.layouts.master')

@section('content')
    <main class="w-full flex-grow pt-2 pb-2 min-[2000px]:pt-20 min-[2000px]:pb-32 bg-[#FDFBF7] flex justify-center">
        <div
            class="flex flex-col lg:flex-row justify-center items-start p-4 md:p-10 gap-5 md:gap-10 max-w-[1536px] w-full self-stretch">

            <!-- Sidebar -->
            @include('frontend.profile.partials.sidebar')

            <!-- Main Content Area -->
            <div class="flex-grow min-h-[600px] flex flex-col xl:flex-row gap-8 items-start">
                @if($cartItems->isEmpty())
                    <!-- Empty State Section -->
                    <div class="flex-grow flex flex-col items-center justify-center p-[40px] gap-6 rounded-[10px]"
                        style="background: linear-gradient(90deg, rgba(219, 179, 88, 0.042) 0%, rgba(151, 102, 0, 0.14) 100%);">
                        <div class="relative">
                            <img src="{{ asset('assets/IC -pagenot found.png') }}" alt="Empty Bag Icon"
                                class="object-contain h-[80px] w-auto opacity-80">
                        </div>
                        <div class="text-center space-y-2">
                            <h2 class="text-2xl font-['Outfit'] font-bold text-[#1A1A1A]">Your Bag is Currently Empty</h2>
                            <p class="text-base text-[#6E6E77] max-w-md mx-auto font-['Outfit']">
                                Looks like you haven't added anything to your bag yet. Start exploring our collection and find
                                something beautiful today.
                            </p>
                        </div>
                        <a href="{{ route('home') }}" style="background: linear-gradient(90deg, #D9BE87 0%, #BE933C 100%);"
                            class="px-10 py-4 rounded-full text-white font-['Outfit'] font-medium text-lg shadow-md hover:opacity-90 transition-all">
                            Continue Shopping
                        </a>
                    </div>
                @else
                    <!-- Middle Column: Delivery + Items -->
                    <div class="flex-grow flex flex-col gap-6 max-w-[750px]">
                        <!-- Delivery Address Bar -->
                        <div
                            class="w-full bg-[#FCF8EC] rounded-[10px] border border-[#EADDCC] flex flex-col md:flex-row justify-between items-center px-8 py-5 gap-6">
                            <div class="flex flex-col gap-1 w-full text-left">
                                <div class="font-['Outfit'] text-[15px] leading-tight">
                                    <span class="text-[#848484] font-normal">Deliver To : </span>
                                    <span
                                        class="text-[#0D0D0E] font-medium tracking-tight">{{ $address ? $address->name . ' , ' . $address->zip : 'No address selected' }}</span>
                                </div>
                                <p class="font-['Outfit'] text-[#848484] text-[15px] font-normal leading-tight">
                                    {{ $address ? $address->address_line_1 . ', ' . $address->area . ', ' . $address->city . ', ' . $address->state : 'Please add a delivery address' }}
                                </p>
                            </div>

                            <button onclick="window.location.href='{{ route('checkout.address') }}';"
                                class="flex-shrink-0 bg-white border border-[#CBA65A] text-[#CBA65A] font-['Outfit'] font-normal text-[15px] w-full md:w-[130px] h-[40px] rounded-[6px] hover:bg-[#FDFBF7] transition-colors whitespace-nowrap">
                                Change Address
                            </button>
                        </div>

                        <!-- Items List -->
                        <div class="flex flex-col gap-5">
                            <!-- List Header -->
                            <div class="flex justify-between items-center px-4 font-['Outfit']">
                                <div class="flex items-center gap-3">
                                    <div id="master-checkbox"
                                        class="w-5 h-5 border-2 border-[#CBA65A] bg-[#CBA65A] rounded flex items-center justify-center text-white cursor-pointer transition-all hover:scale-110 active:scale-95">
                                        <i class="fa-solid fa-check text-[10px] pointer-events-none"></i>
                                    </div>
                                    <span class="text-[#0D0D0E] font-medium text-[14px]">
                                        <span id="selected-count">{{ $cartItems->count() }}</span>/<span id="total-count">{{ $cartItems->count() }}</span>
                                        products selected
                                    </span>
                                </div>
                                <button id="remove-selected-btn" class="text-[#848484] hover:text-red-500 text-[14px]">Remove</button>
                            </div>

                            <div class="space-y-5">
                                    @foreach($cartItems as $item)
                                        <div
                                            class="bg-white rounded-[4px] border border-[#CFD4E3] p-3 relative group hover:shadow-sm transition-shadow">
                                            <!-- Checkbox -->
                                            <div class="absolute top-[18px] left-[18px] z-10">
                                                <div data-id="{{ $item->id }}"
                                                    data-mrp="{{ $item->product->mrp * $item->quantity }}"
                                                    data-discount="{{ ($item->product->mrp - $item->price) * $item->quantity }}"
                                                    data-total="{{ $item->price * $item->quantity }}"
                                                    class="item-checkbox w-5 h-5 border border-[#CBA65A] bg-[#CBA65A] rounded-[4px] flex items-center justify-center text-white cursor-pointer transition-all hover:scale-110 active:scale-95">
                                                    <i class="fa-solid fa-check text-[10px] pointer-events-none"></i>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                class="absolute top-4 right-4 z-10">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-xmark text-lg"></i>
                                                </button>
                                            </form>

                                            <div class="flex flex-col md:flex-row gap-8">
                                                <!-- Image -->
                                                <div
                                                    class="w-full md:w-[200px] h-[250px] bg-[#EEF0F5] rounded-[2px] overflow-hidden flex items-center justify-center flex-shrink-0">
                                                    @if($item->product->images->isNotEmpty())
                                                        <img src="{{ Str::startsWith($item->product->images->first()->image_path, 'http') ? $item->product->images->first()->image_path : asset('storage/' . $item->product->images->first()->image_path) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="w-[90%] h-[90%] object-contain mix-blend-multiply transition-transform group-hover:scale-105 duration-300">
                                                    @endif
                                                </div>

                                                <!-- Details -->
                                                <div class="flex-grow flex flex-col font-['Outfit'] py-1">
                                                    <h3 class="font-normal text-[#0D0D0E] text-[20px] mb-1 leading-tight max-w-[90%]">
                                                        {{ $item->product->name }}
                                                    </h3>
                                                    <p class="font-bold text-[#0D0D0E] text-[20px] mb-4">
                                                        ₹{{ number_format($item->price, 2) }}
                                                    </p>

                                                    <!-- Attributes Rows -->
                                                    <div class="flex flex-col gap-[15px] mb-6">
                                                        <!-- Line 1: Size & Qty -->
                                                        <div class="flex items-center gap-[40px]">
                                                            <div class="flex items-center gap-3">
                                                                <span class="text-[#0D0D0E] text-[20px] font-medium whitespace-nowrap">Size: <span class="text-[#7B85A3] font-normal ml-1">{{ $item->variant ? $item->variant->size : 'N/A' }}</span></span>
                                                                <div class="relative">
                                                                    <select onchange="updateCartQuantity(this, {{ $item->id }})"
                                                                        class="bg-[#F6F6F6] border border-[#E9E9E9] rounded-[4px] px-2 py-0.5 text-[14px] font-medium outline-none focus:ring-1 focus:ring-[#CBA65A] w-fit cursor-pointer appearance-none pr-6">
                                                                        @foreach($item->product->variants as $variant)
                                                                            <option value="{{ $variant->id }}" {{ $item->product_variant_id == $variant->id ? 'selected' : '' }}>
                                                                                {{ $variant->size }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="fa-solid fa-chevron-down absolute right-2 top-1/2 -translate-y-1/2 text-[10px] text-[#848484] pointer-events-none"></i>
                                                                </div>
                                                            </div>

                                                            <div class="flex items-center gap-3">
                                                                <span class="text-[#0D0D0E] text-[20px] font-medium whitespace-nowrap">Qty: <span class="text-[#7B85A3] font-normal ml-1">{{ $item->quantity }}</span></span>
                                                                <div class="relative">
                                                                    <select onchange="updateCartQuantity(this, {{ $item->id }})"
                                                                        class="bg-[#F6F6F6] border border-[#E9E9E9] rounded-[4px] px-2 py-0.5 text-[14px] font-medium outline-none focus:ring-1 focus:ring-[#CBA65A] w-fit cursor-pointer appearance-none pr-6">
                                                                        @for($i = 1; $i <= 10; $i++)
                                                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                    <i class="fa-solid fa-chevron-down absolute right-2 top-1/2 -translate-y-1/2 text-[10px] text-[#848484] pointer-events-none"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Line 2: Metal & Metal Color -->
                                                        <div class="flex items-center gap-[40px]">
                                                            <div class="flex flex-col gap-0.5">
                                                                <span class="text-[#0D0D0E] text-[20px] font-medium">Metal: <span
                                                                        class="text-[#7B85A3] font-normal ml-1">{{ $item->product->metal_purity ?? '14KT' }}</span></span>
                                                            </div>

                                                            <div class="flex flex-col gap-0.5">
                                                                <div class="flex items-center gap-[10px]">
                                                                    <span class="text-[#0D0D0E] text-[20px] font-medium whitespace-nowrap">Metal Color:</span>
                                                                    <div class="flex items-center gap-[10px]">
                                                                        <div class="w-[26px] h-[26px] rounded-full border border-gray-200 shadow-sm flex-shrink-0"
                                                                            style="background-color: {{ $item->product->metalColor ? $item->product->metalColor->color_code : '#E6BE8A' }}">
                                                                        </div>
                                                                        <span
                                                                            class="text-[#7B85A3] font-normal text-[20px] whitespace-nowrap">{{ $item->product->metalColor ? $item->product->metalColor->name : 'Rose' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Line 3: Weight -->
                                                        <div class="flex flex-col gap-0.5">
                                                            <span class="text-[#0D0D0E] text-[20px] font-medium">Weight: <span
                                                                    class="text-[#7B85A3] font-normal ml-1">{{ $item->product->weight ?? '0.786' }}
                                                                    gm</span></span>
                                                        </div>
                                                    </div>

                                                    <!-- Delivery Tag -->
                                                    <div class="flex items-center gap-2 text-[#0D0D0E] text-[20px] mt-auto">
                                                        <div
                                                            class="text-[#09B285] flex items-center justify-center flex-shrink-0 relative">
                                                            <i class="fa-solid fa-certificate text-[28px]"></i>
                                                            <i class="fa-solid fa-check text-white text-[12px] absolute"></i>
                                                        </div>
                                                        <span class="font-light">Express Delivery <span class="font-semibold">in 2
                                                                Days</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div> <!-- End Middle Column -->

                    <!-- Right Column: Price Summary -->
                    <div class="w-full lg:w-[350px] flex-shrink-0">
                        <div class="p-8 bg-white rounded-[10px] shadow-sm sticky top-28 border border-gray-100">
                            <h3 class="font-['Outfit'] font-bold text-[#0D0D0E] text-[18px] mb-8">
                                Price Details ({{ $cartItems->count() }} item)</h3>

                            <div class="space-y-5 mb-8 font-['Outfit']">
                                <div class="flex justify-between text-[#848484] text-[16px]">
                                    <span>Total MRP</span>
                                    <span class="text-[#0D0D0E] font-medium">₹<span id="summary-total-mrp">{{ number_format($totalMrp, 2) }}</span></span>
                                </div>
                                <div class="flex justify-between text-[#848484] text-[16px]">
                                    <span>Discount on MRP</span>
                                    <span class="text-[#09B285] font-medium">-₹<span id="summary-discount">{{ number_format($discount, 2) }}</span></span>
                                </div>
                                <div class="flex justify-between text-[#848484] text-[16px]">
                                    <span>Platform fee</span>
                                    <span class="text-[#0D0D0E] font-medium">₹<span id="summary-platform-fee">{{ number_format($platformFee, 2) }}</span></span>
                                </div>

                                <div class="pt-8 border-t border-gray-100 flex justify-between items-center">
                                    <span class="font-bold text-[20px] text-[#0D0D0E]">Total Amount</span>
                                    <span class="font-bold text-[22px] text-[#0D0D0E]">₹<span id="summary-total-amount">{{ number_format($totalAmount, 2) }}</span></span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.address') }}"
                                class="flex justify-center items-center w-full py-5 rounded-[40px] bg-[#CBA65A] text-white font-['Outfit'] font-normal text-[25px] shadow-sm hover:opacity-95 transition-all">
                                Place Order
                            </a>

                            <p class="text-center text-[12px] text-[#848484] mt-5 font-['Outfit']">Secure payment options
                                available</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const masterCheckbox = document.getElementById('master-checkbox');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const selectedCountField = document.getElementById('selected-count');
            const summaryTotalMrp = document.getElementById('summary-total-mrp');
            const summaryDiscount = document.getElementById('summary-discount');
            const summaryPlatformFee = document.getElementById('summary-platform-fee');
            const summaryTotalAmount = document.getElementById('summary-total-amount');

            function updateSummary() {
                let totalMrp = 0;
                let totalDiscount = 0;
                let totalAmount = 0;
                let selectedCount = 0;

                itemCheckboxes.forEach(cb => {
                    if (cb.classList.contains('bg-[#CBA65A]')) {
                        totalMrp += parseFloat(cb.dataset.mrp);
                        totalDiscount += parseFloat(cb.dataset.discount);
                        totalAmount += parseFloat(cb.dataset.total);
                        selectedCount++;
                    }
                });

                const platformFee = selectedCount > 0 ? 20 : 0;
                const finalAmount = totalAmount + platformFee;

                summaryTotalMrp.innerText = totalMrp.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                summaryDiscount.innerText = totalDiscount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                summaryPlatformFee.innerText = platformFee.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                summaryTotalAmount.innerText = finalAmount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                selectedCountField.innerText = selectedCount;

                // Update Remove Button State
                const removeSelectedBtn = document.getElementById('remove-selected-btn');
                if (selectedCount > 0) {
                    removeSelectedBtn.classList.remove('opacity-40', 'pointer-events-none');
                    removeSelectedBtn.classList.add('cursor-pointer');
                } else {
                    removeSelectedBtn.classList.add('opacity-40', 'pointer-events-none');
                    removeSelectedBtn.classList.remove('cursor-pointer');
                }

                // Update Master Checkbox State
                if (selectedCount === itemCheckboxes.length) {
                    masterCheckbox.classList.add('bg-[#CBA65A]');
                    masterCheckbox.classList.remove('bg-white');
                    masterCheckbox.querySelector('i').classList.remove('hidden');
                } else if (selectedCount === 0) {
                    masterCheckbox.classList.remove('bg-[#CBA65A]');
                    masterCheckbox.classList.add('bg-white');
                    masterCheckbox.querySelector('i').classList.add('hidden');
                } else {
                    masterCheckbox.classList.remove('bg-[#CBA65A]');
                    masterCheckbox.classList.add('bg-white');
                    masterCheckbox.querySelector('i').classList.add('hidden');
                }
            }

            masterCheckbox.addEventListener('click', function() {
                const isSelected = this.classList.contains('bg-[#CBA65A]');
                itemCheckboxes.forEach(cb => {
                    if (isSelected) {
                        cb.classList.remove('bg-[#CBA65A]');
                        cb.classList.add('bg-white');
                        cb.querySelector('i').classList.add('hidden');
                    } else {
                        cb.classList.add('bg-[#CBA65A]');
                        cb.classList.remove('bg-white');
                        cb.querySelector('i').classList.remove('hidden');
                    }
                });
                updateSummary();
            });

            itemCheckboxes.forEach(cb => {
                cb.addEventListener('click', function() {
                    this.classList.toggle('bg-[#CBA65A]');
                    this.classList.toggle('bg-white');
                    this.querySelector('i').classList.toggle('hidden');
                    updateSummary();
                });
            });

            const removeSelectedBtn = document.getElementById('remove-selected-btn');
            removeSelectedBtn.addEventListener('click', function() {
                const selectedIds = Array.from(itemCheckboxes)
                    .filter(cb => cb.classList.contains('bg-[#CBA65A]'))
                    .map(cb => cb.dataset.id);

                if (selectedIds.length === 0) {
                    return;
                }

                if (confirm('Are you sure you want to remove the selected items?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("cart.bulk-destroy") }}';

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';

                    form.appendChild(csrf);
                    form.appendChild(method);

                    selectedIds.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            });

            // Initialize summary on load
            updateSummary();
        });

        function updateCartQuantity(select, itemId) {
            const qty = select.value;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/cart/${itemId}`;

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'PATCH';

            const quantity = document.createElement('input');
            quantity.type = 'hidden';
            quantity.name = 'quantity';
            quantity.value = qty;

            form.appendChild(csrf);
            form.appendChild(method);
            form.appendChild(quantity);
            document.body.appendChild(form);
            form.submit();
        }
    </script>



    <!-- Similar Jewellery Product Section -->
    <!-- <section class="max-w-[1920px] mx-auto px-4 py-12 font-Outfit">
                                    <div class="flex items-center justify-center gap-2 md:gap-6 mb-8 w-full">
                                        <img src="{{ asset('assets/Design.png') }}"
                                            class="h-auto w-[70px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
                                        <div class="text-center flex flex-col items-center">
                                            <p style="font-family: 'Alexandria', sans-serif;"
                                                class="text-[15px] min-[2000px]:text-xl text-[#5C4522] font-bold font-['Alexandria'] mb-[-5px]">
                                                Similar</p>
                                            <h2
                                                class="font-['Outfit'] font-medium text-[28px] md:text-[40px] min-[2000px]:text-5xl leading-tight md:leading-[50px] min-[2000px]:leading-[1.2] text-[#CBA65A]">
                                                Jewellery Product</h2>
                                        </div>
                                        <img src="{{ asset('assets/Design (1).png') }}"
                                            class="h-auto w-[60px] md:w-auto md:flex-1 object-cover md:max-w-[400px]" alt="">
                                    </div>
                                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

                                        <div
                                            class="lg:col-span-1 bg-[#111111] h-full w-full rounded-2xl p-2 flex flex-col items-center justify-between text-center relative overflow-hidden">
                                            <img src="{{ asset('assets/neckless.png') }}" alt="Necklace"
                                                class="w-full h-full object-contain object-center">
                                        </div>


                                        <div class="lg:col-span-4 grid grid-cols-2 md:grid-cols-4 gap-5 content-start">

                                            <div class="flex flex-col gap-3">
                                                <div
                                                    class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                                                    <span
                                                        class="absolute font-['Alexandria'] font-light top-2 right-0 w-[65px] h-[20px] bg-[#C34A37] rounded-l-[100px] flex items-center justify-center text-white text-[10px] z-10 tracking-wide shadow-sm">Best
                                                        Seller</span>
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        {{-- No Fallback Image --}}
                                                    </div>
                                                </div>
                                                <div class="text-center font-['Outfit']">
                                                    <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage Ring</h3>
                                                    <div class="flex items-center justify-center gap-2 text-xs">
                                                        <span class="font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
                                                        <span class="text-[#999999] line-through">₹ 949.00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex flex-col gap-3">
                                                <div
                                                    class="bg-[#FDFBF7] box-border relative w-full aspect-square max-w-[300px] border border-[#D7D7DA] rounded-[14px] group transition-all overflow-hidden">
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        {{-- No Fallback Image --}}
                                                    </div>
                                                </div>
                                                <div class="text-center font-['Outfit']">
                                                    <h3 class="text-sm font-['outfit'] text-[#1A1A1A] mb-1">Twist Cross Cage Ring</h3>
                                                    <div class="flex items-center justify-center gap-2 text-xs">
                                                        <span class="font-['outfit'] text-[#1A1A1A]">₹ 949.00</span>
                                                        <span class="text-[#999999] line-through">₹ 949.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section> -->

    <!-- Know More Section -->
    <div class="flex flex-row justify-center items-center py-[14px] px-[8px] gap-[10px] w-full h-[56px] bg-[#E9D3D6]">
        <span class="font-['Outfit'] text-[16px] text-[#0D0D0E] font-medium">Know More About Tattsvi</span>
    </div>
@endsection