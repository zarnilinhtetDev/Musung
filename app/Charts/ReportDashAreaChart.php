<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use DateTime;
use Illuminate\Support\Facades\DB;

class ReportDashAreaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $target = DB::select('SELECT "line_assign".assign_date,SUM("line_assign".main_target) AS t_main_target FROM line_assign
        WHERE DATE("line_assign".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "line_assign".assign_date ORDER BY "line_assign".assign_date ASC');

        $target_decode = json_decode(json_encode($target), true);
        $target_arr = [];
        for ($i = 0; $i < count($target_decode); $i++) {
            $t_main_target = $target_decode[$i]['t_main_target'];
            $target_arr[] = $t_main_target;
        }

        $date_arr = [];
        for ($k = 0; $k < count($target_decode); $k++) {
            $assign_date = $target_decode[$k]['assign_date'];
            $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
            $day = date('d', strtotime($assign_date));
            $dateObj = DateTime::createFromFormat('!m', $month);

            // Store the month name to variable
            $monthName = $dateObj->format('F');
            $full_format = $day . ' ' . $monthName;
            $date_arr[] = $full_format;
        }

        $time = DB::select('SELECT SUM("time".div_actual_target) AS t_actual_target FROM time
        WHERE DATE("time".created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
        GROUP BY "time".assign_date');

        $time_decode = json_decode(json_encode($time), true);
        $time_arr = [];
        for ($i = 0; $i < count($time_decode); $i++) {
            $t_div_actual_target = $time_decode[$i]['t_actual_target'];
            $time_arr[] = $t_div_actual_target;
        }

        DB::disconnect('musung');

        return $this->chart->areaChart()

            ->setTitle('Production Report of last 30 days')
            ->setSubtitle('Target vs Actual Target')
            ->addData('Target', $target_arr)
            ->addData('Actual Target', $time_arr)
            ->setXAxis($date_arr)
            ->setGrid(false, '#3F51B5', 0.1)
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setDataLabels(true);
    }
}
