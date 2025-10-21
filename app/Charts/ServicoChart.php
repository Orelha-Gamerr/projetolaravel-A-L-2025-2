<?php

namespace App\Charts;

use App\Models\Servico;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ServicoChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($ano = 2025): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $servicos = Servico::selectRaw('strftime("%m", data_servico) as mes, SUM(valor) as total')
            ->whereYear('data_servico', $ano)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = [
            '01' => 'Jan', '02' => 'Fev', '03' => 'Mar', '04' => 'Abr',
            '05' => 'Mai', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
            '09' => 'Set', '10' => 'Out', '11' => 'Nov', '12' => 'Dez'
        ];

        // Criar arrays completos para todos os meses
        $labelsCompletos = [];
        $valoresCompletos = [];

        foreach ($meses as $numeroMes => $nomeMes) {
            $labelsCompletos[] = $nomeMes;
            
            // Buscar o valor correspondente ao mês, ou 0 se não existir
            $servicoMes = $servicos->firstWhere('mes', $numeroMes);
            $valoresCompletos[] = $servicoMes ? (float)$servicoMes->total : 0;
        }

        return $this->chart->barChart()
            ->setTitle("Relatório de Serviços - Ano {$ano}")
            ->setSubtitle('Total de serviços por mês')
            ->addData('Total (R$)', $valoresCompletos)
            ->setXAxis($labelsCompletos);
    }
}