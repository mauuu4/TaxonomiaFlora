<?php

namespace App\Services;

use App\Models\Especie;
use App\Models\Genero;
use App\Models\Imagen;
use App\Models\Ubicacion;
use App\Models\Registro;
use App\Models\User;
use App\Notifications\EspeciePendingValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
class EspecieService
{
    public function getFilteredPaginatedRegistros($search = null, $genero = null, $familia = null, $estado = null)
    {
        $query = DB::table('vista_registros_especies')
            ->where('user_id', auth()->id());
    
        // Búsqueda general
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('esp_nombre_comun', 'ilike', "%{$search}%")
                  ->orWhere('esp_nombre_cientifico', 'ilike', "%{$search}%");
            });
        }
    
        // Filtros específicos
        if ($genero) $query->where('gene_id', $genero);
        if ($familia) $query->where('fam_id', $familia);
        if ($estado) $query->where('regis_estado', $estado);
    
        return $query->orderBy('regis_id', 'desc')->paginate(10);
    }    

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $nombreCientifico = explode(' ', $data['esp_nombre_cientifico']);
            $genero = Genero::find($data['esp_gene_id']);
            if (!$genero || $nombreCientifico[0] != $genero->gene_nombre) {
                throw new \Exception('El nombre científico debe comenzar con el género.');
            }

            // Create especie with validation state
            $data['esp_estado_valid'] = false;
            $especie = Especie::create($data);
            $registro = $this->createRegistro($especie);
            
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

            // Notify taxonomists
            $this->notifyTaxonomos($registro, 'creada');

            return $especie;
        });
    }

    public function update(Especie $especie, array $data)
    {
        return DB::transaction(function () use ($especie, $data) {
            DB::statement("SET app.current_user_id = " . auth()->id());
    
            // Validate scientific name
            $nombreCientifico = explode(' ', $data['esp_nombre_cientifico']);
            $genero = Genero::find($data['esp_gene_id']);
            
            if (!$genero || $nombreCientifico[0] != $genero->gene_nombre) {
                throw new \Exception('El nombre científico debe comenzar con el género.');
            }
    
            // Reset validation state
            $data['esp_estado_valid'] = false;
            
            // Update species core information
            $especie->update($data);
    
            // Update image descriptions
            if (!empty($data['img_descripcion_nueva'])) {
                foreach ($data['img_descripcion_nueva'] as $imagenId => $nuevaDescripcion) {
                    Imagen::where('img_id', $imagenId)->update([
                        'img_descripcion' => $nuevaDescripcion
                    ]);
                }
            }
            
            // Delete selected images
            if (!empty($data['imagenes_eliminar'])) {
                $this->deleteImages($data['imagenes_eliminar']);
            }
            
            // Add new images
            if (!empty($data['nuevas_imagenes'])) {
                $remainingSlots = 5 - ($especie->imagenes->count() - count($data['imagenes_eliminar'] ?? []));
                $imagesToStore = array_slice($data['nuevas_imagenes'], 0, $remainingSlots);
                
                $this->storeImages(
                    $especie, 
                    $imagesToStore,
                    array_slice($data['img_descripcion'] ?? [], 0, $remainingSlots)
                );
            }
            
            // Update location
            $this->updateUbicacion($especie, $data);
    
            // Update registration status
            $this->updateRegistroEstado($especie);

            $registro = Registro::where('esp_id', $especie->esp_id)
                ->latest()
                ->first();
                
            $this->notifyTaxonomos($registro, 'actualizado');
    
            return $especie;
        });
    }

    public function delete(Especie $especie)
    {
        return DB::transaction(function () use ($especie) {
            // Set current user ID for permission checking
            DB::statement("SET app.current_user_id = " . auth()->id());
    
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
        return Registro::create([
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

    private function notifyTaxonomos(Registro $registro, string $accion)
    {
        $taxonomos = User::whereHas('roles', function($query) {
            $query->where('tipus_detalles', 'Taxonomo');
        })->get();
    
        Notification::send($taxonomos, new EspeciePendingValidation($registro, $accion));
    }
}