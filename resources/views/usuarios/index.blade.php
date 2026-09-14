@extends('layout')

@section('titulo', 'Usuarios')

@section('contenido')

    <x-molecule.page-header titulo="Usuarios">
        <x-slot:acciones>
            <x-atom.button :href="route('usuarios.create')">Nuevo usuario</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <x-organism.tabla :cabeceras="['RUT', 'Nombre', 'Email', 'Acciones']">
        @forelse ($usuarios as $usuario)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                <td class="celda">{{ $usuario->rut }}</td>
                <td class="celda">{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                <td class="celda">{{ $usuario->email }}</td>
                <td class="celda">
                    <x-molecule.acciones
                        :show="route('usuarios.show', $usuario)"
                        :edit="route('usuarios.edit', $usuario)"
                        :destroy="route('usuarios.destroy', $usuario)"
                        confirmar="¿Eliminar este usuario?"
                    />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="celda text-center text-slate-500">No hay usuarios registrados.</td>
            </tr>
        @endforelse
    </x-organism.tabla>

    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>

@endsection
