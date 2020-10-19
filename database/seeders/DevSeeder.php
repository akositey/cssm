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
        // \App\Models\Office::factory(30)->create();
        \App\Models\Ip::factory(30)->create();
        \App\Models\Feedback::factory(100)->create();
    }
}
