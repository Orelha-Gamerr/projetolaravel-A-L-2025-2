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

    public function categoria()
    {
        return $this->belongsTo(CategoriaServico::class, 'categoria_id');
    }
}