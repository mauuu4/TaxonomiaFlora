<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $taxonomistRole = Role::where('name', 'taxonomist')->first();
        $userRole = Role::where('name', 'user')->first();

        // Asignar roles a usuarios
        User::find(1)->roles()->attach($adminRole->id); // Admin
        User::find(2)->roles()->attach($taxonomistRole->id); // Taxonomist
        User::find(3)->roles()->attach($userRole->id); // User
        User::find(4)->roles()->attach($userRole->id); // User
    }
}
