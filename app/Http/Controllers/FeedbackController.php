<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return Inertia::render('Feedback/Create', [
            'questions' => Question::all(),
            'services' => Auth::user()->office->services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        # benchmark
        // $timer = microtime(true);

        # validation
        $list = implode(',', Auth::user()->office->services->pluck('id')->toArray());
        $request->validate([
            'service_id' => ['required', "in:$list"],
            'signature' => ['required', 'string']
        ], [
            'service_id.required' => 'Kailangan pong pumili ng isa dito 👇🏻'
        ]);
        # dynamic validation for mandatory questions
        foreach (Question::where('is_required', true)->get() as $q) {
            $request->validate([
                'mandatory.' . $q->id . '.answer' => 'required'
            ], [
                'mandatory.' . $q->id . '.answer.required' => 'Pumili po ng isa sa mga sumusunod 👇🏻, salamat po!'
            ]);
        }

        $fields = $request->only(['service_id', 'mandatory', 'optional', 'signature']);
        $fields['office_id'] = Auth::user()->office->id;

        $folder = 'signatures';
        $filename = Auth::user()->username . '-' . Auth::user()->id . '-' . date('YmdHis') . '.png';

        # begin transaction
        DB::transaction(function () use ($fields, $folder, &$filename) {
            # save to database
            $feedback = Feedback::create($fields + [
                'signature_path' => $folder . '/' . $filename
            ]);

            # save answers
            $feedback->answers()->createMany($fields['mandatory']);
            foreach ($fields['optional'] as $type => $answers) {
                $feedback->answers()->createMany($answers);
            }
        });

        # save signature image
        $encoded_image = explode(",", $fields['signature'])[1];
        $decoded_image = base64_decode($encoded_image);

        # resize, store, and optimize image
        $img_processor = new ImageProcessor($decoded_image, $folder, $filename);
        $img_processor->save();

        # benchmark
        // $timer = microtime(true) - $timer;
        // dd('took:', round($timer, 3));

        # return response
        return redirect(route('start'))->with('bigSuccess', '😃 Salamat po sa inyong kasagutan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback        $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback        $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  \App\Models\Feedback        $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback        $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
