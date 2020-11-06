<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     */
    public function edit(Request $request, Feedback $feedback)
    {
        dd($feedback);
    }
}
