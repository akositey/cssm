<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Office;
use App\Services\DashboardData;
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
        if (!empty($filters['office'])) {
            // dd($filters['office'], Office::find($filters['office']));
            $dashboardData = new DashboardData(Office::find($filters['office']));

            # stats within a specific month
            if (!empty($filters['month'])) {
                $chartData = $dashboardData->getStatsThisMonth($filters['month']);
                return response()->json($chartData);
            }

            $chartData = $dashboardData->getStatsThisPastYear();

            return response()->json($chartData);

        }
        // dd($chartData);
        return response()->json($chartData);

    }
}
