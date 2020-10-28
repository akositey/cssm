<?php

namespace Database\Seeders;

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
        //test admin
        \App\Models\Office::create([
            'id' => 999999999,
            'parent_id' => null,
            'old_id' => null,
            'name' => 'Test Office',
            'abbr' => 'TEST'
        ]);
        $testServices = [[
            'office_id' => 999999999,
            'name' => 'Service # 1'
        ], [
            'office_id' => 999999999,
            'name' => 'Service # 2'
        ], [
            'office_id' => 999999999,
            'name' => 'Service # 3'
        ]];
        foreach ($testServices as $service) {
            \App\Models\Service::create($service);
        }

    }
}
