<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registro>
 */
class RegistroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'esp_id' => $this->faker->numberBetween(1, 100),
            'user_id' => $this->faker->numberBetween(1, 4),
            'regis_estado' => $this->faker->randomElement(['Pendiente', 'Validado', 'Rechazado']),
        ];
    }
}
