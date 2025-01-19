<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubicacion>
 */
class UbicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ubi_mapa_id' => 1,
            'ubi_esp_id' => $this->faker->unique()->numberBetween(1, 104),
            'ubi_latitud' => $this->faker->latitude,
            'ubi_longitud' => $this->faker->longitude,
            'ubi_region' => $this->faker->word,
            'ubi_descripcion' => $this->faker->text(500),
        ];
    }
}
