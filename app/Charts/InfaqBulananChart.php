<?php

namespace App\Charts;

use App\Models\Infaq;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InfaqBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalInfaq = Infaq::userMasjid()->whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('jumlah');
            $dataBulan[] = ubahAngkaToBulan($i);
            // $dataBulan[] = Carbon::create()->month($i)->format('F'); // atau bisa menggunakan seperti ini 
            $dataTotalInfaq[] = $totalInfaq;
        }

        return $this->chart->lineChart()
            ->setTitle('Data Infaq Bulanan')
            ->setSubtitle('Total Penerimaan Infaq Setiap Bulan')
            ->addData('Total Infaq', $dataTotalInfaq)
            ->setHeight(278)
            ->setXAxis($dataBulan);
    }
}
