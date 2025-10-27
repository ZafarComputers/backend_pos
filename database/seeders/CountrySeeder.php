<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/data/countries.json');
        if (!File::exists($path)) {
            $this->command->error("countries.json not found at $path");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        // Structure: [header, database, table => ['data' => [...]]]
        $countries = $data[2]['data'] ?? [];

        $chunks = array_chunk($countries, 100);

        foreach ($chunks as $chunk) {
            $insert = array_map(fn($c) => [
                'id' => $c['id'],
                'title' => $c['title'],
                'phone_code' => $c['phoneCode'],
                'emoji_u' => $c['emojiU'],
                'native' => $c['native'] ?? null,
                'status' => "active" ?? null,
            ], $chunk);

            Country::insert($insert);
        }

        $this->command->info('Countries seeded successfully.');
    }
}