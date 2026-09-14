{{-- Ficha de detalle: tarjeta con una grilla de pares etiqueta/valor.
     Los pares van por el slot (usa <x-molecule.dato>). --}}
<dl {{ $attributes->class('grid grid-cols-1 gap-x-8 gap-y-4 rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:grid-cols-2 dark:border-slate-800 dark:bg-slate-900') }}>
    {{ $slot }}
</dl>
