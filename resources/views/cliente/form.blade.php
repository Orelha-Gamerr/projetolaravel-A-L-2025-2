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

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-user-gear me-2"></i>Formulário de Cliente
        </h2>
        <a href="{{ url('cliente')}}" class="btn btn-outline-primary">
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
                    
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email:</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $dado->email ?? '')  }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="endereco" class="form-label fw-semibold">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco', $dado->endereco ?? '')  }}" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save me-1"></i>{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                            </button>
                            <a href="{{ url('cliente')}}" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@stop