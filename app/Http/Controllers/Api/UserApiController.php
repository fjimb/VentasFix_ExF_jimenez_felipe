<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UserApiController extends Controller
{
    #[OA\Get(
        path: '/api/usuarios',
        summary: 'Listar todos los usuarios',
        security: [['sanctum' => []]],
        tags: ['Usuarios']
    )]
    #[OA\Response(
        response: 200,
        description: 'Listado de usuarios',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/User'))
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    public function index(): JsonResponse
    {
        return response()->json(User::all(), 200);
    }

    #[OA\Post(
        path: '/api/usuarios',
        summary: 'Crear un nuevo usuario',
        security: [['sanctum' => []]],
        tags: ['Usuarios'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['rut', 'nombre', 'apellido', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'rut', type: 'string', example: '12.345.678-5'),
                    new OA\Property(property: 'nombre', type: 'string', example: 'Felipe'),
                    new OA\Property(property: 'apellido', type: 'string', example: 'Jiménez'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'felipe@ventasfix.cl'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'clave1234'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'clave1234'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Usuario creado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Usuario creado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/User'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'data' => $user,
        ], 201);
    }

    #[OA\Get(
        path: '/api/usuarios/{usuario}',
        summary: 'Obtener un usuario por su ID',
        security: [['sanctum' => []]],
        tags: ['Usuarios'],
        parameters: [new OA\Parameter(name: 'usuario', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 200, description: 'Datos del usuario', content: new OA\JsonContent(ref: '#/components/schemas/User'))]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Usuario no encontrado')]
    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }

    #[OA\Put(
        path: '/api/usuarios/{usuario}',
        summary: 'Actualizar un usuario por su ID',
        security: [['sanctum' => []]],
        tags: ['Usuarios'],
        parameters: [new OA\Parameter(name: 'usuario', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['rut', 'nombre', 'apellido', 'email'],
                properties: [
                    new OA\Property(property: 'rut', type: 'string', example: '12.345.678-5'),
                    new OA\Property(property: 'nombre', type: 'string', example: 'Felipe'),
                    new OA\Property(property: 'apellido', type: 'string', example: 'Jiménez'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'felipe@ventasfix.cl'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', description: 'Opcional. Si se omite, la contraseña no cambia.', example: 'nuevaClave1234'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'nuevaClave1234'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Usuario actualizado',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Usuario actualizado correctamente.'),
            new OA\Property(property: 'data', ref: '#/components/schemas/User'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Usuario no encontrado')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $datos = $request->validated();

        if (empty($datos['password'])) {
            unset($datos['password']);
        }

        $user->update($datos);

        return response()->json([
            'message' => 'Usuario actualizado correctamente.',
            'data' => $user,
        ], 200);
    }

    #[OA\Delete(
        path: '/api/usuarios/{usuario}',
        summary: 'Eliminar un usuario por su ID',
        security: [['sanctum' => []]],
        tags: ['Usuarios'],
        parameters: [new OA\Parameter(name: 'usuario', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1)]
    )]
    #[OA\Response(response: 204, description: 'Usuario eliminado')]
    #[OA\Response(response: 401, description: 'No autenticado')]
    #[OA\Response(response: 404, description: 'Usuario no encontrado')]
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, 204);
    }
}