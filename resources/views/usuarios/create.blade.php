@extends('layout')

@section('titulo', 'Nuevo usuario')

@section('contenido')

    <x-molecule.page-header titulo="Nuevo usuario" />

    <x-organism.formulario :action="route('usuarios.store')" :cancelar="route('usuarios.index')">
        <x-molecule.campo name="rut" label="RUT" required />
        <x-molecule.campo name="nombre" label="Nombre" required />
        <x-molecule.campo name="apellido" label="Apellido" required />
        <x-molecule.campo name="email" label="Email" type="email" required />
        <x-molecule.campo name="password" label="Contraseña" type="password" required />
        <x-molecule.campo name="password_confirmation" label="Confirmar contraseña" type="password" />
    </x-organism.formulario>

@endsection
