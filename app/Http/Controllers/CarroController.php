<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarroController extends Controller
{
    public function index()
    {
        $dado = Carro::with('cliente')->get(); // já traz o nome do cliente
        return view('carro.list', compact('dado'));
    }

    public function create()
    {
        $clientes = Cliente::all(); 
        return view('carro.form', compact('clientes'));
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|numeric',
            'renavam' => 'required',
            'cliente_id' => 'required|exists:clientes,id',
        ], [
            'cliente_id.exists' => 'O cliente selecionado não existe.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $carro = Carro::create($request->except('foto'));

        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid().'.'.$arquivo->extension();
            $arquivo->move(storage_path('app/public/carros'), $nomeArquivo);
            $carro->foto = $nomeArquivo;
            $carro->save();
        }

        return redirect()->route('carro.index')->with('success', 'Carro cadastrado com sucesso!');
    }


    public function edit(string $id)
    {
        $dado = Carro::findOrFail($id);
        $clientes = Cliente::all();
        return view('carro.form', compact('dado', 'clientes'));
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $carro = Carro::findOrFail($id);
        $carro->update($request->except('foto'));

        if ($request->hasFile('foto')) {
            if (!empty($carro->foto) && file_exists(storage_path('app/public/carros/'.$carro->foto))) {
                unlink(storage_path('app/public/carros/'.$carro->foto));
            }

            $arquivo = $request->file('foto');
            $nomeArquivo = uniqid().'.'.$arquivo->extension();
            $arquivo->move(storage_path('app/public/carros'), $nomeArquivo);

            $carro->foto = $nomeArquivo;
            $carro->save();
        }

        return redirect()->route('carro.index')->with('success', 'Carro atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $carro = Carro::findOrFail($id);

        if ($carro->foto && Storage::disk('public')->exists('carro/' . $carro->foto)) {
            Storage::disk('public')->delete('carro/' . $carro->foto);
        }

        $carro->delete();

        return redirect()->back()->with('success', 'Carro excluído com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dado = Carro::where($request->tipo, 'like', "%$request->valor%")->get();
        } else {
            $dado = Carro::all();
        }

        return view('carro.list', compact('dado'));
    }
}
