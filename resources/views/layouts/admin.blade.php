<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Jewelry Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-zinc-50 text-zinc-800 font-sans antialiased">
    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Main Content --}}
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('admin.partials.footer')
    </div>
</body>

</html>