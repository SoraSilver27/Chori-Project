<?php

namespace Database\Factories;

use App\Models\Maquinaria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Componente>
 */
class ComponenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estado = $this->faker->randomElement(["En uso", "Disponible", "Indisponible"]);
        $periodo = $this->faker->randomElement([0,7,15,30,60,90,180,360,720]);
        return [
            //
            "ubicacion" => Maquinaria::factory(),
            "nombre" => $this->faker->name(),
            "numero_de_serie" => $this->faker->word(),
            "modelo" => $this->faker->word(),
            "estado" => $estado,
            "descripcion" => $this->faker->sentence(),
            "periodo_mantenimiento" => $periodo,
            "ultimo_mantenimiento" => $this->faker->date(),
            "proximo_mantenimiento" => $this->faker->date(),
            "mantenimiento" => $this->faker->sentence(),
            "mantenimiento_detallado" => $this->faker->sentence(),
            "fecha_ingreso" => $this->faker->date(),
        ];
    }
}
