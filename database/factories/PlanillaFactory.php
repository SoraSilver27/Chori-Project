<?php

namespace Database\Factories;

use App\Models\Componente;
use App\Models\Maquinaria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planilla>
 */
class PlanillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $es_de = $this->faker->boolean;

        return [
            'es_de' => $es_de ? 1:0,
            'id_maquina' => $es_de ? Maquinaria::factory() : null,
            'id_componente' => !$es_de ? Componente::factory() : null,
            'fecha' => $this->faker->date(),
            'encargado' => $this->faker->name(),
            'telefono_encargado' => $this->faker->phoneNumber(),
        ];
    }
    public function maquina($id_maquina)
    {
        return $this->state([
            'es_de' => 1,
            'id_maquina' => $id_maquina,
            'id_componente' => null,
        ]);
    }
    public function componente($id_componente)
    {
        return $this->state([
            'es_de' => 0,
            'id_maquina' => null,
            'id_componente' => $id_componente,
        ]);
    }
}
