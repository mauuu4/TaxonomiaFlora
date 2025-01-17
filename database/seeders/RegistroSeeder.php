<?php

namespace Database\Seeders;

use App\Models\Mapa;
use App\Models\Registro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registro::create([
            'esp_id' => 1,
            'user_id' => 1,
            'regis_estado' => 'Pendiente',
        ]);
        Registro::create([
            'esp_id' => 2,
            'user_id' => 3,
            'regis_estado' => 'Validado',
        ]);
        Registro::create([
            'esp_id' => 3,
            'user_id' => 2,
            'regis_estado' => 'Rechazado',
        ]);
        Registro::create([
            'esp_id' => 4,
            'user_id' => 2,
            'regis_estado' => 'Pendiente',
        ]);

        Registro::factory(100)->create();

        Mapa::create([
            'mapa_nombre' => 'Mapa de la región 1',
            'mapa_url' => 'https://www.google.com/maps/',
        ]);
    }
}
