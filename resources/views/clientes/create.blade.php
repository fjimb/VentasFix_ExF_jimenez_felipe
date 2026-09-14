@extends('layout')

@section('titulo', 'Nuevo cliente')

@section('contenido')

<h1 class="mb-4 text-2xl font-bold">Nuevo cliente</h1>

<form action="{{ route('clientes.store') }}" method="POST" class="max-w-lg">
    @csrf

    <div class="mb-4">
        <label for="rut_empresa" class="block mb-1">RUT empresa</label>
        <input type="text" name="rut_empresa" id="rut_empresa"
               value="{{ old('rut_empresa') }}" class="w-full rounded border p-2">
        @error('rut_empresa')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="razon_social" class="block mb-1">Razón social</label>
        <input type="text" name="razon_social" id="razon_social"
               value="{{ old('razon_social') }}" class="w-full rounded border p-2">
        @error('razon_social')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="rubro" class="block mb-1">Rubro</label>
        <input type="text" name="rubro" id="rubro"
               value="{{ old('rubro') }}" class="w-full rounded border p-2">
        @error('rubro')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="telefono" class="block mb-1">Teléfono</label>
        <input type="text" name="telefono" id="telefono" maxlength="20"
               value="{{ old('telefono') }}" class="w-full rounded border p-2">
        @error('telefono')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="direccion" class="block mb-1">Dirección</label>
        <input type="text" name="direccion" id="direccion"
               value="{{ old('direccion') }}" class="w-full rounded border p-2">
        @error('direccion')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="nombre_contacto" class="block mb-1">Nombre del contacto</label>
        <input type="text" name="nombre_contacto" id="nombre_contacto"
               value="{{ old('nombre_contacto') }}" class="w-full rounded border p-2">
        @error('nombre_contacto')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email_contacto" class="block mb-1">Email del contacto</label>
        <input type="email" name="email_contacto" id="email_contacto"
               value="{{ old('email_contacto') }}" class="w-full rounded border p-2">
        @error('email_contacto')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button>
    <a href="{{ route('clientes.index') }}" class="ml-2">Cancelar</a>
</form>

@endsection