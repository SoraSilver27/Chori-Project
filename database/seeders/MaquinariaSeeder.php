<?php

namespace Database\Seeders;

use App\Models\Componente;
use App\Models\Maquinaria;
use App\Models\Planilla;
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
            ->has(Componente::factory()
                    ->count(5)
                    ->has(Planilla::factory()
                            ->count(3)
                            ->state(function (array $attributes, Componente $componente) {
                                return [
                                    'es_de' => 0,
                                    'id_componente' => $componente->id,
                                    'id_maquina' => null,
                                ];
                            }),
                        'planillas'
                    ),

                'componentes'
            )
            ->has(Planilla::factory()
                    ->count(5)
                    ->maquina(function (array $attributes, Maquinaria $maquinaria) {
                        return $maquinaria->id;
                    }),
                'planillas')
            ->create();
    }

}
