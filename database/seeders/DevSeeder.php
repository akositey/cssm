<?php

namespace Database\Seeders;

use App\Models\Ip;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Office::factory(30)->create();
        // \App\Models\Ip::factory(30)->create();
        $devIps = [[
            'id' => 1,
            'address' => '127.0.0.1',
            'office_id' => 13 //MIS
        ], [
            'id' => 2,
            'address' => '192.168.255.25',
            'office_id' => 13 //MIS
        ]];
        foreach ($devIps as $ip) {
            Ip::create($ip);
        }
        \App\Models\Feedback::factory(100)->create();
    }
}
