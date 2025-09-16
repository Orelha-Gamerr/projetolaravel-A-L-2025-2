<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dado = Carro::all();

        return view('carro.list', ['dado' => $dado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carro.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required',
            'renavam' => 'required',
        ], [
            'placa.required' => 'A placa é obrigatória',
            'marca.required' => 'A marca é obrigatória',
            'modelo.required' => 'O modelo é obrigatório',
            'ano.required' => 'O ano é obrigatório',
            'renavam.required' => 'O renavam é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Carro::create($data);

        return redirect()->route('carro.index');
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
        $dado = Carro::findOrFail($id);

        return view('carro.form', [
            'dado' => $dado
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Carro::updateOrCreate(['id' => $id], $data);

        return redirect('carro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dado = Carro::findOrFail($id);
        $dado->delete();

        return redirect('carro');
    }

    /**
     * Search clients.
     */
    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dado = Carro::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dado = Carro::all();
        }

        return view('carro.list', ['dado' => $dado]);
    }
}
