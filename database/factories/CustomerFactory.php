<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [

            // Pakistani CNIC format
            'cnic'       => $this->faker->unique()->numerify('#####-#######-#'),
            'cnic2'      => $this->faker->numerify('#####-#######-#'),

            'name'       => $this->faker->name(),
            'name2'      => $this->faker->firstName(),

            'email'      => $this->faker->unique()->safeEmail(),
            'address'    => $this->faker->address(),
            'city_id'    => $this->faker->numberBetween(1, 50),

            'cell_no1'   => $this->faker->numerify('03#########'),
            // Always provide fallback values — never null
            'cell_no2'   => $this->faker->numerify('03#########'),
            'cell_no3'   => $this->faker->numerify('03#########'),

            'image_path' => 'default.png',
            'status'     => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Special case for Walk-In Customer
     */
    public function walkIn(): static
    {
        return $this->state(fn (array $attributes) => [
            'cnic'       => '00000-0000000-0',
            'cnic2'      => '11111-1111111-1',
            'name'       => 'Walk In Customer',
            'name2'      => 'Customer',
            'email'      => 'walkin@pos.local',
            'address'    => 'N/A',
            'city_id'    => 1,
            'cell_no1'   => '03000000000',
            'cell_no2'   => '03000000001',
            'cell_no3'   => '03000000002',
            'image_path' => 'default.png',
            'status'     => 'active',
        ]);
    }
}
