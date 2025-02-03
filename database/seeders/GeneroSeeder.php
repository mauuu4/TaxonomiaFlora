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
        // Fabaceae (Leguminosas)
        Genero::create(['gene_id' => 1, 'gene_nombre' => 'Lupinus', 'gene_fam_id' => 1]);  // Chocho
        Genero::create(['gene_id' => 2, 'gene_nombre' => 'Trifolium', 'gene_fam_id' => 1]); // Trébol
        Genero::create(['gene_id' => 3, 'gene_nombre' => 'Vicia', 'gene_fam_id' => 1]);     // Vicia
        Genero::create(['gene_id' => 4, 'gene_nombre' => 'Inga', 'gene_fam_id' => 1]);
        Genero::create(['gene_id' => 5, 'gene_nombre' => 'Mimosa', 'gene_fam_id' => 1]);
        Genero::create(['gene_id' => 6, 'gene_nombre' => 'Prosopis', 'gene_fam_id' => 1]);
        
        // Rosaceae
        Genero::create(['gene_id' => 7, 'gene_nombre' => 'Prunus', 'gene_fam_id' => 2]);    // Capulí
        Genero::create(['gene_id' => 8, 'gene_nombre' => 'Rubus', 'gene_fam_id' => 2]);     // Mora
        Genero::create(['gene_id' => 9, 'gene_nombre' => 'Polylepis', 'gene_fam_id' => 2]); // Árbol de papel
        Genero::create(['gene_id' => 10, 'gene_nombre' => 'Rosa', 'gene_fam_id' => 2]);
        Genero::create(['gene_id' => 11, 'gene_nombre' => 'Potentilla', 'gene_fam_id' => 2]); // Hierbas de páramo
        
        // Asteraceae
        Genero::create(['gene_id' => 12, 'gene_nombre' => 'Baccharis', 'gene_fam_id' => 3]); // Chilca
        Genero::create(['gene_id' => 13, 'gene_nombre' => 'Bidens', 'gene_fam_id' => 3]);    // Ñachag
        Genero::create(['gene_id' => 14, 'gene_nombre' => 'Espeletia', 'gene_fam_id' => 3]); // Frailejón
        Genero::create(['gene_id' => 15, 'gene_nombre' => 'Senecio', 'gene_fam_id' => 3]);
        Genero::create(['gene_id' => 16, 'gene_nombre' => 'Mikania', 'gene_fam_id' => 3]);
        Genero::create(['gene_id' => 17, 'gene_nombre' => 'Chuquiraga', 'gene_fam_id' => 3]);  // Chuquiragua (flor nacional)
        Genero::create(['gene_id' => 18, 'gene_nombre' => 'Tagetes', 'gene_fam_id' => 3]);     // Clavelillos andinos
        Genero::create(['gene_id' => 19, 'gene_nombre' => 'Smallanthus', 'gene_fam_id' => 3]); // Mashua
        
        // Solanaceae
        Genero::create(['gene_id' => 20, 'gene_nombre' => 'Solanum', 'gene_fam_id' => 4]);   // Papa
        Genero::create(['gene_id' => 21, 'gene_nombre' => 'Physalis', 'gene_fam_id' => 4]);  // Uvilla
        Genero::create(['gene_id' => 22, 'gene_nombre' => 'Brugmansia', 'gene_fam_id' => 4]); // Floripondio
        Genero::create(['gene_id' => 23, 'gene_nombre' => 'Capsicum', 'gene_fam_id' => 4]);
        
        // Orchidaceae
        Genero::create(['gene_id' => 24, 'gene_nombre' => 'Epidendrum', 'gene_fam_id' => 5]);
        Genero::create(['gene_id' => 25, 'gene_nombre' => 'Oncidium', 'gene_fam_id' => 5]);
        Genero::create(['gene_id' => 26, 'gene_nombre' => 'Pleurothallis', 'gene_fam_id' => 5]);
        Genero::create(['gene_id' => 27, 'gene_nombre' => 'Sobralia', 'gene_fam_id' => 5]);
        Genero::create(['gene_id' => 28, 'gene_nombre' => 'Masdevallia', 'gene_fam_id' => 5]);// Típicas de bosques nublados
        
        // Lamiaceae
        Genero::create(['gene_id' => 29, 'gene_nombre' => 'Clinopodium', 'gene_fam_id' => 6]); // Tipo
        Genero::create(['gene_id' => 30, 'gene_nombre' => 'Minthostachys', 'gene_fam_id' => 6]); // Muña
        Genero::create(['gene_id' => 31, 'gene_nombre' => 'Salvia', 'gene_fam_id' => 6]);     // Salvia
        Genero::create(['gene_id' => 32, 'gene_nombre' => 'Hyptis', 'gene_fam_id' => 6]);
        
        // Poaceae
        Genero::create(['gene_id' => 33, 'gene_nombre' => 'Festuca', 'gene_fam_id' => 7]);
        Genero::create(['gene_id' => 34, 'gene_nombre' => 'Calamagrostis', 'gene_fam_id' => 7]);
        Genero::create(['gene_id' => 35, 'gene_nombre' => 'Cortaderia', 'gene_fam_id' => 7]); // Sigse
        Genero::create(['gene_id' => 36, 'gene_nombre' => 'Poa', 'gene_fam_id' => 7]);
        
        // Euphorbiaceae
        Genero::create(['gene_id' => 37, 'gene_nombre' => 'Euphorbia', 'gene_fam_id' => 8]);
        Genero::create(['gene_id' => 38, 'gene_nombre' => 'Croton', 'gene_fam_id' => 8]);
        Genero::create(['gene_id' => 39, 'gene_nombre' => 'Ricinus', 'gene_fam_id' => 8]);    // Higuerilla
        Genero::create(['gene_id' => 40, 'gene_nombre' => 'Chamaesyce', 'gene_fam_id' => 8]);
        
        // Brassicaceae
        Genero::create(['gene_id' => 41, 'gene_nombre' => 'Brassica', 'gene_fam_id' => 9]);   // Col
        Genero::create(['gene_id' => 42, 'gene_nombre' => 'Nasturtium', 'gene_fam_id' => 9]); // Berro
        Genero::create(['gene_id' => 43, 'gene_nombre' => 'Raphanus', 'gene_fam_id' => 9]);   // Rábano
        Genero::create(['gene_id' => 44, 'gene_nombre' => 'Draba',     'gene_fam_id' => 9]);
        Genero::create(['gene_id' => 45, 'gene_nombre' => 'Cardamine', 'gene_fam_id' => 9]);
        Genero::create(['gene_id' => 46, 'gene_nombre' => 'Arabis',    'gene_fam_id' => 9]);
        
        // Apiaceae
        Genero::create(['gene_id' => 47, 'gene_nombre' => 'Daucus', 'gene_fam_id' => 10]);    // Zanahoria
        Genero::create(['gene_id' => 48, 'gene_nombre' => 'Arracacia', 'gene_fam_id' => 10]); // Zanahoria blanca
        Genero::create(['gene_id' => 49, 'gene_nombre' => 'Azorella', 'gene_fam_id' => 10]);  // Almohadillas
        Genero::create(['gene_id' => 50, 'gene_nombre' => 'Angelica', 'gene_fam_id' => 10]);
        Genero::create(['gene_id' => 51, 'gene_nombre' => 'Heracleum', 'gene_fam_id' => 10]);
        
        // Bromeliaceae
        Genero::create(['gene_id' => 52, 'gene_nombre' => 'Puya', 'gene_fam_id' => 11]);      // Achupalla
        Genero::create(['gene_id' => 53, 'gene_nombre' => 'Tillandsia', 'gene_fam_id' => 11]);
        Genero::create(['gene_id' => 54, 'gene_nombre' => 'Guzmania', 'gene_fam_id' => 11]);
        Genero::create(['gene_id' => 55, 'gene_nombre' => 'Vriesea', 'gene_fam_id' => 11]);
        
        // Ericaceae
        Genero::create(['gene_id' => 56, 'gene_nombre' => 'Vaccinium', 'gene_fam_id' => 12]); // Mortiño
        Genero::create(['gene_id' => 57, 'gene_nombre' => 'Macleania', 'gene_fam_id' => 12]); // Joyapa
        Genero::create(['gene_id' => 58, 'gene_nombre' => 'Pernettya', 'gene_fam_id' => 12]); // Taglli
        Genero::create(['gene_id' => 59, 'gene_nombre' => 'Gaultheria', 'gene_fam_id' => 12]);
        Genero::create(['gene_id' => 60, 'gene_nombre' => 'Erica', 'gene_fam_id' => 12]);
    }
}
