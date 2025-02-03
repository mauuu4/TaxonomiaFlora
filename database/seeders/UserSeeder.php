<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permiso::create(['perus_detalle' => 'Taxonomia',]);

        $permiso = Permiso::where('perus_detalle', 'Taxonomia')->first();

        Tipo::create([
            'perus_id' => $permiso->perus_id,
            'tipus_detalles' => 'Administrador',
        ]);
        Tipo::create([
            'perus_id' => $permiso->perus_id,
            'tipus_detalles' => 'Taxonomo',
        ]);
        Tipo::create([
            'perus_id' => $permiso->perus_id,
            'tipus_detalles' => 'Usuario',
        ]);

        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Administrador')->first()->tipus_id,
            'user_cedula' => '1900717867',
            'user_nombre' => 'Mauricio',
            'user_apellido' => 'Romero',
            'user_email' => 'mauriciord2004@gmail.com',
            'user_telefono' => '0985507475',
            'user_password' => bcrypt('mau12345'),
            'user_estado' => true,
        ]);
        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Usuario')->first()->tipus_id,
            'user_cedula' => '1050364452',
            'user_nombre' => 'Steven',
            'user_apellido' => 'Moran',
            'user_email' => 'stevenmoran0308@gmail.com',
            'user_telefono' => '0987191099',
            'user_password' => bcrypt('steven12345'),
            'user_estado' => true,
        ]);
        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Taxonomo')->first()->tipus_id,
            'user_cedula' => '1727760140',
            'user_nombre' => 'Jean',
            'user_apellido' => 'Torres',
            'user_email' => 'jeanmtu@outlook.com',
            'user_telefono' => '0979581190',
            'user_password' => bcrypt('jean12345'),
            'user_estado' => true,
        ]);

        // User::factory(100)->create();
    }
}
