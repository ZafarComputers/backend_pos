<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\PaymentMode;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Foreign keys
            'transaction_type_id' => TransactionType::where('id', 9)->value('id') 
                ?? TransactionType::inRandomOrder()->value('id') 
                ?? TransactionType::factory(),
            
            'expense_category_id' => ExpenseCategory::inRandomOrder()->value('id') 
                ?? ExpenseCategory::factory(),

            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id') 
                ?? PaymentMode::factory(),

            // Expense fields
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
