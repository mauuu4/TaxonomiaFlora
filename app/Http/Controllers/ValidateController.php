<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Reino;
use App\Models\Validacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateController extends Controller
{
    public function index(Request $request)
    {
        $plantae = Reino::where('reino_nombre', 'Plantae')->first();
        $familias = $plantae->familias;
        
        $generos = collect();
        foreach ($familias as $familia) {
            $generos = $generos->merge($familia->generos);
        }

        $query = DB::table('vista_registros_especies')->orderBy('created_at', 'desc');

        if ($request->estado) $query->where('regis_estado', $request->estado);

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

        // Paginación
        $registros = $query->paginate(10);
        
        return view('validate.index', compact('registros', 'generos' ,'familias'));
    }

    public function show($regis_id)
    {
        $registro = Registro::with([
            'especie.genero',
            'especie.imagenes',
            'especie.ubicaciones',
            'user',
            'validaciones'
            ])->whereHas('especie.genero.familia.reino', function($query) 
                {$query->where('reino_nombre', 'Plantae');
            })->findOrFail($regis_id);

        return view('validate.show', compact('registro'));
    }

    public function validate(Request $request, $regis_id)
    {
        DB::statement("SET app.current_user_id = " . auth()->id());

        $registro = Registro::findOrFail($regis_id);

        $validated = $request->validate([
            'valid_comentarios' => 'required|string|max:500',
        ]);

        // Crear el registro de validación
        Validacion::create([
            'valid_regis_id' => $regis_id,
            'valid_user_id' => auth()->user()->user_id,
            'valid_fecha' => now(),
            'valid_comentarios' => $validated['valid_comentarios']
        ]);

        // Actualizar el estado del registro
        $registro->update([
            'regis_estado' => 'Validado'
        ]);

        // Actualizar el estado de la especie
        $registro->especie->update([
            'esp_estado_valid' => true
        ]);

        return redirect()->route('validate.index')
            ->with('success', 'Especie validada exitosamente');
    }

    public function reject(Request $request, $regis_id)
    {
        DB::statement("SET app.current_user_id = " . auth()->id());

        $registro = Registro::findOrFail($regis_id);

        $validated = $request->validate([
            'valid_comentarios' => 'required|string|max:500',
        ]);

        // Crear el registro de validación con rechazo
        Validacion::create([
            'valid_regis_id' => $regis_id,
            'valid_user_id' => auth()->user()->user_id,
            'valid_fecha' => now(),
            'valid_comentarios' => $validated['valid_comentarios']
        ]);

        // Actualizar el estado del registro
        $registro->update([
            'regis_estado' => 'Rechazado'
        ]);

        $registro->especie->update([
            'esp_estado_valid' => false
        ]);

        return redirect()->route('validate.index')
            ->with('success', 'Especie rechazada exitosamente');
    }
}