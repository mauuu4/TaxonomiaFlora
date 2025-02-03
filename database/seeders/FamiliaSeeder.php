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
        Familia::create(['fam_nombre' => 'Fabaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Rosaceae', 'fam_reino_id' => 1]);        
        Familia::create(['fam_nombre' => 'Asteraceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Solanaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Orchidaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Lamiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Poaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Euphorbiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Brassicaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Apiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Bromeliaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_nombre' => 'Ericaceae', 'fam_reino_id' => 1]);
    }    
}
