@extends('layout')

@section('titulo', 'Editar cliente')

@section('contenido')

    <x-molecule.page-header titulo="Editar cliente" />

    <x-organism.formulario :action="route('clientes.update', $cliente)" method="PUT" :cancelar="route('clientes.index')">
        <x-molecule.campo name="rut_empresa" label="RUT empresa" :value="$cliente->rut_empresa" required />
        <x-molecule.campo name="razon_social" label="Razón social" :value="$cliente->razon_social" required />
        <x-molecule.campo name="rubro" label="Rubro" :value="$cliente->rubro" />
        <x-molecule.campo name="telefono" label="Teléfono" maxlength="20" :value="$cliente->telefono" />
        <x-molecule.campo name="direccion" label="Dirección" :value="$cliente->direccion" />
        <x-molecule.campo name="nombre_contacto" label="Nombre del contacto" :value="$cliente->nombre_contacto" />
        <x-molecule.campo name="email_contacto" label="Email del contacto" type="email" :value="$cliente->email_contacto" />
    </x-organism.formulario>

@endsection
