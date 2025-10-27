<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/data/cities.json');
        if (!File::exists($path)) {
            $this->command->error("cities.json not found at $path");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);
        $cities = $data[2]['data'] ?? [];

        $this->command->info('Seeding ' . count($cities) . ' cities... This may take a while.');

        $chunks = array_chunk($cities, 500); // Larger chunks for cities

        foreach ($chunks as $i => $chunk) {
            $insert = array_map(fn($c) => [
                'id' => $c['id'],
                'title' => $c['title'],
                'state_id' => $c['stateId'],
                'status' => "active" ?? null,
            ], $chunk);

            City::insert($insert);

            if ($i % 10 == 0) {
                $this->command->info("Inserted " . (($i + 1) * 500) . " cities...");
            }
        }

        $this->command->info('Cities seeded successfully.');
    }
}                