<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Registro;
use App\Http\Requests\EspecieRequest;
use App\Models\Familia;
use App\Models\Reino;
use App\Services\EspecieService;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    protected $especieService;

    public function __construct(EspecieService $especieService)
    {
        $this->especieService = $especieService;
    }

    public function index(Request $request)
    {
        // Obtener todos los géneros, familias y reinos para mostrarlos en el formulario de filtro
        $generos = Genero::all();
        $familias = Familia::all();
        $reinos = Reino::all();

        // Obtenemos los registros filtrados según los parámetros
        $registros = $this->especieService->getFilteredPaginatedRegistros(
            $request->search, // Si hay una búsqueda
            $request->genero, // Filtro por género
            $request->familia, // Filtro por familia
            $request->reino, // Filtro por reino
            $request->estado // Filtro por estado de validación
        );

        return view('especies.index', compact('registros', 'generos', 'familias', 'reinos'));
    }
    

    public function store(EspecieRequest $request)
    {
        try {
            $this->especieService->store($request->validated());
            return redirect()->route('especies.index')
                ->with('success', 'Especie registrada exitosamente.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al registrar la especie: ' . $e->getMessage());
        }
    }

    public function show($especie)
    {
        $especie = Especie::with(['genero', 'imagenes', 'ubicaciones'])->find($especie);        
        $validaciones = Registro::where('esp_id', $especie->esp_id)
            ->first()
            ->validaciones()
            ->orderBy('valid_id', 'desc')
            ->get();
            
        return view('especies.show', compact('especie', 'validaciones'));
    }

    public function edit($especie)
    {
        $especie = Especie::with(['genero', 'imagenes', 'ubicaciones'])->find($especie);
        $generos = Genero::all();
        return view('especies.edit', compact('especie', 'generos'));
    }

    public function update(EspecieRequest $request, $especie)
    {
        try {
            $especie = Especie::find($especie);
            $this->especieService->update($especie, $request->validated());
            
            return redirect()->route('especies.show', $especie->esp_id)
                ->with('status', 'Especie actualizada exitosamente.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la especie: ' . $e->getMessage());
        }
    }

    public function destroy($especie)
    {
        try {
            $especie = Especie::find($especie);
            $this->especieService->delete($especie);

            return redirect()->route('especies.index')
                ->with('warning', 'Especie y todos sus datos relacionados eliminados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la especie: ' . $e->getMessage());
        }
    }
}
