<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Lato', sans-serif;
        }

        .gold-text {
            color: #d4af37;
        }

        .gold-border {
            border-color: #d4af37;
        }

        .gold-bg {
            background-color: #d4af37;
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #aa8c2c 100%);
            color: white;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #edc95e 0%, #d4af37 100%);
        }

        .dark-bg {
            background-color: #0f172a;
        }

        /* Slate 900 */
        .input-dark {
            background: #1e293b;
            /* Slate 800 */
            border: 1px solid #334155;
            color: #f8fafc;
        }

        .input-dark:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 1px #d4af37;
            outline: none;
        }

        .glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900">
    {{ $slot }}
</body>

</html>