<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Reino;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamiliaController extends Controller
{
    public function index()
    {
        $familias = Familia::with('reino')
            ->whereHas('reino', function($query) {
                $query->where('reino_nombre', 'Plantae');
            })
            ->paginate(10);
        
        return view('familias.index', compact('familias'));
    }

    public function create()
    {
        return view('familias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fam_nombre' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('tax_familias', 'fam_nombre')
            ]
        ]);

        $reino_plantae = Reino::where('reino_nombre', 'Plantae')->firstOrFail();

        Familia::create([
            'fam_nombre' => $validated['fam_nombre'],
            'fam_reino_id' => $reino_plantae->reino_id
        ]);

        return redirect()->route('familias.index')
            ->with('success', 'Familia creada exitosamente');
    }

    public function edit(Familia $familia)
    {
        // Ensure the familia belongs to Reino Plantae
        if ($familia->reino->reino_nombre !== 'Plantae') {
            abort(403, 'No autorizado');
        }

        return view('familias.edit', compact('familia'));
    }

    public function update(Request $request, Familia $familia)
    {
        // Ensure the familia belongs to Reino Plantae
        if ($familia->reino->reino_nombre !== 'Plantae') {
            abort(403, 'No autorizado');
        }

        $validated = $request->validate([
            'fam_nombre' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('tax_familias', 'fam_nombre')->ignore($familia->fam_id, 'fam_id')
            ]
        ]);

        $familia->update([
            'fam_nombre' => $validated['fam_nombre']
        ]);

        return redirect()->route('familias.index')
            ->with('success', 'Familia actualizada exitosamente');
    }

    public function destroy(Familia $familia)
    {
        // Ensure the familia belongs to Reino Plantae
        if ($familia->reino->reino_nombre !== 'Plantae') {
            abort(403, 'No autorizado');
        }

        // Check if familia has associated generos before deleting
        if ($familia->generos()->exists()) {
            return redirect()->route('familias.index')
                ->with('error', 'No se puede eliminar. Existen géneros asociados.');
        }

        $familia->delete();

        return redirect()->route('familias.index')
            ->with('success', 'Familia eliminada exitosamente');
    }
}
