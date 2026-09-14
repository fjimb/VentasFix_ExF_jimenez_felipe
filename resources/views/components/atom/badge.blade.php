@props(['color' => 'gray'])

{{-- Insignia/etiqueta pequeña. color: gray | green | yellow | red | brand --}}
@php
    $map = [
        'gray'   => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300',
        'green'  => 'bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-300',
        'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-950 dark:text-yellow-300',
        'red'    => 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300',
        'brand'  => 'bg-brand-50 text-brand-700 dark:bg-brand-700 dark:text-brand-50',
    ];
@endphp

<span {{ $attributes->class('inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ' . ($map[$color] ?? $map['gray'])) }}>
    {{ $slot }}
</span>
