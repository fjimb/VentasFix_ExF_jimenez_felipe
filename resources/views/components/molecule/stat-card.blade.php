@props([
    'rotulo',
    'valor',
    'href' => null,
])

{{-- Tarjeta de cifra para el tablero. Si recibe href, es un enlace. --}}
@php
    $clases = 'block rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition-colors dark:border-slate-800 dark:bg-slate-900';
    $etiqueta = $href ? 'a' : 'div';
@endphp

<{{ $etiqueta }}
    @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class($clases . ($href ? ' hover:border-brand-500' : '')) }}
>
    <p class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ $rotulo }}</p>
    <p class="mt-1 text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-100">{{ $valor }}</p>
</{{ $etiqueta }}>
