<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'office_id'];

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
    public function feedback()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    /**
     * @param $query
     * @param array    $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhereHas('office', function ($query) use ($search) {
                    $query->where('abbr', 'like', "%$search%");
                });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
