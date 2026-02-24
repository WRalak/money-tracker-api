<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Store a newly created user
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified user with wallets and balances
     */
    public function show(int $id): JsonResponse
    {
        $user = User::with('wallets')->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            'wallets' => $user->wallets->map(function ($wallet) {
                return [
                    'id' => $wallet->id,
                    'name' => $wallet->name,
                    'description' => $wallet->description,
                    'balance' => $wallet->balance
                ];
            }),
            'total_balance' => $user->total_balance
        ]);
    }
}