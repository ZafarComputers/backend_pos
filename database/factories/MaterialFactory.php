<?php

// database/factories/MaterialFactory.php
namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array {
        $materials = ['Cotton', 'Silk', 'Linen', 'Wool', 'Denim', 'Polyester', 'Fabric'];

        return [
            'title' => $this->faker->unique()->randomElement($materials),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}

