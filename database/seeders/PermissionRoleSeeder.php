<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $taxonomistRole = Role::where('name', 'taxonomist')->first();
        $userRole = Role::where('name', 'user')->first();

        $manageUsers = Permission::where('name', 'manage_users')->first();
        $validateSpecies = Permission::where('name', 'validate_species')->first();
        $addSpecies = Permission::where('name', 'add_species')->first();

        // Asignar permisos a roles
        $adminRole->permissions()->attach([$manageUsers->id, $validateSpecies->id, $addSpecies->id]);
        $taxonomistRole->permissions()->attach([$validateSpecies->id]);
        $userRole->permissions()->attach([$addSpecies->id]);
    }
}
