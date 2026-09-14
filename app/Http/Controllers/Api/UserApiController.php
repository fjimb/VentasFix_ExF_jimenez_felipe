<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::all(), 200);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'data' => $user,
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user, 200);
    }

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

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, 204);
    }
}