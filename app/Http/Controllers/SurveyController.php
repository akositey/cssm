<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SurveyController extends Controller
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
                'signature_path' => $folder . '/' . $filename,
                'user_id' => Auth::user()->id
            ]);

            # save answers
            $feedback->answers()->createMany($fields['mandatory']);
            foreach ($fields['optional'] as $type => $answers) {
                $feedback->answers()->createMany($answers);
            }
        });

        # save signature image
        $encodedImage = explode(",", $fields['signature'])[1];
        $decodedImage = base64_decode($encodedImage);

        # resize, store, and optimize image
        $imgProcessor = new ImageProcessor($decodedImage, $folder, $filename);
        $imgProcessor->save();

        # benchmark
        // $timer = microtime(true) - $timer;
        // dd('took:', round($timer, 3));

        # return response
        return redirect(route('home'))->with('bigSuccess', '😃 Salamat po sa inyong kasagutan!');

    }
}
