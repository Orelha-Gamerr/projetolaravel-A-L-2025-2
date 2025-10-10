<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mecanico;
use App\Models\CategoriaServico;

class MecanicoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = CategoriaServico::all()->pluck('id')->toArray();

        Mecanico::factory()
            ->count(3)
            ->create()
            ->each(function ($mecanico) use ($categorias) {
                $mecanico->categorias()->sync(
                    collect($categorias)->random(rand(1, 3))->toArray()
                );
            });
    }
}
