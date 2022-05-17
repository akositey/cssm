<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $service_id
 * @property string|null $positive_comments transcribed from image
 * @property string|null $negative_comments transcribed from image
 * @property string|null $comments_image_path
 * @property string $signature_image_path
 * @property int $user_id author
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FeedbackAnswers[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Office|null $office
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\FeedbackFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Query\Builder|Feedback onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCommentsImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereNegativeComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback wherePositiveComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereSignatureImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Feedback withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Feedback withoutTrashed()
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'positive_comments', 'negative_comments', 'comments_image_path', 'signature_image_path', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function office(): HasOneThrough
    {
        return $this->hasOneThrough(Office::class, Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(FeedbackAnswers::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param array $filters
     */
    public function scopeFilter($query, array $filters): void
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
            ->when($filters['date'] ?? null, function ($query, $date) {
                $query->where('created_at', 'like', $date . '%');
            })
            ->when($filters['month'] ?? null, function ($query, $month) {
                $query->whereBetween('feedback.created_at', [date('Y-m-01', strtotime($month)), date('Y-m-t', strtotime($month))]);
            })
            ->when($filters['hasComments'] ?? null, function ($query, $yesNo) {
                if ($yesNo === 'with') {
                    $query->whereNotNull('comments_image_path');
                } else {
                    $query->whereNull('comments_image_path');
                }
            });
    }
}
