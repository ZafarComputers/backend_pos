<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transType' => $this->faker->randomElement([
                'Purchase Transaction',
                'Sale Transaction',
                'Purchase Return Transaction',
                'Sale Return Transaction',
                'Cash Account',
                'Bank Account',
                'Debtors',
                'Creditors',
                'Expenses'
            ]),
            'code' => $this->faker->unique()->randomElement([
                'PT', 'ST', 'PRT', 'SRT', 'CT', 'BT', 'DR', 'CR', 'EXP'
            ]),
        ];
    }
}
