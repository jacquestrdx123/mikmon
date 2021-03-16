<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('devices')->insert([
            'ip' => '10.39.1.6',
            'description' => 'Office 2011',
            'model' => 'Office 2011',
            'status' => '1',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 2
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.38.32',
            'description' => 'Office 750',
            'model' => 'Office 750',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.39.1',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.1',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.2',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.3',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.4',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.5',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.6',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.7',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.8',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.9',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.10',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.11',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.12',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.13',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.14',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.15',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '10.99.37.16',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'public',
            'username' => 'admin',
            'password' => 'ittxle4K00m',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '160.19.36.7',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'ittx',
            'username' => 'jacquest',
            'password' => 'CocaCola1',
            'location_id' => 1
        ]);
        \DB::table('devices')->insert([
            'ip' => '160.19.36.12',
            'description' => 'Office CCR',
            'model' => 'Office CCR',
            'status' => '4',
            'devicetype' => 'mikrotik',
            'created_at' => '2020-01-01 10:10:10',
            'updated_at' => '2020-01-01 10:10:10',
            'snmp_community' => 'ittx',
            'username' => 'jacquest',
            'password' => 'CocaCola1',
            'location_id' => 1
        ]);
    }
}
