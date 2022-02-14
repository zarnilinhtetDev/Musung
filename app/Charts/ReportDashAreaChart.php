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
        $month = date('m'); // Create date object to store the DateTime format
        $dateObj = DateTime::createFromFormat('!m', $month);

        // Store the month name to variable
        $monthName = $dateObj->format('F');

        $target = DB::select('SELECT SUM("line_assign".main_target) AS t_main_target FROM line_assign
WHERE DATE("line_assign".created_at) >= DATE(NOW()) - INTERVAL \'360\' DAY
GROUP BY "line_assign".assign_date ORDER BY "line_assign".assign_date ASC');

        $target_decode = json_decode(json_encode($target), true);
        $target_arr = [];
        for ($i = 0; $i < count($target_decode); $i++) {
            $t_main_target = $target_decode[$i]['t_main_target'];
            $target_arr[] = $t_main_target;
        }

        $time = DB::select('SELECT DISTINCT SUM("time".div_actual_target) AS t_actual_target FROM time
        WHERE DATE("time".created_at) >= DATE(NOW()) - INTERVAL \'360\' DAY
        GROUP BY "time".assign_date');
        $time_decode = json_decode(json_encode($time), true);
        $time_arr = [];
        for ($i = 0; $i < count($time_decode); $i++) {
            $t_div_actual_target = $time_decode[$i]['t_actual_target'];
            $time_arr[] = $t_div_actual_target;
        }

        DB::disconnect('musung');
        $year = date('Y');

        return $this->chart->areaChart()

            ->setTitle('Production Report of ' . $year)
            ->setSubtitle('Target vs Actual Target')
            ->addData('Target', $target_arr)
            ->addData('Actual Target', $time_arr)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
            ->setGrid(false, '#3F51B5', 0.1)
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setDataLabels(true);
    }
}
