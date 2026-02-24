<?php
// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'amount',
        'type',
        'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    /**
     * Get the wallet that owns the transaction
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Boot the model to handle balance updates
     */
    protected static function booted()
    {
        static::created(function ($transaction) {
            $wallet = $transaction->wallet;
            
            if ($transaction->type === 'income') {
                $wallet->balance += $transaction->amount;
            } else {
                $wallet->balance -= $transaction->amount;
            }
            
            $wallet->save();
        });
    }
}