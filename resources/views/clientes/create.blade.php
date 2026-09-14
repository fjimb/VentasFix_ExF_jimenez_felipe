@extends('layout')

@section('titulo', 'Nuevo cliente')

@section('contenido')

    <x-molecule.page-header titulo="Nuevo cliente" />

    <x-organism.formulario :action="route('clientes.store')" :cancelar="route('clientes.index')">
        <x-molecule.campo name="rut_empresa" label="RUT empresa" required />
        <x-molecule.campo name="razon_social" label="Razón social" required />
        <x-molecule.campo name="rubro" label="Rubro" />
        <x-molecule.campo name="telefono" label="Teléfono" maxlength="20" />
        <x-molecule.campo name="direccion" label="Dirección" />
        <x-molecule.campo name="nombre_contacto" label="Nombre del contacto" />
        <x-molecule.campo name="email_contacto" label="Email del contacto" type="email" />
    </x-organism.formulario>

@endsection
