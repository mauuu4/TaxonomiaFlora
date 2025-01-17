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
            'user_cedula' => '1234567890',
            'user_nombre' => 'admin',
            'user_apellido' => 'admin',
            'user_telefono' => '1234567890',
            'user_email' => 'admin@gmail.com',
            'user_password' => bcrypt('admin123'),
            'user_estado' => true,
        ]);

        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Taxonomo')->first()->tipus_id,
            'user_cedula' => '1234567890',
            'user_nombre' => 'Mauricio',
            'user_apellido' => 'Romero',
            'user_email' => 'mauriciord2004@gmail.com',
            'user_telefono' => '1234567890',
            'user_password' => bcrypt('mau12345'),
            'user_estado' => false,
        ]);
        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Usuario')->first()->tipus_id,
            'user_cedula' => '1234567890',
            'user_nombre' => 'Steven',
            'user_apellido' => 'Moran',
            'user_email' => 'stevenmoran@gmail.com',
            'user_telefono' => '1234567890',
            'user_password' => bcrypt('steven12345'),
            'user_estado' => true,
        ]);
        User::create([
            'tipus_id' => Tipo::where('tipus_detalles', 'Usuario')->first()->tipus_id,
            'user_cedula' => '1234567890',
            'user_nombre' => 'Jean',
            'user_apellido' => 'Torres',
            'user_email' => 'jeanmtu@outlook.com',
            'user_telefono' => '1234567890',
            'user_password' => bcrypt('jean12345'),
            'user_estado' => false,
        ]);

        User::factory(100)->create();
    }
}
