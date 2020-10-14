<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    /**
     * @var mixed
     */
    private $ctr;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $all = Question::all();
        // $questions = [];
        // $types = [null, 'positive', 'negative', 'etc'];
        // foreach ($all as $q) {
        //     if ($q->is_required) {
        //         $questions['mandatory'][] = $q;
        //     } else {
        //         $questions['optional'][$types[$q->type]][] = $q;
        //     }
        // }
        $mandatory = Question::where('is_required', true)->get();
        $etc = Question::where('type', '3')->get();
        $optional['positive'] = Question::where('type', '1')->get();
        $optional['negative'] = Question::where('type', '2')->get();

        $this->ctr['mandatory'] = count($mandatory);
        // $this->ctr['optional']['positive'] = count($optional['positive']);
        // $this->ctr['optional']['negative'] = count($optional['negative']);

        if (count($etc)) {
            $optional['etc'] = Question::where('type', '3')->get();
            // $this->ctr['optional']['etc'] = count($optional['etc']);
        }
        return Inertia::render('Feedback/Create', [
            // 'questions' => $questions
            'questions' =>
            [
                'mandatory' => $mandatory,
                'optional' => $optional
            ]
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
        // validate & save
        $feedback = Feedback::create($request->validate(['ip_id' => 'required']));
        $feedback->answers()->create(
            $request->validate([
                'mandatory' => ['required', 'array', 'size:' . $this->ctr['mandatory']],
                'signature' => ['required', 'string'],
                'ip_id' => 'required'
            ])
        );
        // save
        // store image in storage folder
        // return response
        return redirect(route('feedback.index'))->with('success', 'Salamat po sa inyong kasagutan!');

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
