<?php

namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Imagen;
use App\Models\Registro;
use App\Models\Ubicacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especie::create([
            'esp_gene_id' => 1, // Acacia
            'esp_nombre_cientifico' => 'Acacia dealbata',
            'esp_nombre_comun' => 'Mimosa plateada',
            'esp_descripcion' => 'Árbol ornamental de rápido crecimiento.',
            'esp_estado_valid' => true,
        ]);
        Especie::create([
            'esp_gene_id' => 1,
            'esp_nombre_cientifico' => 'Acacia rubra',
            'esp_nombre_comun' => 'Acacia roja',            
            'esp_descripcion' => 'La acacia de bola azul, acacia de hoja azul, mimosa de hoja azul o acacia plateada (Acacia dealbata) es una especie arbórea perteneciente a la familia de las fabáceas.',
            'esp_estado_valid' => false,
        ]);

        Especie::create([
            'esp_gene_id' => 2, // Rosa
            'esp_nombre_cientifico' => 'Rosa canina',
            'esp_nombre_comun' => 'Rosa silvestre',
            'esp_descripcion' => 'Arbusto de la familia de las rosáceas.',
            'esp_estado_valid' => true,
        ]);

        Especie::create([
            'esp_gene_id' => 2, // Rosa
            'esp_nombre_cientifico' => 'Rosa rubiginosa',
            'esp_nombre_comun' => 'Rosa mosqueta',
            'esp_descripcion' => 'La rosa mosqueta es un arbusto de la familia de las rosáceas.',
            'esp_estado_valid' => true,
        ]);

        Registro::create([
            'esp_id' => 1,
            'user_id' => 1,
            'regis_estado' => 'Pendiente',
        ]);
        Registro::create([
            'esp_id' => 2,
            'user_id' => 2,
            'regis_estado' => 'Validado',
        ]);
        Registro::create([
            'esp_id' => 3,
            'user_id' => 3,
            'regis_estado' => 'Rechazado',
        ]);
        Registro::create([
            'esp_id' => 4,
            'user_id' => 4,
            'regis_estado' => 'Pendiente',
        ]);

        Imagen::create([
            'img_esp_id' => 1,
            'img_ruta' => 'especies/img1.jpeg',
            'img_descripcion' => 'Acacia dealbata',
        ]);

        Imagen::create([
            'img_esp_id' => 2,
            'img_ruta' => 'especies/img2.jpeg',
            'img_descripcion' => 'Rosa canina',
        ]);

        Imagen::create([
            'img_esp_id' => 3,
            'img_ruta' => 'especies/img3.jpeg',
            'img_descripcion' => 'Rosa no canina',
        ]);

        Imagen::create([
            'img_esp_id' => 4,
            'img_ruta' => 'especies/img4.jpeg',
            'img_descripcion' => 'Acacia dealbata mod',
        ]);

        Ubicacion::create([
            'ubi_esp_id' => 1,
            'ubi_latitud' => 40.416775,
            'ubi_longitud' => -3.707790,
            'ubi_region' => 'Madrid',
            'ubi_descripcion' => 'Plaza Mayor',
        ]);

        Ubicacion::create([
            'ubi_esp_id' => 2,
            'ubi_latitud' => 40.416175,
            'ubi_longitud' => -3.703790,
            'ubi_region' => 'Madrid',
            'ubi_descripcion' => 'Plaza Mayor',
        ]);

        Ubicacion::create([
            'ubi_esp_id' => 3,
            'ubi_latitud' => 40.416775,
            'ubi_longitud' => -3.773790,
            'ubi_region' => 'Madrid',
            'ubi_descripcion' => 'Plaza Mayor',
        ]);

        Ubicacion::create([
            'ubi_esp_id' => 4,
            'ubi_latitud' => 40.416775,
            'ubi_longitud' => -3.803790,
            'ubi_region' => 'Madrid',
            'ubi_descripcion' => 'Plaza Mayor',
        ]);
    }
}
