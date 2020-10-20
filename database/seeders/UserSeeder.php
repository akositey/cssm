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
    public function run()
    {
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'chestermartinez@gmail.com',
                'email_verified_at' => now(),
                'type' => 1, //admin
                'password' => bcrypt('@12345'), // password
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'GO',
                'username' => 'go',
                'password' => bcrypt('X12N20070260'),
                'email_verified_at' => now(),
                'office_id' => 1
            ], [
                'name' => 'EA',
                'username' => 'ea',
                'password' => bcrypt('X12N20070259'),
                'email_verified_at' => now(),
                'office_id' => 2
            ], [
                'name' => 'IASD',
                'username' => 'iasd',
                'password' => bcrypt('X12N20070282'),
                'email_verified_at' => now(),
                'office_id' => 3
            ], [
                'name' => 'BLOM',
                'username' => 'blom',
                'password' => bcrypt('X12N20070300'),
                'email_verified_at' => now(),
                'office_id' => 10
            ], [
                'name' => 'PISD',
                'username' => 'pisd',
                'password' => bcrypt('X12N20070258'),
                'email_verified_at' => now(),
                'office_id' => 43
            ], [
                'name' => 'LSI',
                'username' => 'lsi',
                'password' => bcrypt('X12N20070280'),
                'email_verified_at' => now(),
                'office_id' => 8
            ], [
                'name' => 'EESD',
                'username' => 'eesd',
                'password' => bcrypt('X12N20070242'),
                'email_verified_at' => now(),
                'office_id' => 4
            ], [
                'name' => 'SCD',
                'username' => 'scd',
                'password' => bcrypt('X12N20070297'),
                'email_verified_at' => now(),
                'office_id' => 6
            ], [
                'name' => 'PDCMD',
                'username' => 'pdcmd',
                'password' => bcrypt('X12N20070264'),
                'email_verified_at' => now(),
                'office_id' => 5
            ], [
                'name' => 'GSMAC',
                'username' => 'gsmac',
                'password' => bcrypt('X12N20070296'),
                'email_verified_at' => now(),
                'office_id' => 44
            ], [
                'name' => 'OMBC',
                'username' => 'ombc',
                'password' => bcrypt('X12N20070284'),
                'email_verified_at' => now(),
                'office_id' => 45
            ], [
                'name' => 'SP1',
                'username' => 'sp1',
                'password' => bcrypt('X12N20070286'),
                'email_verified_at' => now(),
                'office_id' => 11
            ], [
                'name' => 'SP2',
                'username' => 'sp2',
                'password' => bcrypt('X12N20070263'),
                'email_verified_at' => now(),
                'office_id' => 11
            ], [
                'name' => 'PA',
                'username' => 'pa',
                'password' => bcrypt('X12N20070254'),
                'email_verified_at' => now(),
                'office_id' => 12
            ], [
                'name' => 'ARTA',
                'username' => 'arta',
                'password' => bcrypt('X12N20070291'),
                'email_verified_at' => now(),
                'office_id' => 46
            ], [
                'name' => 'PPDO',
                'username' => 'ppdo',
                'password' => bcrypt('X12N20070285'),
                'email_verified_at' => now(),
                'office_id' => 15
            ], [
                'name' => 'PBO',
                'username' => 'pbo',
                'password' => bcrypt('X12N20070253'),
                'email_verified_at' => now(),
                'office_id' => 23
            ], [
                'name' => 'OPA',
                'username' => 'opa',
                'password' => bcrypt('X12N20070290'),
                'email_verified_at' => now(),
                'office_id' => 24
            ], [
                'name' => 'PTO',
                'username' => 'pto',
                'password' => bcrypt('X12N20070255'),
                'email_verified_at' => now(),
                'office_id' => 25
            ], [
                'name' => 'PHRMO',
                'username' => 'phrmo',
                'password' => bcrypt('X12N20070267'),
                'email_verified_at' => now(),
                'office_id' => 14
            ], [
                'name' => 'PGSO',
                'username' => 'pgso',
                'password' => bcrypt('X12N20070287'),
                'email_verified_at' => now(),
                'office_id' => 21
            ], [
                'name' => 'PAsO',
                'username' => 'paso',
                'password' => bcrypt('X12N20070243'),
                'email_verified_at' => now(),
                'office_id' => 26
            ], [
                'name' => 'PLO',
                'username' => 'plo',
                'password' => bcrypt('X12N20070256'),
                'email_verified_at' => now(),
                'office_id' => 27
            ], [
                'name' => 'PHO',
                'username' => 'pho',
                'password' => bcrypt('X12N20070293'),
                'email_verified_at' => now(),
                'office_id' => 29
            ], [
                'name' => 'NCH',
                'username' => 'nch',
                'password' => bcrypt('X12N20070266'),
                'email_verified_at' => now(),
                'office_id' => 35
            ], [
                'name' => 'OMCDH',
                'username' => 'omcdh',
                'password' => bcrypt('X12N20070299'),
                'email_verified_at' => now(),
                'office_id' => 32
            ], [
                'name' => 'OMSDH',
                'username' => 'omsdh',
                'password' => bcrypt('X12N20070303'),
                'email_verified_at' => now(),
                'office_id' => 33
            ], [
                'name' => 'OMPH',
                'username' => 'omph',
                'password' => bcrypt('X12N20070277'),
                'email_verified_at' => now(),
                'office_id' => 30
            ], [
                'name' => 'PSWDO',
                'username' => 'pswdo',
                'password' => bcrypt('X12N20070278'),
                'email_verified_at' => now(),
                'office_id' => 36
            ], [
                'name' => 'PAgO',
                'username' => 'pago',
                'password' => bcrypt('X12N20070292'),
                'email_verified_at' => now(),
                'office_id' => 37
            ], [
                'name' => 'PTIEDO1',
                'username' => 'ptiedo1',
                'password' => bcrypt('X12N20070265'),
                'email_verified_at' => now(),
                'office_id' => 41
            ], [
                'name' => 'PTIEDO2',
                'username' => 'ptiedo2',
                'password' => bcrypt('X12N20070298'),
                'email_verified_at' => now(),
                'office_id' => 41
            ], [
                'name' => 'ENRO',
                'username' => 'enro',
                'password' => bcrypt('X12N20070294'),
                'email_verified_at' => now(),
                'office_id' => 39
            ], [
                'name' => 'ProVet',
                'username' => 'provet',
                'password' => bcrypt('X12N20070288'),
                'email_verified_at' => now(),
                'office_id' => 38
            ], [
                'name' => 'PEO',
                'username' => 'peo',
                'password' => bcrypt('X12N20070241'),
                'email_verified_at' => now(),
                'office_id' => 40
            ], [
                'name' => 'PDRRMO',
                'username' => 'pdrrmo',
                'password' => bcrypt('X12N20070279'),
                'email_verified_at' => now(),
                'office_id' => 28
            ]
        ];
        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
