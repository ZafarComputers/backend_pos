<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $cityIds = City::pluck('id')->toArray();

        if (empty($cityIds)) {
            $this->command->error('No cities found! Run PakistanSeeder first.');
            return;
        }

        // Walk-In Customer
        $walkInCityId = $cityIds[array_rand($cityIds)];

        Customer::firstOrCreate(
            ['cnic' => '00000-0000000-0'],
            [
                'cnic2'      => '00000-0000000-0',
                'name'       => 'Walk In Customer',
                'name2'      => 'Customer',
                'email'      => 'walkin@pos.local',
                'address'    => 'N/A',
                'city_id'    => $walkInCityId,
                'cell_no1'   => '03000000000',
                'cell_no2'   => '03000000001',
                'cell_no3'   => '03000000002',
                'image_path' => 'default.png',
                'status'     => 'active',
            ]
        );

        $this->command->info("Walk-In Customer created (city_id: $walkInCityId)");

        // 10 Random Customers
        Customer::factory()
            ->count(5)
            ->state([
                'city_id' => fn() => $cityIds[array_rand($cityIds)],
            ])
            ->create();

        $this->command->info('5 random customers created with valid cities & phone numbers.');
    }
}