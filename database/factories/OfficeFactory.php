<?php

namespace Database\Factories;

use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Office::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = "Office-" . $this->faker->company;
        return [
            'name' => $company,
            'nick' => preg_replace('/\b(\w)|./', '$1', $company)
            // 'parent_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
