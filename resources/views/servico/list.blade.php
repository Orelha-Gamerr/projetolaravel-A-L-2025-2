@extends('base')
@section('titulo', 'Listagem de Serviço')
@section('conteudo')

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-list-check"></i> Listagem de Serviços</h2>
        <a href="{{ url('')}}" class="btn btn-outline-primary">
            <i class="fa-solid fa-house"></i> Tela Inicial
        </a>
    </div>

    <!-- Filtro de busca -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('servico.search')}}" method="post" class="row g-3 align-items-end">
                @csrf

                <div class="col-md-3">
                    <label for="tipo" class="form-label fw-semibold">Tipo:</label>
                    <select name="tipo" class="form-select">
                        <option value="cliente">Cliente</option>
                        <option value="telefone">Telefone</option>
                        <option value="placa">Placa</option>
                        <option value="categoria">Categoria</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="valor" class="form-label fw-semibold">Valor:</label>
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Pesquisar...">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-success" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>

                <div class="col-md-2 d-grid">
                    <a class="btn btn-warning" href="{{ url('servico/create')}}">
                        <i class="fa-solid fa-plus"></i> Cadastrar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabela de serviços -->
    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Data</th>
                    <th>Veículo</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dado as $item)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $item->id }}</span></td>
                        <td>{{ $item->cliente->nome ?? '-' }}</td>
                        <td>{{ $item->cliente->telefone ?? '-' }}</td>
                        <td>{{ $item->data_servico ? $item->data_servico->format('d/m/Y') : '-' }}</td>
                        <td>{{ $item->carro->placa ?? '-' }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->categoria->nome ?? '-' }}</span></td>
                        
                        <!-- Botão de descrição -->
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#descricaoModal{{ $item->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="descricaoModal{{ $item->id }}" tabindex="-1" aria-labelledby="descricaoLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title" id="descricaoLabel{{ $item->id }}">
                                                Descrição do Serviço #{{ $item->id }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->descricao ?? 'Sem descrição' }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>R$ {{ number_format((float) ($item->valor ?? 0), 2, ',', '.') }}</td>

                        <!-- Editar -->
                        <td class="text-center">
                            <a class="btn btn-sm btn-primary" href="{{ route('servico.edit', $item->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>

                        <!-- Excluir -->
                        <td class="text-center">
                            <form action="{{ route('servico.destroy',$item->id) }}" method="post">
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

@stop
