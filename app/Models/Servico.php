<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = "servicos";

    protected $fillable = [
        'cliente_id',
        'carro_id',
        'categoria_id',
        'descricao',
        'data_servico',
        'valor',
    ];

    protected $casts = [
        'data_servico' => 'date',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaServico::class, 'categoria_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function carro()
{
    return $this->belongsTo(Carro::class, 'carro_id');
}
}