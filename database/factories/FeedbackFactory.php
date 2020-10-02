<?php

namespace Database\Factories;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip_id' => $this->faker->numberBetween(1, 10),
            'question1' => $this->faker->numberBetween(1, 5),
            'question2' => $this->faker->numberBetween(1, 5),
            'question3' => $this->faker->numberBetween(1, 5),
            'positive1' => $this->faker->boolean(),
            'positive2' => $this->faker->boolean(),
            'positive3' => $this->faker->boolean(),
            'positive4' => $this->faker->boolean(),
            'positive5' => $this->faker->boolean(),
            'positive6' => $this->faker->boolean(),
            'negative1' => $this->faker->boolean(),
            'negative2' => $this->faker->boolean(),
            'negative3' => $this->faker->boolean(),
            'negative4' => $this->faker->boolean(),
            'negative5' => $this->faker->boolean(),
            'negative6' => $this->faker->boolean(),
            'negative7' => $this->faker->boolean(),
            'negative8' => $this->faker->boolean(),
            'suggestion' => $this->faker->boolean() ?? $this->faker->words(3, true),
        ];
    }
}
