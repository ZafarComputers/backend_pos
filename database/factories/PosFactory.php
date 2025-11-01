<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Pos, Customer, Employee, PaymentMode, TransactionType, PosBankDetail, PosDetail};

class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        return [
            'inv_date'            => $this->faker->date(),
            'customer_id'         => Customer::inRandomOrder()->value('id'),
            'employee_id'         => Employee::inRandomOrder()->value('id'),
            'payment_mode_id'     => PaymentMode::inRandomOrder()->value('id'),
            'transaction_type_id' => TransactionType::inRandomOrder()->value('id'),
            'tax'                 => $this->faker->randomFloat(2, 0, 100),
            'discPer'             => $this->faker->randomFloat(2, 0, 20),
            'discAmount'          => $this->faker->randomFloat(2, 0, 100),
            'inv_amount'          => $this->faker->randomFloat(2, 500, 20000),
            'paid'                => $this->faker->randomFloat(2, 100, 20000),
            'total_extra_amount'  => $this->faker->randomFloat(2, 100, 20000),
            'description'         => $this->faker->sentence(8),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Pos $pos) {
            // Create related PosDetails (each will create its own PosExtras)
            PosDetail::factory(rand(1, 3))->create([
                'pos_id' => $pos->id,
            ]);

            // If payment mode is Bank, create a bank detail record
            if ($pos->paymentMode?->mode_name === 'Bank') {
                PosBankDetail::factory()->create([
                    'pos_id' => $pos->id,
                ]);
            }
        });
    }
}
