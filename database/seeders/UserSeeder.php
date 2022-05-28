<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'position' => 'app-admin',
            'username' => 'admin',
            'email' => 'chestermartinez@gmail.com',
            'email_verified_at' => now(),
            'is_admin' => 1, //admin
            'office_id' => 999999999,
            'password' => bcrypt('@12345'), // password
            'remember_token' => Str::random(10)
        ]);

        $boundDevices = [
            'go' => 'X12N20070260',
            'go-mssd' => 'X12N20070259',
            'go-iasd' => 'X12N20070282',
            'go-blom' => 'X12N20070300',
            'go-pisd' => 'X12N20070258',
            'go-lsi' => 'X12N20070280',
            'go-eesd' => 'X12N20070266', //was X12N20070242
            'go-scd' => 'X12N20070297',
            'go-pdcmd' => 'X12N20070264',
            'go-gsmac' => 'X12N20070296',
            'go-ombc' => 'X12N20070284',
            'sp-ovg' => 'X12N20070286',
            'sp-records' => 'X12N20070263',
            'pa' => 'X12N20070254',
            'pa-arta' => 'X12N20070291',
            'ppdo' => 'X12N20070285',
            'pbo' => 'X12N20070253',
            'opa' => 'X12N20070290',
            'pto' => 'X12N20070255',
            'phrmo' => 'X12N20070267',
            'pgso' => 'X12N20070287',
            'paso' => 'X12N20070243',
            'plo' => 'X12N20070256',
            // 'pho' => 'X12N20070293',
            // 'nch' => 'X12N20070266',
            'omcdh' => 'X12N20070299',
            'omsdh' => 'X12N20070303',
            'omph' => 'X12N20070277',
            'pswdo' => 'X12N20070278',
            'pago' => 'X12N20070292',
            'ptiedo' => 'X12N20070265',
            'ptiedo-tourism' => 'X12N20070298',
            'enro' => 'X12N20070293', // was X12N20070294
            'provet' => 'X12N20070288',
            'peo' => 'X12N20070241',
            'pdrrmo' => 'X12N20070279'
        ];
        foreach ($boundDevices as $officeAbbr => $serial) {
            //find office
            $officeMatch = \App\Models\Office::whereRaw(sprintf("UPPER(abbr) = '%s'", strtoupper($officeAbbr)))->first();
            if ($officeMatch) {
                //create user
                \App\Models\User::create([
                    'name' => strtoupper($officeAbbr),
                    'username' => $officeAbbr,
                    'password' => bcrypt($serial),
                    'email_verified_at' => now(),
                    'office_id' => $officeMatch->id,
                    'remember_token' => Str::random(10)
                ]);
            } else {
                dd($officeAbbr, $serial);
            }
        }

        \App\Models\User::create([
            'name' => 'JENNI D. NAS',
            'position' => 'Administrative Aide IV',
            'username' => 'jenn',
            'email' => '',
            'email_verified_at' => now(),
            'is_admin' => 1, //admin
            'office_id' => \App\Models\Office::where('abbr', 'PA')->first()->id,
            'password' => bcrypt('@12345'), // password
            'remember_token' => Str::random(10)
        ]);

    }
}
