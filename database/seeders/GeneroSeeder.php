<?php

namespace Database\Seeders;

use App\Models\Familia;
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
        // Fabaceae (Leguminosas)
        $fabaceae = Familia::where('fam_nombre', 'Fabaceae')->first();

        Genero::create(['gene_nombre' => 'Lupinus', 'gene_fam_id' => $fabaceae->fam_id]); // Chocho
        Genero::create(['gene_nombre' => 'Trifolium', 'gene_fam_id' => $fabaceae->fam_id]); // Trébol
        Genero::create(['gene_nombre' => 'Vicia', 'gene_fam_id' => $fabaceae->fam_id]);     // Vicia
        Genero::create(['gene_nombre' => 'Inga', 'gene_fam_id' => $fabaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Mimosa', 'gene_fam_id' => $fabaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Prosopis', 'gene_fam_id' => $fabaceae->fam_id]);
        
        // Rosaceae
        $rosaceae = Familia::where('fam_nombre', 'Rosaceae')->first();

        Genero::create(['gene_nombre' => 'Prunus', 'gene_fam_id' => $rosaceae->fam_id]);    // Capulí
        Genero::create(['gene_nombre' => 'Rubus', 'gene_fam_id' => $rosaceae->fam_id]);     // Mora
        Genero::create(['gene_nombre' => 'Polylepis', 'gene_fam_id' => $rosaceae->fam_id]); // Árbol de papel
        Genero::create(['gene_nombre' => 'Rosa', 'gene_fam_id' => $rosaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Potentilla', 'gene_fam_id' => $rosaceae->fam_id]); // Hierbas de páramo
        
        // Asteraceae
        $asteraceae = Familia::where('fam_nombre', 'Asteraceae')->first();

        Genero::create(['gene_nombre' => 'Baccharis', 'gene_fam_id' => $asteraceae->fam_id]); // Chilca
        Genero::create(['gene_nombre' => 'Bidens', 'gene_fam_id' => $asteraceae->fam_id]);    // Ñachag
        Genero::create(['gene_nombre' => 'Espeletia', 'gene_fam_id' => $asteraceae->fam_id]); // Frailejón
        Genero::create(['gene_nombre' => 'Senecio', 'gene_fam_id' => $asteraceae->fam_id]);
        Genero::create(['gene_nombre' => 'Mikania', 'gene_fam_id' => $asteraceae->fam_id]);
        Genero::create(['gene_nombre' => 'Chuquiraga', 'gene_fam_id' => $asteraceae->fam_id]);  // Chuquiragua (flor nacional)
        Genero::create(['gene_nombre' => 'Tagetes', 'gene_fam_id' => $asteraceae->fam_id]);     // Clavelillos andinos
        Genero::create(['gene_nombre' => 'Smallanthus', 'gene_fam_id' => $asteraceae->fam_id]); // Mashua
        
        // Solanaceae
        $solanaceae = Familia::where('fam_nombre', 'Solanaceae')->first();

        Genero::create(['gene_nombre' => 'Solanum', 'gene_fam_id' => $solanaceae->fam_id]);   // Papa
        Genero::create(['gene_nombre' => 'Physalis', 'gene_fam_id' => $solanaceae->fam_id]);  // Uvilla
        Genero::create(['gene_nombre' => 'Brugmansia', 'gene_fam_id' => $solanaceae->fam_id]); // Floripondio
        Genero::create(['gene_nombre' => 'Capsicum', 'gene_fam_id' => $solanaceae->fam_id]);
        
        // Orchidaceae
        $orchidaceae = Familia::where('fam_nombre', 'Orchidaceae')->first();

        Genero::create(['gene_nombre' => 'Epidendrum', 'gene_fam_id' => $orchidaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Oncidium', 'gene_fam_id' => $orchidaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Pleurothallis', 'gene_fam_id' => $orchidaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Sobralia', 'gene_fam_id' => $orchidaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Masdevallia', 'gene_fam_id' => $orchidaceae->fam_id]);// Típicas de bosques nublados
        
        // Lamiaceae
        $lamiaceae = Familia::where('fam_nombre', 'Lamiaceae')->first();

        Genero::create(['gene_nombre' => 'Clinopodium', 'gene_fam_id' => $lamiaceae->fam_id]); // Tipo
        Genero::create(['gene_nombre' => 'Minthostachys', 'gene_fam_id' => $lamiaceae->fam_id]); // Muña
        Genero::create(['gene_nombre' => 'Salvia', 'gene_fam_id' => $lamiaceae->fam_id]);     // Salvia
        Genero::create(['gene_nombre' => 'Hyptis', 'gene_fam_id' => $lamiaceae->fam_id]);
        
        // Poaceae
        $poaceae = Familia::where('fam_nombre', 'Poaceae')->first();

        Genero::create(['gene_nombre' => 'Festuca', 'gene_fam_id' => $poaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Calamagrostis', 'gene_fam_id' => $poaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Cortaderia', 'gene_fam_id' => $poaceae->fam_id]); // Sigse
        Genero::create(['gene_nombre' => 'Poa', 'gene_fam_id' => $poaceae->fam_id]);
        
        // Euphorbiaceae
        $euphorbiaceae = Familia::where('fam_nombre', 'Euphorbiaceae')->first();

        Genero::create(['gene_nombre' => 'Euphorbia', 'gene_fam_id' => $euphorbiaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Croton', 'gene_fam_id' => $euphorbiaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Ricinus', 'gene_fam_id' => $euphorbiaceae->fam_id]);    // Higuerilla
        Genero::create(['gene_nombre' => 'Chamaesyce', 'gene_fam_id' => $euphorbiaceae->fam_id]);
        
        // Brassicaceae
        $brassicaceae = Familia::where('fam_nombre', 'Brassicaceae')->first();

        Genero::create(['gene_nombre' => 'Brassica', 'gene_fam_id' => $brassicaceae->fam_id]);   // Col
        Genero::create(['gene_nombre' => 'Nasturtium', 'gene_fam_id' => $brassicaceae->fam_id]); // Berro
        Genero::create(['gene_nombre' => 'Raphanus', 'gene_fam_id' => $brassicaceae->fam_id]);   // Rábano
        Genero::create(['gene_nombre' => 'Draba',     'gene_fam_id' => $brassicaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Cardamine', 'gene_fam_id' => $brassicaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Arabis',    'gene_fam_id' => $brassicaceae->fam_id]);
        
        // Apiaceae
        $apiaceae = Familia::where('fam_nombre', 'Apiaceae')->first();

        Genero::create(['gene_nombre' => 'Daucus', 'gene_fam_id' => $apiaceae->fam_id]);    // Zanahoria
        Genero::create(['gene_nombre' => 'Arracacia', 'gene_fam_id' => $apiaceae->fam_id]); // Zanahoria blanca
        Genero::create(['gene_nombre' => 'Azorella', 'gene_fam_id' => $apiaceae->fam_id]);  // Almohadillas
        Genero::create(['gene_nombre' => 'Angelica', 'gene_fam_id' => $apiaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Heracleum', 'gene_fam_id' => $apiaceae->fam_id]);
        
        // Bromeliaceae
        $bromeliaceae = Familia::where('fam_nombre', 'Bromeliaceae')->first();

        Genero::create(['gene_nombre' => 'Puya', 'gene_fam_id' => $bromeliaceae->fam_id]);      // Achupalla
        Genero::create(['gene_nombre' => 'Tillandsia', 'gene_fam_id' => $bromeliaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Guzmania', 'gene_fam_id' => $bromeliaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Vriesea', 'gene_fam_id' => $bromeliaceae->fam_id]);
        
        // Ericaceae
        $ericaceae = Familia::where('fam_nombre', 'Ericaceae')->first();
        
        Genero::create(['gene_nombre' => 'Vaccinium', 'gene_fam_id' => $ericaceae->fam_id]); // Mortiño
        Genero::create(['gene_nombre' => 'Macleania', 'gene_fam_id' => $ericaceae->fam_id]); // Joyapa
        Genero::create(['gene_nombre' => 'Pernettya', 'gene_fam_id' => $ericaceae->fam_id]); // Taglli
        Genero::create(['gene_nombre' => 'Gaultheria', 'gene_fam_id' => $ericaceae->fam_id]);
        Genero::create(['gene_nombre' => 'Erica', 'gene_fam_id' => $ericaceae->fam_id]);
    }
}
