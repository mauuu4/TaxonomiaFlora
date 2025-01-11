<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage_users', 'description' => 'Gestionar usuarios']);
        Permission::create(['name' => 'validate_species', 'description' => 'Validar especies']);
        Permission::create(['name' => 'add_species', 'description' => 'Agregar especies']);
    }
}
