<?php

namespace Database\Seeders;

use App\Models\NotaDelCalendario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotaDelCalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         NotaDelCalendario::factory()
            ->count(25)
            ->create();
    }
}
