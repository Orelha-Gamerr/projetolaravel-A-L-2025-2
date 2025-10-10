<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf', 'telefone'];

    public function categorias()
    {
        return $this->belongsToMany(
            CategoriaServico::class,
            'categoria_mecanico', 
            'mecanico_id',       
            'categoria_id'       
        );
    }

}

