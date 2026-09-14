@extends('layout')

@section('titulo', 'Detalle de usuario')

@section('contenido')

<h1 class="mb-6 text-2xl font-bold">
    {{ $user->nombre }} {{ $user->apellido }}
</h1>

<div class="max-w-lg rounded bg-white p-6 shadow">
    <dl class="space-y-3">
        <div>
            <dt class="text-sm text-gray-500">ID</dt>
            <dd>{{ $user->id }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">RUT</dt>
            <dd>{{ $user->rut }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Nombre</dt>
            <dd>{{ $user->nombre }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Apellido</dt>
            <dd>{{ $user->apellido }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Email</dt>
            <dd>{{ $user->email }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Fecha de creación</dt>
            <dd>{{ $user->created_at->format('d/m/Y H:i') }}</dd>
        </div>
    </dl>
</div>

<div class="mt-4">
    <a href="{{ route('usuarios.edit', $user) }}"
       class="rounded bg-blue-600 px-4 py-2 text-white">Editar</a>
    <a href="{{ route('usuarios.index') }}" class="ml-2">Volver</a>
</div>

@endsection