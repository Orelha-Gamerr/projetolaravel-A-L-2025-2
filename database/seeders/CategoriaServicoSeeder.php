<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaServico;

class CategoriaServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'MOTOR',
            'CÂMBIO',
            'ILUMINAÇÃO',
            'ESCAPAMENTO',
            'SUSPENSÃO',
            'FREIOS',
            'DIREÇÃO',
        ];

        foreach ($categorias as $nome) {
            CategoriaServico::create(['nome' => $nome]);
        }

    }
}