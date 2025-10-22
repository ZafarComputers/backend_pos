<?php

namespace Database\Factories;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionTypeFactory extends Factory
{
    protected $model = TransactionType::class;

    public function definition(): array
    {
        // ✅ Fixed mapping of transType => code
        $types = [
            ['transType' => 'Purchase Transaction', 'code' => 'PT'],
            ['transType' => 'Sale Transaction', 'code' => 'ST'],
            ['transType' => 'Purchase Return Transaction', 'code' => 'PRT'],
            ['transType' => 'Sale Return Transaction', 'code' => 'SRT'],
            ['transType' => 'Cash Account', 'code' => 'CT'],
            ['transType' => 'Bank Account', 'code' => 'BT'],
            ['transType' => 'Debtors', 'code' => 'DR'],
            ['transType' => 'Creditors', 'code' => 'CR'],
            ['transType' => 'Expenses', 'code' => 'EXP'],
            ['transType' => 'Income', 'code' => 'INC'],
        ];

        // Pick one random type–code pair safely
        return $this->faker->unique()->randomElement($types);
    }
}
