<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $types = ['mandatory', 'optional: positive', 'optional: negative', 'optional: etc'];
        $questions = Question::filter($request->only('search', 'trashed'))->paginate(10)->withQueryString();
        $questions->transform(function ($question) use ($types) {
            $qType = !$question->type ? 0 : $question->type;
            return [
                'id' => $question->id,
                'question' => $question->question,
                'type' => $types[$qType],
                'deleted_at' => $question->deleted_at
            ];
        });

        return Inertia::render('Questions/Index', [
            'filters' => $request->all('search', 'trashed'),
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Questions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Question::create($request->validate([
            'question' => 'required',
            'is_required' => 'required',
            'type' => 'nullable'
        ]));

        return redirect(route('questions.index'))->with('success', 'Question Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Question $question
     * @return void
     */
    public function show(Question $question): void
    {
        // N/A
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Inertia\Response
     */
    public function edit(Question $question): \Inertia\Response
    {
        return Inertia::render('Questions/Edit', [
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->validate([
            'question' => 'required',
            'is_required' => 'required',
            'type' => 'nullable'
        ]));

        return redirect(route('questions.index'))->with('success', 'Question Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect(route('questions.index'))->with('success', 'Question Successfully Deleted');
    }
}
