<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Jewelry Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
        /* Import Google Fonts dynamically - MUST BE FIRST */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;700&family=Inter:wght@400;700&family=Roboto:wght@400;700&family=Lato:wght@400;700&family=Open+Sans:wght@400;700&family=Montserrat:wght@400;700&family=Merriweather:wght@400;700&family=Nunito:wght@400;700&family=Raleway:wght@400;700&display=swap');

        /* Dynamic Theme Variables */
        :root {
            --color-primary: {{ $settings->primary_color ?? '#ffbf00' }};
            --color-secondary: {{ $settings->secondary_color ?? '#000000' }};
            --color-header: {{ $settings->header_color ?? '#ffffff' }};
            --font-family: '{{ $settings->font_family ?? 'Cinzel' }}', serif;
        }
        
        [x-cloak] { display: none !important; }

        /* SMART OVERRIDES FOR DYNAMIC THEME */
        :root {
            /* Define a light variant for backgrounds (10% opacity) */
            --color-primary-light: {{ $settings->primary_color ?? '#ffbf00' }}1a; 
        }

        /* Text - Force all amber text to Primary */
        .text-amber-50, .text-amber-100, .text-amber-200, .text-amber-300, 
        .text-amber-400, .text-amber-500, .text-amber-600, .text-amber-700, 
        .text-amber-800, .text-amber-900 {
            color: var(--color-primary) !important;
        }

        /* Backgrounds - Light shades use opacity, Dark shades use solid */
        .bg-amber-50, .bg-amber-100 {
            background-color: var(--color-primary-light) !important;
        }
        .bg-amber-200, .bg-amber-300, .bg-amber-400, .bg-amber-500, 
        .bg-amber-600, .bg-amber-700, .bg-amber-800, .bg-amber-900 {
            background-color: var(--color-primary) !important;
        }
        
        /* Borders */
        .border-amber-100, .border-amber-200, .border-amber-300,
        .border-amber-400, .border-amber-500, .border-amber-600 {
            border-color: var(--color-primary) !important;
        }

        /* Form Effects */
        .focus\:ring-amber-500:focus {
            --tw-ring-color: var(--color-primary) !important;
            outline: none !important;
        }

        /* Premium Utilities */
        .glass-premium {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .font-premium {
            font-family: var(--font-family);
        }
        .font-heading {
            font-family: var(--font-family);
        }
        
        /* Premium Button - Dynamic */
        .btn-gold {
            background-color: #ffbf00; /* Fallback */
            background-color: var(--color-primary) !important;
            color: #000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            filter: brightness(1.1);
            background-color: var(--color-primary) !important; /* Ensure hover keeps color */
        }

        /* DATATABLES RESTYLING for Premium Theme */
        .dataTables_wrapper {
            padding: 1.5rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border: 1px solid #f4f4f5;
            font-family: 'Inter', sans-serif;
            position: relative;
        }
        
        /* Header Controls (Length & Search) - Right Aligned by default */
        .dataTables_wrapper .dataTables_length {
            float: right !important;
            margin-left: 1rem;
            margin-bottom: 1rem;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right !important;
            margin-bottom: 1rem;
        }
        
        /* Mobile Responsiveness for DataTables Controls */
        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left;
                margin-left: 0;
                margin-bottom: 0.5rem;
                width: 100%;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100%; /* Full width search on mobile */
                margin-left: 0;
                margin-top: 0.25rem;
                min-width: 0; /* Override the desktop min-width */
            }
            .dataTables_wrapper {
                padding: 1rem; /* Slightly less padding on mobile */
            }
        }
        
        /* Header Controls Styling */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e4e4e7;
            border-radius: 0.5rem;
            padding: 0.4rem 2rem 0.4rem 0.8rem;
            background-color: #fcfcfc;
            font-size: 0.875rem;
            cursor: pointer;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e4e4e7;
            border-radius: 0.5rem;
            padding: 0.4rem 1rem;
            margin-left: 0.5rem;
            outline: none;
            transition: all 0.2s;
            font-size: 0.875rem;
            min-width: 250px;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(255, 191, 0, 0.1);
        }

        /* Clear floats for header */
        .dataTables_wrapper .dataTables_length:after,
        .dataTables_wrapper .dataTables_filter:after {
            content: "";
            clear: both;
        }

        /* Table Styling */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e4e4e7;
            margin-bottom: 1rem;
            clear: both; /* Ensure table sits below floated header controls */
            width: 100% !important;
        }
        table.dataTable thead th {
            border-bottom: 2px solid var(--color-primary);
            color: #18181b;
            font-weight: 700;
            padding: 1rem;
            white-space: nowrap;
            background-color: #fafafa;
        }
        table.dataTable tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f4f4f5;
            color: #3f3f46;
            vertical-align: middle;
        }
        
        /* DataTables Footer Alignment */
        .dataTables_wrapper .dataTables_info {
            float: left;
            padding-top: 0.85em;
            color: #71717a;
            font-size: 0.875rem;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            padding-top: 0.25em;
        }
        
        /* Clear floats */
        .dataTables_wrapper:after {
            content: "";
            display: block;
            clear: both;
        }

        /* Pagination Buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--color-primary) !important;
            color: #000 !important;
            border: 1px solid var(--color-primary) !important;
            border-radius: 0.5rem;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f4f4f5 !important;
            color: #000 !important;
            border: 1px solid #e4e4e7 !important;
            border-radius: 0.5rem;
        }
    </style>

    {{-- jQuery & DataTables JS --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
</head>

<body x-data="{ sidebarOpen: window.innerWidth >= 768 }"
    class="h-screen bg-zinc-50/50 text-zinc-800 font-sans antialiased selection:bg-amber-500 selection:text-black overflow-hidden relative">
    
    {{-- Mobile Sidebar Backdrop --}}
    <div x-show="sidebarOpen && window.innerWidth < 768" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-50 md:hidden glass-premium"
         style="backdrop-filter: blur(4px);">
    </div>

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    <div :class="{ 'md:ml-64': sidebarOpen }" class="flex flex-col min-w-0 h-screen overflow-hidden relative transition-all duration-300 ease-in-out">
        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Main Content --}}
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('admin.partials.footer')
    </div>

    {{-- Stack for Page Specific Scripts --}}
    @stack('scripts')
</body>

</html>