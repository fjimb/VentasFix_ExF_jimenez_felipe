<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::orderBy('nombre')->paginate(10);

        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $datos = $request->validated();

        $datos['imagen'] = $request->file('imagen')->store('productos', 'public');

        Producto::create($datos);

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $datos = $request->validated();


        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($producto->imagen);
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto actualizado correctamente.');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        Storage::disk('public')->delete($producto->imagen);

        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto eliminado correctamente.');
    }
}
