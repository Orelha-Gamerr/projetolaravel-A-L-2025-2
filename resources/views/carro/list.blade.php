@extends('base')
@section('titulo', 'Listagem de Carros')
@section('conteudo')

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-car-side me-2"></i>Listagem de Carros
        </h2>
        <a href="{{ url('')}}" class="btn btn-outline-primary">
            <i class="fa-solid fa-house me-1"></i> Tela Inicial
        </a>
    </div>

    <!-- Filtro de busca -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('carro.search')}}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="tipo" class="form-label fw-semibold">Tipo:</label>
                        <select name="tipo" class="form-select">
                            <option value="placa">Placa</option>
                            <option value="marca">Marca</option>
                            <option value="modelo">Modelo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="valor" class="form-label fw-semibold">Valor:</label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="Pesquisar...">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Buscar
                        </button>
                    </div>
                    <div class="col-md-2 d-grid">
                        <a class="btn btn-warning" href="{{ url('carro/create')}}">
                            <i class="fa-solid fa-plus me-1"></i> Cadastrar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabela de carros -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th>Renavam</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dado as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{$item->id}}</span></td>
                                <td class="fw-bold">{{$item->placa}}</td>
                                <td>{{$item->marca}}</td>
                                <td>{{$item->modelo}}</td>
                                <td>{{$item->ano}}</td>
                                <td>{{$item->renavam}}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" href="{{ route('carro.edit', $item->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('carro.destroy',$item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@stop