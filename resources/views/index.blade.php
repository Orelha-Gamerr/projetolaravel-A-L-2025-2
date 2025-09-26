@extends('base')
@section('titulo', 'Tela Inicial')
@section('conteudo')

<div class="container mt-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark"><i class="fa-solid fa-warehouse"></i> Oficina Mecânica</h1>
        <p class="text-muted">Sistema de gerenciamento de serviços, clientes e veículos.</p>
    </div>

    <!-- Cards de Ações -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="fa-solid fa-screwdriver-wrench fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Serviços</h5>
                    <p class="card-text text-muted">Orçamentos, reparos e manutenções.</p>
                    <a href="{{ url('servico')}}" class="btn btn-primary">  <!-- route serviço -->
                        <i class="fa-solid fa-plus"></i> Novo Serviço  
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="fa-solid fa-user-gear fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text text-muted">Cadastre e acompanhe seus clientes.</p>
                    <a href="{{ url('cliente')}}" class="btn btn-warning">  <!-- route cliente -->
                        <i class="fa-solid fa-user-plus"></i> Novo Cliente
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="fa-solid fa-car-side fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Carros</h5>
                    <p class="card-text text-muted">Gerencie a frota de veículos dos clientes.</p>
                    <a href="{{ url('carro')}}" class="btn btn-danger"> <!-- route carro -->
                        <i class="fa-solid fa-car"></i> Novo Carro
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@stop
