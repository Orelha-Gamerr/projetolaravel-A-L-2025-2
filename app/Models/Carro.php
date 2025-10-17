<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
    
    protected $table = 'carros';

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'ano',
        'renavam',
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}