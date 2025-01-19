<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Imagen>
 */
class ImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img_ruta' => $this->faker->imageUrl(),
            'img_descripcion' => $this->faker->text(500),
            'img_esp_id' => $this->faker->numberBetween(1, 104),
        ];
    }
}
