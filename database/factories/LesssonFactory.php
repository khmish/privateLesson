<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Lessson;
use App\Models\Subject;
use App\Models\User;

class LesssonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lessson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => User::factory(),
            'teacher_id' => User::factory(),
            'subject_id' => Subject::factory(),
            'date_execution' => $this->faker->dateTime(),
            'state' => $this->faker->word,
        ];
    }
}
