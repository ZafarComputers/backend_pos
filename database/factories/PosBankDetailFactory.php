<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pos;

class PosBankDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pos_id'            => Pos::inRandomOrder()->value('id'),
            'bank_name'         => $this->faker->randomElement(['UBL', 'HBL', 'Meezan Bank', 'Allied Bank']),
            'account_title'     => $this->faker->name(),
            'account_number'    => $this->faker->bankAccountNumber(),
            // 'transaction_number'=> strtoupper($this->faker->bothify('TXN#######')),
        ];
    }
}
