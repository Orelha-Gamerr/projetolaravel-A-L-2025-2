<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mecanicos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']); // se houver FK
            $table->dropColumn('categoria_id');
        });
    }

    public function down(): void
    {
        Schema::table('mecanicos', function (Blueprint $table) {
            $table->foreignId('categoria_id')->nullable()->constrained('categoria_servicos');
        });
    }
};
