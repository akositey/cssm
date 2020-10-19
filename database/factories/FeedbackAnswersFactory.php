<?php

namespace Database\Factories;

use App\Models\FeedbackAnswers;
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
            'question_id' => $this->faker->numberBetween(1, 18),
            'answer' => '1'
        ];
    }
}
