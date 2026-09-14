@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'ayuda' => null,
    'required' => false,
    'rows' => 4,
])

{{-- Campo de formulario: label + control + ayuda + error.
     type admite text/email/password/number/file/textarea.
     Atributos extra (min, maxlength, accept, step, placeholder…) se pasan al control. --}}
@php
    $val = old($name, $value);
    $hasError = $errors->has($name);
    $control = $attributes->class([
        'w-full rounded-md border px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500 bg-white text-slate-900 placeholder-slate-400 dark:bg-slate-800 dark:text-slate-100',
        'border-red-400' => $hasError,
        'border-slate-300 dark:border-slate-600' => ! $hasError,
    ]);
@endphp

<div class="mb-4">
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-200">
        {{ $label }}@if ($required)<span class="ml-0.5 text-red-500">*</span>@endif
    </label>

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" {{ $control }}>{{ $val }}</textarea>
    @elseif ($type === 'file')
        <input type="file" name="{{ $name }}" id="{{ $name }}" {{ $control }}>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $val }}" {{ $control }}>
    @endif

    @if ($ayuda)
        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $ayuda }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
