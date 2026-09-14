@extends('layout')

@section('titulo', 'Detalle de usuario')

@section('contenido')

    <x-molecule.page-header :titulo="$user->nombre . ' ' . $user->apellido">
        <x-slot:acciones>
            <x-atom.button :href="route('usuarios.edit', $user)">Editar</x-atom.button>
            <x-atom.button :href="route('usuarios.index')" variant="ghost">Volver</x-atom.button>
        </x-slot:acciones>
    </x-molecule.page-header>

    <x-organism.ficha>
        <x-molecule.dato label="ID">{{ $user->id }}</x-molecule.dato>
        <x-molecule.dato label="RUT">{{ $user->rut }}</x-molecule.dato>
        <x-molecule.dato label="Nombre">{{ $user->nombre }}</x-molecule.dato>
        <x-molecule.dato label="Apellido">{{ $user->apellido }}</x-molecule.dato>
        <x-molecule.dato label="Email">{{ $user->email }}</x-molecule.dato>
        <x-molecule.dato label="Fecha de creación">{{ $user->created_at->format('d/m/Y H:i') }}</x-molecule.dato>
    </x-organism.ficha>

@endsection
