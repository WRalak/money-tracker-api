<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);

        // Create wallets for the user
        $personalWallet = Wallet::create([
            'user_id' => $user->id,
            'name' => 'Personal',
            'description' => 'Personal expenses wallet'
        ]);

        $businessWallet = Wallet::create([
            'user_id' => $user->id,
            'name' => 'Business',
            'description' => 'Business account wallet'
        ]);

        // Add some transactions
        Transaction::create([
            'wallet_id' => $personalWallet->id,
            'amount' => 1000.00,
            'type' => 'income',
            'description' => 'Salary'
        ]);

        Transaction::create([
            'wallet_id' => $personalWallet->id,
            'amount' => 50.00,
            'type' => 'expense',
            'description' => 'Groceries'
        ]);

        Transaction::create([
            'wallet_id' => $businessWallet->id,
            'amount' => 5000.00,
            'type' => 'income',
            'description' => 'Client payment'
        ]);
    }
}