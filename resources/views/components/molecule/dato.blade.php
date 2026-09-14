@props(['label'])

{{-- Par etiqueta/valor para las fichas de detalle (dentro de <x-organism.ficha>). --}}
<div>
    <dt class="text-xs font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ $label }}</dt>
    <dd class="mt-0.5 text-sm text-slate-900 dark:text-slate-100">{{ $slot }}</dd>
</div>
