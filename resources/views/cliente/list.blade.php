@extends('base')
@section('titulo', 'Listagem de Clientes')
@section('conteudo')

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fa-solid fa-user-gear me-2"></i>Listagem de Clientes
        </h2>
        <a href="{{ url('')}}" class="btn btn-outline-primary">
            <i class="fa-solid fa-house me-1"></i> Tela Inicial
        </a>
    </div>

    <!-- Filtro de busca -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('cliente.search')}}" method="post">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="tipo" class="form-label fw-semibold">Tipo:</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="telefone">Telefone</option>
                            <option value="email">Email</option>
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
                        <a class="btn btn-warning" href="{{ url('cliente/create')}}">
                            <i class="fa-solid fa-plus me-1"></i> Cadastrar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabela de clientes -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th>Carros</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dado as $item)
                            <!-- Linha principal clicável -->
                            <tr class="accordion-toggle cursor-pointer {{ $highlightId == $item->id ? 'table-warning' : '' }}"
                                data-bs-toggle="collapse" 
                                data-bs-target="#carros-{{$item->id}}" 
                                aria-expanded="false" 
                                aria-controls="carros-{{$item->id}}"
                                style="cursor: pointer;">
                                <td><span class="badge bg-secondary">{{$item->id}}</span></td>
                                <td class="fw-semibold">{{$item->nome}}</td>
                                <td>{{$item->cpf}}</td>
                                <td>{{$item->telefone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->endereco}}</td>
                                <td>
                                    @if($item->carros->count() > 0)
                                        <span class="badge bg-info">
                                            {{ $item->carros->count() }} carro(s)
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" href="{{ route('cliente.edit', $item->id) }}" onclick="event.stopPropagation()">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('cliente.destroy',$item->id) }}" method="post" onclick="event.stopPropagation()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o registro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                            <!-- Linha do accordion para os carros -->
                            @if($item->carros->count() > 0)
                                <tr class="accordion-row">
                                    <td colspan="9" class="p-0 border-0">
                                        <div class="collapse" id="carros-{{$item->id}}">
                                            <div class="card card-body border-0 bg-light m-2">
                                                <h6 class="fw-bold mb-3">
                                                    <i class="fa-solid fa-car me-2"></i>
                                                    Carros do Cliente: {{ $item->nome }}
                                                    <span class="badge bg-primary ms-2">{{ $item->carros->count() }}</span>
                                                </h6>
                                                <div class="row">
                                                    @foreach($item->carros as $carro)
                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                            <div class="card h-100">
                                                                <div class="card-header py-2 bg-dark text-white">
                                                                    <small class="fw-bold">
                                                                        <i class="fa-solid fa-car-side me-1"></i>
                                                                        {{ $carro->marca }} {{ $carro->modelo }}
                                                                    </small>
                                                                </div>
                                                                <div class="card-body py-2">
                                                                    <small class="text-muted d-block">
                                                                        <i class="fa-solid fa-id-card me-1"></i>
                                                                        <strong>Placa:</strong> {{ $carro->placa }}
                                                                    </small>
                                                                    @if(isset($carro->cor))
                                                                        <small class="text-muted d-block">
                                                                            <i class="fa-solid fa-palette me-1"></i>
                                                                            <strong>Cor:</strong> {{ $carro->cor }}
                                                                        </small>
                                                                    @endif
                                                                    @if(isset($carro->ano))
                                                                        <small class="text-muted d-block">
                                                                            <i class="fa-solid fa-calendar me-1"></i>
                                                                            <strong>Ano:</strong> {{ $carro->ano }}
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
.accordion-toggle:hover {
    background-color: #f8f9fa !important;
}
.cursor-pointer {
    cursor: pointer;
}
</style>

@stop