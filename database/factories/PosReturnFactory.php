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
        // Randomly decide whether this return is linked to a POS
        $posId = $this->faker->boolean(70) // 70% chance it belongs to a POS
            ? (POS::inRandomOrder()->value('id') ?? POS::factory())
            : null; // otherwise null (no linked POS)

        return [
            'customer_id' => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'pos_id' => $posId,
            'invRet_date' => $this->faker->date(),
            'reason' => $this->faker->sentence(),
            
            'return_inv_amount' => $this->faker->randomFloat(2, 100, 3000),
            'tax'               => $this->faker->randomFloat(2, 0, 100),
            'discPer'           => $this->faker->randomFloat(2, 0, 20),
            'discAmount'        => $this->faker->randomFloat(2, 0, 100),
            'paid'              => $this->faker->randomFloat(2, 10, 1000),

            'transaction_type_id' => TransactionType::where('code', 'SRT')->value('id')
                ?? TransactionType::inRandomOrder()->value('id')
                ?? TransactionType::factory(),

            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id')
                ?? PaymentMode::factory(),
        ];
    }
}
