<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaServico;

class CategoriaServicoSeeder extends Seeder
{
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

        foreach ($categorias as $categoria) {
            CategoriaServico::firstOrCreate(['nome' => $categoria]);
        }
    }
}
