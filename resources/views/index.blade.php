@extends('base')
@section('titulo', 'Tela Inicial')
@section('conteudo')

    <h3>Tela Inicial</h3>

    <div class="row">
        <div class="col">
            <p>Bem-vindo ao sistema de gerenciamento!</p>
            <a href="{{ url('servico')}}" class="btn btn-primary"><i class="fa-solid fa-screwdriver-wrench"></i> Cadastrar Serviço</a>
            <a href="{{ url('cliente')}}" class="btn btn-warning"><i class="fa-solid fa-user"></i> Cadastrar Cliente</a>
            <a href="{{ url('carro')}}" class="btn btn-danger"><i class="fa-solid fa-car-side"></i> Cadastrar Carro</a>
        </div>
    </div>
@stop