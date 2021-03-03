<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => null,
            'password' => bcrypt(1234),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'img' => null,
            'last_name' => $this->faker->lastName,
            'gender_id' => $this->faker->randomElement(Gender::all()),
            'remember_token' => Str::random(10)
        ];
    }
}
