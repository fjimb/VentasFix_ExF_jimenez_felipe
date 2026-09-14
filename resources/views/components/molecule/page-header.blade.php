@props(['titulo'])

{{-- Encabezado de página: título a la izquierda, acciones opcionales a la derecha.
     Uso: <x-molecule.page-header titulo="Usuarios"><x-slot:acciones>...</x-slot:acciones></x-molecule.page-header> --}}
<div class="mb-6 flex flex-wrap items-center gap-4">
    <h1 class="flex-1 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
        {{ $titulo }}
    </h1>

    @isset($acciones)
        <div class="flex items-center gap-2">
            {{ $acciones }}
        </div>
    @endisset
</div>
