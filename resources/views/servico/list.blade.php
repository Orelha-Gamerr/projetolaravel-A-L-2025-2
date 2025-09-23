@extends('base')
@section('titulo', 'Listagem de Serviço')
@section('conteudo')

    <h3>Listagem de Serviço</h3>
    <a href="{{ url('')}}" class="btn btn-primary"><i class="fa-solid fa-house"></i> Tela inicial</a>

    <div class="row">
        <div class="col">
            <form action="{{ route('servico.search')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" class="form-select">
                            <option value="cliente">Cliente</option>
                            <option value="telefone">Telefone</option>
                            <option value="placa">Veiculo</option>
                            <option value="categoria">Categoria</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="valor">Valor:</label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-warning" href="{{ url('servico/create')}}"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                    </div>
                </div>
            </form>
            
        </div>

        
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <td>#ID</td>
                <td>Cliente</td>
                <td>Telefone</td>
                <td>Data</td>
                <td>Veiculo</td>
                <td>Categoria</td>
                <td>Descrição</td>
                <td>Preço</td>
                <td>Ação</td>
                <td>Ação</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dado as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{ $item->cliente->nome ?? '' }}</td>
                    <td>{{ $item->cliente->telefone ?? '' }}</td>
                    <td>{{ $item->data_servico ? $item->data_servico->format('d/m/Y') : '' }}</td>
                    <td>{{ $item->carro->placa ?? '' }}</td>
                    <td>{{ $item->categoria->nome ?? '' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#descricaoModal{{ $item->id }}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <div class="modal fade" id="descricaoModal{{ $item->id }}" tabindex="-1" aria-labelledby="descricaoLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="descricaoLabel{{ $item->id }}">Descrição do Serviço {{ $item->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
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

                    <td>{{ $item->valor ?? '' }}</td>
                    <td> <a class="btn btn-sm btn-primary" href="{{ route('servico.edit', $item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td>
                        <form action="{{ route('servico.destroy',$item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o registro?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

@stop