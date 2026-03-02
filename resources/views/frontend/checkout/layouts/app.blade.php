<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tattsvi - Shopping Bag</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .ticker-wrapper {
            width: 100%;
            overflow: hidden;
            background: #f3dede;
            white-space: nowrap;
        }

        .ticker {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-left 30s linear infinite;
        }

        .ticker span {
            display: inline-block;
            font-family: outfit;
            padding-right: 50px;
            font-size: 14px;
            font-weight: 300;
            color: #6b4b4b;
            letter-spacing: 1px;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Custom Checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: white;
            width: 20px;
            height: 20px;
            border: 2px solid #CBA65A;
            border-radius: 4px;
            display: grid;
            place-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .custom-checkbox:checked {
            background-color: #CBA65A;
            border-color: #CBA65A;
        }

        .custom-checkbox::before {
            content: "";
            width: 10px;
            height: 10px;
            transform: scale(0);
            box-shadow: inset 1em 1em white;
            transform-origin: center;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
            transition: 120ms transform ease-in-out;
        }

        .custom-checkbox:checked::before {
            transform: scale(1);
        }

        /* Custom Radio (Square like checkbox) */
        .custom-radio {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #D1D5DB;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            display: grid;
            place-content: center;
        }

        .custom-radio:checked {
            border-color: #CBA65A;
            background-color: #CBA65A;
        }

        .custom-radio:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 12px;
        }

        /* Custom Checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #D1D5DB;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            position: relative;
            display: grid;
            place-content: center;
        }

        .custom-checkbox:checked {
            border-color: #CBA65A;
            background-color: #CBA65A;
        }

        .custom-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 12px;
        }

        /* Custom Input */
        .custom-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E5E7EB;
            border-radius: 6px;
            font-size: 14px;
            color: #374151;
            outline: none;
            transition: border-color 0.2s;
        }

        .custom-input:focus {
            border-color: #CBA65A;
        }

        .custom-input::placeholder {
            color: #9CA3AF;
        }

        /* Bank Logo Circle */
        .bank-logo-circle {
            width: 40px;
            height: 40px;
            background-color: #F3F4F6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hide scrollbar for cleaner look */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#FDFBF7] text-gray-800">

    @include('frontend.checkout.partials.header', ['activeStep' => $activeStep ?? ''])

    @yield('content')

    @include('frontend.partials.footer')

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-[60] hidden transition-opacity opacity-0"></div>
    <div id="mobile-menu-sidebar"
        class="fixed top-0 left-0 w-[85%] max-w-[320px] h-full bg-white z-[70] transform -translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
        <!-- Header -->
        <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-cream">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 flex items-center justify-center">
                    <img src="{{ asset('assets/logo.png') }}" alt="logo">
                </div>
                <span class="serif text-xl tracking-tighter">TATTSVI</span>
            </div>
            <button id="close-menu-btn"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-red-500 shadow-sm transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        @include('frontend.partials.mobile-menu')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Toast Session Message Handlers ---
            @if (session('success'))
                if (window.showToast) window.showToast("{{ session('success') }}", "success");
            @endif

            @if (session('error'))
                if (window.showToast) window.showToast("{{ session('error') }}", "error");
            @endif

            @if (session('info'))
                if (window.showToast) window.showToast("{{ session('info') }}", "info");
            @endif

            @if (session('warning'))
                if (window.showToast) window.showToast("{{ session('warning') }}", "warning");
            @endif
        });
    </script>
</body>

</html>