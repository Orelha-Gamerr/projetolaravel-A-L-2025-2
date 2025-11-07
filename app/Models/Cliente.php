<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco'
    ];

    public function carros()
    {
        return $this->hasMany(Carro::class, 'cliente_id');
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'cliente_id');
    }
}