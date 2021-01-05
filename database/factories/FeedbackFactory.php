<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Service;
use App\Models\User;
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
            'service_id' => $this->faker->numberBetween(1, Service::all()->count()),
            'user_id' => $this->faker->numberBetween(1, User::all()->count()),
            'comments_image_path' => random_int(0, 1) ? 'comments/comment_admin_1_dummy.png' : null,
            'signature_image_path' => 'signatures/signature_admin_1_dummy.png',
            'created_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
