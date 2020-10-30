<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackAnswers extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['question_id', 'answer'];

    /**
     * @return mixed
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
