<?php

namespace Database\Seeders;

use App\Models\Familia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Familia::create(['fam_nombre' => 'Fabaceae', 'fam_reino_id' => 1]); // Plantae
        Familia::create(['fam_nombre' => 'Rosaceae', 'fam_reino_id' => 1]); // Plantae
    }
}
