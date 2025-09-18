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

        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('servico')}}" class="btn btn-primary">Voltar</a>
            </div>
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

@stop
