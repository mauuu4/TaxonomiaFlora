<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Imagen;
use App\Models\Registro;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EspecieController extends Controller
{
    public function index()
    {
        $registros = auth()->user()->registros()
            ->with(['especie', 'validaciones' => function($query) {
                $query->orderBy('valid_fecha', 'desc');
            }])
            ->orderBy('regis_id', 'desc')->paginate();
 
        return view('especies.index', compact('registros'));
    }

    public function create()
    {
        $generos = Genero::all();
        return view('especies.create', compact('generos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'esp_gene_id' => ['required', 'exists:tax_generos,gene_id'],
            'esp_nombre_cientifico' => ['required','min:3','max:50', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['nullable', 'string', 'max:500', 'regex:/\S/'],
            'imagenes.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'img_descripcion.*' => ['nullable', 'string', 'max:255'],
            'ubi_longitud' => ['required', 'numeric', 'between:-180,180'],
            'ubi_latitud' => ['required', 'numeric', 'between:-90,90'],
            'ubi_region' => ['required', 'string', 'max:30'],
            'ubi_descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        $especie = Especie::create($validated);

        // Guardar las imágenes
        if($request->hasFile('imagenes')) {
            foreach($request->file('imagenes') as $index => $imagen) {
                $path = $imagen->store('especies', 'public');
                
                Imagen::create([
                    'img_ruta' => $path,
                    'img_descripcion' => $request->img_descripcion[$index] ?? null,
                    'img_esp_id' => $especie->esp_id
                ]);
            }
        }

        // Crear la ubicación
        Ubicacion::create([
            'ubi_esp_id' => $especie->esp_id,
            'ubi_longitud' => $request->ubi_longitud,
            'ubi_latitud' => $request->ubi_latitud,
            'ubi_region' => $request->ubi_region,
            'ubi_descripcion' => $request->ubi_descripcion,
        ]);

        // Crear el registro
        Registro::create([
            'esp_id' => $especie->esp_id,  // Asignar el esp_id correctamente
            'user_id' => auth()->id(), // Usuario autenticado
        ]);

        return redirect()->route('especies.index')
            ->with('success', 'Especie registrada exitosamente.');
    }

    public function show($especie)
    {
        $especie = Especie::with(['genero', 'imagenes', 'ubicaciones'])->find($especie);        
        return view('especies.show', compact('especie'));
    }

    public function edit($especie)
    {
        $especie = Especie::with(['genero', 'imagenes', 'ubicaciones'])->find($especie);
        $generos = Genero::all();
        return view('especies.edit', compact('especie', 'generos'));
    }

    public function update(Request $request, $especie)
    {
        $validated = $request->validate([
            'esp_gene_id' => ['required', 'exists:tax_generos,gene_id'],
            'esp_nombre_cientifico' => ['required','min:3','max:50', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_nombre_comun' => ['required', 'min:3', 'max:50', 'regex:/^(?!^\d+$)[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ\-]+$/'],
            'esp_descripcion' => ['nullable', 'string', 'max:500', 'regex:/\S/'],
            'nuevas_imagenes.*' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'nuevas_img_descripcion.*' => ['nullable', 'string', 'max:255'],
            'ubi_longitud' => ['required', 'numeric', 'between:-180,180'],
            'ubi_latitud' => ['required', 'numeric', 'between:-90,90'],
            'ubi_region' => ['required', 'string', 'max:30'],
            'ubi_descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        $especie = Especie::find($especie);
        $especie->update($validated);

         // Manejar eliminación de imágenes
        if ($request->has('imagenes_eliminar')) {
            foreach ($request->imagenes_eliminar as $imagenId) {
                $imagen = Imagen::find($imagenId);
                if ($imagen) {
                    Storage::disk('public')->delete($imagen->img_ruta);
                    $imagen->delete();
                }
            }
        }

        // Manejar nuevas imágenes
        if($request->hasFile('nuevas_imagenes')) {
            foreach($request->file('nuevas_imagenes') as $index => $imagen) {
                $path = $imagen->store('especies', 'public');
                
                Imagen::create([
                    'img_ruta' => $path,
                    'img_descripcion' => $request->nuevas_img_descripcion[$index] ?? null,
                    'img_esp_id' => $especie->esp_id
                ]);
            }
        }

        // Actualizar ubicación
        if($especie->ubicaciones->first()) {
            $especie->ubicaciones->first()->update([
                'ubi_longitud' => $request->ubi_longitud,
                'ubi_latitud' => $request->ubi_latitud,
                'ubi_region' => $request->ubi_region,
                'ubi_descripcion' => $request->ubi_descripcion,
            ]);
        }

        //update registro estado
        $registro = Registro::where('esp_id', $especie->esp_id)->first();
        $registro->update([
            'regis_estado' => 'Pendiente'
        ]);

        return redirect()->route('especies.show', $especie->esp_id)
            ->with('success', 'Especie actualizada exitosamente.');
    }

    public function destroy($especie)
    {
        $especie = Especie::find($especie);
    
        // Eliminar imágenes del almacenamiento
        foreach($especie->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->img_ruta);
        }

        // Eliminar registros relacionados
        $registro = Registro::where('esp_id', $especie->esp_id)->first();
        if ($registro) {
            $registro->validaciones()->delete();
            $registro->delete();
        }
        
        // Eliminar ubicaciones
        $especie->ubicaciones()->delete();
        
        // Eliminar imágenes de la base de datos
        $especie->imagenes()->delete();

        // Eliminar la especie
        $especie->delete();
        
        return redirect()->route('especies.index')
            ->with('success', 'Especie y todos sus datos relacionados eliminados exitosamente.');
    }
}
