@extends('base')

@section('titulo', 'Gráfico de Serviços')

@section('conteudo')
<div class="container mt-4">
    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-chart-line"></i> Gráfico de Serviços</h2>
        <div>
            <a href="{{ url('servico') }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-rotate-left"></i> Voltar
            </a>
        </div>
    </div>

    <!-- Filtro por Ano -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('servico.chart') }}" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="ano" class="col-form-label fw-bold">Selecione o Ano:</label>
                </div>
                <div class="col-auto">
                    <select name="ano" id="ano" class="form-select" onchange="this.form.submit()">
                        @for($i = 2021; $i <= 2025; $i++)
                            <option value="{{ $i }}" {{ ($anoSelecionado ?? date('Y')) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if(isset($chart) && $chart)
                {!! $chart->container() !!}
            @else
                <div class="text-center py-4">
                    <i class="fa-solid fa-chart-line fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Nenhum dado disponível para o período selecionado.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@if(isset($chart) && $chart)
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endif

<style>
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-bottom: 2px solid #f8f9fa;
        border-radius: 10px 10px 0 0 !important;
    }
    .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
</style>
@stop