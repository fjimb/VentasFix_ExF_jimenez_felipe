@props(['href', 'active' => false])

{{-- Enlace de navegación con estado activo. Uso: <x-atom.nav-link :href="..." :active="request()->routeIs('...')">Texto</x-atom.nav-link> --}}
<a
    href="{{ $href }}"
    {{ $attributes->class([
        'block rounded-md px-3 py-2 text-sm transition-colors',
        'bg-brand-600 text-white font-medium' => $active,
        'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' => ! $active,
    ]) }}
>
    {{ $slot }}
</a>
