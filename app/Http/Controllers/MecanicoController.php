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
        $dado = Mecanico::all();

        return view('mecanico.list', ['dado' => $dado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaServico::all();

        return view('mecanico.form', [
            'categorias' => $categorias
        ]);
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
            'categoria_id' => 'required',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório',
            'telefone.required' => 'O telefone é obrigatório',
            'categoria_id.required' => 'A categoria é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $mecanico = Mecanico::create($request->except('categoria_id'));

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dado = Mecanico::findOrFail($id);
        $categorias = CategoriaServico::all();

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
        $data = $request->all();

        Mecanico::updateOrCreate(['id' => $id], $data);

        return redirect('mecanico');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dado = Mecanico::findOrFail($id);
        $dado->delete();

        return redirect('mecanico');
    }

    /**
     * Search mecanic.
     */
    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dado = Mecanico::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dado = Mecanico::all();
        }

        return view('mecanico.list', ['dado' => $dado]);
    }
}
