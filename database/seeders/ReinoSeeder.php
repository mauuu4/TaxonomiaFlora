<?php

namespace Database\Seeders;

use App\Models\Reino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Reino::create(['reino_nombre' => 'Plantae']);
        Reino::create(['reino_nombre' => 'Fungi']);
        Reino::create(['reino_nombre' => 'Animalia']);
    }
}
