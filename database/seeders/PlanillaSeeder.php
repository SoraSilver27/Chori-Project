<?php

namespace Database\Seeders;

use App\Models\Planilla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Planilla::factory()
            ->count(25)
            ->create();
    }
}
