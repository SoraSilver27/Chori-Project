<?php

namespace Database\Factories;

use App\Models\Repuesto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RepuestosUtilizado>
 */
class RepuestosUtilizadoFactory extends Factory
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
            'cantidad'=> $this->faker->numberBetween(0,10),
            'nombre_repuesto'=> $this->faker->randomElement(Repuesto::pluck('nombre')->toArray()),
        ];
    }
}
