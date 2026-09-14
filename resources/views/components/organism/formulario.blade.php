@props([
    'action',
    'method' => 'POST',
    'enctype' => null,
    'cancelar' => null,
    'submit' => 'Guardar',
])

{{-- Tarjeta de formulario: card + <form> + @csrf + method spoofing + acciones.
     Los campos van por el slot (usa <x-molecule.campo>). --}}
@php
    $metodo = strtoupper($method);
    $spoof = ! in_array($metodo, ['GET', 'POST'], true);
@endphp

<form
    action="{{ $action }}"
    method="{{ $spoof ? 'POST' : $metodo }}"
    @if ($enctype) enctype="{{ $enctype }}" @endif
    {{ $attributes->class('max-w-xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900') }}
>
    @csrf
    @if ($spoof)
        @method($method)
    @endif

    {{ $slot }}

    <div class="mt-6 flex items-center gap-3">
        <x-atom.button type="submit">{{ $submit }}</x-atom.button>
        @if ($cancelar)
            <x-atom.button :href="$cancelar" variant="ghost">Cancelar</x-atom.button>
        @endif
    </div>
</form>
