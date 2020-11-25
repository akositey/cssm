<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Office;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only('office', 'service', 'month', 'hasComments');
        $feedback = Feedback::filter($filters)->orderBy('created_at', 'DESC')->paginate(10)->withQueryString();
        $feedback->transform(function ($row) {
            return [
                'id' => $row->id,
                'officeName' => $row->service->office->name,
                'serviceName' => $row->service->name,
                'positiveComments' => $row->positive_comments,
                'negativeComments' => $row->negative_comments,
                'commentsImgPath' => $row->comments_image_path,
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
            'positiveComments' => $feedback->positive_comments,
            'negativeComments' => $feedback->negative_comments,
            'commentsImgPath' => $feedback->comments_image_path,
            'signatureImgPath' => $feedback->signature_image_path,
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

    /**
     * update only comments. this is for transcribing comment image
     *
     * @param  Request  $request
     * @param  Feedback $feedback
     * @return void
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback->update([
            'positive_comments' => $request->positiveComments,
            'negative_comments' => $request->negativeComments
        ]);
        return back()->with('success', 'Feedback Successfully Updated');

    }

}
