<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Lessson;
use App\Models\Subject;
use App\Models\User;
use App\Models\Tutor;

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
        $genders=['male','female'];
        $states=['new','accepted','canceled'];
        return [
            'student_id' => User::factory()->state(function (array $attributes) use($genders) {
                return [
                    'gender' => $genders[rand(0,1)],
                ];
            }),
            'teacher_id' => User::factory()->has(Tutor::factory())->state(function (array $attributes) use($genders) {
                return [
                    'role' => "tutor",
                    'gender' => $genders[rand(0,1)],
                ];
            }),
            'subject_id' => Subject::factory(),
            'date_execution' => $this->faker->dateTime(),
            'state' => $states[rand(0,2)],
        ];
    }
}
