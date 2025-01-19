<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\Mapa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Genero::create(['gene_nombre' => 'Acacia', 'gene_fam_id' => 1]); // Fabaceae
        Genero::create(['gene_nombre' => 'Rosa', 'gene_fam_id' => 2]);   // Rosaceae
        Genero::create(['gene_nombre' => 'Albizia', 'gene_fam_id' => 1]); // Fabaceae
        Genero::create(['gene_nombre' => 'Cassia', 'gene_fam_id' => 1]); // Fabaceae
        Genero::create(['gene_nombre' => 'Phaseolus', 'gene_fam_id' => 1]); // Fabaceae
        Genero::create(['gene_nombre' => 'Malus', 'gene_fam_id' => 2]); // Rosaceae
        Genero::create(['gene_nombre' => 'Prunus', 'gene_fam_id' => 2]); // Rosaceae
        Genero::create(['gene_nombre' => 'Fragaria', 'gene_fam_id' => 2]); // Rosaceae
        Genero::create(['gene_nombre' => 'Geum', 'gene_fam_id' => 1]); // Fabaceae
        Genero::create(['gene_nombre' => 'Vigna ', 'gene_fam_id' => 1]); // Fabaceae

        Mapa::create([
            'mapa_nombre' => 'Mapa de la región 1',
            'mapa_url' => 'https://www.google.com/maps/',
        ]);
    }
}
