<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'tipus_id' => $this->faker->numberBetween(1, 3),
            'user_nombre' => $this->faker->name(),
            'user_apellido' => $this->faker->lastName(),
            'user_email' => $this->faker->unique()->safeEmail(),
            'user_telefono' => '09' . $this->faker->randomNumber(8),
            'user_password' => static::$password ??= Hash::make('password'),
        ];
    }
}
