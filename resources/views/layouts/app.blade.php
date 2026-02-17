<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Shipment Tracker') - Shipment Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ route('shipments.index') }}" class="text-xl font-bold hover:text-blue-100 transition">
                 Shipment Tracker
            </a>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>