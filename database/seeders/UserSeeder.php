<?php

namespace Database\Seeders;

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
        User::create([
            'user_nombre' => 'admin',
            'user_apellido' => 'admin',
            'user_telefono' => '1234567890',
            'user_email' => 'admin@gmail.com',
            'user_password' => bcrypt('admin123'),
        ]);

        User::create([
            'user_nombre' => 'Mauricio',
            'user_apellido' => 'Romero',
            'user_telefono' => '1234567890',
            'user_email' => 'mauriciord2004@gmail.com',
            'user_password' => bcrypt('mau12345'),
        ]);
        User::create([
            'user_nombre' => 'Steven',
            'user_apellido' => 'Moran',
            'user_telefono' => '1234567890',
            'user_email' => 'stevenmoran@gmail.com',
            'user_password' => bcrypt('steven12345'),
        ]);
        User::create([
            'user_nombre' => 'Jean',
            'user_apellido' => 'Torres',
            'user_telefono' => '1234567890',
            'user_email' => 'jeanmtu@outlook.com',
            'user_password' => bcrypt('jean12345'),
        ]);
    }
}
