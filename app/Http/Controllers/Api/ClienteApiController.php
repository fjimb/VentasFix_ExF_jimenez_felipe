<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ClienteApiController extends Controller
{
    #[OA\Get(
        path: '/api/clientes',
        summary: 'Listar todos los clientes',
        security: [['sanctum' => []]],
        tags: ['Clientes']
    )]
    #[OA\Response(
        response: 200,
        description: 'Listado de clientes',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Cliente'))
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    public function index(): JsonResponse
    {
        return response()->json(Cliente::all(), 200);
    }

    #[OA\Post(
        path: '/api/clientes',
        summary: 'Crear un nuevo cliente',
        security: [['sanctum' => []]],
        tags: ['Clientes'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['rut_empresa', 'rubro', 'razon_social', 'telefono', 'direccion', 'nombre_contacto', 'email_contacto'],
                properties: [
                    new OA\Property(property: 'rut_empresa', type: 'string', example: '76.123.456-7'),
                    new OA\Property(property: 'rubro', type: 'string', example: 'Retail'),
                    new OA\Property(property: 'razon_social', type: 'string', example: 'Comercial Los Andes SpA'),
                    new OA\Property(property: 'telefono', type: 'string', example: '+56 9 1234 5678'),
                    new OA\Property(property: 'direccion', type: 'string', example: 'Av. Siempre Viva 123'),
                    new OA\Property(property: 'nombre_contacto', type: 'string', example: 'María Pérez'),
                    new OA\Property(property: 'email_contacto', type: 'string', format: 'email', example: 'maria@losandes.cl'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Cliente creado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Cliente creado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Cliente'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
    public function store(StoreClienteRequest $request): JsonResponse
    {
        $cliente = Cliente::create($request->validated());

        return response()->json([
            'message' => 'Cliente creado correctamente.',
            'data' => $cliente,
        ], 201);
    }

    #[OA\Get(
        path: '/api/clientes/{cliente}',
        summary: 'Obtener un cliente por su ID',
        security: [['sanctum' => []]],
        tags: ['Clientes'],
        parameters: [new OA\Parameter(name: 'cliente', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 200, description: 'Datos del cliente', content: new OA\JsonContent(ref: '#/components/schemas/Cliente'))]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Cliente no encontrado')]
    public function show(Cliente $cliente): JsonResponse
    {
        return response()->json($cliente, 200);
    }

    #[OA\Put(
        path: '/api/clientes/{cliente}',
        summary: 'Actualizar un cliente por su ID',
        security: [['sanctum' => []]],
        tags: ['Clientes'],
        parameters: [new OA\Parameter(name: 'cliente', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['rut_empresa', 'rubro', 'razon_social', 'telefono', 'direccion', 'nombre_contacto', 'email_contacto'],
                properties: [
                    new OA\Property(property: 'rut_empresa', type: 'string', example: '76.123.456-7'),
                    new OA\Property(property: 'rubro', type: 'string', example: 'Retail'),
                    new OA\Property(property: 'razon_social', type: 'string', example: 'Comercial Los Andes SpA'),
                    new OA\Property(property: 'telefono', type: 'string', example: '+56 9 1234 5678'),
                    new OA\Property(property: 'direccion', type: 'string', example: 'Av. Siempre Viva 123'),
                    new OA\Property(property: 'nombre_contacto', type: 'string', example: 'María Pérez'),
                    new OA\Property(property: 'email_contacto', type: 'string', format: 'email', example: 'maria@losandes.cl'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Cliente actualizado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Cliente actualizado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/Cliente'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Cliente no encontrado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
    public function update(UpdateClienteRequest $request, Cliente $cliente): JsonResponse
    {
        $cliente->update($request->validated());

        return response()->json([
            'message' => 'Cliente actualizado correctamente.',
            'data' => $cliente,
        ], 200);
    }

    #[OA\Delete(
        path: '/api/clientes/{cliente}',
        summary: 'Eliminar un cliente por su ID',
        security: [['sanctum' => []]],
        tags: ['Clientes'],
        parameters: [new OA\Parameter(name: 'cliente', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 204, description: 'Cliente eliminado')]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Cliente no encontrado')]
    public function destroy(Cliente $cliente): JsonResponse
    {
        $cliente->delete();

        return response()->json(null, 204);
    }
}