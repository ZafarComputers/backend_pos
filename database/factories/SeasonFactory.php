<?php

// database/factories/SeasonFactory.php
namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition(): array {
        static $seasons = ['Winter', 'Summer', 'Mid-Season'];
        static $i = 0;

        $title = $seasons[$i % count($seasons)];
        $i++;

        return [
            'title' => $title,
            'status' => 'Active',
        ];
    }
}
