<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_type_id' => 9,
            'name' => $this->faker->sentence(3),
            'expense_category_id' => ExpenseCategory::factory(),
            'description' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
