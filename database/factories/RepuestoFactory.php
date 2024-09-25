<?php

namespace Database\Factories;

use App\Models\CategoriaRepuesto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repuesto>
 */
class RepuestoFactory extends Factory
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
            'categoria' => CategoriaRepuesto::class,
            'cantidad'=> $this->faker->numberBetween(0,10000),
            'nombre'=> $this->faker->name(),
            'descripcion'=> $this->faker->word(),
            'fabricante'=> $this->faker->name(),
            'modelo'=> $this->faker->word(),
        ];
    }
}
