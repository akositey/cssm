<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $filters = $request->only('transcribed');
        $feedback = Feedback::whereNotNull('comments_path')->filter($filters)->orderBy('created_at', 'DESC')->paginate(10);
        $feedback->transform(function ($row) {
            return [
                'id' => $row->id,
                'officeName' => $row->service->office->name,
                'serviceName' => $row->service->name,
                'authorName' => $row->user->name,
                'date' => $row->created_at->format('M j, Y g:i a')
            ];
        });
        return Inertia::render('Feedback/Index', [
            'filters' => $filters,
            'feedback' => $feedback,
            'services' => Service::all()->transform(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'officeId' => $service->office->id

                ];
            }),
            'offices' => Office::all()->transform(function ($office) {
                return [
                    'id' => $office->id,
                    'abbr' => $office->abbr
                ];
            })
        ]);
    }
}
