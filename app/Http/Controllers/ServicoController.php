<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\CategoriaServico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dado = Servico::All();

        return view('servico.list', ['dado' => $dado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaServico::orderBy('nome')->get();

        return view('servico.form', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    private function validateRequest(Request $request)
    {
        $request->validate([
            'cliente' => 'required',
            'categoria_id' => 'required',
        ], [
            'cliente.required' => 'O cliente é obrigatório',
            'categoria_id.required' => 'A categoria é obrigatória',
        ]);
    }
    public function store(Request $request)
    {
        //dd(vars: $request->all());

        $this->validateRequest($request);
        $data = $request->all();

        Servico::create($data);

        return redirect()->route('servico');
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
        $categorias = CategoriaServico::orderBy('nome')->get();

        return view('servico.form', [
            'dado' => $dado,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all(), $id);

        $this->validateRequest($request);
        $data = $request->all();

        Servico::updateOrCreate(['id' => $id], $data);

        return redirect('servico');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dado = Servico::findOrFail($id);

        $dado->delete();

        return redirect('servico');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dado = Servico::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dado = Servico::All();
        }

        return view('servico.list', ['dado' => $dado]);
    }
}