<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\CategoriaServico;
use App\Models\Carro;
use Illuminate\Database\Eloquent\Factories\Factory;


class ServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? Cliente::factory(),
            'carro_id' => Carro::inRandomOrder()->first()->id ?? Carro::factory(),
            'descricao' => $this->faker->text(200),
            'data_servico' => $this->faker->dateTimeBetween('2021-01-01', '2025-12-31')->format('Y-m-d'),
            'valor' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}