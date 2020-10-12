<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'chestermartinez@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('@12345'), // password
            'remember_token' => Str::random(10)
        ]);
        \App\Models\Office::factory(30)->create();
        \App\Models\Ip::factory(30)->create();
        \App\Models\Feedback::factory(100)->create();
    }
}
