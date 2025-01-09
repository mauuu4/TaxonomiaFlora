<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especie::create([
            'esp_nombre_cientifico' => 'Acacia dealbata',
            'esp_nombre_comun' => 'Mimosa plateada',
            'esp_descripcion' => 'Árbol ornamental de rápido crecimiento.',
            'esp_gene_id' => 1, // Acacia
        ]);

        Especie::create([
            'esp_nombre_cientifico' => 'Rosa canina',
            'esp_nombre_comun' => 'Escaramujo',
            'esp_descripcion' => 'Arbusto con flores rosadas y frutos rojos.',
            'esp_gene_id' => 2, // Rosa
        ]);
        Especie::create([
            'esp_nombre_cientifico' => 'Rosa no canina',
            'esp_nombre_comun' => 'Escaramujo',
            'esp_descripcion' => 'Arbusto sin flores y frutos.',
            'esp_gene_id' => 2, // Rosa
        ]);
        Especie::create([
            'esp_nombre_cientifico' => 'Acacia dealbata mod',
            'esp_nombre_comun' => 'Mimosa plateada',
            'esp_descripcion' => 'Árbol ornamental de rápido crecimiento.',
            'esp_gene_id' => 1, // Acacia
        ]);
    }
}
