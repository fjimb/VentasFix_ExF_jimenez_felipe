<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

class AuthApiController extends Controller
{
    #[OA\Post(
        path: '/api/login',
        summary: 'Iniciar sesión y obtener un token',
        tags: ['Autenticación'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'admin@ventasfix.cl'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Autenticación exitosa',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Autenticación exitosa.'),
            new OA\Property(property: 'token', type: 'string', example: '1|abcdef1234567890'),
            new OA\Property(property: 'user', ref: '#/components/schemas/User'),
        ])
    )]
    #[OA\Response(response: 401, description: 'Credenciales incorrectas')]
    #[OA\Response(response: 422, description: 'Error de validación', content: new OA\JsonContent(ref: '#/components/schemas/ValidationError'))]
    public function login(Request $request): JsonResponse
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credenciales['email'])->first();

        if (! $user || ! Hash::check($credenciales['password'], $user->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Autenticación exitosa.',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    #[OA\Post(
        path: '/api/logout',
        summary: 'Cerrar sesión (revoca el token actual)',
        security: [['sanctum' => []]],
        tags: ['Autenticación']
    )]
    #[OA\Response(
        response: 200,
        description: 'Sesión cerrada correctamente',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'message', type: 'string', example: 'Sesión cerrada correctamente.'),
        ])
    )]
    #[OA\Response(response: 401, description: 'No autenticado')]
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ], 200);
    }
}