<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['address', 'office_id'];

    /**
     * @return mixed
     */
    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
}
