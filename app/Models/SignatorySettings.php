<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatorySettings extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['reviewer_name', 'reviewer_position', 'noter_name', 'noter_position'];

}
