<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaServico extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'categoria_servico');
    }
}