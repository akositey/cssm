<?php

namespace Database\Seeders;

use Database\Seeders\QuestionSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
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

        $this->call([
            QuestionSeeder::class
        ]);
    }
}
