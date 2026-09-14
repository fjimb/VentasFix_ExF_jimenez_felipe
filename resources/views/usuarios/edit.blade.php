@extends('layout')

@section('titulo', 'Editar usuario')

@section('contenido')

    <x-molecule.page-header titulo="Editar usuario" />

    <x-organism.formulario :action="route('usuarios.update', $user)" method="PUT" :cancelar="route('usuarios.index')">
        <x-molecule.campo name="rut" label="RUT" :value="$user->rut" required />
        <x-molecule.campo name="nombre" label="Nombre" :value="$user->nombre" required />
        <x-molecule.campo name="apellido" label="Apellido" :value="$user->apellido" required />
        <x-molecule.campo name="email" label="Email" type="email" :value="$user->email" required />
        <x-molecule.campo name="password" label="Contraseña" type="password" ayuda="Déjala en blanco para conservar la actual." />
        <x-molecule.campo name="password_confirmation" label="Confirmar contraseña" type="password" />
    </x-organism.formulario>

@endsection
