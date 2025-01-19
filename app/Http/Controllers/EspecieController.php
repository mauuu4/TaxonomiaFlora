<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Registro;
use App\Http\Requests\EspecieRequest;
use App\Services\EspecieService;

class EspecieController extends Controller
{
    protected $especieService;

    public function __construct(EspecieService $especieService)
    {
        $this->especieService = $especieService;
    }

    public function index()
    {
        $registros = $this->especieService->getPaginatedRegistros();
        $generos = Genero::all();
        return view('especies.index', compact('registros', 'generos'));
    }

    public function create()
    {
        $generos = Genero::all();
        return view('especies.create', compact('generos'));
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
