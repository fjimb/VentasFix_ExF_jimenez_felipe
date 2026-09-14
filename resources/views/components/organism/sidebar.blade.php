{{-- Barra lateral del backoffice. Reemplaza a la navbar superior.
     Inspirada en el layout de ventasfix, con Tailwind y estilo sobrio. --}}
<aside class="flex w-56 shrink-0 flex-col border-r border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="px-5 py-5">
        <a href="{{ route('dashboard') }}" class="block">
            <p class="text-lg font-bold tracking-tight text-slate-900 dark:text-slate-100">VentasFix</p>
            <p class="text-xs uppercase tracking-widest text-slate-400">backoffice</p>
        </a>
    </div>

    <nav class="flex-1 space-y-1 px-3">
        <x-atom.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-atom.nav-link>
        <x-atom.nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')">Usuarios</x-atom.nav-link>
        <x-atom.nav-link :href="route('productos.index')" :active="request()->routeIs('productos.*')">Productos</x-atom.nav-link>
        <x-atom.nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')">Clientes</x-atom.nav-link>
    </nav>

    <div class="border-t border-slate-200 px-5 py-4 dark:border-slate-800">
        <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
            {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}
        </p>
        <p class="mb-3 text-xs text-slate-400">{{ auth()->user()->email }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:text-red-700 hover:underline">
                Cerrar sesión
            </button>
        </form>
    </div>
</aside>
