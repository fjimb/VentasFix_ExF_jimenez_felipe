@extends('layout')

@section('titulo', 'Editar usuario')

@section('contenido')

<h1 class="mb-4 text-2x1 font-bold">Editar usuario</h1>

<form action="{{ route('usuarios.update', $user) }}" method="POST" class="max-w-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="rut" class="block mb-1">RUT</label>
        <input type="text" name="rut" id="rut" value="{{ old('rut', $user->rut) }}" class="w-full rounded border p-2">
        @error('rut')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="nombre" class="block mb-1">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}" class="w-full rounded border p-2">
        @error('nombre')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="apellido" class="block mb-1">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $user->apellido) }}" class="w-full rounded border p-2">
        @error('apellido')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
        
    <div>
        <label for="email" class="block mb-1">Email</label>
        <input type="text" name="email" id="email" value="{{ old('email), $user->email }}" class="w-full rounded border p-2">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block mb-1">Contraseña</label>
        <input type="password" name="password" id="password" class="w-full rounded border p-2">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block mb-1">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded border p-2">
    </div>

    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button>
    <a href="{{ route('usuarios.index') }}" class="ml-2">Cancelar</a>
</form>

@endsection