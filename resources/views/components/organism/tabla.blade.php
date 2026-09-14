@props(['cabeceras' => []])

{{-- Tabla del backoffice. Dos formas de uso:
     1) Pasando :cabeceras="['RUT','Nombre',...]" y el <tbody> por el slot.
     2) Pasando el <thead> por el slot 'head' y el <tbody> por el slot por defecto.
     Usa las clases .celda en los <td> para un padding consistente (ver más abajo). --}}
<div class="overflow-x-auto rounded-lg border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-400">
            @isset($head)
                {{ $head }}
            @else
                <tr>
                    @foreach ($cabeceras as $cabecera)
                        <th class="px-4 py-3 font-medium">{{ $cabecera }}</th>
                    @endforeach
                </tr>
            @endisset
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700 dark:divide-slate-800 dark:text-slate-300">
            {{ $slot }}
        </tbody>
    </table>
</div>
