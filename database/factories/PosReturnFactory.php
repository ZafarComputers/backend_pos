<?php

namespace Database\Factories;

use App\Models\PosReturn;
use App\Models\Customer;
use App\Models\POS;
use App\Models\PaymentMode;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosReturnFactory extends Factory
{
    protected $model = PosReturn::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'pos_id' => POS::inRandomOrder()->value('id') ?? POS::factory(),
            'invRet_date' => $this->faker->date(),
            'reason' => $this->faker->sentence(),
            'return_inv_amout' => $this->faker->randomFloat(2, 100, 3000),

            // ✅ New Fields to prevent the error
            'transaction_type_id' => TransactionType::where('code', 'SRT')->value('id')
                ?? TransactionType::inRandomOrder()->value('id')
                ?? TransactionType::factory(),

            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id')
                ?? PaymentMode::factory(),
        ];
    }
}
