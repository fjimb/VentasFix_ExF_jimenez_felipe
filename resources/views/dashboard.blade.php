@extends('layout')

@section('titulo', 'Dashboard')

@section('contenido')

<h1 class="mb-6 text-2xl font-bold">Dashboard</h1>

<div class="grid grid-cols-3 gap-4">
    <a href="{{ route('usuarios.index') }}" class="rounded bg-white p-6 shadow">
        <p class="text-sm text-gray-500">Usuarios</p>
        <p class="text-3xl font-bold">{{ $usuarios }}</p>
    </a>

    <div class="rounded bg-white p-6 shadow">
        <p class="text-sm text-gray-500">Productos</p>
        <p class="text-3xl font-bold">{{ $productos }}</p>
    </div>

    <div class="rounded bg-white p-6 shadow">
        <p class="text-sm text-gray-500">Clientes</p>
        <p class="text-3xl font-bold">{{ $clientes }}</p>
    </div>
</div>

@endsection