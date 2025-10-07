<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoriaServico>
 */
class CategoriaServicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->randomElement([
                'MOTOR',
                'CÂMBIO',
                'ILUMINAÇÃO',
                'ESCAPAMENTO',
                'SUSPENSÃO',
                'FREIOS',
                'DIREÇÃO',
            ]),
        ];
    }
}