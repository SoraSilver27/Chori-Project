<?php

namespace Database\Seeders;

use App\Models\Maquinaria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Maquinaria::factory()
            ->count(25)
            ->hasdetalles(1)
            ->create();
    }

}
