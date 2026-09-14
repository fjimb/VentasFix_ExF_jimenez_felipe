@extends('layout')

@section('titulo', 'Detalle de cliente')

@section('contenido')

<h1 class="mb-6 text-2xl font-bold">{{ $cliente->razon_social }}</h1>

<div class="max-w-lg rounded bg-white p-6 shadow">
    <dl class="space-y-3">
        <div>
            <dt class="text-sm text-gray-500">ID</dt>
            <dd>{{ $cliente->id }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">RUT empresa</dt>
            <dd>{{ $cliente->rut_empresa }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Razón social</dt>
            <dd>{{ $cliente->razon_social }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Rubro</dt>
            <dd>{{ $cliente->rubro }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Teléfono</dt>
            <dd>{{ $cliente->telefono }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Dirección</dt>
            <dd>{{ $cliente->direccion }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Nombre del contacto</dt>
            <dd>{{ $cliente->nombre_contacto }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Email del contacto</dt>
            <dd>{{ $cliente->email_contacto }}</dd>
        </div>
    </dl>
</div>

<div class="mt-4">
    <a href="{{ route('clientes.edit', $cliente) }}"
       class="rounded bg-blue-600 px-4 py-2 text-white">Editar</a>
    <a href="{{ route('clientes.index') }}" class="ml-2">Volver</a>
</div>

@endsection