<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Requests\StoreWalletRequest;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    /**
     * Store a newly created wallet
     */
    public function store(StoreWalletRequest $request): JsonResponse
    {
        $wallet = Wallet::create($request->validated());

        return response()->json([
            'message' => 'Wallet created successfully',
            'wallet' => $wallet
        ], 201);
    }

    /**
     * Display the specified wallet with its transactions
     */
    public function show(int $id): JsonResponse
    {
        $wallet = Wallet::with('transactions')->find($id);

        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found'
            ], 404);
        }

        return response()->json([
            'wallet' => [
                'id' => $wallet->id,
                'name' => $wallet->name,
                'description' => $wallet->description,
                'balance' => $wallet->balance,
                'user_id' => $wallet->user_id
            ],
            'transactions' => $wallet->transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'type' => $transaction->type,
                    'description' => $transaction->description,
                    'created_at' => $transaction->created_at
                ];
            })
        ]);
    }
}