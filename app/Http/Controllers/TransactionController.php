<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends Controller
{
    /**
     * Store a newly created transaction
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            $wallet = Wallet::findOrFail($request->wallet_id);
            
            $transaction = Transaction::create($request->validated());

            return response()->json([
                'message' => 'Transaction created successfully',
                'transaction' => [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'type' => $transaction->type,
                    'description' => $transaction->description,
                    'wallet_id' => $transaction->wallet_id,
                    'created_at' => $transaction->created_at
                ],
                'wallet_balance' => $wallet->fresh()->balance
            ], 201);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Wallet not found'
            ], 404);
        }
    }
}