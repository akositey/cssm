<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SignatorySettings
 *
 * @property int $id
 * @property string|null $reviewer_name
 * @property string|null $reviewer_position
 * @property string|null $noter_name
 * @property string|null $noter_position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereNoterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereNoterPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereReviewerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereReviewerPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SignatorySettings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SignatorySettings extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['reviewer_name', 'reviewer_position', 'noter_name', 'noter_position'];

}
