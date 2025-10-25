<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Coa;
use App\Models\PaymentMode;
use App\Models\TransactionType;

class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Transaction type — fixed or random fallback
            'transaction_type_id' => TransactionType::where('id', 9)->value('id') 
                ?? TransactionType::inRandomOrder()->value('id') 
                ?? TransactionType::factory(),

            // ✅ expense_category_id now stores a CoA ID between 5 and 40
            'expense_category_id' => Coa::whereBetween('id', [5, 40])
                ->inRandomOrder()
                ->value('id') ?? 5,

            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id') 
                ?? PaymentMode::factory(),

            // Expense fields
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->sentence(),
            'date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
