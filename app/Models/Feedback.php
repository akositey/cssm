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
    protected $fillable = ['service_id', 'comments', 'comments_path', 'signature_path', 'user_id', 'created_at', 'updated_at'];

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
        $query->when($filters['office'] ?? null, function ($query, $id) {
            $query->whereHas('service', function ($query) use ($id) {
                $query->whereHas('office', function ($query) use ($id) {
                    $query->where('id', $id);
                });
            });
        })
            ->when($filters['service'] ?? null, function ($query, $id) {
                $query->whereHas('service', function ($query) use ($id) {
                    $query->where('id', $id);
                });
            })
            ->when($filters['month'] ?? null, function ($query, $month) {
                $query->whereBetween('created_at', [date('Y-m-01', strtotime($month)), date('Y-m-t', strtotime($month))]);
            })
            ->when($filters['hasComments'] ?? null, function ($query, $yesNo) {
                if ($yesNo === "with") {
                    $query->whereNotNull('comments_path');
                } else {
                    $query->whereNull('comments_path');
                }
            });
    }

}
