<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use DB;

class KasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($dataPenerimaan, $dataPengeluaran, $tahun): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Grafik Penerimaan dan Pengeluaran Tahun '.$tahun)
            ->setSubtitle('Penerimaan & Pengeluaran')
            ->addData('Penerimaan', $dataPenerimaan)
            ->addData('Pengeluaran', $dataPengeluaran)
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
