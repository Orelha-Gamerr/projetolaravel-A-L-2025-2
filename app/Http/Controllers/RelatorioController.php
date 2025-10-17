<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Cliente;

class RelatorioController extends Controller
{
     public function index(Request $request)
    {
        $ano = $request->ano ?? date('Y'); // Ano atual por padrão
        $cliente_id = $request->cliente_id ?? null;

        $clientes = Cliente::all();

        // Query base
        $query = Servico::selectRaw('SUM(valor) as total');

        if ($cliente_id) {
            $query->where('cliente_id', $cliente_id);
        }

        $query->whereYear('data_servico', $ano);

        $registro = $query->first();
        $total = $registro ? (float) $registro->total : 0;

        // Labels e dados para Chart.js
        $labels = [$ano];
        $data = [$total];

        return view('relatorio.servicos', compact('labels', 'data', 'clientes', 'cliente_id', 'ano'));

    }

}
