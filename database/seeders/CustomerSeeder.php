<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // 🟢 Create Walk-In Customer if not exists
        Customer::firstOrCreate(
            ['cnic' => '00000-0000000-0'],
            [
                'cnic2'      => '11111-1111111-1',
                'name'       => 'Walk In Customer',
                'name2'      => 'Customer',
                'email'      => 'walkin@pos.local',
                'address'    => 'N/A',
                'city_id'    => 1,
                'cell_no1'   => '03000000000',
                'cell_no2'   => '03000000001',
                'cell_no3'   => '03000000002',
                'image_path' => 'default.png',
                'status'     => 'active',
            ]
        );

        // 🟡 Create 20 random customers (no duplicates)
        Customer::factory(10)->create();
    }
}
