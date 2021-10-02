<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'email_verified_at' => $this->faker->dateTime(),
            'dateOfBirth' => $this->faker->dateTime(),
            'exceprience' => $this->faker->word,
            'gender' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            // 'pic' => $this->faker->text,
            'city_id' => City::factory(),
        ];
    }
}
