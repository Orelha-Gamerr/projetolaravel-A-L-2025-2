<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .header {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: right;
            font-size: 12px;
            margin-top: 30px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }
        .info {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Título do Documento -->
    <h1>{{ $titulo }}</h1>

    <!-- Dados do Cliente e Serviço -->
    <div class="header">
        <p class="info"><strong>Cliente:</strong> {{ $servico->cliente->nome }}</p>
        <p class="info"><strong>Telefone:</strong> {{ $servico->cliente->telefone }}</p>
        <p class="info"><strong>Veículo:</strong> {{ $servico->carro->placa }}</p>
        <p class="info"><strong>Data do Serviço:</strong> {{ \Carbon\Carbon::parse($servico->data_servico)->format('d/m/Y') }}</p>
    </div>

    <!-- Tabela com os Detalhes do Serviço -->
    <table>
        <tr>
            <th>Categoria</th>
            <td>
                @foreach ($servico->categorias as $categoria)
                    {{ $categoria->nome }} @if(!$loop->last), @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>{{ $servico->descricao }}</td>
        </tr>
        <tr>
            <th>Preço</th>
            <td>R$ {{ number_format($servico->valor, 2, ',', '.') }}</td>
        </tr>
    </table>

    <!-- Observações (caso tenha) -->
    <div class="footer">
        <p class="section-title">Observações:</p>
        <p>{{ $servico->observacoes ?? 'Nenhuma observação.' }}</p>
    </div>

</body>
</html>
