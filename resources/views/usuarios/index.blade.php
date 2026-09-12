@extends('layout')

@section('titulo', 'usuarios')

@section('contenido')

<div class="mb-4 flex items-center justify-between">
    <h1 class="text-2x1 font-bold">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white">Nuevo usuario</a>
</div>

<table class="w-full bg-white text-left">
    <thead class="border-b">
        <tr>
            <th class="p-3">RUT</th>
            <th class="p-3">Nombre</th>
            <th class="p-3">Email</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($usuarios as $usuario)
            <tr class="border-b">
                <td class="p-3">{{ $usuario->rut }}</td>
                <td class="p-3">{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                <td class="p-3">{{ $usuario->email}}</td>
                <td class="p-3">
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-600">Editar</a>

                    <form action="{{ route('usuarios.destroy', $usuario) }}" 
                            method="POST" class="inline"
                            onsubmit="return confirm('¿Eliminar este usuario?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-6 text-center text-gray-500">
                    No hay usuarios registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $usuarios->links() }}
</div>

@endsection