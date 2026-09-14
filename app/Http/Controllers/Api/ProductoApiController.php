<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;

class ProductoApiController extends Controller
{
    #[OA\Get(
        path: '/api/productos',
        summary: 'Listar todos los productos',
        security: [['sanctum' => []]],
        tags: ['Productos']
    )]
    #[OA\Response(
        response: 200,
        description: 'Listado de productos',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Producto'))
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    public function index(): JsonResponse
    {
        return response()->json(Producto::all(), 200);
    }

    #[OA\Post(
        path: '/api/productos',
        summary: 'Crear un nuevo producto',
        description: 'El precio_de_venta se calcula automáticamente aplicando 19% de IVA sobre el precio_neto. La imagen se envía como archivo (multipart/form-data).',
        security: [['sanctum' => []]],
        tags: ['Productos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['sku', 'nombre', 'descripcion_corta', 'descripcion_larga', 'imagen', 'precio_neto', 'stock_actual', 'stock_minimo', 'stock_bajo', 'stock_alto'],
                    properties: [
                        new OA\Property(property: 'sku', type: 'string', example: 'SKU-001'),
                        new OA\Property(property: 'nombre', type: 'string', example: 'Teclado mecánico'),
                        new OA\Property(property: 'descripcion_corta', type: 'string', example: 'Teclado RGB'),
                        new OA\Property(property: 'descripcion_larga', type: 'string', example: 'Teclado mecánico retroiluminado.'),
                        new OA\Property(property: 'imagen', type: 'string', format: 'binary', description: 'Archivo de imagen (jpeg, png, jpg, webp — máx 2MB)'),
                        new OA\Property(property: 'precio_neto', type: 'integer', example: 10000),
                        new OA\Property(property: 'stock_actual', type: 'integer', example: 50),
                        new OA\Property(property: 'stock_minimo', type: 'integer', example: 5),
                        new OA\Property(property: 'stock_bajo', type: 'integer', example: 10),
                        new OA\Property(property: 'stock_alto', type: 'integer', example: 100),
                    ]
                )
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Producto creado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Producto creado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Producto'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
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

    #[OA\Get(
        path: '/api/productos/{producto}',
        summary: 'Obtener un producto por su ID',
        security: [['sanctum' => []]],
        tags: ['Productos'],
        parameters: [new OA\Parameter(name: 'producto', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 200, description: 'Datos del producto', content: new OA\JsonContent(ref: '#/components/schemas/Producto'))]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Producto no encontrado')]
    public function show(Producto $producto): JsonResponse
    {
        return response()->json($producto, 200);
    }

    #[OA\Post(
        path: '/api/productos/{producto}',
        summary: 'Actualizar un producto por su ID',
        description: 'Para actualizar enviando la imagen use POST con multipart/form-data e incluya el campo _method=PUT (Laravel form method spoofing). La imagen es opcional; si se omite se conserva la actual.',
        security: [['sanctum' => []]],
        tags: ['Productos'],
        parameters: [new OA\Parameter(name: 'producto', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['sku', 'nombre', 'descripcion_corta', 'descripcion_larga', 'precio_neto', 'stock_actual', 'stock_minimo', 'stock_bajo', 'stock_alto'],
                    properties: [
                        new OA\Property(property: '_method', type: 'string', example: 'PUT'),
                        new OA\Property(property: 'sku', type: 'string', example: 'SKU-001'),
                        new OA\Property(property: 'nombre', type: 'string', example: 'Teclado mecánico'),
                        new OA\Property(property: 'descripcion_corta', type: 'string', example: 'Teclado RGB'),
                        new OA\Property(property: 'descripcion_larga', type: 'string', example: 'Teclado mecánico retroiluminado.'),
                        new OA\Property(property: 'imagen', type: 'string', format: 'binary', description: 'Opcional. Archivo de imagen (jpeg, png, jpg, webp — máx 2MB)'),
                        new OA\Property(property: 'precio_neto', type: 'integer', example: 12000),
                        new OA\Property(property: 'stock_actual', type: 'integer', example: 45),
                        new OA\Property(property: 'stock_minimo', type: 'integer', example: 5),
                        new OA\Property(property: 'stock_bajo', type: 'integer', example: 10),
                        new OA\Property(property: 'stock_alto', type: 'integer', example: 100),
                    ]
                )
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Producto actualizado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Producto actualizado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Producto'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Producto no encontrado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
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

    #[OA\Delete(
        path: '/api/productos/{producto}',
        summary: 'Eliminar un producto por su ID',
        security: [['sanctum' => []]],
        tags: ['Productos'],
        parameters: [new OA\Parameter(name: 'producto', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 204, description: 'Producto eliminado')]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Producto no encontrado')]
    public function destroy(Producto $producto): JsonResponse
    {
        Storage::disk('public')->delete($producto->imagen);

        $producto->delete();

        return response()->json(null, 204);
    }
}