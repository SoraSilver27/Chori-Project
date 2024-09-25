<?php

namespace Database\Seeders;

use App\Models\HistorialGeneral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorialGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HistorialGeneral::factory()
            ->count(25)
            ->create();
    }
}
