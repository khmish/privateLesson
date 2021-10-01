<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tutor;
use App\Models\User;

class TutorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title_cert' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'price' => $this->faker->word,
            'type' => $this->faker->word,
        ];
    }
}
