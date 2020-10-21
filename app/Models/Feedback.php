<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['office_id'];

    /**
     * @return mixed
     */
    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }

    /**
     * @return mixed
     */
    public function answers()
    {
        return $this->hasMany('App\Models\FeedbackAnswers');
    }
}
