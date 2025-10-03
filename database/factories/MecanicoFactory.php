<?php

namespace Database\Factories;

use App\Models\Mecanico;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mecanico>
 */
class MecanicoFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'telefone' => $this->faker->phoneNumber,
            'categoria_id' => \App\Models\CategoriaServico::inRandomOrder()->first()->id,
        ];
    }
}