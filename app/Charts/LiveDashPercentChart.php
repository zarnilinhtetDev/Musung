<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Line;
use App\Models\Time;
use Illuminate\Support\Facades\DB;

class LiveDashPercentChart
{
    protected $percent_chart;

    public function __construct(LarapexChart $percent_chart)
    {
        $this->percent_chart = $percent_chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        return $this->percent_chart->horizontalBarChart()
            ->setTitle('Los Angeles vs Miami.')
            ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Actual Target', [6, 9, 3, 4, 10, 8])
            ->addData('Target', [Time::select('div_target')->orderBy('line_id', 'asc')->pluck('div_target')->toArray()])
            ->setXAxis([Line::select('l_name')->where('a_status', 1)->orderBy('l_pos', 'asc')->pluck('l_name')->toArray()]);
        // ->groupBy('line_id')->orderBy('line_id', 'asc')
    }
}
