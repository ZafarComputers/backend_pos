<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pos;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\PaymentMode;
use App\Models\TransactionType;

class PosFactory extends Factory
{
    protected $model = Pos::class;

    public function definition(): array
    {
        return [
            'inv_date'            => $this->faker->date(),
            'customer_id'         => Customer::inRandomOrder()->first()->id,
            'employee_id'         => Employee::inRandomOrder()->first()->id,
            'tax'                 => $this->faker->randomFloat(2, 0, 100),
            'discPer'             => $this->faker->randomFloat(2, 0, 20),
            'discAmount'          => $this->faker->randomFloat(2, 0, 100),
            'inv_amount'          => $this->faker->randomFloat(2, 500, 20000),
            'paid'                => $this->faker->randomFloat(2, 100, 20000),
            'description'         => $this->faker->sentence(8),
            'payment_mode_id'     => PaymentMode::inRandomOrder()->first()->id,
            'transaction_type_id' => TransactionType::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Pos $pos) {
            $pos->loadMissing('paymentMode');

            if ($pos->paymentMode?->mode_name === 'Bank') {
                \App\Models\PosBankDetail::factory()->create([
                    'pos_id' => $pos->id,
                ]);
            }

            // $pos->extras()->saveMany(
            //     \App\Models\PosExtra::factory()
            //         ->count(rand(1, 2))
            //         ->make()
            // );

            // Extras: Safe creation with pos_id
            \App\Models\PosExtra::factory()
                ->count(rand(1, 2))
                ->create(['pos_id' => $pos->id]);
                
        });
    }
}