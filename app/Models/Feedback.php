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
    protected $fillable = ['service_id', 'signature_path'];

    /**
     * @return mixed
     */
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    /**
     * @return mixed
     */
    public function answers()
    {
        return $this->hasMany('App\Models\FeedbackAnswers');
    }
}
