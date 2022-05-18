<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Question;
use App\Models\Service;
use App\Services\PdfReportCreator;
use App\Services\ReportData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * @var \App\Services\PdfReportCreator
     */
    private $pdfReportCreator;

    public function __construct(
        PdfReportCreator $pdfReportCreator
    )
    {
        $this->pdfReportCreator = $pdfReportCreator;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $filters = $request->only('office', 'month_from', 'month_to');
        $office = $monthFrom = $monthTo = null;
        if(!empty($filters)) {
            ['office' => $office, 'month_from' => $monthFrom, 'month_to' => $monthTo] = $filters;
        }
        $stats = [
            'services' => [],
            'total' => []
        ];
        if ($office && $monthFrom) {
            $data = new ReportData(new Question(), new Service());
            $stats = $data->get($office, $monthFrom, $monthTo);
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

    public function print(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $post = $request->only('office', 'month_from', 'month_to');
        ['office' => $office, 'month_from' => $monthFrom, 'month_to' => $monthTo] = $post;

        $filePath = $this->pdfReportCreator->execute($office, $monthFrom, $monthTo);

        return response()->file($filePath);

    }
}
