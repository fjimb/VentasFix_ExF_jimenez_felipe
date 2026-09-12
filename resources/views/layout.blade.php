<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'VentasFix')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('components.organism.navbar')

    <main class="p-6">
        @if (session('ok'))
            <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">
                {{ session('ok') }}
            </div>
        @endif

        @yield('contenido')
    </main>
    
</body>
</html>