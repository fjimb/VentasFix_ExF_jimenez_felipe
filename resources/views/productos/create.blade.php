@extends('layout')

@section('titulo', 'Nuevo producto')

@section('contenido')

    <x-molecule.page-header titulo="Nuevo producto" />

    <x-organism.formulario
        :action="route('productos.store')"
        enctype="multipart/form-data"
        :cancelar="route('productos.index')"
    >
        <x-molecule.campo name="sku" label="SKU" required />
        <x-molecule.campo name="nombre" label="Nombre" required />
        <x-molecule.campo name="descripcion_corta" label="Descripción corta" maxlength="250" />
        <x-molecule.campo name="descripcion_larga" label="Descripción larga" type="textarea" />
        <x-molecule.campo name="imagen" label="Imagen" type="file" accept="image/*" ayuda="JPG, PNG o WEBP. Máximo 2 MB." />
        <x-molecule.campo name="precio_neto" label="Precio neto" type="number" min="1" ayuda="El precio de venta se calcula agregando el 19% de IVA." required />
        <x-molecule.campo name="stock_minimo" label="Stock mínimo" type="number" min="0" required />
        <x-molecule.campo name="stock_bajo" label="Stock bajo" type="number" min="0" required />
        <x-molecule.campo name="stock_alto" label="Stock alto" type="number" min="0" required />
        <x-molecule.campo name="stock_actual" label="Stock actual" type="number" min="0" required />
    </x-organism.formulario>

@endsection
