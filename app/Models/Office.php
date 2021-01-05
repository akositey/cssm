<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'abbr', 'parent_id'];

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * @return mixed
     */
    public function feedback()
    {
        return $this->hasManyThrough('App\Models\Feedback', 'App\Models\Service');
    }

    /**
     * @return mixed
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    /**
     * @param $query
     * @param array    $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('abbr', 'like', "%$search%");
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        })->when($filters['office'] ?? null, function ($query, $id) {
            $query->where('id', $id);
        });
    }
}
