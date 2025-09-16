@extends('base')
@section('titulo', 'Formulário de Serviço')
@section('conteudo')

    @php
        if (!empty($dado)) {
            $action = route('servico.update', $dado->id);
        }else {
            $action = route('servico.store');
        }
    @endphp

    <h3>Formulário de Serviço</h3>
    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif 

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '' ) }}">

        <div class="row">
            <div class="col">
                <label for="cliente">Cliente:</label>
                {{-- 
                <select name="cliente_id">
                    @foreach ($cliente as $item)
                        <option value="{{ $item->id }}"
                            {{ old('cliente_id', $dado->cliente_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }} 
                        </option>
                    @endforeach
                </select>
                 --}}
            </div>
            <div class="col">
                <label for="cpf">Cpf:</label>
                {{-- Mostrar cpf do cliente selecionado --}}
            </div>
            <div class="col">
                <label for="telefone">Telefone:</label>
                {{-- Mostrar telefone do cliente selecionado --}}
            </div>

            <div class="col">
                <label for="categoria">Categoria do serviço</label>
                <select name="categoria_id">
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}"
                            {{ old('categoria_id', $dado->categoria_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }} 
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                    <a href="{{ url('servico')}}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </form>

@stop