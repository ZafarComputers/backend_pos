<?php

// database/seeders/SeasonSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run(): void {
        $seasons = ['Winter', 'Summer', 'Mid-Season'];

        foreach ($seasons as $s) {
            Season::firstOrCreate(
                ['title' => $s],
                ['status' => 'Active']
            );
        }
    }
}
