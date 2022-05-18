<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * @param \App\Models\Feedback $feedback
     * @return \Inertia\Response
     */
    public function edit(Feedback $feedback): \Inertia\Response
    {
        return Inertia::render('Feedback/Comment/Edit', [
            'feedback' => [
                'id' => $feedback->id,
                'positiveComments' => $feedback->positive_comments,
                'negativeComments' => $feedback->negative_comments,
                'commentsImgPath' => $feedback->comments_image_path
            ]
        ]);
    }
}
