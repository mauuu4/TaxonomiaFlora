<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especie>
 */
class EspecieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'esp_gene_id' => $this->faker->numberBetween(1, 10),
            'esp_nombre_cientifico' => $this->faker->word . ' ' . $this->faker->word,
            'esp_nombre_comun' => $this->faker->word,
            'esp_descripcion' => $this->faker->text(150),
        ];
    }
}
