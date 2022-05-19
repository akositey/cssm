<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $offices = [
            //GO
            [
                'old_id' => 10,
                'name' => 'Office of the Governor',
                'abbr' => 'GO',
                'children' => [
                    [
                        'old_id' => 42,
                        'name' => 'GO-Management Support Staff Division',
                        'abbr' => 'GO-MSSD'
                    ],
                    [
                        'old_id' => 23,
                        'name' => 'GO-Internal Audit & Services Division',
                        'abbr' => 'GO-IASD'
                    ],
                    [
                        'old_id' => 8,
                        'name' => 'GO-Education & Employment Services Division',
                        'abbr' => 'GO-EESD'
                    ], // how about 4? multiple entries (>,<)!!!
                    [
                        'old_id' => 24,
                        'name' => 'GO-Provincial Detention Center Management Division',
                        'abbr' => 'GO-PDCMD'
                    ],
                    [
                        'old_id' => null,
                        'name' => 'GO-PDCMD-Pinamalayan',
                        'abbr' => 'GO-PDCMD-Pinamalayan'
                    ],
                    [
                        'old_id' => null,
                        'name' => 'GO-PDCMD-Roxas',
                        'abbr' => 'GO-PDCMD-Roxas'
                    ],
                    [
                        'old_id' => 130,
                        'name' => 'GO-Special Concerns Division',
                        'abbr' => 'GO-SCD'
                    ],
                    [
                        'old_id' => 131,
                        'name' => 'GO-Provincial Social Action Center',
                        'abbr' => 'GO-PSAC'
                    ],
                    [
                        'old_id' => 35,
                        'name' => 'GO-Language Skills Institute',
                        'abbr' => 'GO-LSI'
                    ],
                    [
                        'old_id' => 36,
                        'name' => 'GO-Extension Office',
                        'abbr' => 'GO-EXT'
                    ],
                    [
                        'old_id' => 40,
                        'name' => 'GO-Botika ng Lalawigan',
                        'abbr' => 'GO-BLOM'
                    ],
                    [
                        'old_id' => 25,
                        'name' => 'GO-Public Information Services Division',
                        'abbr' => 'GO-PISD'
                    ],
                    [
                        'old_id' => 69,
                        'name' => 'GO-Galing at Serbisyo para sa Mindoreño Action Center',
                        'abbr' => 'GO-GSMAC'
                    ],
                    [
                        'old_id' => 132,
                        'name' => 'GO-Oriental Mindoro Blood Council',
                        'abbr' => 'GO-OMBC'
                    ]
                ]
            ],
            // SP
            [
                'old_id' => 11,
                'name' => 'Office of the Vice Governor & Sangguniang Panlalawigan',
                'abbr' => 'SP-OVG',
                'children' => [
                    [
                        'old_id' => null,
                        'name' => 'SP-Records',
                        'abbr' => 'SP-Records'
                    ]
                ]
            ],
            //PA
            [
                'old_id' => 12,
                'name' => 'Provincial Administrator\'s Office',
                'abbr' => 'PA',
                'children' => [
                    [
                        'old_id' => 32,
                        'name' => 'PA-Management Information Services Division',
                        'abbr' => 'PA-MISD'
                    ],
                    [
                        'old_id' => null,
                        'name' => 'PA-Anti Red Tape Act Desk',
                        'abbr' => 'PA-ARTA'
                    ]
                ]
            ],
            // PHRMO
            [
                'old_id' => 9,
                'name' => 'Provincial Human Resource Management Office',
                'abbr' => 'PHRMO'
            ],
            // PPDO
            [
                'old_id' => 13,
                'name' => 'Provincial Planning and Development Office',
                'abbr' => 'PPDO',
                'children' => [
                    [
                        'old_id' => 1,
                        'name' => 'PPDO-Administrative Division',
                        'abbr' => 'PPDO-Admin'
                    ],
                    [
                        'old_id' => 2,
                        'name' => 'PPDO-Planning & Programming Division',
                        'abbr' => 'PPDO-Planning'
                    ],
                    [
                        'old_id' => 3,
                        'name' => 'PPDO-Statistics & Evaluation Division',
                        'abbr' => 'PPDO-Statistics'
                    ],
                    [
                        'old_id' => 44,
                        'name' => 'PPDO-Research and Project Development Management Division',
                        'abbr' => 'PPDO-Research'
                    ],
                    [
                        'old_id' => 45,
                        'name' => 'PPDO-Monitoring and Evaluation Division',
                        'abbr' => 'PPDO-Monitoring'
                    ]
                ]
            ],
            // PGSO
            [
                'old_id' => 14,
                'name' => 'Provincial General Services Office',
                'abbr' => 'PGSO',
                'children' => [
                    [
                        'old_id' => 21,
                        'name' => 'PGSO-Civil Security Division',
                        'abbr' => 'PGSO-CSD'
                    ]
                ]
            ],
            // PBO / OPA / PTO / PAsO / PLO
            [
                'old_id' => 15,
                'name' => 'Provincial Budget Office',
                'abbr' => 'PBO'
            ],
            [
                'old_id' => 16,
                'name' => 'Office of the Provincial Accountant',
                'abbr' => 'OPA'
            ],
            [
                'old_id' => 17,
                'name' => 'Provincial Treasurer\'s Office',
                'abbr' => 'PTO'
            ],
            [
                'old_id' => 18,
                'name' => 'Provincial Assessor\'s Office',
                'abbr' => 'PASO'
            ],
            [
                'old_id' => 26,
                'name' => 'Provincial Legal Office',
                'abbr' => 'PLO'
            ],
            // PDRRMO
            [
                'old_id' => 7,
                'name' => 'Provincial Disaster Risk Reduction & Mgt. Office',
                'abbr' => 'PDRRMO'
            ],
            // PHO
            [
                'old_id' => 43,
                'name' => 'Provincial Health Office',
                'abbr' => 'PHO',
                'children' => [
                    [
                        'old_id' => 5,
                        'name' => 'Oriental Mindoro Provincial Hospital',
                        'abbr' => 'OMPH'
                    ],
                    [
                        'old_id' => 46,
                        'name' => 'PHO-Drug Rehab Center',
                        'abbr' => 'PHO-DRC'
                    ],
                    [
                        'old_id' => 37,
                        'name' => 'Oriental Mindoro Central District Hospital',
                        'abbr' => 'OMCDH'
                    ],
                    [
                        'old_id' => 38,
                        'name' => 'Oriental Mindoro Southern District Hospital',
                        'abbr' => 'OMSDH'
                    ],
                    [
                        'old_id' => 39,
                        'name' => 'Bulalacao Community Hospital',
                        'abbr' => 'BCH'
                    ],
                    [
                        'old_id' => 41,
                        'name' => 'Naujan Community Hospital',
                        'abbr' => 'NCH'
                    ]
                ]
            ],
            // etc
            [
                'old_id' => 27,
                'name' => 'Provincial Social Welfare & Development Office',
                'abbr' => 'PSWDO'
            ],
            [
                'old_id' => 28,
                'name' => 'Provincial Agriculturist Office',
                'abbr' => 'PAgO'
            ],
            [
                'old_id' => 29,
                'name' => 'Provincial Veterinary\'s Office',
                'abbr' => 'ProVet'
            ],
            [
                'old_id' => 30,
                'name' => 'Provincial Environment & Natural Resources Office',
                'abbr' => 'ENRO'
            ],
            [
                'old_id' => 31,
                'name' => 'Provincial Engineering Office',
                'abbr' => 'PEO'
            ],
            [
                'old_id' => 22,
                'name' => 'Provincial Tourism, Investment, and Enterprise Development Office',
                'abbr' => 'PTIEDO',
                'children' => [
                    [
                        'old_id' => 67,
                        'name' => 'Provincial Tourism and Cultural Affairs Office',
                        'abbr' => 'PTIEDO-Tourism']
                ]
            ]
        ];

        $this->create($offices);

        // $offices = [
        //     //test office
        //     ['id' => 999999999, 'parent_id' => null, 'old_id' => null, 'name' => 'Test Office', 'abbr' => 'TEST'],
        //     //GO
        //     ['id' => 1, 'parent_id' => null, 'old_id' => 10, 'name' => 'Office of the Governor', 'abbr' => 'GO'],
        //     ['id' => 2, 'parent_id' => 1, 'old_id' => 42, 'name' => 'GO-Management Support Staff Division', 'abbr' => 'GO-MSSD'],
        //     ['id' => 3, 'parent_id' => 1, 'old_id' => 23, 'name' => 'GO-Internal Audit & Services Division', 'abbr' => 'GO-IASD'],
        //     ['id' => 4, 'parent_id' => 1, 'old_id' => 8, 'name' => 'GO-Education & Employment Services Division', 'abbr' => 'GO-EESD'], // how about 4? multiple entries (>,<)!!!
        //     ['id' => 5, 'parent_id' => 1, 'old_id' => 24, 'name' => 'GO-Provincial Detention Center Management Division', 'abbr' => 'GO-PDCMD'],
        //     ['id' => 47, 'parent_id' => 5, 'old_id' => null, 'name' => 'GO-PDCMD-Pinamalayan', 'abbr' => 'GO-PDCMD-Pinamalayan'],
        //     ['id' => 48, 'parent_id' => 5, 'old_id' => null, 'name' => 'GO-PDCMD-Roxas', 'abbr' => 'GO-PDCMD-Roxas'],
        //     ['id' => 6, 'parent_id' => 1, 'old_id' => 130, 'name' => 'GO-Special Concerns Division', 'abbr' => 'GO-SCD'],
        //     ['id' => 7, 'parent_id' => 1, 'old_id' => 131, 'name' => 'GO-Provincial Social Action Center', 'abbr' => 'GO-PSAC'],
        //     ['id' => 8, 'parent_id' => 1, 'old_id' => 35, 'name' => 'GO-Language Skills Institute', 'abbr' => 'GO-LSI'],
        //     ['id' => 9, 'parent_id' => 1, 'old_id' => 36, 'name' => 'GO-Extension Office', 'abbr' => 'GO-EXT'],
        //     ['id' => 10, 'parent_id' => 1, 'old_id' => 40, 'name' => 'GO-Botika ng Lalawigan', 'abbr' => 'GO-BLOM'],
        //     ['id' => 43, 'parent_id' => 1, 'old_id' => 25, 'name' => 'GO-Public Information Services Division', 'abbr' => 'GO-PISD'],
        //     ['id' => 44, 'parent_id' => 1, 'old_id' => 69, 'name' => 'GO-Galing at Serbisyo para sa Mindoreño Action Center', 'abbr' => 'GO-GSMAC'],
        //     ['id' => 45, 'parent_id' => 1, 'old_id' => 132, 'name' => 'GO-Oriental Mindoro Blood Council', 'abbr' => 'GO-OMBC'],
        //     // SP
        //     ['id' => 11, 'parent_id' => null, 'old_id' => 11, 'name' => 'Office of the Vice Governor & Sangguniang Panlalawigan', 'abbr' => 'SP-OVG'],
        //     ['id' => 49, 'parent_id' => null, 'old_id' => null, 'name' => 'SP-Records', 'abbr' => 'SP-Records'],
        //     //PA
        //     ['id' => 12, 'parent_id' => null, 'old_id' => 12, 'name' => 'Provincial Administrator\'s Office', 'abbr' => 'PA'],
        //     ['id' => 13, 'parent_id' => 12, 'old_id' => 32, 'name' => 'PA-Management Information Services Division', 'abbr' => 'PA-MISD'],
        //     ['id' => 46, 'parent_id' => 12, 'old_id' => null, 'name' => 'PA-Anti Red Tape Act Desk', 'abbr' => 'PA-ARTA'],
        //     // PHRMO
        //     ['id' => 14, 'parent_id' => null, 'old_id' => 9, 'name' => 'Provincial Human Resource Management Office', 'abbr' => 'PHRMO'],
        //     // PPDO
        //     ['id' => 15, 'parent_id' => null, 'old_id' => 13, 'name' => 'Provincial Planning and Development Office', 'abbr' => 'PPDO'],
        //     ['id' => 16, 'parent_id' => 15, 'old_id' => 1, 'name' => 'PPDO-Administrative Division', 'abbr' => 'PPDO-Admin'],
        //     ['id' => 17, 'parent_id' => 15, 'old_id' => 2, 'name' => 'PPDO-Planning & Programming Division', 'abbr' => 'PPDO-Planning'],
        //     ['id' => 18, 'parent_id' => 15, 'old_id' => 3, 'name' => 'PPDO-Statistics & Evaluation Division', 'abbr' => 'PPDO-Statistics'],
        //     ['id' => 19, 'parent_id' => 15, 'old_id' => 44, 'name' => 'PPDO-Research and Project Development Management Division', 'abbr' => 'PPDO-Research'],
        //     ['id' => 20, 'parent_id' => 15, 'old_id' => 45, 'name' => 'PPDO-Monitoring and Evaluation Division', 'abbr' => 'PPDO-Monitoring'],
        //     // PGSO
        //     ['id' => 21, 'parent_id' => null, 'old_id' => 14, 'name' => 'Provincial General Services Office', 'abbr' => 'PGSO'],
        //     ['id' => 22, 'parent_id' => null, 'old_id' => 21, 'name' => 'PGSO-Civil Security Division', 'abbr' => 'PGSO-CSD'],
        //     // PBO / OPA / PTO / PAsO / PLO
        //     ['id' => 23, 'parent_id' => null, 'old_id' => 15, 'name' => 'Provincial Budget Office', 'abbr' => 'PBO'],
        //     ['id' => 24, 'parent_id' => null, 'old_id' => 16, 'name' => 'Office of the Provincial Accountant', 'abbr' => 'OPA'],
        //     ['id' => 25, 'parent_id' => null, 'old_id' => 17, 'name' => 'Provincial Treasurer\'s Office', 'abbr' => 'PTO'],
        //     ['id' => 26, 'parent_id' => null, 'old_id' => 18, 'name' => 'Provincial Assessor\'s Office', 'abbr' => 'PASO'],
        //     ['id' => 27, 'parent_id' => null, 'old_id' => 26, 'name' => 'Provincial Legal Office', 'abbr' => 'PLO'],
        //     // PDRRMO
        //     ['id' => 28, 'parent_id' => null, 'old_id' => 7, 'name' => 'Provincial Disaster Risk Reduction & Mgt. Office', 'abbr' => 'PDRRMO'],
        //     // PHO
        //     ['id' => 29, 'parent_id' => null, 'old_id' => 43, 'name' => 'Provincial Health Office', 'abbr' => 'PHO'],
        //     ['id' => 30, 'parent_id' => 28, 'old_id' => 5, 'name' => 'Oriental Mindoro Provincial Hospital', 'abbr' => 'OMPH'],
        //     ['id' => 31, 'parent_id' => 28, 'old_id' => 46, 'name' => 'PHO-Drug Rehab Center', 'abbr' => 'PHO-DRC'],
        //     ['id' => 32, 'parent_id' => 28, 'old_id' => 37, 'name' => 'Oriental Mindoro Central District Hospital', 'abbr' => 'OMCDH'],
        //     ['id' => 33, 'parent_id' => 28, 'old_id' => 38, 'name' => 'Oriental Mindoro Southern District Hospital', 'abbr' => 'OMSDH'],
        //     ['id' => 34, 'parent_id' => 28, 'old_id' => 39, 'name' => 'Bulalacao Community Hospital', 'abbr' => 'BCH'],
        //     ['id' => 35, 'parent_id' => 28, 'old_id' => 41, 'name' => 'Naujan Community Hospital', 'abbr' => 'NCH'],
        //     // etc
        //     ['id' => 36, 'parent_id' => null, 'old_id' => 27, 'name' => 'Provincial Social Welfare & Development Office', 'abbr' => 'PSWDO'],
        //     ['id' => 37, 'parent_id' => null, 'old_id' => 28, 'name' => 'Provincial Agriculturist Office', 'abbr' => 'PAgO'],
        //     ['id' => 38, 'parent_id' => null, 'old_id' => 29, 'name' => 'Provincial Veterinary\'s Office', 'abbr' => 'ProVet'],
        //     ['id' => 39, 'parent_id' => null, 'old_id' => 30, 'name' => 'Provincial Environment & Natural Resources Office', 'abbr' => 'ENRO'],
        //     ['id' => 40, 'parent_id' => null, 'old_id' => 31, 'name' => 'Provincial Engineering Office', 'abbr' => 'PEO'],
        //     ['id' => 41, 'parent_id' => null, 'old_id' => 22, 'name' => 'Provincial Tourism, Investment, and Enterprise Development Office', 'abbr' => 'PTIEDO'],
        //     ['id' => 42, 'parent_id' => null, 'old_id' => 67, 'name' => 'Provincial Tourism and Cultural Affairs Office', 'abbr' => 'PTIEDO-Tourism']
        // ];

        // foreach ($offices as $dept) {
        //     \App\Models\Office::create($dept);
        // }

    }

    /**
     * @param array  $offices
     * @param String|null $parentId
     */
    private function create(array $offices, string $parentId = null): void
    {
        foreach ($offices as $office) {
            $origOffice = $office;
            unset($office['children']);
            $office['parent_id'] = $parentId;
            $newOffice = \App\Models\Office::create($office);
            if (isset($origOffice['children'])) {
                $this->create($origOffice['children'], $newOffice->id);
            }
        }
    }
}
