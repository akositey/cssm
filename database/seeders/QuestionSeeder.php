<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mandatoryQuestions = [
            [
                'question' => 'Magalang ang pagbibigay ng serbisyo',
                'is_required' => true,
                'type' => null
            ],
            [
                'question' => 'Mabilis na natugunan ang pangangailangan',
                'is_required' => true,
                'type' => null
            ],
            [
                'question' => 'Natugunan ng wasto at kumpleto ang pangangailangan',
                'is_required' => true,
                'type' => null
            ]
        ];

        $optionalPositiveQuestions = [
            [
                'question' => 'Maagap sa pag-asikaso sa kliyente',
                'is_required' => false,
                'type' => 1
            ],
            [
                'question' => 'Magalang at maayos ang pakikitungo ng mga empleyado',
                'is_required' => false,
                'type' => 1
            ],
            [
                'question' => 'Malinis ang opisina',
                'is_required' => false,
                'type' => 1
            ],
            [
                'question' => 'Mabilis ang pagproseso ng mga dokumento',
                'is_required' => false,
                'type' => 1
            ],
            [
                'question' => 'Maayos ang pasilidad para sa mga Senior Citizens at PWD',
                'is_required' => false,
                'type' => 1
            ],
            [
                'question' => 'Maaga pumasok ang empleyado',
                'is_required' => false,
                'type' => 1
            ]
        ];

        $optionalNegativeQuestions = [
            [
                'question' => 'Hindi agad naasikaso ang kliyente',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Masungit/suplado/nakasimangot ang empleyado',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Madumi ang opisina/CR/facilities',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Hindi natugunan nang maayos ang pangangailangan',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Matagal ang pagproseso ng mga dokumento',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Nanghihingi ng pera ang empleyado',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Hindi inuuna ang mga Senior Citizen o PWD',
                'is_required' => false,
                'type' => 2
            ],
            [
                'question' => 'Hindi nakauniporme/walang suot na ID',
                'is_required' => false,
                'type' => 2
            ]
        ];
        $optionalEtcQuestions = [
            // [
            //     'question' => 'Mga karagdagang kumento o suhestyon',
            //     'is_required' => false,
            //     'type' => 3
            // ]
        ];

        foreach (array_merge($mandatoryQuestions, $optionalPositiveQuestions, $optionalNegativeQuestions, $optionalEtcQuestions) as $question) {

            try {
                Question::create($question);
            } catch (\Throwable $th) {
                dd($th, $question);
            }
        }

    }
}
