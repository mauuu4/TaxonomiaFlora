<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Genero;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::orderBy('esp_id', 'desc')->paginate();
        return view('especies.index', compact('especies'));
    }

    public function create()
    {
        $generos = Genero::all();
        return view('especies.create', compact('generos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'esp_gene_id' => ['required', 'exists:TAX_GENEROS,gene_id'],
            'esp_nombre_cientifico' => ['required','min:3','max:50', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['nullable','max:500', 'regex:/\S/'],
        ]);

        Especie::create($validated);

        return redirect()->route('especies.index')
            ->with('success', 'Especie registrada exitosamente.');
    }

    public function show($especie)
    {
        $especie = Especie::with('genero')->find($especie);
        return view('especies.show', compact('especie'));
    }

    public function edit($especie)
    {
        $especie = Especie::find($especie);
        $generos = Genero::all();
        return view('especies.edit', compact('especie', 'generos'));
    }

    public function update(Request $request, $especie)
    {
        $validated = $request->validate([
            'esp_gene_id' => ['required', 'exists:TAX_GENEROS,gene_id'],
            'esp_nombre_cientifico' => ['required','min:3','max:50', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['nullable','max:500', 'regex:/\S/'],
        ]);

        Especie::find($especie)->update($validated);

        return redirect()->route('especies.show', $especie)
            ->with('success', 'Especie actualizada exitosamente.');
    }

    public function destroy($especie)
    {
        Especie::destroy($especie);
        return redirect()->route('especies.index')
            ->with('success', 'Especie eliminada exitosamente.');
    }
}
