<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property int $office_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feedback[] $feedback
 * @property-read int|null $feedback_count
 * @property-read \App\Models\Office|null $office
 * @method static \Illuminate\Database\Eloquent\Builder|Service filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Query\Builder|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Service withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Service withoutTrashed()
 * @mixin \Eloquent
 */
class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'office_id', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * @param $query
     * @param array $filters
     */
    public function scopeFilter($query, array $filters): void
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
