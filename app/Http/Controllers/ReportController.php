<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Question;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only('office', 'month');

        $stats = [
            'ratings' => [
                'services' => [],
                'total' => []
            ]
        ];
        $mandatoryQuestions = Question::where('is_required', 1);
        $mandatoryQuestionIds = $mandatoryQuestions->pluck('id')->toArray();

        $services = Service::where('office_id', $request->only('office'))->with('feedback')->with('feedback.answers')->get();
        // dd($services);
        foreach ($services as $service) {

            $allFeedback = $service->feedback;

            if ($allFeedback->count()) {
                $totalAnswers = 0;
                $goodScore = 0;
                $tallyPerQuestion = [];
                $tallyPerRating = array_fill_keys([1, 2, 3, 4, 5], 0);

                # Fill tallyPerQuestion with empty data
                foreach ($mandatoryQuestionIds as $qId) {
                    for ($i = 1; $i <= 5; $i++) {
                        $tallyPerQuestion[$qId][$i] = 0;
                    }
                }

                # count stuff during loop
                foreach ($allFeedback as $feedback) {

                    foreach ($feedback->answers as $answer) {
                        if (in_array($answer->question_id, $mandatoryQuestionIds)) {
                            $totalAnswers++;
                            $tallyPerQuestion[$answer->question_id][$answer->answer]++;
                            $tallyPerRating[$answer->answer]++;
                        }
                        if (in_array($answer->answer, [4, 5])) {
                            $goodScore++;
                        }
                    }
                }

                # % of VS & O Ratings
                $goodPercent = ($goodScore / $totalAnswers) * 100;

                # questions - rating
                $questions = [];
                foreach ($mandatoryQuestions->get() as $q) {
                    $questions[] = [
                        'question' => $q->question,
                        'ratings' => $tallyPerQuestion[$q->id]
                    ];
                }
                $stats['ratings']['services'][] = [
                    'service' => $service->name,
                    'clients' => $allFeedback->count(),
                    'goodPercent' => number_format($goodPercent, 2),
                    'averagePercent' => $tallyPerRating,
                    'questions' => $questions,
                    'comments' => [
                        'positive' => ['Comment1', 'Comment2', 'Comment3', 'Comment4', 'Comment5', 'Comment6'],
                        'negative' => ['NegativeComment1', 'NegativeComment2']
                    ]
                ];

                // dd($stats);
            }

        }
        // $stats = [
        //     'ratings' => [
        //         'services' =>
        //         [
        //             [
        //                 'service' => 'Service1',
        //                 'clients' => 1,
        //                 'goodPercent' => 100,
        //                 'averagePercent' => [0, 0, 0, 0, 0],
        //                 'questions' => [
        //                     [
        //                         'question' => 'Question1',
        //                         'ratings' => [0, 1, 2, 3, 4]
        //                     ],
        //                     [
        //                         'question' => 'Question2',
        //                         'ratings' => [0, 1, 2, 3, 4]
        //                     ],
        //                     [
        //                         'question' => 'Question3',
        //                         'ratings' => [0, 1, 2, 3, 4]
        //                     ]
        //                 ],
        //                 'comments' => [
        //                     'positive' => ['Comment1', 'Comment2', 'Comment3', 'Comment4', 'Comment5', 'Comment6'],
        //                     'negative' => ['NegativeComment1', 'NegativeComment2']
        //                 ]

        //             ],
        //             [
        //                 'service' => 'Service2',
        //                 'clients' => 2,
        //                 'goodPercent' => 90,
        //                 'averagePercent' => [0, 0, 0, 0, 0],
        //                 'questions' => [
        //                     [
        //                         'question' => 'Question1',
        //                         'ratings' => [5, 4, 3, 2, 1]
        //                     ],
        //                     [
        //                         'question' => 'Question2',
        //                         'ratings' => [5, 4, 3, 2, 1]
        //                     ],
        //                     [
        //                         'question' => 'Question3',
        //                         'ratings' => [5, 4, 3, 2, 1]
        //                     ]
        //                 ],
        //                 'comments' => [
        //                     [
        //                         'positive' => ['Comment7', 'Comment8', 'Comment9'],
        //                         'negative' => ['NegativeComment10', 'NegativeComment11']
        //                     ]
        //                 ]

        //             ]
        //         ],
        //         'total' =>
        //         [
        //             'clients' => 3,
        //             'goodPercent' => 95
        //         ]
        //     ]
        // ];

        return Inertia::render('Reports/Index', [
            'filters' => $filters,
            'offices' => Office::all()->transform(function ($office) {
                return [
                    'id' => $office->id,
                    'abbr' => $office->abbr
                ];
            }),
            'stats' => $stats
        ]);
    }
}
