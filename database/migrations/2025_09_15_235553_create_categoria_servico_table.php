<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('categoria_servico', function (Blueprint $table) {
        $table->id(); // Cria coluna "id"
        $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
        $table->foreignId('servico_id')->constrained()->onDelete('cascade');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_servico');
    }
};
