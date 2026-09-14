@extends('layout')

@section('titulo', 'Detalle de producto')

@section('contenido')

    <x-molecule.page-header :titulo="$producto->nombre">
        <x-slot:acciones>
            <x-atom.button :href="route('productos.edit', $producto)">Editar</x-atom.button>
            <x-atom.button :href="route('productos.index')" variant="ghost">Volver</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <div class="mb-4">
        <img src="{{ asset('storage/'.$producto->imagen) }}"
             alt="{{ $producto->nombre }}"
             class="h-48 w-48 rounded-lg border border-slate-200 object-cover dark:border-slate-800">
    </div>

    <x-organism.ficha>
        <x-molecule.dato label="ID">{{ $producto->id }}</x-molecule.dato>
        <x-molecule.dato label="SKU">{{ $producto->sku }}</x-molecule.dato>
        <x-molecule.dato label="Descripción corta">{{ $producto->descripcion_corta }}</x-molecule.dato>
        <x-molecule.dato label="Descripción larga">{{ $producto->descripcion_larga }}</x-molecule.dato>
        <x-molecule.dato label="Precio neto">${{ number_format($producto->precio_neto, 0, ',', '.') }}</x-molecule.dato>
        <x-molecule.dato label="Precio de venta (IVA incluido)">${{ number_format($producto->precio_de_venta, 0, ',', '.') }}</x-molecule.dato>
        <x-molecule.dato label="Stock actual">{{ $producto->stock_actual }}</x-molecule.dato>
        <x-molecule.dato label="Stock mínimo / bajo / alto">{{ $producto->stock_minimo }} / {{ $producto->stock_bajo }} / {{ $producto->stock_alto }}</x-molecule.dato>
    </x-organism.ficha>

@endsection
