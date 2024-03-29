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

        $ips =
            ["10.0.22.33",
            "10.0.101.33",
            "10.0.1.193",
            "10.0.31.65",
            "10.0.90.1",
            "10.0.90.33",
            "10.0.10.33",
            "10.0.14.161",
            "10.0.20.97",
            "10.0.90.65",
            "10.0.6.33",
            "10.0.80.1",
            "10.0.97.129",
            "10.0.13.65",
            "10.0.1.1",
            "10.0.1.33",
            "10.0.102.129",
            "10.0.30.225",
            "10.0.2.161",
            "10.0.7.97",
            "10.0.8.193",
            "10.0.9.161",
            "10.0.10.1",
            "10.0.90.97",
            "10.0.15.97",
            "10.0.10.65",
            "10.0.10.97",
            "10.0.9.225",
            "10.0.14.129",
            "10.0.100.193",
            "10.0.90.129",
            "10.0.15.33",
            "10.0.102.97",
            "10.0.101.97",
            "10.0.8.129",
            "10.0.97.33",
            "10.0.3.193",
            "10.0.24.97",
            "10.0.94.97",
            "10.0.100.129",
            "10.0.5.161",
            "10.0.90.193",
            "10.0.91.1",
            "10.0.91.33",
            "10.0.100.97",
            "10.0.6.65",
            "10.0.97.129",
            "10.0.96.65",
            "10.0.91.65",
            "10.0.102.1",
            "10.0.2.1",
            "10.0.1.65",
            "10.0.11.225",
            "10.0.14.1",
            "10.0.13.193",
            "10.0.10.161",
            "10.0.10.193",
            "10.0.24.161",
            "10.0.8.225",
            "10.0.91.97",
            "10.0.14.33",
            "10.0.14.65",
            "10.0.1.129",
            "10.0.102.65",
            "10.0.91.129",
            "10.0.30.193",
            "10.0.91.161",
            "10.0.91.193",
            "10.0.2.65",
            "10.0.2.97",
            "10.0.2.225",
            "10.0.96.129",
            "10.0.93.65",
            "10.0.92.1",
            "10.0.100.161",
            "10.0.2.129",
            "10.0.2.33",
            "10.0.97.1",
            "10.0.8.33",
            "10.0.92.33",
            "10.0.92.65",
            "10.0.97.225",
            "10.0.13.33",
            "10.0.92.97",
            "10.0.13.129",
            "10.0.11.1",
            "10.0.11.193",
            "10.0.5.129",
            "10.0.92.129",
            "10.0.5.65",
            "10.0.0.1",
            "10.0.92.161",
            "10.0.100.225",
            "10.0.92.193",
            "10.0.93.1",
            "10.0.101.129",
            "10.0.13.161",
            "10.0.31.1",
            "10.0.93.33",
            "10.0.95.1",
            "10.0.100.33",
            "10.0.100.1",
            "10.0.19.33",
            "10.0.12.225",
            "10.0.98.1",
            "10.0.4.65",
            "10.0.4.97",
            "10.0.5.1",
            "10.0.7.33",
            "10.0.96.129",
            "10.0.93.97",
            "10.0.12.129",
            "10.0.14.225",
            "10.0.15.1",
            "10.0.93.129",
            "10.0.93.161",
            "10.0.93.193",
            "10.0.3.129",
            "10.0.94.1",
            "10.0.80.33",
            "10.0.12.97",
            "10.0.4.193",
            "10.0.13.97",
            "10.0.9.97",
            "10.0.8.1",
            "10.0.26.1",
            "10.0.11.97",
            "10.0.13.1",
            "10.0.94.33",
            "10.0.27.1",
            "10.0.94.65",
            "10.0.14.193",
            "10.0.94.129",
            "10.0.101.193",
            "10.0.12.65",
            "10.0.6.161",
            "10.0.40.1",
            "10.0.3.161",
            "10.0.61.193",
            "10.0.94.161",
            "10.0.8.97",
            "10.0.15.225",
            "10.0.94.193",
            "10.0.9.65",
            "10.0.1.97",
            "10.0.9.1",
            "10.0.96.33",
            "10.0.95.1",
            "10.0.96.225",
            "10.0.6.193",
            "10.0.96.97",
            "10.0.7.129",
            "10.0.7.161",
            "10.0.97.65",
            "10.0.101.65",
            "10.0.13.225",
            "10.0.95.65",
            "10.0.9.129",
            "10.0.6.1",
            "10.0.6.130",
            "10.0.101.1",
            "10.0.101.161",
            "10.0.2.193",
            "10.0.1.161",
            "10.0.3.97",
            "10.0.96.193",
            "10.0.24.33",
            "10.0.101.225",
            "10.0.10.129",
            "10.0.97.97",
            "10.0.95.97",
            "10.0.11.65",
            "10.0.11.161",
            "10.0.8.161",
            "10.0.96.161",
            "10.0.95.129",
            "10.0.24.129",
            "10.0.95.161",
            "10.0.11.129",
            "10.0.61.161",
            "10.0.97.193",
            "10.0.100.65",
            "10.0.31.97",
            "10.0.61.97",
            "10.0.61.129",
            "10.0.3.65",
            "10.0.95.193",
            "10.0.80.65",
            "10.0.30.161",
            "10.0.14.97",
            "10.0.4.1",
            "10.0.4.129",
            "10.0.4.161",
            "10.0.62.65",
            "10.0.62.97",
            "10.0.4.33",
            "10.0.61.65",
            "10.0.96.1"];
        $x = 1;
        foreach($ips as $ip){
            \DB::table('devices')->insert([
                'ip' => $ip,
                'description' => 'Office 2011',
                'model' => 'Office 2011',
                'status' => '1',
                'devicetype' => 'mikrotik',
                'created_at' => '2020-01-01 10:10:10',
                'updated_at' => '2020-01-01 10:10:10',
                'snmp_community' => 'barkomonitor',
                'username' => 'B@rkoM0n1t0R',
                'password' => 'B@rkoM0n1t0ROp3r@t0R!',
                'location_id' => $x
            ]);
            $x++;
        }

    }
}
