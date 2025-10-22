<?php

// database/factories/SizeFactory.php
namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition(): array {
        static $sizes = ['Small', 'Medium', 'Large', 'Extra Large'];
        static $i = 0;

        $title = $sizes[$i % count($sizes)];
        $i++;

        return [
            'title' => $title,
            'status' => 'Active',
        ];
    }
}
