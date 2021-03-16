<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('locations')->insert([
            'description' => 'ITTX Office',
            'longitude' => '-25',
            'latitude' => '28',
            'status' => 0
        ]);
        \DB::table('locations')->insert([
            'description' => 'Test Office',
            'longitude' => '-25',
            'latitude' => '28',
            'status' => 0
        ]);
    }
}
