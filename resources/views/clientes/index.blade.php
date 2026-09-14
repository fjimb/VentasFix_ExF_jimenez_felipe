@extends('layout')

@section('titulo', 'Clientes')

@section('contenido')

    <x-molecule.page-header titulo="Clientes">
        <x-slot:acciones>
            <x-atom.button :href="route('clientes.create')">Nuevo cliente</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <x-organism.tabla :cabeceras="['RUT empresa', 'Razón social', 'Rubro', 'Contacto', 'Acciones']">
        @forelse ($clientes as $cliente)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                <td class="celda">{{ $cliente->rut_empresa }}</td>
                <td class="celda">{{ $cliente->razon_social }}</td>
                <td class="celda">{{ $cliente->rubro }}</td>
                <td class="celda">{{ $cliente->nombre_contacto }}</td>
                <td class="celda">
                    <x-molecule.acciones
                        :show="route('clientes.show', $cliente)"
                        :edit="route('clientes.edit', $cliente)"
                        :destroy="route('clientes.destroy', $cliente)"
                        confirmar="¿Eliminar este cliente?"
                    />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="celda text-center text-slate-500">No hay clientes registrados.</td>
            </tr>
        @endforelse
    </x-organism.tabla>

    <div class="mt-4">
        {{ $clientes->links() }}
    </div>

@endsection
