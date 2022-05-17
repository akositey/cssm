<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Office
 *
 * @property int $id
 * @property string $name
 * @property string $abbr
 * @property int|null $parent_id
 * @property int|null $old_id if from dtr_dept table
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feedback[] $feedback
 * @property-read int|null $feedback_count
 * @property-read Office|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\OfficeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Office filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Office newQuery()
 * @method static \Illuminate\Database\Query\Builder|Office onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Office query()
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereOldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Office withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Office withoutTrashed()
 * @mixin \Eloquent
 */
class Office extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'abbr', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function feedback(): HasManyThrough
    {
        return $this->hasManyThrough(Feedback::class, Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo($this, 'parent_id');
    }

    /**
     * @param $query
     * @param array $filters
     */
    public function scopeFilter($query, array $filters): void
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
