<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Familia;
use App\Models\Reino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExplorerController extends Controller
{
    public function especies(Request $request)
    {
        $plantae = Reino::where('reino_nombre', 'Plantae')->first();
        $familias = $plantae->familias;
        
        $generos = collect();
        foreach ($familias as $familia) {
            $generos = $generos->merge($familia->generos);
        }

        $query = DB::table('vista_registros_especies')
            ->orderBy('created_at', 'desc');

        $search = $request->search;
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('esp_nombre_comun', 'ilike', "%{$search}%")
                  ->orWhere('esp_nombre_cientifico', 'ilike', "%{$search}%");
            });
        }
        // Filtro por género
        if ($request->genero) $query->where('gene_id', $request->genero);

        // Filtro por familia
        if ($request->familia) $query->where('fam_id', $request->familia);

        // Filtro por estado de validación
        if ($request->estado) $query->where('regis_estado', $request->estado);

        // Paginación
        $registros = $query->paginate(10);
        
        return view('explorar.especies', compact('registros', 'generos' ,'familias'));
    }
}
