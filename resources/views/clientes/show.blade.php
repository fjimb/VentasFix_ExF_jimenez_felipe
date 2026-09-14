@extends('layout')

@section('titulo', 'Detalle de cliente')

@section('contenido')

    <x-molecule.page-header :titulo="$cliente->razon_social">
        <x-slot:acciones>
            <x-atom.button :href="route('clientes.edit', $cliente)">Editar</x-atom.button>
            <x-atom.button :href="route('clientes.index')" variant="ghost">Volver</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <x-organism.ficha>
        <x-molecule.dato label="ID">{{ $cliente->id }}</x-molecule.dato>
        <x-molecule.dato label="RUT empresa">{{ $cliente->rut_empresa }}</x-molecule.dato>
        <x-molecule.dato label="Razón social">{{ $cliente->razon_social }}</x-molecule.dato>
        <x-molecule.dato label="Rubro">{{ $cliente->rubro }}</x-molecule.dato>
        <x-molecule.dato label="Teléfono">{{ $cliente->telefono }}</x-molecule.dato>
        <x-molecule.dato label="Dirección">{{ $cliente->direccion }}</x-molecule.dato>
        <x-molecule.dato label="Nombre del contacto">{{ $cliente->nombre_contacto }}</x-molecule.dato>
        <x-molecule.dato label="Email del contacto">{{ $cliente->email_contacto }}</x-molecule.dato>
    </x-organism.ficha>

@endsection
