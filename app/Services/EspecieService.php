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
        return auth()->user()->registros()
            ->with(['especie', 'validaciones' => function($query) {
                $query->orderBy('valid_id', 'desc');
            }])
            ->orderBy('regis_id', 'desc')
            ->paginate();
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
            
            // Handle image deletion
            if (isset($data['imagenes_eliminar'])) {
                $this->deleteImages($data['imagenes_eliminar']);
            }
            
            // Handle new images
            if (isset($data['nuevas_imagenes'])) {
                $this->storeImages(
                    $especie, 
                    $data['nuevas_imagenes'],
                    $data['nuevas_img_descripcion'] ?? []
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