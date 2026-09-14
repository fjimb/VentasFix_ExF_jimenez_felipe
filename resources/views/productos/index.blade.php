@extends('layout')

@section('titulo', 'Productos')

@section('contenido')

    <x-molecule.page-header titulo="Productos">
        <x-slot:acciones>
            <x-atom.button :href="route('productos.create')">Nuevo producto</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <x-organism.tabla :cabeceras="['Imagen', 'SKU', 'Nombre', 'Precio venta', 'Stock', 'Acciones']">
        @forelse ($productos as $producto)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                <td class="celda">
                    <img src="{{ asset('storage/'.$producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="h-12 w-12 rounded object-cover">
                </td>
                <td class="celda">{{ $producto->sku }}</td>
                <td class="celda">{{ $producto->nombre }}</td>
                <td class="celda">${{ number_format($producto->precio_de_venta, 0, ',', '.') }}</td>
                <td class="celda">
                    @php
                        $color = match (true) {
                            $producto->stock_actual <= $producto->stock_minimo => 'red',
                            $producto->stock_actual <= $producto->stock_bajo => 'yellow',
                            default => 'green',
                        };
                    @endphp
                    <x-atom.badge :color="$color">{{ $producto->stock_actual }}</x-atom.badge>
                </td>
                <td class="celda">
                    <x-molecule.acciones
                        :show="route('productos.show', $producto)"
                        :edit="route('productos.edit', $producto)"
                        :destroy="route('productos.destroy', $producto)"
                        confirmar="¿Eliminar este producto?"
                    />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="celda text-center text-slate-500">No hay productos registrados.</td>
            </tr>
        @endforelse
    </x-organism.tabla>

    <div class="mt-4">
        {{ $productos->links() }}
    </div>

@endsection
