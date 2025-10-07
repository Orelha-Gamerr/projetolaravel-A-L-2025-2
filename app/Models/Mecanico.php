<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    use HasFactory;
    protected $table = 'mecanicos';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'categoria_id',
    ];

    public function categorias()
    {
        return $this->belongsToMany(CategoriaServico::class, 'categoria_mecanico');
    }

}