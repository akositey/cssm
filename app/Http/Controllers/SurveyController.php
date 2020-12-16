<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Question;
use App\Services\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SurveyController extends Controller
{
    /**
     * @var mixed
     */
    protected $imageHandler;

    /**
     * @param ImageHandler $imageHandler
     */
    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Feedback/Create', [
            'questions' => Question::all(),
            'services' => Auth::user()->office->services->where('is_active', 1)
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

        $user = Auth::user();

        ### TODO: move validation out of this controller
        # validation
        $list = implode(',', $user->office->services->pluck('id')->toArray());
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

        $fields = $request->only(['service_id', 'mandatory', 'optional', 'additional_comments', 'signature']);
        $fields['office_id'] = $user->office->id;

        ### TODO: send to jobs instead?
        $commentsFolder = 'comments';
        $commentsFilename = 'comment_' . $user->username . '_' . $user->id . '_' . date('YmdHis') . '.png';
        # save comment image, if not empty
        if ($fields['additional_comments']) {
            $encodedCommentImage = explode(",", $fields['additional_comments'])[1];
            $decodedCommentImage = base64_decode($encodedCommentImage);

            # resize, store, and optimize image
            $this->imageHandler->create($decodedCommentImage, $commentsFolder, $commentsFilename, 768);
        }

        # save signature image
        $sigFolder = 'signatures';
        $sigFilename = 'signature_' . $user->username . '_' . $user->id . '_' . date('YmdHis') . '.png';
        $encodedSignatureImage = explode(",", $fields['signature'])[1];
        $decodedSignatureImage = base64_decode($encodedSignatureImage);

        # resize, store, and optimize image
        $this->imageHandler->create($decodedSignatureImage, $sigFolder, $sigFilename);

        # begin transaction
        DB::transaction(function () use ($fields, $user, $commentsFolder, &$commentsFilename, $sigFolder, &$sigFilename) {
            # save to database
            $fields = $fields + [
                'comments_image_path' => $fields['additional_comments'] ? $commentsFolder . '/' . $commentsFilename : null,
                'signature_image_path' => $sigFolder . '/' . $sigFilename,
                'user_id' => $user->id
            ];
            $feedback = Feedback::create($fields);

            # save answers
            $feedback->answers()->createMany($fields['mandatory']);
            foreach ($fields['optional'] as $answers) {
                $feedback->answers()->createMany($answers);
            }
        });

        # benchmark
        // $timer = microtime(true) - $timer;
        // dd('took:', round($timer, 3));

        # return response
        return redirect(route('home'))->with('bigSuccess', '😃 Salamat po sa inyong kasagutan!');

    }
}
