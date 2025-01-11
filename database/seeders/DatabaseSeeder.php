<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleUserSeeder::class,
            PermissionRoleSeeder::class,
            ReinoSeeder::class,
            FamiliaSeeder::class,
            GeneroSeeder::class,
            EspecieSeeder::class,
            RegistroSeeder::class,
        ]);
    }
}
