<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

// use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OfficeSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            QuestionSeeder::class
        ]);
        if (App::environment('local', 'testing', 'staging')) {
            $this->call([
                DevSeeder::class
            ]);
        }
    }
}
