@extends('base')
@section('titulo', 'Relatório de Serviços Mensal')
@section('conteudo')

<div class="container mt-4">
    <h2 class="mb-4"><i class="fa-solid fa-chart-line me-2"></i>Relatório de Serviços Mensal</h2>

    <!-- Filtro -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('relatorio.servicos') }}" method="get" class="row g-3">
                 <div class="col-md-3">
                    <label for="ano" class="form-label">Ano:</label>
                    <input type="number" name="ano" class="form-control" value="{{ $ano }}">
                </div>
                <div class="col-md-4">
                    <label for="cliente_id" class="form-label">Cliente:</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid align-self-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <canvas id="servicosChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('servicosChart').getContext('2d');
    const servicosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Total de Serviços (R$)',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR', {minimumFractionDigits: 2});
                        }
                    }
                }
            }
        }
    });
</script>

@stop
