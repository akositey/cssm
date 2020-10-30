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
    protected $fillable = ['service_id', 'signature_path', 'user_id'];

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
    public function office()
    {
        return $this->hasOneThrough('App\Models\Office', 'App\Models\Service');
    }

    /**
     * @return mixed
     */
    public function answers()
    {
        return $this->hasMany('App\Models\FeedbackAnswers');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @param $query
     * @param array    $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('office', 'like', "%$search%")
                ->orWhereHas('user', 'like', "%$search%")
                ->orWhereBetween('created_at', "%$search%");
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
