<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;

class GrafikChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $penerimaan = Penerimaan::get();
        $data = [
            $penerimaan->where('tanggal'->month, '01')->count(),
            $penerimaan->where('tanggal'->month, '02')->count(),
            $penerimaan->where('tanggal'->month, '03')->count(),
            $penerimaan->where('tanggal'->month, '04')->count(),
            $penerimaan->where('tanggal'->month, '05')->count(),
        ];
        $label = [
            'Januari',
            'Febuari',
            'Maret',
            'April',
            'Mei',
        ];
        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', $data)
            ->setXAxis(['January', 'February', 'March', 'April', 'May']);
    }
}
