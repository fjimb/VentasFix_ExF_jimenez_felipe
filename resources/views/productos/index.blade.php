@extends('layout')

@section('titulo', 'Productos')

@section('contenido')

<div class="mb-4 flex items-center justify-between">
    <h1 class="text-2xl font-bold">Productos</h1>
    <a href="{{ route('productos.create') }}"
       class="rounded bg-blue-600 px-4 py-2 text-white">Nuevo producto</a>
</div>

<table class="w-full bg-white text-left">
    <thead class="border-b">
        <tr>
            <th class="p-3">Imagen</th>
            <th class="p-3">SKU</th>
            <th class="p-3">Nombre</th>
            <th class="p-3">Precio venta</th>
            <th class="p-3">Stock</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($productos as $producto)
            <tr class="border-b">
                <td class="p-3">
                    <img src="{{ asset('storage/'.$producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="h-12 w-12 rounded object-cover">
                </td>
                <td class="p-3">{{ $producto->sku }}</td>
                <td class="p-3">{{ $producto->nombre }}</td>
                <td class="p-3">${{ number_format($producto->precio_de_venta, 0, ',', '.') }}</td>
                <td class="p-3">
                    <span @class([
                        'rounded px-2 py-1 text-sm',
                        'bg-red-100 text-red-800' => $producto->stock_actual <= $producto->stock_minimo,
                        'bg-yellow-100 text-yellow-800' => $producto->stock_actual > $producto->stock_minimo
                            && $producto->stock_actual <= $producto->stock_bajo,
                        'bg-green-100 text-green-800' => $producto->stock_actual > $producto->stock_bajo,
                    ])>
                        {{ $producto->stock_actual }}
                    </span>
                </td>
                <td class="p-3">
                    <a href="{{ route('productos.show', $producto) }}" class="text-gray-700">Ver</a>
                    <a href="{{ route('productos.edit', $producto) }}" class="text-blue-600">Editar</a>

                    <form action="{{ route('productos.destroy', $producto) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('¿Eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-500">
                    No hay productos registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $productos->links() }}
</div>

@endsection