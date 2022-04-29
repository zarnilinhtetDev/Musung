<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Line;
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

        $time = DB::select('SELECT SUM("time".div_actual_target) AS total_actual_target FROM time
        JOIN line_assign ON "line_assign".l_id = "time".line_id AND "line_assign".assign_date="time".assign_date AND
        "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "time".line_id ORDER BY "time".line_id ASC');

        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) AS diff_target_percent,
        ROW_NUMBER() OVER(ORDER BY  ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) DESC) AS row_num
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY "line".l_pos ASC');

        $arr_decode = json_decode(json_encode($top_line), true);

        $arr = [];
        for ($i = 0; $i < count($arr_decode); $i++) {
            $total_actual_target = $arr_decode[$i]['diff_target_percent'];
            if ($total_actual_target == '') {
                $total_actual_target = 0;
            }
            $arr[] = $total_actual_target;
        }

        return $this->percent_chart->horizontalBarChart()
            ->addData('Output Target', $arr)
            ->setXAxis($line)
            ->setDataLabels()
            ->setGrid();
    }
}
