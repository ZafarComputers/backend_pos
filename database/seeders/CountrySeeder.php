<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Country::factory()->count(10)->create()->each(function ($country) {
        $country->states()->saveMany(\App\Models\State::factory(5)->make())->each(function ($state) {
            $state->cities()->saveMany(\App\Models\City::factory(10)->make());
        });
    });
        
    }
}
