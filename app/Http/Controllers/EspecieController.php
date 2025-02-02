<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Registro;
use App\Http\Requests\EspecieRequest;
use App\Models\Familia;
use App\Models\User;
use App\Services\EspecieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecieController extends Controller
{
    protected $especieService;

    public function __construct(EspecieService $especieService)
    {
        $this->especieService = $especieService;
    }

    public function index(Request $request)
    {
        // Obtener todos los géneros y familias para mostrarlos en el formulario de filtro
        $generos = Genero::all();
        $familias = Familia::all();

        // Obtenemos los registros filtrados según los parámetros
        $registros = $this->especieService->getFilteredPaginatedRegistros(
            $request->search, // Si hay una búsqueda
            $request->genero, // Filtro por género
            $request->familia, // Filtro por familia
            $request->estado // Filtro por estado de validación
        );

        return view('especies.index', compact('registros', 'generos', 'familias'));
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
        $especie = Especie::find($especie);
        if (!$especie) {
            abort(404);
        }
        
        $registro = $especie->registros->first();

        $validaciones = Registro::where('esp_id', $especie->esp_id)
            ->first()
            ->validaciones()
            ->orderBy('valid_id', 'desc')
            ->get();

        $validaciones->each(function ($validacion) {
            $validacion->user_nombre = User::find($validacion->valid_user_id)->user_nombre ?? 'Usuario desconocido';
        });

        return view('especies.show', compact('especie', 'validaciones'));
    }

    public function edit($especie)
    {
        $especie = Especie::find($especie);
        
        if (!$especie || !$this->checkPermission($especie->esp_id, 'edit')) {
            return redirect()->route('especies.index')
                ->with('error', 'No tienes permiso para editar esta especie.');
        }
        
        $generos = Genero::all();
        return view('especies.edit', compact('especie', 'generos'));
    }

    public function update(EspecieRequest $request, $especie)
    {
        try {
            $especie = Especie::find($especie);

            $imagenesActuales = $especie->imagenes()->count();
            $imagenesAEliminar = $request->input('imagenes_eliminar', []);
            $nuevasImagenes = $request->file('nuevas_imagenes', []);

            $totalImagenesDespuesDeUpdate = $imagenesActuales - count($imagenesAEliminar) + count($nuevasImagenes);

            if (!$especie || !$this->checkPermission($especie->esp_id, 'edit')) {
                return redirect()->route('especies.index')
                    ->with('error', 'No tienes permiso para actualizar esta especie.');
            }

            if ($totalImagenesDespuesDeUpdate < 1) {
                return back()
                    ->withInput()
                    ->with(['error' => 'Debe mantener al menos una imagen para la especie.']);
            }

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
            
            if (!$especie || !$this->checkPermission($especie->esp_id, 'delete')) {
                return redirect()->route('especies.index')
                    ->with('error', 'No tienes permiso para eliminar esta especie.');
            }
    
            $this->especieService->delete($especie);
    
            return redirect()->route('especies.index')
                ->with('warning', 'Especie y todos sus datos relacionados eliminados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la especie: ' . $e->getMessage());
        }
    }

    private function checkPermission($especieId, $permission)
    {
        return DB::select(
        'SELECT check_especie_permissions(?, ?, ?)',
            [auth()->id(), $especieId, $permission]
            )[0]->check_especie_permissions;
    }
}
