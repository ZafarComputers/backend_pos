<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'ref_no' => $this->faker->unique()->numerify('REF-#####'),
            'date' => $this->faker->date(),
            'category' => $this->faker->randomElement(['Sale', 'Purchase', 'Expense', 'Income']),
            'description' => $this->faker->sentence(),
            'debit' => $this->faker->randomFloat(2, 0, 5000),
            'credit' => $this->faker->randomFloat(2, 0, 5000),
            'trans_type' => $this->faker->randomElement(['Cash', 'Bank']),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
