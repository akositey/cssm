<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Office;
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

        return Inertia::render('Dashboard/Index', [
            'filters' => $filters,
            'mostFeedback' => array_values($mostFeedback)
        ]
        );
    }

    /**
     * @param Request $request
     */
    public function officeStats(Request $request)
    {
        // $filters = $request->only('office', 'month');
        // # get office stats per week
        // $office = Office::find($filters['office']);
        // return []

    }
}
