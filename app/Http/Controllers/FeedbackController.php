<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

// use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Question::all());
        return Inertia::render('Feedback/Create', [
            'questions' => Question::all()
        ]);
        // $mandatory = Question::where('is_required', true)->get();
        // $optional['positive'] = Question::where('type', '1')->get();
        // $optional['negative'] = Question::where('type', '2')->get();
        // $etc = Question::where('type', '3')->get();
        // if (count($etc)) {
        //     $optional['etc'] = $etc;
        // }
        // return Inertia::render('Feedback/Create', [
        //     'questions' =>
        //     [
        //         'mandatory' => $mandatory,
        //         'optional' => $optional
        //     ]
        // ]);
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
    /**
     * @param $from
     * @param $to
     */
    /**
     * @param $from
     * @param $to
     */
    /**
     * @param $from
     * @param $to
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // validate
        $fields = $request->validate([
            'mandatory' => '',
            'optional' => '',
            'signature' => ['required', 'string'],
            'ip_id' => 'required'
        ]);
        // dynamic validation for mandatory questions
        foreach (Question::where('is_required', true)->get() as $q) {
            $request->validate([
                'mandatory.' . $q->id . '.answer' => 'required'
            ], [
                'mandatory.' . $q->id . '.answer.required' => 'Pumili po ng isa sa mga sumusunod 👇🏻, salamat po!'
            ]);
        }

        // begin transaction
        DB::transaction(function () use ($fields) {

            // save to database
            $feedback = Feedback::create($fields);
            foreach ($fields['mandatory'] as $answers) {
                $feedback->answers()->create(
                    $answers
                );
            }
            foreach ($fields['optional'] as $type) {
                foreach ($type as $answers) {
                    $feedback->answers()->create(
                        $answers
                    );
                }
            }
            // store image in storage folder
            $encoded_image = explode(",", $fields['signature'])[1];
            $decoded_image = base64_decode($encoded_image);
            $image_path = 'signatures/' . $feedback->id . '.png';
            // $optimized_image_path = 'signatures/' . $feedback->id . '_optimized.png';
            //save to storage
            Storage::put($image_path, $decoded_image);
            //resize
            $image = Image::make(Storage::path($image_path));
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //optimize
            if ($image->save(Storage::path($image_path))) {
                ImageOptimizer::optimize(Storage::path($image_path), Storage::path($image_path));
            }

        });

        //
        // return response
        return redirect(route('guest.start'))->with('bigSuccess', '😃 Salamat po sa inyong kasagutan!');

    }

    /**
     * @param $from
     * @param $to
     */
    public function convert($from, $to)
    {
        $command = 'convert '
            . $from
            . ' '
            . '-resize 50%'
            . ' '
            . $to;
        return $command;
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
