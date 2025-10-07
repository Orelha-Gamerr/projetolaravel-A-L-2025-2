<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
        ];
    }
}
