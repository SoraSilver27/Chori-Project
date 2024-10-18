<?php

namespace Database\Seeders;

use App\Models\CategoriaRepuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaRepuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CategoriaRepuesto::factory()
            ->count(25)
            ->hasrepuestos(200)
            ->create();
    }
}
