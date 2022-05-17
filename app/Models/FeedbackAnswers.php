<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FeedbackAnswers
 *
 * @property int $id
 * @property int $feedback_id
 * @property int $question_id
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Question|null $question
 * @method static \Database\Factories\FeedbackAnswersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers newQuery()
 * @method static \Illuminate\Database\Query\Builder|FeedbackAnswers onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereFeedbackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedbackAnswers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|FeedbackAnswers withTrashed()
 * @method static \Illuminate\Database\Query\Builder|FeedbackAnswers withoutTrashed()
 * @mixin \Eloquent
 */
class FeedbackAnswers extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['question_id', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
