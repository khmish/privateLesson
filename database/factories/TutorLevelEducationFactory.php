<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Leveleducation;
use App\Models\Tutor;
use App\Models\TutorLevelEducation;

class TutorLevelEducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TutorLevelEducation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tutor_id' => Tutor::factory(),
            'leveleducation_id' => Leveleducation::factory(),
        ];
    }
}
