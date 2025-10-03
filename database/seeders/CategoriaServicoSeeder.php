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
        CategoriaServico::insert([
            ['nome' => 'MOTOR', 'nivel' => 1],
            ['nome' => 'CÂMBIO', 'nivel' => 2],
            ['nome' => 'ILUMINAÇÃO', 'nivel' => 3],
            ['nome' => 'ESCAPAMENTO', 'nivel' => 4],
            ['nome' => 'SUSPENSÃO', 'nivel' => 5],
            ['nome' => 'FREIOS', 'nivel' => 6],
            ['nome' => 'DIREÇÃO', 'nivel' => 7],
        ]);
    }
}