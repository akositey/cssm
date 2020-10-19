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
    protected $fillable = ['name', 'nick', 'parent_id'];

    /**
     * @return mixed
     */
    public function ips()
    {
        return $this->hasMany('App\Models\Ip');
    }
}
