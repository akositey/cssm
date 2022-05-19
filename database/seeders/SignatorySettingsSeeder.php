<?php

namespace Database\Seeders;

use App\Models\SignatorySettings;
use Illuminate\Database\Seeder;

class SignatorySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $default = [
            'reviewer_name' => 'Engr. MAR JOY B. RIVER',
            'reviewer_position' => 'Supervising Administrative Officer',
            'noter_name' => 'HUB CHRIS A. DOL, MD, MPA, MHA',
            'noter_position' => 'Provincial Administrator'
        ];

        SignatorySettings::create($default);
    }
}
