<?php

namespace Database\Factories;

use App\Models\FeedbackAnswers;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackAnswersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedbackAnswers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'feedback_id' => $this->faker->numberBetween(1, 30),
            'question_id' => $this->faker->numberBetween(1, Question::all()->count()),
            'answer' => '1'
        ];
    }
}
