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
    public function run()
    {
        $default = [
            'reviewer_name' => 'Engr. MARIE JOYCE B. RIVERA',
            'reviewer_position' => 'Supervising Administrative Officer',
            'noter_name' => 'HUBBERT CHRISTOPHER A. DOLOR, MD, MPA, MHA',
            'noter_position' => 'Provincial Administrator'
        ];

        SignatorySettings::create($default);
    }
}
