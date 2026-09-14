@extends('layout')

@section('titulo', 'Dashboard')

@section('contenido')

    <x-molecule.page-header titulo="Dashboard" />

    <div class="grid gap-4 sm:grid-cols-3">
        <x-molecule.stat-card rotulo="Usuarios" :valor="$usuarios" :href="route('usuarios.index')" />
        <x-molecule.stat-card rotulo="Productos" :valor="$productos" :href="route('productos.index')" />
        <x-molecule.stat-card rotulo="Clientes" :valor="$clientes" :href="route('clientes.index')" />
    </div>

@endsection
