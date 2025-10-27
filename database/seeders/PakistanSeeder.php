<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PakistanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Import only Pakistan
        $countryJson = File::get(storage_path('app/data/countries.json'));
        $countries = json_decode($countryJson, true)[2]['data'] ?? [];

        $pakistan = collect($countries)->firstWhere('id', 167); // Pakistan ID = 167

        if (!$pakistan) {
            $this->command->error('Pakistan not found in countries.json');
            return;
        }

        Country::updateOrCreate(
            ['id' => 167],
            [
                'title'       => $pakistan['title'],
                'phone_code' => $pakistan['phoneCode'],
                'emoji_u'    => $pakistan['emojiU'],
                'native'     => $pakistan['native'] ?? null,
                'status' => "active" ?? null,

            ]
        );

        $this->command->info('Pakistan imported.');

        // 2. Import only Pakistan states
        $stateJson = File::get(storage_path('app/data/states.json'));
        $states = json_decode($stateJson, true)[2]['data'] ?? [];

        $pakistanStates = collect($states)->where('countryId', 167);

        $stateIds = [];
        foreach ($pakistanStates->chunk(100) as $chunk) {
            $insert = $chunk->map(fn($s) => [
                'id'          => $s['id'],
                'title'        => $s['title'],
                'state_code'  => $s['stateCode'],
                'country_id'  => 167,
                'status' => "active" ?? null,

            ])->toArray();

            State::insert($insert);
            $stateIds = array_merge($stateIds, $chunk->pluck('id')->toArray());
        }

        $this->command->info('Pakistan states imported: ' . $pakistanStates->count());

        // 3. Import only cities of Pakistan states
        $cityJson = File::get(storage_path('app/data/cities.json'));
        $cities = json_decode($cityJson, true)[2]['data'] ?? [];

        $pakistanCities = collect($cities)->whereIn('stateId', $stateIds);

        $total = $pakistanCities->count();
        $this->command->info("Found $total cities in Pakistan. Importing in chunks...");

        foreach ($pakistanCities->chunk(500) as $i => $chunk) {
            $insert = $chunk->map(fn($c) => [
                'id'       => $c['id'],
                'title'     => $c['title'],
                'state_id' => $c['stateId'],
                'status' => "active" ?? null,
                
            ])->toArray();

            City::insert($insert);

            if (($i + 1) % 10 == 0) {
                $this->command->info("Inserted " . (($i + 1) * 500) . " cities...");
            }
        }

        $this->command->info("Pakistan cities imported: $total");
    }
}