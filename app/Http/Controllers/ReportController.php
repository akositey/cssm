<?php

namespace App\Http\Controllers;

use App\Models\Office;
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
                'services' =>
                [
                    [
                        'service' => 'Service1',
                        'clients' => 1,
                        'goodPercent' => 100,
                        'averagePercent' => [0, 0, 0, 0, 0],
                        'questions' => [
                            [
                                'question' => 'Question1',
                                'ratings' => [0, 1, 2, 3, 4]
                            ],
                            [
                                'question' => 'Question2',
                                'ratings' => [0, 1, 2, 3, 4]
                            ],
                            [
                                'question' => 'Question3',
                                'ratings' => [0, 1, 2, 3, 4]
                            ]
                        ],
                        'comments' => [
                            'positive' => ['Comment1', 'Comment2', 'Comment3', 'Comment4', 'Comment5', 'Comment6'],
                            'negative' => ['NegativeComment1', 'NegativeComment2']
                            // [
                            //     'type' => 1, //positive
                            //     'comment' => 'Comment1'
                            // ],
                            // [
                            //     'type' => 1, //positive
                            //     'comment' => 'Comment2'
                            // ],
                            // [
                            //     'type' => 1, //positive
                            //     'comment' => 'Comment3'
                            // ],
                            // [
                            //     'type' => 0, //negative
                            //     'comment' => 'NegativeComment1'
                            // ],
                            // [
                            //     'type' => 0, //negative
                            //     'comment' => 'NegativeComment2'
                            // ]
                        ]

                    ],
                    [
                        'service' => 'Service2',
                        'clients' => 2,
                        'goodPercent' => 90,
                        'averagePercent' => [0, 0, 0, 0, 0],
                        'questions' => [
                            [
                                'question' => 'Question1',
                                'ratings' => [5, 4, 3, 2, 1]
                            ],
                            [
                                'question' => 'Question2',
                                'ratings' => [5, 4, 3, 2, 1]
                            ],
                            [
                                'question' => 'Question3',
                                'ratings' => [5, 4, 3, 2, 1]
                            ]
                        ],
                        'comments' => [
                            [
                                'positive' => ['Comment7', 'Comment8', 'Comment9'],
                                'negative' => ['NegativeComment10', 'NegativeComment11']
                            ]
                        ]

                    ]
                ],
                'total' =>
                [
                    'clients' => 3,
                    'goodPercent' => 95
                ]
            ]
        ];

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
