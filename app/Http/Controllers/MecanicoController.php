<?php

namespace App\Http\Controllers;

use App\Models\Mecanico;
use Illuminate\Http\Request;
use App\Models\CategoriaServico;

class MecanicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dado = Mecanico::with('categorias')->get();

        return view('mecanico.list', ['dado' => $dado]);
    }


    public function create()
    {
        $categorias = CategoriaServico::orderBy('nome')->get();
        return view('mecanico.form', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'categoria_id' => 'required|array',
            'categoria_id.*' => 'exists:categoria_servicos,id',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório',
            'telefone.required' => 'O telefone é obrigatório',
            'categoria_id.required' => 'A categoria é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $mecanico = Mecanico::create($request->only(['nome', 'cpf', 'telefone']));

        if ($request->has('categoria_id')) {
            $mecanico->categorias()->sync($request->categoria_id);
        }

        return redirect()->route('mecanico.index')->with('success', 'Mecânico cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $dado = Mecanico::with('categorias')->findOrFail($id);
        $categorias = CategoriaServico::orderBy('nome')->get();

        return view('mecanico.form', [
            'dado' => $dado,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $mecanico = Mecanico::findOrFail($id);
        $mecanico->update($request->only(['nome', 'cpf', 'telefone']));

        if ($request->has('categoria_id')) {
            $mecanico->categorias()->sync($request->categoria_id);
        }

        return redirect()->route('mecanico.index')->with('success', 'Mecânico atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mecanico = Mecanico::findOrFail($id);
        $mecanico->categorias()->detach(); // remove vínculo com categorias
        $mecanico->delete();

        return redirect()->route('mecanico.index')->with('success', 'Mecânico removido com sucesso!');
    }

    public function search(Request $request)
    {
        $query = Mecanico::query();

        if (!empty($request->valor)) {
            switch ($request->tipo) {
                case 'nome':
                case 'cpf':
                case 'telefone':
                    $query->where($request->tipo, 'like', "%{$request->valor}%");
                    break;

                case 'categoria':
                    $query->whereHas('categorias', function ($q) use ($request) {
                        $q->where('nome', 'like', "%{$request->valor}%");
                    });
                    break;
            }
        }

        $dado = $query->with('categorias')->get();

        return view('mecanico.list', [
            'dado' => $dado,
            'tipo' => $request->tipo,
            'valor' => $request->valor
        ]);
    }
}