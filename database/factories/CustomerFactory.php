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
            // Pakistani CNIC format: 5 digits - 7 digits - 1 digit
            'cnic'      => $this->faker->numerify('#####-#######-#'),

            // Full name
            'name'      => $this->faker->name(),

            // Unique email
            'email'     => $this->faker->unique()->safeEmail(),

            // Random address
            'address'   => $this->faker->address(),

            // Foreign key (assuming city IDs exist in DB)
            'city_id'   => $this->faker->numberBetween(1, 50),

            // Pakistani mobile numbers (11 digits)
            'cell_no1'  => $this->faker->numerify('03#########'),
            'cell_no2'  => $this->faker->optional()->numerify('03#########'),

            // Placeholder image path (can be updated later)
            'image_path'=> 'default.png',

            // Status (active/inactive)
            'status'    => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
