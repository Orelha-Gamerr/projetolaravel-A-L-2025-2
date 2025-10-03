@extends('base')
@section('titulo', 'Formulário de Mecanico')
@section('conteudo')

@php
    if (!empty($dado)) {
        $action = route('mecanico.update', $dado->id);
    }else {
        $action = route('mecanico.store');
    }
@endphp

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-user-gear me-2"></i>Formulário de Mecânico
        </h2>
        <a href="{{ url('mecanico')}}" class="btn btn-outline-primary">
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
                        <label for="nome" class="form-label fw-semibold">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', $dado->nome ?? '' ) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefone" class="form-label fw-semibold">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone', $dado->telefone ?? '')  }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cpf" class="form-label fw-semibold">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf', $dado->cpf ?? '')  }}" required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Especializações de serviços</label>
                    <div class="form-check">
                        @foreach ($categorias as $item)
                            <div class="form-check">
                                <input 
                                type="checkbox" 
                                    name="categoria_id[]" 
                                    value="{{ $item->id }}" 
                                    class="form-check-input"
                                    {{ in_array($item->id, old('categoria_id', isset($dado) ? (array) $dado->categoria_id : [])) ? 'checked' : '' }}
                                >
                                <label class="form-check-label">
                                    {{ $item->nome }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save me-1"></i>{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                            </button>
                            <a href="{{ url('mecanico')}}" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@stop