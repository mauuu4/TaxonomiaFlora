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
        // Familias previamente definidas
        Familia::create(['fam_id' => 1 , 'fam_nombre' => 'Fabaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 2 , 'fam_nombre' => 'Rosaceae', 'fam_reino_id' => 1]);        
        Familia::create(['fam_id' => 3 , 'fam_nombre' => 'Asteraceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 4 , 'fam_nombre' => 'Solanaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 5 , 'fam_nombre' => 'Orchidaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 6 , 'fam_nombre' => 'Lamiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 7 , 'fam_nombre' => 'Poaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 8 , 'fam_nombre' => 'Euphorbiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 9 , 'fam_nombre' => 'Brassicaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 10, 'fam_nombre' => 'Apiaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 11, 'fam_nombre' => 'Bromeliaceae', 'fam_reino_id' => 1]);
        Familia::create(['fam_id' => 12, 'fam_nombre' => 'Ericaceae', 'fam_reino_id' => 1]);
    }    
}
