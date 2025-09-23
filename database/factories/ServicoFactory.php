<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\CategoriaServico;
use Illuminate\Database\Eloquent\Factories\Factory;


class ServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->sentence(2), // "troca pneus"
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? Cliente::factory(),
            'categoria_id' => CategoriaServico::inRandomOrder()->first()->id ?? CategoriaServico::factory(),
            'descricao' => $this->faker->text(200),
            'data_servico' => $this->faker->date(),
            'valor' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}