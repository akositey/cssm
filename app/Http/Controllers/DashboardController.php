<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Office;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $filters = $request->only('month');

        // offices with most feedback
        $mostFeedback = Office::all()->transform(function ($office) use ($filters) {
            return [
                'id' => $office->id,
                'abbr' => $office->abbr,
                'feedbackCount' => $office->feedback()->filter($filters)->count()
            ];
        })->sortBy('feedbackCount')->reverse()->toArray();
        // dd(array_values($mostFeedback));

        $chartData = [
            'labels' => [],
            'datasets' => []
        ];
        $data = [
            'filters' => $filters,
            'mostFeedback' => array_values($mostFeedback)
        ];
        return Inertia::render('Dashboard/Index', $data);
    }

    /**
     * @param Request $request
     */
    public function officeStats(Request $request)
    {
        $filters = $request->only('office', 'month');
        # office stats for the month
        $chartData = [
            'labels' => [],
            'data' => []
        ];
        if (isset($filters['office'])) {

            # stats within a specific month
            if (isset($filters['month']) && !isset($filters['office'])) {
                $feedback = Office::find($filters['office'])
                    ->feedback()->filter($filters)
                    ->get();

                $lastDate = new CarbonImmutable($filters['month']);
                $lastDate->endOfMonth();

                $chartDataByDay = array_fill(1, +$lastDate->format('t'), 0);
                foreach ($feedback as $feed) {
                    $chartDataByDay[$feed->created_at->format('j')] += 1;
                }

                $chartData['labels'] = (array_keys($chartDataByDay));
                $chartData['data'] = (array_values($chartDataByDay));

                return response()->json($chartData);
            }

            # stats within the past year
            $lastMonth = new CarbonImmutable();
            $lastMonth->subYear()->format('Y-m');
            $feedback = Office::find($filters['office'])
                ->feedback()->filter($filters)->get()->filter(function ($feed) use ($lastMonth) {
                return $feed->created_at->format('Y-m') <= $lastMonth;
            });

            $chartDataByMonth = [];
            foreach ($feedback->pluck('created_at') as $date) {
                if (!isset($chartDataByMonth[$date->format('Y-m')])) {
                    $chartDataByMonth[$date->format('Y-m')] = 0;
                }
                $chartDataByMonth[$date->format('Y-m')] += 1;
            }
            ksort($chartDataByMonth);
            $chartData['labels'] = array_keys($chartDataByMonth);
            $chartData['data'] = array_values($chartDataByMonth);

            return response()->json($chartData);

        }
        // dd($chartData);
        return response()->json($chartData);

    }
}
