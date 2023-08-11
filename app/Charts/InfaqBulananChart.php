<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class InfaqBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Data Infaq Bulanan')
            ->setSubtitle('Total Penerimaan Infaq Setiap Bulan')
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setHeight(278)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
