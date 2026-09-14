<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'VentasFix')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased dark:bg-slate-950 dark:text-slate-100">

    <div class="flex min-h-screen">
        <x-organism.sidebar />

        <main class="flex-1 px-8 py-6">
            <div class="mx-auto max-w-5xl">
                <x-molecule.flash />

                @yield('contenido')
            </div>
        </main>
    </div>

</body>
</html>
