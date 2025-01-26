<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::with('familia.reino')->paginate(10);
        $familias = Familia::whereHas('reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->get();
        
        return view('generos.index', compact('generos', 'familias'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gene_nombre' => 'required|unique:tax_generos,gene_nombre|max:255',
            'gene_fam_id' => 'required|exists:tax_familias,fam_id'
        ]);

        Genero::create($validated);

        return redirect()->route('generos.index')
            ->with('success', 'Género creado exitosamente.');
    }

    public function edit(Genero $genero)
    {
        // Only get families from Plantae kingdom
        $familias = Familia::whereHas('reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->get();

        return view('generos.edit', compact('genero', 'familias'));
    }

    public function update(Request $request, Genero $genero)
    {
        $validated = $request->validate([
            'gene_nombre' => 'required|unique:tax_generos,gene_nombre,'.$genero->gene_id.',gene_id|max:255',
            'gene_fam_id' => 'required|exists:tax_familias,fam_id'
        ]);

        $genero->update($validated);

        return redirect()->route('generos.index')
            ->with('status', 'Género actualizado exitosamente.');
    }

    public function destroy(Genero $genero)
    {
        if ($genero->especies()->exists()) {
            return redirect()->route('generos.index')
                ->with('error', 'No se puede eliminar. Existen especies asociadas.');
        }
        $genero->delete();

        return redirect()->route('generos.index')
            ->with('success', 'Género eliminado exitosamente.');
    }
}
