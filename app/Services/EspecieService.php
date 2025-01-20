<?php

namespace App\Services;

use App\Models\Especie;
use App\Models\Imagen;
use App\Models\Ubicacion;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EspecieService
{
    public function getPaginatedRegistros()
    {
        // Consider adding a parameter for items per page
        return auth()->user()->registros()
            ->with(['especie.genero.familia.reino', 'validaciones' => function($query) {
                $query->orderBy('valid_id', 'desc');
            }])
            ->orderBy('regis_id', 'desc')
            ->paginate(10); // Specify number of items per page
    }

    public function getFilteredPaginatedRegistros($search = null, $genero = null, $familia = null, $reino = null, $estado = null)
    {
        $query = auth()->user()->registros()
            ->with(['especie.genero.familia.reino', 'validaciones' => function($query) {
                $query->orderBy('valid_id', 'desc');
            }])
            ->orderBy('regis_id', 'desc');
    
        // Si hay un término de búsqueda, aplicar el filtro sin distinguir entre mayúsculas y minúsculas
        if ($search) {
            $query->whereHas('especie', function($q) use ($search) {
                $q->where('esp_nombre_comun', 'like', '%' . strtolower($search) . '%')
                  ->orWhere('esp_nombre_cientifico', 'like', '%' . strtolower($search) . '%');
            });
        }
    
        // Filtro por género
        if ($genero) {
            $query->whereHas('especie.genero', function($q) use ($genero) {
                $q->where('gene_id', $genero);
            });
        }
    
        // Filtro por familia
        if ($familia) {
            $query->whereHas('especie.genero.familia', function($q) use ($familia) {
                $q->where('fam_id', $familia);
            });
        }
    
        // Filtro por reino
        if ($reino) {
            $query->whereHas('especie.genero.familia.reino', function($q) use ($reino) {
                $q->where('reino_id', $reino);
            });
        }
        
        // Filtro por estado
        if ($estado) {
            $query->where('regis_estado', $estado);
        }    
    
        return $query->paginate(10); // Paginación
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create especie with validation state
            $data['esp_estado_valid'] = false;
            $especie = Especie::create($data);
            
            // Handle images if present
            if (isset($data['esp_imagenes'])) {
                $this->storeImages(
                    $especie, 
                    $data['esp_imagenes'], 
                    $data['img_descripcion'] ?? []
                );
            }

            // Create ubicacion
            $this->storeUbicacion($especie, $data);

            // Create registro
            $this->createRegistro($especie);

            return $especie;
        });
    }

    public function update(Especie $especie, array $data)
    {
        return DB::transaction(function () use ($especie, $data) {
            // Update especie with validation state
            $data['esp_estado_valid'] = false;
            $especie->update($data);

            if(isset($data['img_descripcion_nueva'])) {
                foreach ($data['img_descripcion_nueva'] as $imagenId => $nuevaDescripcion) {
                    $imagen = Imagen::find($imagenId);
                    if ($imagen) {
                        $imagen->img_descripcion = $nuevaDescripcion;
                        $imagen->save();
                    }
                }
            }
            
            // Handle image deletion
            if (isset($data['imagenes_eliminar'])) {
                $this->deleteImages($data['imagenes_eliminar']);
            }
            
            // Handle new images
            if (isset($data['nuevas_imagenes'])) {
                $this->storeImages(
                    $especie, 
                    $data['nuevas_imagenes'],
                    $data['img_descripcion'] ?? []
                );
            }
            
            // Update ubicacion
            $this->updateUbicacion($especie, $data);

            // Update registro estado
            $this->updateRegistroEstado($especie);

            return $especie;
        });
    }

    public function delete(Especie $especie)
    {
        return DB::transaction(function () use ($especie) {
            // Delete images from storage
            foreach ($especie->imagenes as $imagen) {
                Storage::disk('public')->delete($imagen->img_ruta);
            }

            // Delete related records
            $registro = Registro::where('esp_id', $especie->esp_id)->first();
            if ($registro) {
                $registro->validaciones()->delete();
                $registro->delete();
            }

            // Delete related records
            $especie->ubicaciones()->delete();
            $especie->imagenes()->delete();
            $especie->delete();

            return true;
        });
    }

    private function storeImages(Especie $especie, array $imagenes, array $descripciones)
    {
        foreach ($imagenes as $index => $imagen) {
            $path = $imagen->store('especies', 'public');
            
            Imagen::create([
                'img_ruta' => $path,
                'img_descripcion' => $descripciones[$index] ?? null,
                'img_esp_id' => $especie->esp_id
            ]);
        }
    }

    private function deleteImages(array $imageIds)
    {
        foreach ($imageIds as $imageId) {
            $imagen = Imagen::find($imageId);
            if ($imagen) {
                Storage::disk('public')->delete($imagen->img_ruta);
                $imagen->delete();
            }
        }
    }

    private function storeUbicacion(Especie $especie, array $data)
    {
        Ubicacion::create([
            'ubi_mapa_id' => 1,
            'ubi_esp_id' => $especie->esp_id,
            'ubi_longitud' => $data['ubi_longitud'],
            'ubi_latitud' => $data['ubi_latitud'],
            'ubi_region' => $data['ubi_region'],
            'ubi_descripcion' => $data['ubi_descripcion'] ?? null,
        ]);
    }

    private function updateUbicacion(Especie $especie, array $data)
    {
        if ($ubicacion = $especie->ubicaciones->first()) {
            $ubicacion->update([
                'ubi_longitud' => $data['ubi_longitud'],
                'ubi_latitud' => $data['ubi_latitud'],
                'ubi_region' => $data['ubi_region'],
                'ubi_descripcion' => $data['ubi_descripcion'] ?? null,
            ]);
        }
    }

    private function createRegistro(Especie $especie)
    {
        Registro::create([
            'esp_id' => $especie->esp_id,
            'user_id' => auth()->id(),
            'regis_estado' => 'Pendiente'
        ]);
    }

    private function updateRegistroEstado(Especie $especie)
    {
        $registro = Registro::where('esp_id', $especie->esp_id)->first();
        return $registro->update(['regis_estado' => 'Pendiente']);
    }
}