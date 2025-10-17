<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dado = Cliente::with('carros')->get();

        $highlightId = $request->query('id');

        return view('cliente.list', [
            'dado' => $dado,
            'highlightId' => $highlightId,
        ]);
    }

    public function create()
    {
        return view('cliente.form');
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
            'email' => 'required',
            'endereco' => 'required',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório',
            'telefone.required' => 'O telefone é obrigatório',
            'email.required' => 'O email é obrigatório',
            'endereco.required' => 'O endereço é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Cliente::create($data);

        return redirect()->route('cliente.index');
    }

    public function edit(string $id)
    {
        $dado = Cliente::findOrFail($id);

        return view('cliente.form', [
            'dado' => $dado
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Cliente::updateOrCreate(['id' => $id], $data);

        return redirect('cliente');
    }

    public function destroy(string $id)
    {
        $dado = Cliente::findOrFail($id);
        $dado->delete();

        return redirect('cliente');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dado = Cliente::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dado = Cliente::all();
        }

        return view('cliente.list', ['dado' => $dado]);
    }
}
