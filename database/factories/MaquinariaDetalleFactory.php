<?php

namespace Database\Factories;

use App\Models\Maquinaria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaquinariaDetalle>
 */
class MaquinariaDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "id_maquinaria" => Maquinaria::factory(),
            "capacidad_de_produccion" => $this->faker->numberBetween(100,10000),
            "voltaje" => $this->faker->numberBetween(100,10000),
            "peso" => $this->faker->numberBetween(100,10000),
            "tipo" => $this->faker->text(),
            "velocidad_ajustable" => $this->faker->boolean(),
            "pantalla_digital" => $this->faker->boolean(),
            "facil_desmontaje" => $this->faker->boolean(),
            "garantia" => $this->faker->boolean(),
            "problemas_recurrentes" => $this->faker->sentence(),
            "periodo_mantenimiento" => $this->faker->numberBetween(1,1000),
        ];
    }
}
