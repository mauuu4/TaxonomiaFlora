<?php

namespace Database\Seeders;

use App\Models\Genero;
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
    }
}
