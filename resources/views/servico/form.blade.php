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

<h3>Formulário de Serviço</h3>
<form action="{{ $action }}" method="post">
    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif 

    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '' ) }}">

    <div class="row">
        <div class="col">
            <label for="cliente">Cliente:</label> <br>
            <select name="cliente_id" id="cliente">
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
        <div class="col">
            <label for="cpf">Cpf:</label>
            <input type="text" id="cpf" name="cpf" class="form-control-plaintext" value="{{ old('cpf', $dado->cliente->cpf ?? '') }}" readonly>
        </div>
        <div class="col">
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control-plaintext" value="{{ old('telefone', $dado->cliente->telefone ?? '') }}" readonly>
        </div>        
    </div>

    <div class="row">
        <div class="col">
            <label for="carro">Carro:</label> <br>
            <select name="carro_id" id="carro">
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
        <div class="col">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" class="form-control-plaintext" value="{{ old('marca', $dado->carro->marca ?? '') }}" readonly>
        </div>
        <div class="col">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" class="form-control-plaintext" value="{{ old('modelo', $dado->carro->modelo ?? '') }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="categoria">Categoria do serviço</label>
            <select name="categoria_id">
                <option value="">--Selecione--</option>
                @foreach ($categorias as $item)
                    <option value="{{ $item->id }}"
                        {{ old('categoria_id', $dado->categoria_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->nome }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="descricao">Descrição do serviço:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="3" class="form-control">{{ old('descricao', $dado->descricao ?? '') }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="data_servico">Data do serviço:</label>
            <input type="date" name="data_servico" id="data_servico" class="form-control" value="{{ old('data_servico', isset($dado->data_servico) ? $dado->data_servico->format('Y-m-d') : '') }}">
        </div>
        <div class="col">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="{{ old('valor', $dado->valor ?? '') }}">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ url('servico')}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>

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
