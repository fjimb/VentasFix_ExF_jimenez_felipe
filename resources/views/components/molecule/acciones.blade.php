@props([
    'show' => null,
    'edit' => null,
    'destroy' => null,
    'confirmar' => '¿Eliminar este registro?',
])

{{-- Grupo de acciones de fila: Ver / Editar / Eliminar (con confirmación). --}}
<div class="flex items-center gap-3 text-sm">
    @if ($show)
        <a href="{{ $show }}" class="text-slate-600 hover:underline dark:text-slate-300">Ver</a>
    @endif

    @if ($edit)
        <a href="{{ $edit }}" class="text-brand-600 hover:underline">Editar</a>
    @endif

    @if ($destroy)
        <form action="{{ $destroy }}" method="POST" onsubmit="return confirm('{{ $confirmar }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
        </form>
    @endif
</div>
