<?php


namespace Database\Factories;

use App\Models\IncomeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    public function definition(): array
    {
        $category = IncomeCategory::factory()->create();

        return [
            'transaction_type_id' => 8,
            'date' => $this->faker->date(),
            'income_category_id' => $category->id,
            'incm_cat_name' => $this->faker->words(2, true),  // e.g. "Freelance Income"
            'notes' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 500, 10000),
        ];
    }
}
