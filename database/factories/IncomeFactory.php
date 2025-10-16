<?php

namespace Database\Factories;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition(): array
    {
        // Dynamically fetch ID of 'Income' transaction type
        $incomeTypeId = TransactionType::where('code', 'INC')->value('id')
                        ?? TransactionType::factory()->create(['transType' => 'Income', 'code' => 'INC'])->id;

        return [
            'transaction_type_id' => $incomeTypeId,
            'date' => $this->faker->date(),
            'income_category_id' => IncomeCategory::inRandomOrder()->value('id') ?? IncomeCategory::factory(),
            'incm_cat_name' => $this->faker->words(2, true),
            'notes' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 500, 10000),
        ];
    }
}
