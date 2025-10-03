<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servico;
use App\Models\CategoriaServico;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria até 7 categorias diferentes (da sua lista)
        $categorias = CategoriaServico::factory()->count(7)->create();

        // Cria 10 serviços e associa 2-3 categorias para cada
        Servico::factory()->count(10)->create()->each(function ($servico) use ($categorias) {
            $ids = $categorias->random(rand(2, 3))->pluck('id');
            $servico->categorias()->attach($ids);
        });
    }

}