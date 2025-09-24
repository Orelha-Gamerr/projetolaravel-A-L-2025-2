@extends('base')
@section('titulo', 'Formulário de Cliente')
@section('conteudo')

    @php
        if (!empty($dado)) {
            $action = route('cliente.update', $dado->id);
        }else {
            $action = route('cliente.store');
        }
    @endphp

    <h3>Formulário de Cliente</h3>
    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif 

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '' ) }}">

        <div class="row">
            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome', $dado->nome ?? '' ) }}" required>
            </div>
            <div class="col">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $dado->telefone ?? '')  }}" required>
            </div>
            <div class="col">
                <label for="cpf">Cpf:</label>
                <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $dado->cpf ?? '')  }}" required>
            </div>
        </div>
            
        <div class="row mt-4">
            <div class="col">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ old('email', $dado->email ?? '')  }}" required>
            </div>
            <div class="col">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $dado->endereco ?? '')  }}" required>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('cliente')}}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>

@stop