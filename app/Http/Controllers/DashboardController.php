<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Services\DashboardData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $filters = $request->only('month');
//        dd($filters);

        // offices with most feedback
        $mostFeedback = Office::all()->transform(function ($office) use ($filters) {
            return [
                'id' => $office->id,
                'abbr' => $office->abbr,
                'feedbackCount' => $office->feedback()->filter($filters)->count()
            ];
        })->sortBy('feedbackCount')->reverse()->toArray();

        $data = [
            'filters' => $filters,
            'mostFeedback' => array_values($mostFeedback)
        ];
        return Inertia::render('Dashboard/Index', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function officeStats(Request $request): JsonResponse
    {
        $filters = $request->only('office', 'month');
        # office stats for the month
        $chartData = [
            'labels' => [],
            'data' => []
        ];
        if (!empty($filters['office'])) {
            $dashboardData = new DashboardData(Office::find($filters['office']));

            # stats within a specific month
            if (!empty($filters['month'])) {
                $chartData = $dashboardData->getStatsThisMonth($filters['month']);
                return response()->json($chartData);
            }

            $chartData = $dashboardData->getStatsThisPastYear();

            return response()->json($chartData);

        }

        return response()->json($chartData);

    }
}
