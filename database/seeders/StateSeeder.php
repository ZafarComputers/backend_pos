<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/data/states.json');
        if (!File::exists($path)) {
            $this->command->error("states.json not found at $path");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);
        $states = $data[2]['data'] ?? [];

        $chunks = array_chunk($states, 200);

        foreach ($chunks as $chunk) {
            $insert = array_map(fn($s) => [
                'id' => $s['id'],
                'title' => $s['title'],
                'state_code' => $s['stateCode'],
                'country_id' => $s['countryId'],
                'status' => "active" ?? null,

            ], $chunk);

            State::insert($insert);
        }

        $this->command->info('States seeded successfully.');
    }
}