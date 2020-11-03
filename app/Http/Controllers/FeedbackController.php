<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
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
        $all_feedback = Feedback::paginate(10);
        $all_feedback->transform(function ($feedback) {
            return [
                'id' => $feedback->id,
                'office' => $feedback->service->office->name,
                'service' => $feedback->service->name,
                'user' => $feedback->user->name,
                'date' => $feedback->created_at->format('M j, Y g:i a'),
                'signaturePath' => $feedback->signature_path

            ];
        });
        return Inertia::render('Feedback/Index', [
            'feedback' => $all_feedback
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
        $types = ['mandatory', 'optional: positive', 'optional: negative', 'optional: etc'];

        return Inertia::render('Feedback/Show', [
            'feedback' => $feedback,
            'creationDate' => $feedback->created_at->format('M j, Y g:i a'),
            'office' => $feedback->service->office->name,
            'answers' => $feedback->answers
                ->transform(function ($f) use ($types) {
                    $type = !$f->question->type ? 0 : $f->question->type;
                    return [
                        'type' => $type,
                        'typeWords' => $types[$type],
                        'question' => $f->question->question,
                        'answer' => $f->answer
                    ];
                })
        ]);
    }

}
