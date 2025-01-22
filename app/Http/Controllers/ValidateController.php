<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Validacion;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function index(Request $request)
    {
        $estado = $request->get('estado');
        
        $registrosQuery = Registro::with(['especie.genero', 'user', 'validaciones'])
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })
            ->orderBy('created_at', 'desc');
        
        if ($estado) {
            $registrosQuery->where('regis_estado', $estado);
        }
        
        $registros = $registrosQuery->paginate();
        $estados = ['Pendiente', 'Validado', 'Rechazado'];
        
        return view('validate.index', compact('registros', 'estados', 'estado'));
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
                {$query->where('reino_nombre', 'plantae');
            })->findOrFail($regis_id);

        return view('validate.show', compact('registro'));
    }

    public function validate(Request $request, $regis_id)
    {
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

        return redirect()->route('validate.index')
            ->with('success', 'Especie rechazada exitosamente');
    }
}