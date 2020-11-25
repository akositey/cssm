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
        if ($request->office && $request->month) {

            $mandatoryQuestions = Question::where('is_required', 1);
            $mandatoryQuestionIds = $mandatoryQuestions->pluck('id')->toArray();

            $services = Service::where('office_id', $request->office)->where('created_at', 'like', $request->month . "%")->with('feedback')->get();

            $totalClients = 0;
            $totalGoodScore = 0;
            $totalAnswers = 0;
            $totalGoodPercent = 0;

            foreach ($services as $service) {

                $allFeedback = $service->feedback;

                if ($allFeedback->count()) {
                    $ctrAnswers = 0;
                    $ctrGoodScore = 0;
                    $tallyPerQuestion = [];
                    $tallyPerRating = array_fill_keys([1, 2, 3, 4, 5], 0);

                    # fill tallyPerQuestion with empty data
                    foreach ($mandatoryQuestionIds as $qId) {
                        for ($i = 1; $i <= 5; $i++) {
                            $tallyPerQuestion[$qId][$i] = 0;
                        }
                    }

                    # count stuff during loop
                    foreach ($allFeedback as $feedback) {

                        foreach ($feedback->answers as $answer) {
                            if (in_array($answer->question_id, $mandatoryQuestionIds)) {
                                $ctrAnswers++;
                                $tallyPerQuestion[$answer->question_id][$answer->answer]++;
                                $tallyPerRating[$answer->answer]++;
                            }
                            if (in_array($answer->answer, [4, 5])) {
                                $ctrGoodScore++;
                            }
                        }
                    }

                    # % of VS & O Ratings
                    $goodPercent = number_format(($ctrGoodScore / $ctrAnswers) * 100, 2);

                    # questions - rating
                    $questions = [];
                    foreach ($mandatoryQuestions->get() as $q) {
                        $questions[] = [
                            'question' => $q->question,
                            'ratings' => $tallyPerQuestion[$q->id]
                        ];
                    }

                    # comments
                    $positiveComments = [];
                    $negativeComments = [];
                    $untranscribedComments = [];
                    foreach ($allFeedback as $feedback) {
                        if (!is_null($feedback->positive_comments)) {
                            $positiveComments[] = [
                                'id' => $feedback->id,
                                'comment' => $feedback->positive_comments
                            ];
                        }
                        if (!is_null($feedback->negative_comments)) {
                            $negativeComments[] = [
                                'id' => $feedback->id,
                                'comment' => $feedback->negative_comments
                            ];
                        }
                        if ($feedback->comments_image_path && is_null($feedback->positive_comments) && is_null($feedback->negative_comments)) {
                            $untranscribedComments[] = [
                                'id' => $feedback->id,
                                'comment' => '-- untranscribed comment/suggestion --'
                            ];
                        }
                    }
                    // $positiveComments = $allFeedback->filter(function ($feedback) {
                    //     return !is_null($feedback->positive_comments);
                    // })->transform(function ($feedback) {
                    //     return [
                    //         'id' => $feedback->id,
                    //         'comment' => $feedback->positive_comments
                    //     ];
                    // })->all()->toArray();
                    // $negativeComments = $allFeedback->filter(function ($feedback) {
                    //     return !is_null($feedback->negative_comments);
                    // })->transform(function ($feedback) {
                    //     return [
                    //         'id' => $feedback->id,
                    //         'comment' => $feedback->negative_comments
                    //     ];
                    // })->all()->toArray();
                    // $untranscribedComments = $allFeedback->filter(function ($feedback) {
                    //     return $feedback->comments_image_path && is_null($feedback->positive_comments) && is_null($feedback->negative_comments);
                    // })->transform(function ($feedback) {
                    //     return [
                    //         'id' => $feedback->id,
                    //         'comment' => '-- untranscribed comment/suggestion --'
                    //     ];
                    // })->all()->toArray();
                    // $positiveComments = $allFeedback->pluck('positive_comments')->filter()->flatten()->all();
                    // $negativeComments = $allFeedback->pluck('negative_comments')->filter()->flatten()->all();
                    // $untranscribedComments = $allFeedback->filter(function ($feedback) {
                    //     return $feedback->comments_image_path && is_null($feedback->positive_comments) && is_null($feedback->negative_comments);
                    // })->pluck('id')->all();
                    // dd($untranscribedComments);
                    # num of clients
                    $ctrClients = $allFeedback->count();

                    $stats['ratings']['services'][] = [
                        'service' => $service->name,
                        'clients' => $ctrClients,
                        'goodPercent' => $goodPercent,
                        'averagePercent' => $tallyPerRating,
                        'questions' => $questions,
                        'comments' => [
                            'positive' => $positiveComments,
                            'negative' => $negativeComments,
                            'untranscribed' => $untranscribedComments
                        ]
                    ];
                    $totalClients += $ctrClients;
                    $totalGoodScore += $ctrGoodScore;
                    $totalAnswers += $ctrAnswers;
                    // dd($stats);
                }

            }

            # totals
            $totalGoodPercent = number_format(($totalGoodScore / $totalAnswers) * 100, 2);

            $stats['ratings']['total'] = [
                'clients' => $totalAnswers,
                'goodPercent' => $totalGoodPercent
            ];

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
