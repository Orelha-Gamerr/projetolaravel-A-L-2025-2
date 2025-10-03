@extends('base')
@section('titulo', 'Formulário de Serviço')
@section('conteudo')

@php
    if (!empty($dado)) {
        $action = route('servico.update', $dado->id);
    } else {
        $action = route('servico.store');
    }
@endphp

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-screwdriver-wrench me-2"></i>Formulário de Serviço
        </h2>
        <a href="{{ url('servico')}}" class="btn btn-outline-primary">
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

                <!-- Seção Cliente -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="text-primary mb-3">
                            <i class="fa-solid fa-user-gear me-2"></i>Dados do Cliente
                        </h5>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cliente" class="form-label fw-semibold">Cliente:</label>
                        <select name="cliente_id" id="cliente" class="form-select">
                            <option value="">--Selecione--</option>
                            @foreach ($cliente as $item)
                                <option value="{{ $item->id }}"
                                    data-cpf="{{ $item->cpf }}"
                                    data-telefone="{{ $item->telefone }}"
                                    {{ old('cliente_id', $dado->cliente_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nome }} 
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cpf" class="form-label fw-semibold">Cpf:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control bg-light" value="{{ old('cpf', $dado->cliente->cpf ?? '') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="telefone" class="form-label fw-semibold">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control bg-light" value="{{ old('telefone', $dado->cliente->telefone ?? '') }}" readonly>
                    </div>

                    <div class="col-12">
                        <a href="{{ url('cliente/create')}}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-user-plus me-1"></i> Cliente ainda não cadastrado?
                        </a>
                    </div>
                </div>

                <!-- Seção Carro -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="text-danger mb-3">
                            <i class="fa-solid fa-car-side me-2"></i>Dados do Veículo
                        </h5>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="carro" class="form-label fw-semibold">Carro:</label>
                        <select name="carro_id" id="carro" class="form-select">
                            <option value="">--Selecione--</option>
                            @foreach ($carro as $item)
                                <option value="{{ $item->id }}"
                                    data-marca="{{ $item->marca }}"
                                    data-modelo="{{ $item->modelo }}"
                                    {{ old('carro_id', $dado->carro_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->placa }} 
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="marca" class="form-label fw-semibold">Marca:</label>
                        <input type="text" id="marca" name="marca" class="form-control bg-light" value="{{ old('marca', $dado->carro->marca ?? '') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="modelo" class="form-label fw-semibold">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" class="form-control bg-light" value="{{ old('modelo', $dado->carro->modelo ?? '') }}" readonly>
                    </div>

                    <div class="col-12">
                        <a href="{{ url('carro/create')}}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa-solid fa-car me-1"></i> Carro ainda não cadastrado?
                        </a>
                    </div>
                </div>

                <!-- Seção Serviço -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="text-warning mb-3">
                            <i class="fa-solid fa-tools me-2"></i>Dados do Serviço
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Categoria do serviço</label>
                        <div class="form-check">
                            @foreach ($categorias as $item)
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="categoria_id[]" 
                                        value="{{ $item->id }}" 
                                        class="form-check-input"
                                        @if(isset($dado) && $dado->categorias->contains($item->id))
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">
                                        {{ $item->nome }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="descricao" class="form-label fw-semibold">Descrição do serviço:</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $dado->descricao ?? '') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="data_servico" class="form-label fw-semibold">Data do serviço:</label>
                        <input type="date" name="data_servico" id="data_servico" class="form-control" value="{{ old('data_servico', isset($dado->data_servico) ? $dado->data_servico->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="valor" class="form-label fw-semibold">Valor:</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="text" name="valor" id="valor" class="form-control" value="{{ old('valor', $dado->valor ?? '') }}">
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save me-1"></i>{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
                            </button>
                            <a href="{{ url('servico')}}" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const clienteSelect = document.getElementById('cliente');
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    clienteSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        cpfInput.value = selectedOption.dataset.cpf || '';
        telefoneInput.value = selectedOption.dataset.telefone || '';
    });

    // Preencher se já tiver cliente selecionado ao carregar a página
    window.addEventListener('DOMContentLoaded', function() {
        const selectedOption = clienteSelect.options[clienteSelect.selectedIndex];
        if(selectedOption.value) {
            cpfInput.value = selectedOption.dataset.cpf || '';
            telefoneInput.value = selectedOption.dataset.telefone || '';
        }
    });
</script>

<script>
    const carroSelect = document.getElementById('carro');
    const marcaInput = document.getElementById('marca');
    const modeloInput = document.getElementById('modelo');

    carroSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        marcaInput.value = selectedOption.dataset.marca || '';
        modeloInput.value = selectedOption.dataset.modelo || '';
    });

    // Preencher se já tiver carro selecionado ao carregar a página
    window.addEventListener('DOMContentLoaded', function() {
        const selectedOption = carroSelect.options[carroSelect.selectedIndex];
        if(selectedOption.value) {
            marcaInput.value = selectedOption.dataset.marca || '';
            modeloInput.value = selectedOption.dataset.modelo || '';
        }
    });
</script>

@stop