<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password_hash' => static::$password ??= Hash::make('password'),
            'date_of_birth' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'address' => fake()->streetAddress(),
            'is_admin' => false,
        ];
    }

}
