{{-- Avisos de sesión (éxito / error). Se muestra solo si hay algo que mostrar. --}}
@if (session('ok'))
    <div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-2 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
        {{ session('ok') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-300">
        {{ session('error') }}
    </div>
@endif
