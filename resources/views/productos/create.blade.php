@extends('layout')

@section('titulo', 'Nuevo producto')

@section('contenido')

<h1 class="mb-4 text-2xl font-bold">Nuevo producto</h1>

<form action="{{ route('productos.store') }}" method="POST"
      enctype="multipart/form-data" class="max-w-lg">
    @csrf

    <div class="mb-4">
        <label for="sku" class="block mb-1">SKU</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
               class="w-full rounded border p-2">
        @error('sku')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="nombre" class="block mb-1">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
               class="w-full rounded border p-2">
        @error('nombre')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="descripcion_corta" class="block mb-1">Descripción corta</label>
        <input type="text" name="descripcion_corta" id="descripcion_corta"
               maxlength="250" value="{{ old('descripcion_corta') }}"
               class="w-full rounded border p-2">
        @error('descripcion_corta')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="descripcion_larga" class="block mb-1">Descripción larga</label>
        <textarea name="descripcion_larga" id="descripcion_larga" rows="4"
                  class="w-full rounded border p-2">{{ old('descripcion_larga') }}</textarea>
        @error('descripcion_larga')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="imagen" class="block mb-1">Imagen</label>
        <input type="file" name="imagen" id="imagen" accept="image/*"
               class="w-full rounded border p-2">
        <p class="mt-1 text-sm text-gray-500">JPG, PNG o WEBP. Máximo 2 MB.</p>
        @error('imagen')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="precio_neto" class="block mb-1">Precio neto</label>
        <input type="number" name="precio_neto" id="precio_neto" min="1"
               value="{{ old('precio_neto') }}" class="w-full rounded border p-2">
        <p class="mt-1 text-sm text-gray-500">
            El precio de venta se calcula automáticamente agregando el 19% de IVA.
        </p>
        @error('precio_neto')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="stock_minimo" class="block mb-1">Stock mínimo</label>
        <input type="number" name="stock_minimo" id="stock_minimo" min="0"
               value="{{ old('stock_minimo') }}" class="w-full rounded border p-2">
        @error('stock_minimo')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="stock_bajo" class="block mb-1">Stock bajo</label>
        <input type="number" name="stock_bajo" id="stock_bajo" min="0"
               value="{{ old('stock_bajo') }}" class="w-full rounded border p-2">
        @error('stock_bajo')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="stock_alto" class="block mb-1">Stock alto</label>
        <input type="number" name="stock_alto" id="stock_alto" min="0"
               value="{{ old('stock_alto') }}" class="w-full rounded border p-2">
        @error('stock_alto')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="stock_actual" class="block mb-1">Stock actual</label>
        <input type="number" name="stock_actual" id="stock_actual" min="0"
               value="{{ old('stock_actual') }}" class="w-full rounded border p-2">
        @error('stock_actual')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button>
    <a href="{{ route('productos.index') }}" class="ml-2">Cancelar</a>
</form>

@endsection