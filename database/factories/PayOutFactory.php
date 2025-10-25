<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PayOut;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\PaymentMode;
use App\Models\Coa;
use App\Models\User;

class PayOutFactory extends Factory
{
    protected $model = PayOut::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),

            // Transaction type (try id=9 first, else random or factory)
            'transaction_type_id' => TransactionType::where('id', 9)->value('id')
                ?? TransactionType::inRandomOrder()->value('id')
                ?? TransactionType::factory(),

            // Payment mode (existing or factory)
            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id')
                ?? PaymentMode::factory(),

            // Chart of account (COA)
            'coas_id' => Coa::inRandomOrder()->value('id')
                ?? Coa::factory(),

            // Expense category COA IDs (5–40 range)
            'expense_category_id' => Coa::whereBetween('id', [5, 40])
                ->inRandomOrder()
                ->value('id') ?? 5,

            // User reference
            'users_id' => User::inRandomOrder()->value('id')
                ?? User::factory(),

            // Text fields
            'naration' => $this->faker->sentence(6),
            'description' => $this->faker->sentence(10),

            // Amount
            'amount' => $this->faker->randomFloat(2, 1000, 50000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PayOut $payOut) {
            // Determine main and counter COA IDs
            $mainCoaId = $payOut->payment_mode_id == 1 ? 3 : 7; // Cash:3, Bank:7
            $counterCoaId = $payOut->coas_id;

            // Create Credit transaction (Cash/Bank decreases)
            Transaction::create([
                'date' => $payOut->date,
                'transaction_type_id' => $payOut->transaction_type_id, // ✅ corrected
                'invRef_id' => $payOut->id,
                'coas_id' => $mainCoaId,
                'coaRef_id' => $counterCoaId,
                'description' => $payOut->description . ' (Credit)',
                'debit' => 0,
                'credit' => $payOut->amount,
                'users_id' => $payOut->users_id,
            ]);

            // Create Debit transaction (Expense increases)
            Transaction::create([
                'date' => $payOut->date,
                'transaction_type_id' => $payOut->transaction_type_id, // ✅ corrected
                'invRef_id' => $payOut->id,
                'coas_id' => $counterCoaId,
                'coaRef_id' => $mainCoaId,
                'description' => $payOut->description . ' (Debit)',
                'debit' => $payOut->amount,
                'credit' => 0,
                'users_id' => $payOut->users_id,
            ]);
        });
    }
}
