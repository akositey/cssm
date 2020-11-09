<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * @param Request $request
     */
    public function edit(Request $request, Feedback $feedback)
    {
        // dd($feedback);
        return Inertia::render('Feedback/Comment/Edit', [
            'feedback' => $feedback
        ]);
    }
}
