@extends('layout')

@section('titulo', 'Detalle de producto')

@section('contenido')

<h1 class="mb-6 text-2xl font-bold">{{ $producto->nombre }}</h1>

<div class="max-w-2xl rounded bg-white p-6 shadow">

    <img src="{{ asset('storage/'.$producto->imagen) }}"
         alt="{{ $producto->nombre }}"
         class="mb-6 h-48 w-48 rounded object-cover">

    <dl class="space-y-3">
        <div>
            <dt class="text-sm text-gray-500">ID</dt>
            <dd>{{ $producto->id }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">SKU</dt>
            <dd>{{ $producto->sku }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Descripción corta</dt>
            <dd>{{ $producto->descripcion_corta }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Descripción larga</dt>
            <dd>{{ $producto->descripcion_larga }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Precio neto</dt>
            <dd>${{ number_format($producto->precio_neto, 0, ',', '.') }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Precio de venta (IVA incluido)</dt>
            <dd>${{ number_format($producto->precio_de_venta, 0, ',', '.') }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Stock actual</dt>
            <dd>{{ $producto->stock_actual }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Stock mínimo / bajo / alto</dt>
            <dd>{{ $producto->stock_minimo }} / {{ $producto->stock_bajo }} / {{ $producto->stock_alto }}</dd>
        </div>
    </dl>
</div>

<div class="mt-4">
    <a href="{{ route('productos.edit', $producto) }}"
       class="rounded bg-blue-600 px-4 py-2 text-white">Editar</a>
    <a href="{{ route('productos.index') }}" class="ml-2">Volver</a>
</div>

@endsection