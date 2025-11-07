<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        $cliente = Cliente::create($request->except('foto'));

        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid().'.'.$arquivo->extension();
            $arquivo->move(storage_path('app/public/cliente'), $nomeArquivo);
            $cliente->foto = $nomeArquivo;
            $cliente->save();
        }

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
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->except('foto'));

        if ($request->hasFile('foto')) {
            if (!empty($cliente->foto) && file_exists(storage_path('app/public/cliente/'.$cliente->foto))) {
                unlink(storage_path('app/public/cliente/'.$cliente->foto));
            }

            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid().'.'.$arquivo->extension();
            $arquivo->move(storage_path('app/public/cliente'), $nomeArquivo);

            $cliente->foto = $nomeArquivo;
            $cliente->save();
        }

        return redirect()->route('cliente.index')->with('success', 'Carro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $cliente = Cliente::with(['carros', 'servicos'])->findOrFail($id);

            foreach ($cliente->servicos as $servico) {
                $servico->delete();
            }

            foreach ($cliente->carros as $carro) {
                if (!empty($carro->foto) && Storage::disk('public')->exists('carro/' . $carro->foto)) {
                    Storage::disk('public')->delete('carro/' . $carro->foto);
                }
                $carro->delete();
            }

            if (!empty($cliente->foto) && Storage::disk('public')->exists('cliente/' . $cliente->foto)) {
                Storage::disk('public')->delete('cliente/' . $cliente->foto);
            }

            $cliente->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Cliente excluído com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao excluir cliente: ' . $e->getMessage());
        }
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
