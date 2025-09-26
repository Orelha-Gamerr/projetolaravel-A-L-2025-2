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

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-car-side me-2"></i>Formulário de Carro
        </h2>
        <a href="{{ url('carro')}}" class="btn btn-outline-primary">
            <i class="fa-solid fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <!-- Formulário -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ $action }}" method="post">
                @csrf

                @if (!empty($dado->id))
                    @method('put')
                @endif 

                <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '' ) }}">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="placa" class="form-label fw-semibold">Placa:</label>
                        <input type="text" id="placa" name="placa" class="form-control" value="{{ old('placa', $dado->placa ?? '' ) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="marca" class="form-label fw-semibold">Marca:</label>
                        <input type="text" id="marca" name="marca" class="form-control" value="{{ old('marca', $dado->marca ?? '')  }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" value="{{ old('modelo', $dado->modelo ?? '')  }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="ano" class="form-label fw-semibold">Ano:</label>
                        <input type="text" id="ano" name="ano" class="form-control" value="{{ old('ano', $dado->ano ?? '')  }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="renavam" class="form-label fw-semibold">Renavam:</label>
                        <input type="text" id="renavam" name="renavam" class="form-control" value="{{ old('renavam', $dado->renavam ?? '')  }}" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save me-1"></i>{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                            </button>
                            <a href="{{ url('carro')}}" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@stop