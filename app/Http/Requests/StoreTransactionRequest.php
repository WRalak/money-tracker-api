<?php
// app/Http/Requests/StoreTransactionRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Transaction amount is required',
            'amount.numeric' => 'Amount must be a number',
            'amount.min' => 'Amount must be greater than 0',
            'type.required' => 'Transaction type is required',
            'type.in' => 'Transaction type must be either income or expense',
            'description.required' => 'Description is required'
        ];
    }
}