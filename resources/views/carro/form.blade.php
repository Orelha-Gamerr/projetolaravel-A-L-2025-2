@extends('base')
@section('titulo', 'Formulário de Carro')
@section('conteudo')

    @php
        if (!empty($dado)) {
            $action = route('carro.update', $dado->id);
        }else {
            $action = route('carro.store');
        }
    @endphp

    <h3>Formulário de Carro</h3>
    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif 

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '' ) }}">

        <div class="row">
            <div class="col">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" value="{{ old('placa', $dado->placa ?? '' ) }}" required>
            </div>
            <div class="col">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="{{ old('marca', $dado->marca ?? '')  }}" required>
            </div>
            <div class="col">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="{{ old('modelo', $dado->modelo ?? '')  }}" required>
            </div>
            <div class="col">
                <label for="ano">Ano:</label>
                <input type="text" id="ano" name="ano" value="{{ old('ano', $dado->ano ?? '')  }}" required>
            </div>
            <div class="col">
                <label for="renavam">Renavam: </label>
                <input type="text" id="renavam" name="renavam" value="{{ old('renavam', $dado->renavam ?? '')  }}" required>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                    <a href="{{ url('carro')}}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </form>

@stop