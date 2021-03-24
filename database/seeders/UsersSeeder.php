<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => "Jacques",
            'email' => 'jacques.trdx@gmail.com',
            'password' => \Hash::make('password'),
        ]);
        \DB::table('users')->insert([
            'name' => "Magnus",
            'email' => 'magnus@barko.co.za',
            'password' => \Hash::make('password'),
        ]);
        \DB::table('users')->insert([
            'name' => "Ronald",
            'email' => 'ronald@barko.co.za',
            'password' => \Hash::make('B@rk02021!'),
        ]);
        \DB::table('users')->insert([
            'name' => "Johan ST",
            'email' => 'johanst@barko.co.za',
            'password' => \Hash::make('password'),
        ]);

        \DB::table('users')->insert([
            'name' => "Johan VS",
            'email' => 'johanvs@barko.co.za',
            'password' => \Hash::make('password'),
        ]);

    }
}
