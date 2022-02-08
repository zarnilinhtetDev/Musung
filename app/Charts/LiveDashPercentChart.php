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
        $time = DB::select('SELECT SUM("time".div_actual_target) AS total_actual_target FROM time JOIN line_assign ON "line_assign".l_id = "time".line_id AND "line_assign".assign_date= \'' . $date_string . '\' GROUP BY "time".line_id ORDER BY "time".line_id ASC');

        $arr_decode = json_decode(json_encode($time), true);

        $arr = [];
        for ($i = 0; $i < count($arr_decode); $i++) {
            $total_actual_target = $arr_decode[$i]['total_actual_target'];
            $arr[] = $total_actual_target;
        }

        return $this->percent_chart->horizontalBarChart()
            ->setTitle('Target and Actual Target')
            // ->setSubtitle('Wins during season 2021.')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Actual Target', $arr)
            ->addData('Target', $line_assign)
            ->setXAxis($line);
    }
}
