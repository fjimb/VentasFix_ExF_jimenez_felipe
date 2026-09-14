@extends('layout')

@section('titulo', 'Clientes')

@section('contenido')

<div class="mb-4 flex items-center justify-between">
    <h1 class="text-2xl font-bold">Clientes</h1>
    <a href="{{ route('clientes.create') }}"
       class="rounded bg-blue-600 px-4 py-2 text-white">Nuevo cliente</a>
</div>

<table class="w-full bg-white text-left">
    <thead class="border-b">
        <tr>
            <th class="p-3">RUT empresa</th>
            <th class="p-3">Razón social</th>
            <th class="p-3">Rubro</th>
            <th class="p-3">Contacto</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clientes as $cliente)
            <tr class="border-b">
                <td class="p-3">{{ $cliente->rut_empresa }}</td>
                <td class="p-3">{{ $cliente->razon_social }}</td>
                <td class="p-3">{{ $cliente->rubro }}</td>
                <td class="p-3">{{ $cliente->nombre_contacto }}</td>
                <td class="p-3">
                    <a href="{{ route('clientes.show', $cliente) }}" class="text-gray-700">Ver</a>
                    <a href="{{ route('clientes.edit', $cliente) }}" class="text-blue-600">Editar</a>

                    <form action="{{ route('clientes.destroy', $cliente) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('¿Eliminar este cliente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">
                    No hay clientes registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $clientes->links() }}
</div>

@endsection