<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maquinaria>
 */
class MaquinariaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estado = $this->faker->randomElement(["En uso", "Disponible", "Indisponible"]);
        return [
            //
            "nombre" => $this->faker->name(),
            "numero_de_serie" => $this->faker->word(),
            "modelo" => $this->faker->word(),
            "estado" => $estado,
            "en_seguimiento" => $this->faker->boolean(),
            "fecha_adquisicion" => $this->faker->date(),
            "observaciones_generales" => $this->faker->sentence(),
            "ultimo_mantenimiento" => $this->faker->date(),
            "proximo_mantenimiento" => $this->faker->date(),
        ];
    }
}
