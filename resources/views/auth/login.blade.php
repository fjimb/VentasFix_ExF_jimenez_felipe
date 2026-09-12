<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=[device-width], initial-scale=1.0">
    <title>Iniciar sesión — VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
    {{-- formulario de logeo --}}
    <div class="w-full max-w-sm bg-white rounded-lg shadow p-8">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" value="{{ old('email') }}">
            <input type="password" name="password">
            <button type="submit">Entrar</button>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </form>
    </div>
</body>
</html>

