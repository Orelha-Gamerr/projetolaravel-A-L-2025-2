<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categoria_servico', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                ->constrained('categoria_servicos') // tabela certa de categorias
                ->onDelete('cascade');

            $table->foreignId('servico_id')
                ->constrained('servicos') // tabela certa de serviços
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_servico');
    }
};
