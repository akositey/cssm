<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Office;
use App\Models\Service;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Request::all('search', 'office', 'service', 'month');
        $feedback = Feedback::filter($filters)->orderBy('created_at', 'DESC')->paginate(10);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback        $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        $feedbackData = [
            'id' => $feedback->id,
            'serviceName' => $feedback->service->name,
            'date' => $feedback->created_at->format('M j, Y g:i a'),
            'officeName' => $feedback->service->office->name,
            'signaturePath' => $feedback->signature_path,
            'authorName' => $feedback->user->name
        ];

        $types = ['Mandatory', 'Positive', 'Negative', 'Etc'];
        $answers = [];
        foreach ($feedback->answers as $answer) {
            $type = !$answer->question->type ? 0 : $answer->question->type;

            $answers[$types[$type]][] = [
                'question' => $answer->question->question,
                'answer' => $answer->answer
            ];
        }

        return Inertia::render('Feedback/Show', [
            'feedback' => $feedbackData,
            'answers' => $answers
        ]);
    }

}
