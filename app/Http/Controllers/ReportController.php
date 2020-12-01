<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Question;
use App\Models\Service;
use App\Models\SignatorySettings;
use App\Services\ReportData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;

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

            $data = new ReportData(new Question(), new Service());
            $stats = $data->get($request->office, $request->month);

        }

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

    function print(Request $request) {
        // dd(json_decode($request->stats, true));

        $nodeBin = env('NODE_BIN');
        $npmBin = env('NPM_BIN');

        $stats = json_decode($request->stats, true);
        $signatory = SignatorySettings::first();
        if (!$signatory->count()) {
            $signatory = [
                'reviewer' => [
                    'name' => '--NOT SET--',
                    'position' => '--NOT SET--'
                ],
                'noter' => [
                    'name' => '--NOT SET--',
                    'position' => '--NOT SET--'
                ]
            ];
        }
        $data = [
            'stats' => $stats,
            'office' => Office::find($request->office)->name,
            'month' => $request->month,
            'preparer' => [
                'name' => Auth::user()->name,
                'position' => Auth::user()->position
            ],
            'reviewer' => [
                'name' => $signatory->reviewer_name,
                'position' => $signatory->reviewer_position
            ],
            'noter' => [
                'name' => $signatory->noter_name,
                'position' => $signatory->noter_position
            ]
        ];

        # debugging: output to browser
        // return view('report', $data);

        $content = view('report', $data)->render();

        # debugging: output html
        // return Browsershot::html($content)
        //     ->setNodeBinary($nodeBin)
        //     ->setNpmBinary($npmBin)
        //     ->margins(18, 18, 18, 18)
        //     ->format('Letter')
        //     ->bodyHtml();

        # output as pdf
        return response()->stream(function () use ($content, $nodeBin, $npmBin) {
            echo Browsershot::html($content)
                ->setNodeBinary($nodeBin)
                ->setNpmBinary($npmBin)
                ->margins(15, 15, 15, 22)
                ->format('Letter')
                ->pdf();
        }, 200, ['Content-Type' => 'application/pdf']);

        # download as pdf
        // $filename = Office::find($request->office)->abbr . '-' . $request->month . '.pdf';
        // return response()->streamDownload(function () use ($content,$nodeBin,$npmBin) {
        //     echo Browsershot::html($content)
        //         ->setNodeBinary($nodeBin)
        //         ->setNpmBinary($npmBin)
        //         ->margins(18, 18, 18, 18)
        //         ->format('Letter')
        //         ->pdf();
        // }, $filename, ['Content-Type' => 'application/pdf']);

    }
}
