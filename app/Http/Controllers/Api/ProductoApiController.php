<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductoApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Producto::all(), 200);
    }

    public function store(StoreProductoRequest $request): JsonResponse
    {
        $datos = $request->validated();

        $datos['imagen'] = $request->file('imagen')->store('productos', 'public');

        $producto = Producto::create($datos);

        return response()->json([
            'message' => 'Producto creado correctamente.',
            'data' => $producto,
        ], 201);
    }

    public function show(Producto $producto): JsonResponse
    {
        return response()->json($producto, 200);
    }

    public function update(UpdateProductoRequest $request, Producto $producto): JsonResponse
    {
        $datos = $request->validated();

        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($producto->imagen);
            $datos['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return response()->json([
            'message' => 'Producto actualizado correctamente.',
            'data' => $producto,
        ], 200);
    }

    public function destroy(Producto $producto): JsonResponse
    {
        Storage::disk('public')->delete($producto->imagen);

        $producto->delete();

        return response()->json(null, 204);
    }
}