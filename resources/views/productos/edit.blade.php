@extends('layout')

@section('titulo', 'Editar producto')

@section('contenido')

    <x-molecule.page-header titulo="Editar producto" />

    <x-organism.formulario
        :action="route('productos.update', $producto)"
        method="PUT"
        enctype="multipart/form-data"
        :cancelar="route('productos.index')"
    >
        <x-molecule.campo name="sku" label="SKU" :value="$producto->sku" required />
        <x-molecule.campo name="nombre" label="Nombre" :value="$producto->nombre" required />
        <x-molecule.campo name="descripcion_corta" label="Descripción corta" maxlength="250" :value="$producto->descripcion_corta" />
        <x-molecule.campo name="descripcion_larga" label="Descripción larga" type="textarea" :value="$producto->descripcion_larga" />

        <div class="mb-4">
            <span class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-200">Imagen actual</span>
            <img src="{{ asset('storage/'.$producto->imagen) }}"
                 alt="{{ $producto->nombre }}"
                 class="mb-2 h-24 w-24 rounded object-cover">
        </div>

        <x-molecule.campo name="imagen" label="Reemplazar imagen" type="file" accept="image/*" ayuda="Deja este campo vacío para conservar la imagen actual." />
        <x-molecule.campo name="precio_neto" label="Precio neto" type="number" min="1" :value="$producto->precio_neto" ayuda="El precio de venta se calcula agregando el 19% de IVA." required />
        <x-molecule.campo name="stock_minimo" label="Stock mínimo" type="number" min="0" :value="$producto->stock_minimo" required />
        <x-molecule.campo name="stock_bajo" label="Stock bajo" type="number" min="0" :value="$producto->stock_bajo" required />
        <x-molecule.campo name="stock_alto" label="Stock alto" type="number" min="0" :value="$producto->stock_alto" required />
        <x-molecule.campo name="stock_actual" label="Stock actual" type="number" min="0" :value="$producto->stock_actual" required />
    </x-organism.formulario>

@endsection
