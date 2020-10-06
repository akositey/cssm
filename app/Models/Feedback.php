<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['ip_id', 'question1', 'question2', 'question3', 'positive1', 'positive2', 'positive3', 'positive4', 'positive5', 'positive6', 'negative1', 'negative2', 'negative3', 'negative4', 'negative5', 'negative6', 'negative7', 'negative8', 'suggestion'];
}
