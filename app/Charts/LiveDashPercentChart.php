<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Line;
use App\Models\Time;
use Illuminate\Support\Facades\DB;
use App\Models\LineAssign;

class LiveDashPercentChart
{
    protected $percent_chart;

    public function __construct(LarapexChart $percent_chart)
    {
        $this->percent_chart = $percent_chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        $date_string = date("d.m.Y");
        $line_assign = LineAssign::select('main_target')->orderBy('l_id', 'asc')->where('assign_date', $date_string)->pluck('main_target')->toArray();
        $line = Line::select('l_name')->where('a_status', 1)->orderBy('l_pos', 'asc')->pluck('l_name')->toArray();
        $time = Time::select(DB::raw('line_id,sum(div_actual_target) as total_actual_target'))->groupBy('line_id')->orderBy('line_id', 'asc')->pluck('total_actual_target')->toArray();
        return $this->percent_chart->horizontalBarChart()
            ->setTitle('Target and Actual Target')
            // ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Actual Target', $time)
            ->addData('Target', $line_assign)
            ->setXAxis($line);
        // ->groupBy('line_id')->orderBy('line_id', 'asc')
    }
}
