<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>{{ $titulo }}</title>
  <style> /* seu css aqui */ </style>
</head>
<body>
  <h1>{{ $titulo }}</h1>

  @if($servicos->isEmpty())
    <p>Nenhum serviço encontrado para o ano {{ $ano }}.</p>
  @else
    @foreach($servicos as $servico)
      <div style="margin-bottom:18px;">
        <p><strong>Cliente:</strong> {{ $servico->cliente->nome ?? '-' }} — <strong>Telefone:</strong> {{ $servico->cliente->telefone ?? '-' }}</p>
        <p><strong>Veículo:</strong> {{ $servico->carro->placa ?? '-' }} — <strong>Data:</strong> {{ \Carbon\Carbon::parse($servico->data_servico)->format('d/m/Y') }}</p>

        <p><strong>Categorias:</strong>
        @if($servico->categorias->isEmpty())
          Nenhuma categoria.
        @else
          @foreach($servico->categorias as $categoria)
            {{ $categoria->nome }}@if(!$loop->last), @endif
          @endforeach
        @endif
        </p>

        <p><strong>Descrição:</strong> {{ $servico->descricao }}</p>
        <p><strong>Valor:</strong> R$ {{ number_format($servico->valor, 2, ',', '.') }}</p>

        <hr>
      </div>
    @endforeach
  @endif
</body>
</html>
