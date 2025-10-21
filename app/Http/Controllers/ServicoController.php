<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\CategoriaServico;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Carro;
use App\Charts\ServicoChart;


class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dado = Servico::with(['cliente', 'carro', 'categorias'])->get();

        return view('servico.list', ['dado' => $dado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaServico::orderBy('nome')->get();
        $carro = Carro::orderBy('nome')->get();
        $clientes = Cliente::all(); // pega todos os clientes
        


        return view('servico.form', [
            'categorias' => $categorias,
            'carro' => $carro,
            'cliente' => $clientes, // aqui definimos a variável para a view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    private function validateRequest(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'carro_id' => 'required',
            'categoria_id' => 'required|array',
            'categoria_id.*' => 'exists:categoria_servicos,id',
        ], [
            'cliente_id.required' => 'O cliente é obrigatório',
            'carro_id.required' => 'O carro é obrigatório',
            'categoria_id.required' => 'A categoria é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $servico = Servico::create($request->only([
            'cliente_id',
            'carro_id',
            'descricao',
            'data_servico',
            'valor'
        ]));

        // associa múltiplas categorias
        $servico->categorias()->sync($request->categoria_id);

        return redirect()->route('servico.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dado = Servico::findOrFail($id);
        $clientes = Cliente::all();
        $carros = Carro::all();
        $categorias = CategoriaServico::orderBy('nome')->get();

        return view('servico.form', [
            'dado' => $dado,
            'cliente' => $clientes,
            'carro' => $carros,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $data = $request->except('categoria_id');
        $servico = Servico::findOrFail($id);
        $servico->update($data);

        $servico->categorias()->sync($request->categoria_id);

        return redirect()->route('servico.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dado = Servico::findOrFail($id);

        $dado->delete();

        return redirect()->route('servico.index');
    }

    public function search(Request $request)
    {
        $tipo = $request->input('tipo');
        $valor = $request->input('valor');

        $query = Servico::query();

        if (!empty($valor)) {
            switch ($tipo) {
                case 'cliente':
                    $query->whereHas('cliente', function ($q) use ($valor) {
                        $q->where('nome', 'like', "%{$valor}%");
                    });
                    break;

                case 'telefone':
                    $query->whereHas('cliente', function ($q) use ($valor) {
                        $q->where('telefone', 'like', "%{$valor}%");
                    });
                    break;

                case 'placa':
                    $query->whereHas('carro', function ($q) use ($valor) {
                        $q->where('placa', 'like', "%{$valor}%");
                    });
                    break;

                case 'categoria':
                    $query->whereHas('categorias', function ($q) use ($valor) {
                        $q->where('nome', 'like', "%{$valor}%");
                    });
                    break;
            }
        }

        $dado = Servico::with(['cliente', 'carro', 'categorias'])->get();

        return view('servico.list', [
        'dado' => $dado,
        'tipo' => $tipo,
        'valor' => $valor
    ]);
    }

    public function chart(ServicoChart $chart, Request $request)
    {
        $ano = $request->input('ano', date('Y')); // padrão: ano atual
        return view('servico.chart', ['chart' => $chart->build($ano), 'anoSelecionado' => $ano]);
    }
}